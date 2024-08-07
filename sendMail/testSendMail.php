<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'sendMail/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate phone number
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        die('Invalid phone number. Please enter a valid 10-digit phone number.');
    }

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Your email configuration settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'akshpateltop2025@gmail.com'; // Updated Gmail email address
        $mail->Password = 'tnqhtjbfcxgaeior'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient email addresses
        $mail->setFrom('akshpateltop2025@gmail.com', 'DR IMRAN PATEL');
        $mail->addAddress('akshpateltop2025@gmail.com', 'DR IMRAN PATEL');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Email from ' . $full_name;
        $bodyContent = "<h1>Hello!</h1>";
        $bodyContent .= '<p>' . $full_name . ' is trying to connect with you for ' . $subject . ' inquiry</p>';
        $bodyContent .= '<p>Name: ' . $full_name . '</p>';
        $bodyContent .= '<p>Email: ' . $email . '</p>';
        $bodyContent .= '<p>Contact Number: ' . $phone . '</p>';
        $bodyContent .= '<p>Message: ' . $message . '</p>';

        $mail->Body = $bodyContent;

        // Send the email
        $mail->send();
        echo '<script type="text/javascript">';
        echo 'alert("Thank you for the message. We will contact you shortly.");';
        echo 'window.location.href = "index.html";'; // Change "index.html" to the path of your home page
        echo '</script>';
        exit(); // Ensure no further code is executed
    } catch (Exception $e) {
        echo 'Message was not sent. Mailer error: ' . $mail->ErrorInfo;
    }
}
?>
