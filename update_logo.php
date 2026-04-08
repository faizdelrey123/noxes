<?php

$dir = new RecursiveDirectoryIterator('C:/xampp/htdocs/noxes/resources/views/user');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/.*\.blade\.php$/', RegexIterator::GET_MATCH);

$search1 = '<h1 class="text-4xl font-bold text-[#1E5C4F]">
        <a href="{{ route(\'home\') }}">NOXÉS</a>
    </h1>';

$search2 = '<h1 class="text-4xl font-bold text-[#1E5C4F]">
            <a href="{{ route(\'home\') }}">NOXÉS</a>
        </h1>';

$replace = '<h1 class="text-4xl font-black tracking-tighter italic">
        <a href="{{ route(\'home\') }}" class="flex items-center gap-1 group">
            <span class="text-transparent bg-clip-text bg-gradient-to-br from-[#1E5C4F] to-[#4ade80] group-hover:from-[#15463b] group-hover:to-[#22c55e] transition-all duration-500 drop-shadow-md">NOX</span>
            <span class="text-[#1E5C4F] group-hover:text-[#15463b] transition-colors duration-500">ÉS</span>
            <div class="w-2 h-2 rounded-full bg-[#4ade80] self-end mb-1.5 group-hover:animate-bounce"></div>
        </a>
    </h1>';

foreach ($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    $original = $content;
    
    // Normalize newlines for searching
    $normalizedContent = preg_replace('/\r\n/', "\n", $content);
    $normalizedSearch1 = preg_replace('/\r\n/', "\n", $search1);
    
    if (strpos($normalizedContent, $normalizedSearch1) !== false) {
        $normalizedContent = str_replace($normalizedSearch1, $replace, $normalizedContent);
        // Put back CRLF so we don't mess up windows editors entirely
        $content = str_replace("\n", "\r\n", $normalizedContent);
        file_put_contents($path, $content);
        echo "Updated $path\n";
    }
}
?>
