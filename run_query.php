<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=noxes_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Ignore error if column already exists
    try {
        $pdo->exec('ALTER TABLE orders ADD COLUMN is_notified BOOLEAN DEFAULT 1;');
        echo "Column is_notified added successfully.\n";
    } catch (PDOException $e) {
        echo "Column might already exist: " . $e->getMessage() . "\n";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
