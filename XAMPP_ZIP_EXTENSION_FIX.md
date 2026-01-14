# Fix: "Class ZipArchive not found" Error in XAMPP

## Problem
After reinstalling XAMPP, you may encounter this error when importing Excel files:
```
Class "ZipArchive" not found
```

This happens because the PHP `zip` extension is not enabled by default in XAMPP.

## Solution: Enable PHP Zip Extension

### Step 1: Locate php.ini File
1. Open XAMPP Control Panel
2. Click **Config** button next to Apache
3. Select **PHP (php.ini)** from the dropdown menu
   - OR manually navigate to: `C:\xampp\php\php.ini`

### Step 2: Enable Zip Extension
1. Open `php.ini` in a text editor (Notepad++ recommended)
2. Press `Ctrl + F` to search for: `;extension=zip`
3. Find the line that looks like:
   ```ini
   ;extension=zip
   ```
4. Remove the semicolon (`;`) at the beginning to uncomment it:
   ```ini
   extension=zip
   ```
5. Save the file (`Ctrl + S`)

### Step 3: Restart Apache
1. In XAMPP Control Panel, click **Stop** for Apache
2. Wait a few seconds
3. Click **Start** for Apache

### Step 4: Verify Extension is Loaded
1. Visit: `http://localhost/phpinfo.php` (if you have phpinfo.php)
2. OR run the diagnostic script: `http://localhost/nirobfordhaka12/public/check-extensions.php`
3. Look for "zip" in the loaded extensions list
4. You should see: `ZipArchive` class is available

## Alternative: Check via Command Line
Open Command Prompt and run:
```bash
php -m | findstr zip
```
If you see `zip` in the output, the extension is enabled.

## Still Not Working?
1. Make sure you edited the correct `php.ini` file (the one used by Apache)
2. Check if `php_zip.dll` exists in `C:\xampp\php\ext\` folder
3. If the DLL is missing, you may need to reinstall XAMPP or download the zip extension separately
4. Verify PHP version matches (PHP 8.2.12 in your case)

## Required PHP Extensions for This Project
- ✅ `zip` - Required for Excel file import/export (PhpSpreadsheet)
- ✅ `xml` - Required for XML processing
- ✅ `gd` - Required for image processing (if used)
- ✅ `mbstring` - Required for string manipulation
- ✅ `openssl` - Required for secure connections
- ✅ `pdo_mysql` - Required for database connections

## Quick Test
After enabling the extension, try importing an Excel file again. The error should be resolved.

