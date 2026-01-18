<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Smalot\PdfParser\Parser;

class BuildNidIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf:build-index 
                            {--force : Force rebuild even if index exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build NID index from all PDF files (scans PDFs once)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pdfPath = public_path('pdf');
        $indexPath = storage_path('app/nid_index.json');

        // Check if PDF directory exists
        if (!File::exists($pdfPath)) {
            $this->error("PDF directory not found: {$pdfPath}");
            return 1;
        }

        // Check if index already exists (unless --force)
        if (File::exists($indexPath) && !$this->option('force')) {
            if (!$this->confirm('Index file already exists. Do you want to rebuild it?')) {
                $this->info('Index build cancelled.');
                return 0;
            }
        }

        $this->info('Starting PDF indexing process...');
        $this->info("PDF Directory: {$pdfPath}");
        $this->info("Index will be saved to: {$indexPath}");

        // Get all PDF files
        $pdfFiles = File::files($pdfPath);
        $pdfFiles = array_filter($pdfFiles, function ($file) {
            return strtolower($file->getExtension()) === 'pdf';
        });

        if (empty($pdfFiles)) {
            $this->error('No PDF files found in the directory.');
            return 1;
        }

        $totalPdfs = count($pdfFiles);
        $this->info("Found {$totalPdfs} PDF files to process.");
        $this->newLine();

        // Initialize index array: NID => PDF filename
        $nidIndex = [];
        $parser = new Parser();
        $progressBar = $this->output->createProgressBar($totalPdfs);
        $progressBar->start();

        $processedCount = 0;
        $totalNids = 0;
        $errors = [];

        foreach ($pdfFiles as $index => $pdfFile) {
            $filename = $pdfFile->getFilename();
            $filePath = $pdfFile->getRealPath();

            try {
                // Parse PDF
                $pdf = $parser->parseFile($filePath);

                // Extract text from all pages
                $text = $pdf->getText();

                // Convert Bangla digits to English digits for consistent matching
                $text = $this->banglaToEnglish($text);

                // Extract NID numbers using flexible regex patterns
                // NIDs can be: plain digits (1234567890), with spaces (123 456 789), with dashes (123-456-789)
                // Pattern 1: Plain digits 10-17 chars
                preg_match_all('/\b\d{10,17}\b/', $text, $matches1);
                
                // Pattern 2: Digits with spaces or dashes (e.g., "123 456 7890" or "123-456-7890")
                // Matches 10-17 digits with optional spaces/dashes between
                preg_match_all('/(?:\d[\s-]?){10,17}\d/', $text, $matches2);
                
                // Combine matches
                $matches = array_merge($matches1[0] ?? [], $matches2[0] ?? []);

                if (!empty($matches)) {
                    // Remove duplicates and normalize NIDs (remove spaces, dashes, and non-digits)
                    $uniqueNids = array_unique(array_map(function ($nid) {
                        // Remove all non-digit characters for normalization
                        return preg_replace('/\D/', '', trim($nid));
                    }, $matches));

                    // Store in index: NID => PDF filename
                    foreach ($uniqueNids as $nid) {
                        // Normalize NID (should already be digits only, but ensure)
                        $normalizedNid = preg_replace('/\D/', '', $nid);
                        
                        // Validate NID length (10-17 digits)
                        if (strlen($normalizedNid) < 10 || strlen($normalizedNid) > 17) {
                            continue; // Skip invalid NIDs
                        }
                        
                        // If NID already exists, append to array (in case same NID in multiple PDFs)
                        if (isset($nidIndex[$normalizedNid])) {
                            // If not already in array, add it
                            if (!is_array($nidIndex[$normalizedNid])) {
                                $nidIndex[$normalizedNid] = [$nidIndex[$normalizedNid]];
                            }
                            if (!in_array($filename, $nidIndex[$normalizedNid])) {
                                $nidIndex[$normalizedNid][] = $filename;
                            }
                        } else {
                            $nidIndex[$normalizedNid] = $filename;
                        }
                    }

                    $totalNids += count($uniqueNids);
                }

                $processedCount++;
            } catch (\Exception $e) {
                $errors[] = [
                    'file' => $filename,
                    'error' => $e->getMessage()
                ];
                $this->warn("\nError processing {$filename}: " . $e->getMessage());
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        // Save index to JSON file
        try {
            // Ensure storage/app directory exists
            $storageDir = storage_path('app');
            if (!File::exists($storageDir)) {
                File::makeDirectory($storageDir, 0755, true);
            }

            // Convert single filenames to arrays for consistency in search
            $normalizedIndex = [];
            foreach ($nidIndex as $nid => $pdfName) {
                $normalizedIndex[$nid] = is_array($pdfName) ? $pdfName : [$pdfName];
            }

            File::put($indexPath, json_encode($normalizedIndex, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            // Display summary
            $this->info("✓ Indexing completed successfully!");
            $this->newLine();
            $this->table(
                ['Metric', 'Count'],
                [
                    ['PDFs Processed', $processedCount],
                    ['PDFs with Errors', count($errors)],
                    ['Unique NIDs Found', count($normalizedIndex)],
                    ['Total NID Entries', $totalNids],
                    ['Index File Size', $this->formatBytes(File::size($indexPath))],
                ]
            );

            if (!empty($errors)) {
                $this->newLine();
                $this->warn('Errors encountered:');
                foreach ($errors as $error) {
                    $this->line("  - {$error['file']}: {$error['error']}");
                }
            }

            $this->newLine();
            $this->info("Index saved to: {$indexPath}");
            $this->info("You can now use the search functionality. Search time will be under 1 second.");

            return 0;
        } catch (\Exception $e) {
            $this->error("Failed to save index file: " . $e->getMessage());
            return 1;
        }
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
     * Format bytes to human readable size
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
