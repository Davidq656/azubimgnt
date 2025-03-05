-- Erstellt die Users-Tabelle für den Auth-Service
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'azubi', 'pl', 'tl', 'ausbilder') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);