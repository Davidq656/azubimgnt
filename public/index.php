<?php
// Erzwinge HTTPS, falls die Seite über HTTP aufgerufen wird
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], true, 301);
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Willkommen im Ausbildungsmanagement</h2>
        <p id="user-info">Lade Benutzerdaten...</p>
        <button onclick="logout()">Logout</button>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let token = localStorage.getItem("token");
        if (!token) {
            window.location.href = "login.php";
        } else {
            fetch("/services/auth_service.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ action: "validate", token: token })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("user-info").innerText = "Eingeloggt als: " + data.role;
                } else {
                    localStorage.removeItem("token");
                    window.location.href = "login.php";
                }
            })
            .catch(error => console.error("Fehler:", error));
        }
    });

    function logout() {
        localStorage.removeItem("token");
        window.location.href = "login.php";
    }
    </script>
</body>
</html>
