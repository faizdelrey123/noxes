<?php

function updateFile($path, $isEdit) {
    if(!file_exists($path)) return;
    $content = file_get_contents($path);
    if (strpos($content, 'name="spesifikasi"') !== false) return;

    if ($isEdit) {
        $search = '<div class="form-group">
                        <label>Deskripsi Produk</label>
                        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                    </div>';
        $replace = $search . "\n\n" . '                    <div class="form-group">
                        <label>Spesifikasi Produk</label>
                        <textarea name="spesifikasi" class="form-control">{{ $product->spesifikasi }}</textarea>
                    </div>';
    } else {
        $search = '<div class="form-group">
                        <label>Deskripsi Produk</label>
                        <textarea name="description" class="form-control" placeholder="Tuliskan detail produk di sini..."></textarea>
                    </div>';
        $replace = $search . "\n\n" . '                    <div class="form-group">
                        <label>Spesifikasi Produk</label>
                        <textarea name="spesifikasi" class="form-control" placeholder="Tuliskan spesifikasi produk di sini..."></textarea>
                    </div>';
    }
    
    // Fallback regex if exact match fails due to \r\n
    if (strpos($content, trim(explode("\n", $search)[1])) !== false) {
        if ($isEdit) {
            $content = preg_replace('/(<textarea name="description"[^>]*>\{\{\s*\$product->description\s*\}\}<\/textarea>\s*<\/div>)/i', "$1\n\n                    <div class=\"form-group\">\n                        <label>Spesifikasi Produk</label>\n                        <textarea name=\"spesifikasi\" class=\"form-control\">{{ \$product->spesifikasi }}</textarea>\n                    </div>", $content);
        } else {
            $content = preg_replace('/(<textarea name="description"[^>]*><\/textarea>\s*<\/div>)/i', "$1\n\n                    <div class=\"form-group\">\n                        <label>Spesifikasi Produk</label>\n                        <textarea name=\"spesifikasi\" class=\"form-control\" placeholder=\"Tuliskan spesifikasi produk di sini...\"></textarea>\n                    </div>", $content);
        }
        file_put_contents($path, $content);
        echo "Updated $path\n";
    }
}

updateFile('C:/xampp/htdocs/noxes/resources/views/admin/products/create.blade.php', false);
updateFile('C:/xampp/htdocs/noxes/resources/views/admin/products/edit.blade.php', true);
updateFile('C:/xampp/htdocs/noxes/resources/views/staff/product/create.blade.php', false);
updateFile('C:/xampp/htdocs/noxes/resources/views/staff/product/edit.blade.php', true);

?>
