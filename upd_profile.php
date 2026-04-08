<?php
$file = 'c:/xampp/htdocs/noxes/resources/views/user/profile.blade.php';
$content = file_get_contents($file);

$search1 = "<!-- STATUS -->\n<div class=\"flex justify-between items-center mb-4\">\n\n    <p class=\"font-medium\">Status Pesanan :</p>\n\n    <span class=\"px-4 py-1 rounded-full text-white text-sm";
$replace1 = "<!-- STATUS -->\n<div class=\"flex justify-between items-center mb-4\">\n\n    <p class=\"font-medium\">Status Pesanan :</p>\n\n    <div class=\"flex items-center gap-3\">\n        @if(isset(\$unnotified_ids) && in_array(\$order->id, \$unnotified_ids))\n            <div title=\"Status Pesanan Baru Diperbarui!\" class=\"flex items-center gap-2 text-red-500 text-sm font-bold\">\n                <span class=\"relative flex h-3 w-3\">\n                  <span class=\"animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75\"></span>\n                  <span class=\"relative inline-flex rounded-full h-3 w-3 bg-red-500\"></span>\n                </span>\n                Baru\n            </div>\n        @endif\n\n        <span class=\"px-4 py-1 rounded-full text-white text-sm";

$search2 = "            Selesai\n        @endif\n    </span>\n\n</div>";
$replace2 = "            Selesai\n        @endif\n    </span>\n    </div>\n</div>";

$content = str_replace(str_replace("\r", "", $search1), str_replace("\r", "", $replace1), str_replace("\r", "", $content));
$content = str_replace(str_replace("\r", "", $search2), str_replace("\r", "", $replace2), str_replace("\r", "", $content));

file_put_contents($file, $content);
echo "Profile view updated.\n";
