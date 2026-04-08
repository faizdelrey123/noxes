<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

if (!Schema::hasColumn('orders', 'tracking_level')) {
    Schema::table('orders', function (Blueprint $table) {
        $table->integer('tracking_level')->default(0);
    });
    echo "Added tracking_level column.\n";
} else {
    echo "Column tracking_level already exists.\n";
}
