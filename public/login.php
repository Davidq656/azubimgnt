<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Anmelden</h2>
        <p id="error-msg" class="error" style="display:none;"></p>
        <form id="login-form">
            <input type="email" id="email" placeholder="E-Mail" required>
            <input type="password" id="password" placeholder="Passwort" required>
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
    document.getElementById("login-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Verhindert das Neuladen der Seite
        
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        
        fetch("/services/auth_service.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ email: email, password: password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                localStorage.setItem("token", data.token);
                window.location.href = "index.php"; // Weiterleitung zum Dashboard
            } else {
                document.getElementById("error-msg").innerText = data.message;
                document.getElementById("error-msg").style.display = "block";
            }
        })
        .catch(error => console.error("Fehler:", error));
    });
    </script>
</body>
</html>
