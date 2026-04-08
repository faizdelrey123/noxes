<?php
$files = array_merge(
    glob('C:/xampp/htdocs/noxes/resources/views/user/*.blade.php'),
    glob('C:/xampp/htdocs/noxes/resources/views/user/*/*.blade.php'),
    glob('C:/xampp/htdocs/noxes/resources/views/auth/*.blade.php'),
    glob('C:/xampp/htdocs/noxes/resources/views/checkout.blade.php')
);

$pattern = '/<a href="\{\{ route\(\'profile\'\) \}\}">(.*?)<img src="\{\{ asset\(\'images\/profile\.png\'\) \}\}" alt="Profile"(.*?)><\/a>/s';

$replacement = <<<HTML
<a href="{{ route('profile') }}" class="relative">\n$1<img src="{{ asset('images/profile.png') }}" alt="Profile"$2>
                @php
                    \$unreadOrders = \\App\Models\Order::where('user_id', auth()->id())->where('is_notified', false)->count();
                @endphp
                @if(\$unreadOrders > 0)
                    <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>
                @endif
            </a>
HTML;

foreach ($files as $file) {
    if (is_file($file)) {
        $content = file_get_contents($file);
        $newContent = preg_replace($pattern, $replacement, $content);
        if ($newContent !== $content) {
            file_put_contents($file, $newContent);
            echo "Updated navbar in " . basename($file) . "\n";
        }
    }
}
