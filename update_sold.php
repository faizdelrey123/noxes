<?php
$path = 'C:/xampp/htdocs/noxes/resources/views/user/products/detail.blade.php';
$content = file_get_contents($path);
$content = str_replace('250 terjual', '{{ $product->terjual }} terjual', $content);
file_put_contents($path, $content);
echo "Updated sold count dynamically.";
?>
