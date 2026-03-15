<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $to = "info@renewpoly.com";
    $subject = "Neue Nachricht vom Kontaktformular";

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $consent = $_POST['consent'] ?? '';

    if (empty($name) || empty($email) || empty($message)) {
        echo "Bitte alle Felder ausfüllen.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Ungültige E-Mail-Adresse.";
        exit;
    }

    if ($consent !== 'yes') {
        echo "Bitte stimmen Sie der Datenverarbeitung zu.";
        exit;
    }

    // Protect against header injection
    $name = str_replace(["\r", "\n"], ' ', $name);
    $email = str_replace(["\r", "\n"], '', $email);

    $body = "Name: $name\n";
    $body .= "E-Mail: $email\n\n";
    $body .= "Nachricht:\n$message";

    $headers = "From: website@renewpoly.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "Nachricht erfolgreich gesendet!";
    } else {
        echo "Beim Senden der Nachricht ist ein Fehler aufgetreten.";
    }
}
?>
