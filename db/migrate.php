<?php
// Automatisches Migrations-Skript für MySQL

require __DIR__ . '/../config/config.php';

$migrations = [
    "001_create_users_table.sql",
    "002_add_roles.sql"
];

foreach ($migrations as $file) {
    $sql = file_get_contents(__DIR__ . "/migrations/$file");
    try {
        $pdo->exec($sql);
        echo "Migration $file erfolgreich ausgeführt.<br>";
    } catch (PDOException $e) {
        echo "Fehler bei Migration $file: " . $e->getMessage() . "<br>";
    }
}
?>
