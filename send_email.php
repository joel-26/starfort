<?php
session_start();

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: auth.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize input to prevent XSS
    $senderName = htmlspecialchars($_POST['senderName']);
    $senderEmail = htmlspecialchars($_POST['senderEmail']);
    $to = htmlspecialchars($_POST['recipient']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Set headers for the email
    $headers = "From: $senderName <$senderEmail>\r\n";
    $headers .= "Reply-To: $senderEmail\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        // Redirect to email_client.php with success status
        header("Location: email_client.php?status=success");
        exit();
    } else {
        // Redirect to email_client.php with error status
        header("Location: email_client.php?status=error");
        exit();
    }
} else {
    echo "Invalid request method.";
}
?>
