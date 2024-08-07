<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'sendMail/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    $full_name = $first_name . ' ' . $last_name;

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script type="text/javascript">';
        echo 'alert("Invalid email address. Please enter a valid email address.");';
        echo 'window.history.back();';
        echo '</script>';
        exit();
    }

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Enable SMTP debugging
        $mail->SMTPDebug = 2; // Set to 0 for no debugging, 1 for client messages, and 2 for client and server messages

        // Email configuration settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'princeharshdeep66@gmail.com'; // Use new email address
        $mail->Password = 'ohtzbjiqeuaowfsf'; // Use new email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient email addresses
        $mail->setFrom('princeharshdeep66@gmail.com', 'Harsh deep');
        $mail->addAddress('princeharshdeep66@gmail.com', 'Harsh deep');

        // Attach the image
         $mail->addEmbeddedImage('C:\project\Web1-main\Web1-main\images\header\logo.png', 'logo_img');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Email from ' . $full_name;
        
        $bodyContent = "<div style='text-align: center;'>";
        $bodyContent .= "<img src='cid:logo_img' alt='Logo' style='width: 200px; height: auto;'><br>";
        $bodyContent .= "</div>";
        $bodyContent .= "<div style='text-align: left;'>";
        $bodyContent .= "<h1>test</h1>";
        $bodyContent .= "<h2>Inquiry from contact form</h2>";
        $bodyContent .= '<h3>' . $full_name . ' Is Trying To Connect With You For ' . $subject . ' </h3>';
        $bodyContent .= '<p>Name: ' . $full_name . '</p>';
        $bodyContent .= '<p>Email: ' . $email . '</p>';
        $bodyContent .= '<p>Subject: ' . $subject . '</p>';
        $bodyContent .= '<p>Message: ' . $message . '</p>';
        $bodyContent .= "</div>";

        $mail->Body = $bodyContent;

        // Send the email
        $mail->send();
        echo '<script type="text/javascript">';
        echo 'alert("Thank you for the message. We will contact you shortly.");';
        echo 'window.location.href = "index.html";'; // Change "index.html" to the path of your home page
        echo '</script>';
        exit();
    } catch (Exception $e) {
        echo 'Message was not sent. Mailer error: ' . $mail->ErrorInfo;
    }
}
?>
