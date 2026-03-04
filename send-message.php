<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "info@renewpoly.com"; // Your email
    $subject = "Neue Nachricht vom Kontaktformular";

    // Sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $body = "Name: $name\nE-Mail: $email\nNachricht:\n$message";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "Nachricht erfolgreich gesendet!";
    } else {
        echo "Beim Senden der Nachricht ist ein Fehler aufgetreten.";
    }
}
?>