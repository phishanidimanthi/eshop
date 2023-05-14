<?php

session_start(); //project eke hemathenakdima use karanna puluwn meyta dagathtama
require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];


if(empty($email)){
    echo("Please enter your email");
}else if(strlen($email) > 100){
    echo ("Email must have less than 100 characters");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Invalid email");
}else if(empty($password)){
    echo("Please enter your password");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo ("Password must have between 5-20 characters");
}else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' 
    AND `password`='".$password."'"); //user ge details tika $rs ta gannawa

    $n = $rs->num_rows; //result eken ena rows gana $n gannawa

    if($n == 1){

        echo("success");
        $d = $rs->fetch_assoc(); //user details tika gannawa
        $_SESSION["u"]=$d; // u kiyna namin session ekta denwa $d ge thina tika

        if($rememberme == "true"){
            setcookie("email",$email,time()+(60*60*24*365)); //email eka auruddak yanakn user laga store karnwa
            setcookie("password",$password,time()+(60*60*24*365));
        }else{
            //user remember me option eka dunne nethtan, expire time ekk denwa cookie eka nethi wenna
            setcookie("email","",-1); 
            setcookie("password","",-1);
        }
         
    }else{
        echo("Invalid Username or Password");
    }
}
