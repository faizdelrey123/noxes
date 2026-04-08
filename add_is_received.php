<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

if (!Schema::hasColumn('orders', 'is_received')) {
    Schema::table('orders', function (Blueprint $table) {
        $table->boolean('is_received')->default(false);
    });
    echo "Added is_received column.\n";
} else {
    echo "Column is_received already exists.\n";
}
