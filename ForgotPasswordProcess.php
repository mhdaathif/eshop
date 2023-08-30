<?php

require "connection.php";

require "SMTP.php";
require "Exception.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    if (empty($email)) {

        echo "Please enter a valid Email";
    } else {

        $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' ");
        if ($rs->num_rows == 1) {

            $code = uniqid();
            Database::iud("UPDATE `user` SET `verification_code` = '" . $code . "' WHERE `email` = '" . $email . "'");

            // email code
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'newofficial66@gmail.com';
            $mail->Password = 'kavjenvovznitxgm';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('newofficial66@gmail.com', 'Reset Password');
            $mail->addReplyTo('newofficial66@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'eShop Forgot Password Verification Code';
            $bodyContent = '<h1 style = "color : green;">Your Verification Code is : ' . $code . '</h1>';
            $mail->Body = $bodyContent;

            if (!$mail->send()) {
                echo "Verification code sending failed";
            } else {
                echo "Success";
            }
        } else {
            // echo "Success";
        }
    }
} else {
    echo "Please enter Your Email address.";
}
