<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "venkat.ch@manah.com";  // Change this to your email
    $subject = $_POST["sbj"];
    $name = $_POST["fname"];
    $email = $_POST["email"];
    $company = $_POST["company"];
    $website = $_POST["website"];
    $query = $_POST["query"];
    $message = $_POST["msg"];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email message
    $body = "
    <html>
    <head>
        <title>Contact Form Submission</title>
    </head>
    <body>
        <h2>Contact Form Details</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Company:</strong> $company</p>
        <p><strong>Website:</strong> $website</p>
        <p><strong>Query:</strong> $query</p>
        <p><strong>Message:</strong><br> $message</p>
    </body>
    </html>";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "Success";
    } else {
        echo "Failed to send email.";
    }
} else {
    echo "Invalid request.";
}
?>
