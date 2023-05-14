<?php
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer; //mulin PHPMailer eke thina nameSpace ekta call akrnwa ("PHPMailer\PHPMailer"), ita passe eke thina PHPMailer kiyna clz ekta call karnwa

if(isset($_GET["e"])){  //email ekk set welda balnwa
    $email = $_GET["e"]; //$email ta assign karnwa

    $rs = Database::search(("SELECT * FROM `user` WHERE `email` = '".$email."'")); //db eke check karnwa e wge email ekk thinwda kiyla
    $n = $rs->num_rows; //rows gana gannawa

    if($n == 1){ //eka result ekaida balnwa

        $code = uniqid(); // unique code ekk generate karnwa uniqid eken

        Database::uid("UPDATE `user` SET `verification_code`='".$code."' WHERE `email`='".$email."'");  // send karna email ekta samana db eke thina email eka hoyagannawa, 
                                                                                                        // generate karagatta unique id eka adala email eka thina thena db eke verification code eke save karnwa
//email eka yaddi enna one details tika mekta danna

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'i.dimanthi1998@gmail.com'; //sender ge email eka 
            $mail->Password = 'xjzhzotzytneiqby'; // sender password (Give Google App Password)
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('i.dimanthi1998@gmail.com', 'Reset Password'); //sender email 
            $mail->addReplyTo('i.dimanthi1998@gmail.com', 'Reset Password'); //sender email (reply email address)
            $mail->addAddress($email); //receiver's email -> user
            $mail->isHTML(true);
            $mail->Subject = 'eShop Forgot Password Verification Code';
            $bodyContent = '<h1 style="color:green">Your Verification Code is '.$code.'</h1>'; //verification message for user
            $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo 'Verification code sending failed';
            }else{
                echo 'Success';
            }
                                                                                                                                                                                                        
    }else{ // ehema email ekk nethtan
        echo("Invalid Email address");
    }

}else{
    echo("Please enter your email"); // email ekk set  
}
