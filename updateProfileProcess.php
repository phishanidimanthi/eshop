<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) { //session eke user kenek innawda balnwa

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $mobile = $_POST["m"];
    $line1 = $_POST["l1"];
    $line2 = $_POST["l2"];
    $province = $_POST["p"];
    $district = $_POST["d"];
    $city = $_POST["c"];
    $pcode = $_POST["pc"];

    if (isset($_FILES["image"])) { //image ekk thinwda balnwa
        $image = $_FILES["image"]; //$image variable ekta assign kaarnwa

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml"); //img eke extention tika okkoma gannawa
        $file_ex = $image["type"]; //img eke extention ekath ekta gelapena eka gannawa

        if (!in_array($file_ex, $allowed_image_extentions)) { //select karpu img file eka array eke nethi extention ekk nm 
            echo ("Please select a valid image.");
        } else {  // ex eka gelapena ekk nm ekt assign karnwa

            $new_file_extention; 

            if ($file_ex == "image/jpg") {
                $new_file_extention = ".jpg";
            } else if ($file_ex == "image/jpeg") {
                $new_file_extention = ".jpeg";
            } else if ($file_ex == "image/png") {
                $new_file_extention = ".png";
            } else if ($file_ex == "image/svg+xml") {
                $new_file_extention = ".svg";
            }

            $file_name = "resource/profile_img/" . $_SESSION["u"]["fname"] . "_" . uniqid() . $new_file_extention; //e img eka save karanna ona path  eka denwa

            move_uploaded_file($image["tmp_name"], $file_name); 

            //kalin profile eka update karpu kenekda balnwa
            $image_rs = Database::search("SELECT * FROM `profile_image` WHERE 
            `user_email`='" . $_SESSION["u"]["email"] . "'");
            $image_num = $image_rs->num_rows;

            if ($image_num == 1) { //kalin profile eka update krpu user keek nm

                Database::uid("UPDATE `profile_image` SET `path`='" . $file_name . "' WHERE 
                `user_email`='" . $_SESSION["u"]["email"] . "'"); // adala path eka execute karnwa
            } else {

                Database::uid("INSERT INTO `profile_image` (`path`,`user_email`) VALUES 
                ('" . $file_name . "','" . $_SESSION["u"]["email"] . "')"); //adala path ekta img eka set karla execute karnwa
            }
        }
    }

    Database::uid("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "' 
            WHERE `email`='" . $_SESSION["u"]["email"] . "'"); // "u" ge inna email ekta adalwa details tika gannawa

    $address_rs = Database::search("SELECT * FROM `user_has_city` WHERE 
            `user_email`='" . $_SESSION["u"]["email"] . "'"); // adala userta anuwa city table eke okkoma tika gannawa
    $address_num = $address_rs->num_rows;

    if ($address_num == 1) { //e userta adala details tika update karnwa

        Database::uid("UPDATE `user_has_city` SET `line1`='" . $line1 . "',
                `line2`='" . $line2 . "',
                `city_id`='" . $city . "',
                `postal_code`='" . $pcode . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
    } else { // num_rows 0 nm details tika insert karnwa
 
        Database::uid("INSERT INTO `user_has_city` 
                (`line1`,`line2`,`user_email`,`city_id`,`postal_code`) VALUES 
                ('" . $line1 . "','" . $line2 . "','" . $_SESSION["u"]["email"] . "','" . $city . "','" . $pcode . "')");
    }

    echo "success"; // profile eka update kara nm success kiyla enwa
} else {
    echo ("Please login first"); //log wenne nethuwa profile eka update karanna be
}
