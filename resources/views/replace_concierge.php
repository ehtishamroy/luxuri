<?php
$src = __DIR__ . '/concierge.blade.php.new';
$dst = __DIR__ . '/concierge.blade.php';
if (file_exists($src)) {
    $content = file_get_contents($src);
    file_put_contents($dst, $content);
    unlink($src);
    echo "Replaced successfully\n";
} else {
    echo "Source file not found: $src\n";
}
