<?php
$to = "kush02032004@gmail.com";
$subject = "Test Email";
$message = "This is a test email to check PHP mail() function.";
$headers = "From: kush02032004@gmail.com\r\n";

if (mail($to, $subject, $message, $headers)) {
    echo "Mail Sent Successfully!";
} else {
    echo "Mail Failed!";
}
?>