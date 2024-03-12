<?php
// Generate a nonce value
$nonce = bin2hex(random_bytes(16)); // Generate a random nonce value
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Include the generated nonce value in the CSP meta tag -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; style-src 'self' 'nonce-<?php echo $nonce; ?>';">
    <!-- You can also add other CSP directives as needed -->
</head>
<body>
    <h1>Welcome to the Home Page</h1>
    <p>This is the content of the home page.</p>
    <p>Any inline styles will be subject to the CSP with the nonce value.</p>
</body>
</html>