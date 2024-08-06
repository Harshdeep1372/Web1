<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $first_name = htmlspecialchars(trim($_POST["first_name"]));
    $last_name = htmlspecialchars(trim($_POST["last_name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Basic validation (additional validation can be added)
    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($message)) {
        // Set the recipient email address
        $to = "hardee772783@gmail.com"; // Replace with the recipient's email address

        // Set the email subject
        $email_subject = "New Contact Form Submission from " . $first_name . " " . $last_name;

        // Create the email content
        $body = "You have received a new message from your website contact form.\n\n";
        $body .= "Here are the details:\n";
        $body .= "First Name: " . $first_name . "\n";
        $body .= "Last Name: " . $last_name . "\n";
        $body .= "Email: " . $email . "\n";
        $body .= "Subject: " . $subject . "\n";
        $body .= "Message: \n" . $message . "\n";

        // Set additional headers
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Send the email
        if (mail($to, $email_subject, $body, $headers)) {
            echo 1; // Success response
        } else {
            echo 0; // Error response
        }
    } else {
        echo 0; // Error response for missing fields
    }
} else {
    echo 0; // Invalid request method
}
?>
