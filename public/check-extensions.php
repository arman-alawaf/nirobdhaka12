<?php
/**
 * PHP Extensions Diagnostic Script
 * 
 * This script checks if required PHP extensions are loaded,
 * especially the zip extension needed for Excel import/export.
 * 
 * Access via: http://localhost/nirobfordhaka12/public/check-extensions.php
 */

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Extensions Check - Laravel Excel Import</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
        }
        .extension {
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border-left: 4px solid #ccc;
        }
        .extension.required {
            border-left-color: #dc3545;
        }
        .extension.optional {
            border-left-color: #ffc107;
        }
        .extension.loaded {
            border-left-color: #28a745;
        }
        .status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin-left: 10px;
        }
        .status.loaded {
            background: #28a745;
            color: white;
        }
        .status.missing {
            background: #dc3545;
            color: white;
        }
        .info {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #007bff;
        }
        .warning {
            background: #fff3cd;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #ffc107;
        }
        .error {
            background: #f8d7da;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #dc3545;
        }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }
        .php-version {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 PHP Extensions Diagnostic</h1>
        
        <div class="php-version">
            <strong>PHP Version:</strong> <?php echo PHP_VERSION; ?><br>
            <strong>PHP Configuration File:</strong> <?php echo php_ini_loaded_file(); ?>
        </div>

        <?php
        // Required extensions for Excel import/export
        $requiredExtensions = [
            'zip' => [
                'name' => 'Zip Extension',
                'description' => 'Required for reading/writing Excel files (.xlsx). PhpSpreadsheet uses this to handle ZIP archives.',
                'critical' => true
            ],
            'xml' => [
                'name' => 'XML Extension',
                'description' => 'Required for XML processing in Excel files.',
                'critical' => true
            ],
            'mbstring' => [
                'name' => 'Multibyte String',
                'description' => 'Required for string manipulation with multibyte characters.',
                'critical' => true
            ],
            'pdo_mysql' => [
                'name' => 'PDO MySQL',
                'description' => 'Required for database connections.',
                'critical' => true
            ],
            'openssl' => [
                'name' => 'OpenSSL',
                'description' => 'Required for secure connections and encryption.',
                'critical' => false
            ],
            'gd' => [
                'name' => 'GD Library',
                'description' => 'Optional: Used for image processing.',
                'critical' => false
            ],
        ];

        $allLoaded = true;
        $criticalMissing = false;

        foreach ($requiredExtensions as $ext => $info) {
            $isLoaded = extension_loaded($ext);
            $allLoaded = $allLoaded && $isLoaded;
            
            if ($info['critical'] && !$isLoaded) {
                $criticalMissing = true;
            }
            
            $class = $isLoaded ? 'loaded' : ($info['critical'] ? 'required' : 'optional');
            $status = $isLoaded ? 'LOADED' : 'MISSING';
            $statusClass = $isLoaded ? 'loaded' : 'missing';
            
            echo "<div class='extension {$class}'>";
            echo "<strong>{$info['name']}</strong> ";
            echo "<span class='status {$statusClass}'>{$status}</span>";
            echo "<br><small>{$info['description']}</small>";
            echo "</div>";
        }

        // Check ZipArchive class specifically
        echo "<div style='margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 5px;'>";
        echo "<h3>ZipArchive Class Check</h3>";
        
        if (class_exists('ZipArchive')) {
            echo "<div class='info'>";
            echo "✅ <strong>ZipArchive class is available!</strong><br>";
            echo "This means the zip extension is properly loaded and Excel import should work.";
            echo "</div>";
        } else {
            echo "<div class='error'>";
            echo "❌ <strong>ZipArchive class is NOT found!</strong><br>";
            echo "This is the exact error you're experiencing. The zip extension needs to be enabled in php.ini.";
            echo "</div>";
        }
        echo "</div>";

        // Show instructions if zip is missing
        if (!extension_loaded('zip') || !class_exists('ZipArchive')) {
            echo "<div class='error'>";
            echo "<h3>🔧 How to Fix:</h3>";
            echo "<ol>";
            echo "<li>Open XAMPP Control Panel</li>";
            echo "<li>Click <strong>Config</strong> button next to Apache</li>";
            echo "<li>Select <strong>PHP (php.ini)</strong></li>";
            echo "<li>Search for: <code>;extension=zip</code></li>";
            echo "<li>Remove the semicolon: <code>extension=zip</code></li>";
            echo "<li>Save the file and restart Apache</li>";
            echo "</ol>";
            echo "<p><strong>php.ini location:</strong> <code>" . php_ini_loaded_file() . "</code></p>";
            echo "</div>";
        }

        // Summary
        if ($allLoaded && class_exists('ZipArchive')) {
            echo "<div class='info'>";
            echo "<h3>✅ All Required Extensions Are Loaded!</h3>";
            echo "Your PHP configuration looks good. Excel import/export should work correctly.";
            echo "</div>";
        } else {
            echo "<div class='warning'>";
            echo "<h3>⚠️ Action Required</h3>";
            if ($criticalMissing) {
                echo "Some critical extensions are missing. Please enable them in php.ini and restart Apache.";
            } else {
                echo "Some optional extensions are missing, but they may not be required for basic functionality.";
            }
            echo "</div>";
        }
        ?>

        <div style="margin-top: 30px; padding: 15px; background: #f8f9fa; border-radius: 5px; font-size: 12px; color: #666;">
            <strong>Note:</strong> After making changes to php.ini, you must restart Apache in XAMPP Control Panel for changes to take effect.
        </div>
    </div>
</body>
</html>

