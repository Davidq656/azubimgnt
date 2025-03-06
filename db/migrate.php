<?php
require '../config/config.php'; // Stellt die DB-Verbindung her

header('Content-Type: text/plain');

$migrationsDir = __DIR__ . "/migrations/";
$migrations = glob($migrationsDir . "*.sql"); // Alle SQL-Dateien abrufen
sort($migrations); // Dateien in Reihenfolge ausführen (001, 002, 003...)

foreach ($migrations as $file) {
    $sql = file_get_contents($file);
    
    try {
        $pdo->exec($sql);
        echo "Migration " . basename($file) . " erfolgreich ausgeführt.\n";
    } catch (PDOException $e) {
        echo "Fehler bei " . basename($file) . ": " . $e->getMessage() . "\n";
    }
}
?>