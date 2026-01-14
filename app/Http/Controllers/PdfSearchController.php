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
        $pdfPath = public_path('pdf');
        $pdfs = [];
        
        // Load PDF titles from JSON file
        $titlesPath = storage_path('app/pdf_titles.json');
        $titles = [];
        if (File::exists($titlesPath)) {
            $titlesJson = File::get($titlesPath);
            $titles = json_decode($titlesJson, true) ?? [];
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
}

