-- Datei: 002_add_roles.sql
-- Ergänzt die Rolle "supervisor" zur User-Tabelle

ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'azubi', 'pl', 'tl', 'ausbilder', 'supervisor') NOT NULL;