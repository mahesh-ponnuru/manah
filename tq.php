<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            text-align: center;
            padding: 50px;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <h2>✅ Message Sent Successfully!</h2>
    <p>Redirecting you back in 3 seconds...</p>

    <script type="text/javascript">
        setTimeout(function() {
            window.close(); // Close this popup
        }, 3000);
    </script>
</body>
</html>
