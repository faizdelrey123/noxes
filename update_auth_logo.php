<?php

$dir = new RecursiveDirectoryIterator('C:/xampp/htdocs/noxes/resources/views/auth');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/.*\.blade\.php$/', RegexIterator::GET_MATCH);

$search1 = '<h1 class="text-4xl font-bold text-[#1E5C4F]">
        <a href="{{ route(\'home\') }}">NOXÉS</a>
    </h1>';

$search2 = '<h1 class="text-4xl font-bold text-[#1E5C4F]">
            <a href="{{ route(\'home\') }}">NOXÉS</a>
        </h1>';

$replaceNavbar = '<h1 class="text-4xl font-black tracking-tighter italic">
        <a href="{{ route(\'home\') }}" class="flex items-center gap-1 group">
            <span class="text-transparent bg-clip-text bg-gradient-to-br from-[#1E5C4F] to-[#4ade80] group-hover:from-[#15463b] group-hover:to-[#22c55e] transition-all duration-500 drop-shadow-md">NOX</span>
            <span class="text-[#1E5C4F] group-hover:text-[#15463b] transition-colors duration-500">ÉS</span>
            <div class="w-2 h-2 rounded-full bg-[#4ade80] self-end mb-1.5 group-hover:animate-bounce"></div>
        </a>
    </h1>';

$searchBig5xl = '<h1 class="text-5xl font-bold text-green-800 mb-6">NOXÉS</h1>';
$replaceBig5xl = '<h1 class="text-6xl font-black tracking-tighter italic mb-8 flex items-center gap-1 drop-shadow-sm cursor-default hover:scale-105 transition-transform duration-500">
            <span class="text-transparent bg-clip-text bg-gradient-to-br from-[#1E5C4F] to-[#4ade80]">NOX</span>
            <span class="text-[#1E5C4F]">ÉS</span>
            <div class="w-3 h-3 rounded-full bg-[#4ade80] self-end mb-2animate-pulse"></div>
        </h1>';

$searchBig4xl = '<h1 class="text-4xl font-bold text-green-800 mb-6">NOXÉS</h1>';
$replaceBig4xl = '<h1 class="text-5xl font-black tracking-tighter italic mb-8 flex items-center justify-center gap-1 drop-shadow-sm cursor-default hover:scale-105 transition-transform duration-500">
            <span class="text-transparent bg-clip-text bg-gradient-to-br from-[#1E5C4F] to-[#4ade80]">NOX</span>
            <span class="text-[#1E5C4F]">ÉS</span>
            <div class="w-2.5 h-2.5 rounded-full bg-[#4ade80] self-end mb-1.5 animate-pulse"></div>
        </h1>';

foreach ($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    
    // Normalize newlines
    $normalizedContent = preg_replace('/\r\n/', "\n", $content);
    
    // Replace Navbars
    $normalizedSearch1 = preg_replace('/\r\n/', "\n", $search1);
    if (strpos($normalizedContent, $normalizedSearch1) !== false) {
        $normalizedContent = str_replace($normalizedSearch1, $replaceNavbar, $normalizedContent);
    }
    
    $normalizedSearch2 = preg_replace('/\r\n/', "\n", $search2);
    if (strpos($normalizedContent, $normalizedSearch2) !== false) {
        $normalizedContent = str_replace($normalizedSearch2, $replaceNavbar, $normalizedContent);
    }
    
    // Replace Big 5XL
    $normalizedContent = str_replace($searchBig5xl, $replaceBig5xl, $normalizedContent);
    
    // Replace Big 4XL
    $normalizedContent = str_replace($searchBig4xl, $replaceBig4xl, $normalizedContent);
    
    // Write back
    $content = str_replace("\n", "\r\n", $normalizedContent);
    file_put_contents($path, $content);
    echo "Updated $path\n";
}

?>
