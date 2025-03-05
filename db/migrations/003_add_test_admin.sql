-- Datei: 003_add_test_admin.sql
-- Fügt einen Test-Admin-Benutzer hinzu

INSERT INTO users (email, password_hash, role) 
VALUES ('admin@example.com', '$2y$10$VbM4G1j9/uOj1gUueyI6iOZyXrzovW1HrHNLujZsJNOeOaGk28qzK', 'admin');