<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class PdfSearchController extends Controller
{
    /**
     * Get list of all PDFs in public/pdf directory with titles
     */
    public function getPdfList()
    {
        // Increase memory limit before loading large JSON files
        $currentMemoryLimit = ini_get('memory_limit');
        $memoryLimitBytes = $this->convertToBytes($currentMemoryLimit);
        
        // If memory limit is less than 512MB, increase it
        if ($memoryLimitBytes < 512 * 1024 * 1024) {
            @ini_set('memory_limit', '512M');
        }
        
        $pdfPath = public_path('pdf');
        $pdfs = [];
        
        // Load PDF titles from JSON file with memory-efficient approach
        $titlesPath = storage_path('app/pdf_titles.json');
        $titles = [];
        if (File::exists($titlesPath)) {
            $titlesJson = @file_get_contents($titlesPath);
            if ($titlesJson !== false) {
                $titles = json_decode($titlesJson, true) ?? [];
                unset($titlesJson); // Free memory
            }
        }
        
        if (File::exists($pdfPath)) {
            $files = File::files($pdfPath);
            foreach ($files as $file) {
                if (strtolower($file->getExtension()) === 'pdf') {
                    $filename = $file->getFilename();
                    $pdfs[] = [
                        'name' => $filename,
                        'path' => asset('pdf/' . $filename),
                        'size' => $file->getSize(),
                        'title' => $titles[$filename] ?? $filename, // Use title from JSON or fallback to filename
                    ];
                }
            }
        }
        
        // Sort PDFs by filename
        usort($pdfs, function($a, $b) {
            return strnatcmp($a['name'], $b['name']);
        });
        
        return response()->json([
            'success' => true,
            'pdfs' => $pdfs
        ]);
    }

    /**
     * Convert Bangla/Bengali digits to English digits
     */
    private function banglaToEnglish($text)
    {
        if (empty($text)) {
            return '';
        }
        
        $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        
        return str_replace($banglaDigits, $englishDigits, $text);
    }

    /**
     * Search for NID in the index and return corresponding PDF file
     * Fast search using pre-built index - does NOT parse PDFs
     */
    public function searchNid(Request $request)
    {
        // Increase memory limit before loading large JSON files
        $currentMemoryLimit = ini_get('memory_limit');
        $memoryLimitBytes = $this->convertToBytes($currentMemoryLimit);
        
        // If memory limit is less than 512MB, increase it
        if ($memoryLimitBytes < 512 * 1024 * 1024) {
            @ini_set('memory_limit', '512M');
        }
        
        $request->validate([
            'nid' => 'required|string',
        ]);

        $nid = $request->input('nid');
        
        // Convert Bangla digits to English digits first
        $nid = $this->banglaToEnglish($nid);
        
        // Normalize NID (remove spaces and non-digits for consistent searching)
        $normalizedNid = preg_replace('/\D/', '', $nid);

        if (strlen($normalizedNid) < 10 || strlen($normalizedNid) > 17) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid NID format. NID must be 10-17 digits.',
            ], 400);
        }

        // Load index file
        $indexPath = storage_path('app/nid_index.json');

        if (!File::exists($indexPath)) {
            return response()->json([
                'success' => false,
                'message' => 'Index file not found. Please run: php artisan pdf:build-index',
            ], 500);
        }

        try {
            // Read and decode index with memory-efficient approach
            // Use file_get_contents with error handling
            $indexJson = @file_get_contents($indexPath);
            
            if ($indexJson === false) {
                return response()->json([
                    'success' => false,
                    'message' => 'অনুসন্ধান করতে সমস্যা হয়েছে: Could not read index file. Please check file permissions.',
                ], 500);
            }
            
            // Clear memory by unsetting large string before decode
            $nidIndex = json_decode($indexJson, true);
            unset($indexJson); // Free memory immediately

            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json([
                    'success' => false,
                    'message' => 'Index file is corrupted. Please rebuild it: php artisan pdf:build-index',
                ], 500);
            }

            // Search in index (O(1) hash lookup - extremely fast)
            if (isset($nidIndex[$normalizedNid])) {
                $pdfFiles = $nidIndex[$normalizedNid];
                
                // Ensure it's an array
                if (!is_array($pdfFiles)) {
                    $pdfFiles = [$pdfFiles];
                }

                // Load PDF titles with memory-efficient approach
                $titlesPath = storage_path('app/pdf_titles.json');
                $titles = [];
                if (File::exists($titlesPath)) {
                    $titlesJson = @file_get_contents($titlesPath);
                    if ($titlesJson !== false) {
                        $titles = json_decode($titlesJson, true) ?? [];
                        unset($titlesJson); // Free memory
                    }
                }

                // Prepare response with PDF information
                $pdfs = [];
                foreach ($pdfFiles as $filename) {
                    $pdfPath = public_path('pdf/' . $filename);
                    if (File::exists($pdfPath)) {
                        $pdfs[] = [
                            'name' => $filename,
                            'path' => asset('pdf/' . $filename),
                            'title' => $titles[$filename] ?? $filename,
                        ];
                    }
                }

                if (empty($pdfs)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'NID found in index but PDF file(s) not found on disk.',
                    ], 404);
                }

                return response()->json([
                    'success' => true,
                    'found' => true,
                    'nid' => $normalizedNid,
                    'pdfs' => $pdfs,
                    'message' => 'NID found in ' . count($pdfs) . ' PDF file(s).',
                ]);
            } else {
                // NID not found in index
                return response()->json([
                    'success' => true,
                    'found' => false,
                    'nid' => $normalizedNid,
                    'message' => 'NID not found in any PDF. Please verify the NID number.',
                ]);
            }
        } catch (\Exception $e) {
            // Check if it's a memory error
            $errorMessage = $e->getMessage();
            if (strpos($errorMessage, 'memory') !== false || strpos($errorMessage, 'Memory') !== false) {
                return response()->json([
                    'success' => false,
                    'message' => 'অনুসন্ধান করতে সমস্যা হয়েছে: Server memory limit exceeded. Please contact administrator to increase PHP memory limit.',
                ], 500);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'অনুসন্ধান করতে সমস্যা হয়েছে: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Convert memory limit string to bytes
     */
    private function convertToBytes($memoryLimit)
    {
        $memoryLimit = trim($memoryLimit);
        $last = strtolower($memoryLimit[strlen($memoryLimit) - 1]);
        $value = (int) $memoryLimit;
        
        switch ($last) {
            case 'g':
                $value *= 1024;
            case 'm':
                $value *= 1024;
            case 'k':
                $value *= 1024;
        }
        
        return $value;
    }
}

