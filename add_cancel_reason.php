<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
DB::statement('ALTER TABLE orders ADD COLUMN cancel_reason TEXT NULL AFTER status');
echo "Column added.";
