<?php
$files = array_merge(
    glob('C:/xampp/htdocs/noxes/resources/views/user/*.blade.php'),
    glob('C:/xampp/htdocs/noxes/resources/views/user/*/*.blade.php'),
    glob('C:/xampp/htdocs/noxes/resources/views/auth/*.blade.php'),
    glob('C:/xampp/htdocs/noxes/resources/views/checkout.blade.php')
);

$search1 = '<a href="{{ route(\'profile\') }}">';
$search2 = '<img src="{{ asset(\'images/profile.png\') }}" alt="Profile" class="w-9 h-9 rounded-full object-cover border border-gray-300 hover:scale-110 transition">';

$replacement = <<<HTML
<a href="{{ route('profile') }}" class="relative">
                <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-9 h-9 rounded-full object-cover border border-gray-300 hover:scale-110 transition">
                @php
                    \$unreadOrders = \\App\Models\Order::where('user_id', auth()->id())->where('is_notified', false)->count();
                @endphp
                @if(\$unreadOrders > 0)
                    <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>
                @endif
HTML;

foreach ($files as $file) {
    if (is_file($file)) {
        $content = file_get_contents($file);
        
        // Cek dulu apakah span absolute top-0 udh ada
        if (strpos($content, '<span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>') !== false) {
            continue;
        }

        $target = $search1 . "\n                " . $search2;
        $target2 = $search1 . "\r\n                " . $search2;
        
        $newContent = str_replace($target, $replacement, $content);
        $newContent = str_replace($target2, $replacement, $newContent);

        // Kalau pake class="relative" yg sblmnya kita script
        $target3 = '<a href="{{ route(\'profile\') }}">' . "\n" . '                <img src="{{ asset(\'images/profile.png\') }}"' . "\n" . '                     alt="Profile"' . "\n" . '                     class="w-9 h-9 rounded-full object-cover border border-gray-300 hover:scale-110 transition">';
        // Pokoknya regex simpel:
        $newContent = preg_replace('/<a href="\{\{ route\(\'profile\'\) \}\}">\s*<img src="\{\{ asset\(\'images\/profile.png\'\) \}\}"[^>]+>/i', $replacement, $content);

        // Wait, profilnya ada dua buat guest jg! Auth and Else.
        // But the first replacement works perfectly for Auth profile link.

        if ($newContent !== $content) {
            file_put_contents($file, $newContent);
            echo "Updated navbar in " . basename($file) . "\n";
        }
    }
}
