<?php
$src = 'e:\xampp\htdocs\luxuri\resources\views\index.blade.php';
$content = file_get_contents($src);
$new = file_get_contents('e:\xampp\htdocs\luxuri\resources\views\reviews-replace.txt');

$oldStart = '<div id="reviews" class="swiper swiper-initialized swiper-horizontal swiper-watch-progress">';
$oldEnd = "</div>\n            </div>\n            <script>";

$posStart = strpos($content, $oldStart);
$posEnd = strpos($content, $oldEnd, $posStart);

if ($posStart === false || $posEnd === false) {
    echo "Markers not found.\n";
    exit(1);
}

$before = substr($content, 0, $posStart);
$after = substr($content, $posEnd + strlen($oldEnd) - 8);

file_put_contents($src, $before . $new . "</div>\n            </div>\n            <script>" . $after);
unlink('e:\xampp\htdocs\luxuri\resources\views\reviews-replace.txt');
unlink(__FILE__);
echo "Reviews replaced successfully.\n";
