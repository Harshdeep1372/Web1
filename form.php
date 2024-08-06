<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $first_name = htmlspecialchars(trim($_POST["first_name"]));
    $last_name = htmlspecialchars(trim($_POST["last_name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Set the recipient email address
    $to = "hardee772783@gmail.com"; // Replace with the recipient's email address

    // Set the email subject
    $subject = "New Contact Form Submission from " . $name;

    // Create the email content
    $body = "You have received a new message from your website contact form.\n\n";
    $body .= "Here are the details:\n";
    $body .= "Name: " . $first_name . "\n";
    $body .= "Name: " . $last_name . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Name: " . $subject . "\n";
    $body .= "Message: \n" . $message . "\n";

    // Set additional headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you, your message has been sent.";
    } else {
        echo "Sorry, there was an error sending your message. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
?>
