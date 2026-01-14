<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class PdfSearchController extends Controller
{
    /**
     * Get list of all PDFs in public/pdf directory
     */
    public function getPdfList()
    {
        $pdfPath = public_path('pdf');
        $pdfs = [];
        
        if (File::exists($pdfPath)) {
            $files = File::files($pdfPath);
            foreach ($files as $file) {
                if (strtolower($file->getExtension()) === 'pdf') {
                    $pdfs[] = [
                        'name' => $file->getFilename(),
                        'path' => asset('pdf/' . $file->getFilename()),
                        'size' => $file->getSize(),
                    ];
                }
            }
        }
        
        return response()->json([
            'success' => true,
            'pdfs' => $pdfs
        ]);
    }
}

