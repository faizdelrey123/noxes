<?php

$path = 'C:/xampp/htdocs/noxes/resources/views/user/products/detail.blade.php';
$content = file_get_contents($path);

// Fallback regex because exact string search might fail with trailing whitespace / formatting
$searchRegex = '/<p class="text-gray-600 leading-relaxed mb-10">\s*\{\{\s*\$product->description\s*\}\}\s*<\/p>/i';

$replace = '<div class="mb-6">
            <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                {{ $product->description }}
            </p>
        </div>
        
        @if($product->spesifikasi)
        <div class="mb-10 p-6 bg-gray-50 rounded-xl border border-gray-100">
            <h4 class="text-lg font-bold text-[#1E5C4F] mb-3">Spesifikasi Produk</h4>
            <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                {{ $product->spesifikasi }}
            </p>
        </div>
        @else
        <div class="mb-10"></div>
        @endif';

if (preg_match($searchRegex, $content)) {
    $content = preg_replace($searchRegex, $replace, $content);
    file_put_contents($path, $content);
    echo "Updated successfully.";
} else {
    echo "Pattern not found in file.";
}
?>
