<?php
// Image Path Checker
// Save this as check_paths.php and run it in your browser

echo "<h2>Image Path Debugging Tool</h2>";
echo "<style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    .success { color: green; font-weight: bold; }
    .error { color: red; }
    .info { color: blue; }
    .path { background: #f5f5f5; padding: 5px; margin: 5px 0; border-left: 3px solid #ccc; }
</style>";

// 1. Show current environment info
echo "<h3>Environment Information:</h3>";
echo "<div class='path'><strong>Current File Location (__DIR__):</strong> " . __DIR__ . "</div>";
echo "<div class='path'><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</div>";
echo "<div class='path'><strong>Script Name:</strong> " . $_SERVER['SCRIPT_NAME'] . "</div>";

// 2. List all possible upload directories
echo "<h3>Checking Common Upload Directory Locations:</h3>";

$uploadPaths = [
    'Same level as current file' => __DIR__ . '/uploads/',
    'Admin uploads from current' => __DIR__ . '/admin/uploads/',
    'Parent dir + uploads' => dirname(__DIR__) . '/uploads/',
    'Parent dir + admin/uploads' => dirname(__DIR__) . '/admin/uploads/',
    'Document root + uploads' => $_SERVER['DOCUMENT_ROOT'] . '/uploads/',
    'Document root + admin/uploads' => $_SERVER['DOCUMENT_ROOT'] . '/admin/uploads/',
];

foreach ($uploadPaths as $description => $path) {
    $exists = is_dir($path);
    $readable = $exists && is_readable($path);
    
    echo "<div class='path'>";
    echo "<strong>$description:</strong><br>";
    echo "Path: $path<br>";
    echo "Exists: " . ($exists ? "<span class='success'>YES</span>" : "<span class='error'>NO</span>") . "<br>";
    if ($exists) {
        echo "Readable: " . ($readable ? "<span class='success'>YES</span>" : "<span class='error'>NO</span>") . "<br>";
        
        // List files in directory
        $files = glob($path . '*');
        if ($files) {
            echo "Files found: " . count($files) . "<br>";
            echo "<small>";
            foreach (array_slice($files, 0, 10) as $file) { // Show first 10 files
                $filename = basename($file);
                echo "- $filename<br>";
            }
            if (count($files) > 10) {
                echo "... and " . (count($files) - 10) . " more files<br>";
            }
            echo "</small>";
        } else {
            echo "<span class='info'>Directory is empty</span><br>";
        }
    }
    echo "</div><br>";
}

// 3. Test with a sample image filename
echo "<h3>Testing with Sample Image:</h3>";
$sampleImage = "sample.jpg"; // Change this to an actual image filename from your database

echo "<p><strong>Testing with filename:</strong> <code>$sampleImage</code></p>";
echo "<p><em>Change the \$sampleImage variable above to test with your actual image filename</em></p>";

foreach ($uploadPaths as $description => $path) {
    $fullPath = $path . $sampleImage;
    $exists = file_exists($fullPath);
    
    echo "<div class='path'>";
    echo "<strong>$description:</strong><br>";
    echo "Full path: $fullPath<br>";
    echo "File exists: " . ($exists ? "<span class='success'>YES</span>" : "<span class='error'>NO</span>");
    echo "</div>";
}

// 4. Show recommended web paths
echo "<h3>Web Path Recommendations:</h3>";
echo "<p>If your images are found in any of the directories above, use these web paths:</p>";

$webPaths = [
    'If in document root/uploads' => 'uploads/',
    'If in document root/admin/uploads' => 'admin/uploads/',
    'If in same level as this file' => 'uploads/', // Assuming this file is in web root
];

foreach ($webPaths as $condition => $webPath) {
    echo "<div class='path'>";
    echo "<strong>$condition:</strong><br>";
    echo "Use web path: <code>$webPath</code><br>";
    echo "Full example: <code>&lt;img src=\"{$webPath}your-image.jpg\"&gt;</code>";
    echo "</div>";
}

echo "<hr>";
echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>Look for directories marked with <span class='success'>YES</span> above</li>";
echo "<li>Check if your images are actually in those directories</li>";
echo "<li>Update your \$sampleImage variable above with a real filename and refresh</li>";
echo "<li>Use the corresponding server path and web path in your code</li>";
echo "</ol>";
?>