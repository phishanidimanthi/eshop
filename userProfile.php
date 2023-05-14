<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | eShop</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css " />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include "header.php"; ?>

            <?php

            require "connection.php";

            if (isset($_SESSION["u"])) { //user kenek innawda balnwa

                $email = $_SESSION["u"]["email"]; //eyge email eka mokadda balnwa

                $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON 
                gender.id=user.gender_id WHERE `email`='" . $email . "'"); //gender eke saha user eke thina samana dataa tika gannawa

                $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'"); //email eke thinwa profile eka gannawa

                $address_rs = Database::search("SELECT * FROM `user_has_city` INNER JOIN `city` ON  
                user_has_city.city_id=city.id INNER JOIN `district` ON 
                city.district_id=district.id INNER JOIN `province` ON 
                district.province_id=province.id WHERE `user_email`='" . $email . "'"); // email ekta samana address, city, province wge details tika gannawa

                $data = $details_rs->fetch_assoc(); //details_rs eke thina value tika $data ekta gannawa
                $image_data = $image_rs->fetch_assoc(); // image_data ekta $image_rs eke thina val tika gannawa
                $address_data = $address_rs->fetch_assoc(); // address details tika $address_data ekta gannawa

            ?>

                <div class="col-12 bg-primary">
                    <div class="row">

                        <div class="col-12 bg-body rounded mt-4 mb-4">
                            <!-- ms-> amrgin start me-> margin end  bg-body->body ekta ash color ekk  -->

                            <div class="row g-2">

                                <div class="col-md-3 border-end">

                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <!-- py-> add padding for all side -->

                                        <?php

                                        if (empty($image_data["path"])) { // user img ekk select kare nethtan normal avater ekk set karnwa default
                                        ?>
                                            <img src="resource/new_user.svg" class="rounded mt-5" style="width: 150px;" id="viewImg" />
                                        <?php
                                        } else { //add karoth eke path eka arn save karnwa
                                        ?>
                                            <img src="<?php echo $image_data["path"]; ?>" class="rounded mt-5" style="width: 150px;" id="viewImg" /> 
                                        <?php
                                        }

                                        ?>


                                        <span class="fw-bold"><?php echo $data["fname"] . " " . $data["lname"]; ?></span>  <!-- profile ekta pahalin nama view wenwa -->
                                        <span class="fw-bold text-black-50"><?php echo $email; ?></span>

                                        <input type="file" class="d-none" id="profileimg" accept="image/*" /> <!-- profile eka update karanna file chooser ekk danwa -->
                                        <label for="profileimg" class="btn btn-primary mt-5" onclick="changeImage();">Update Profile Image</label> <!-- profile update button eka (for eken uda input ekath ekka connect karla thinne) -->

                                    </div>

                                </div>

                                <!-- Create the user Profile Details Form -->
                                <div class="col-md-5 border-end">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold">Profile Settings</h4>
                                        </div>
                                        <!-- database eken detail tika gannawa --> 
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" value="<?php echo $data["fname"]; ?>" id="fname" /> 
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" value="<?php echo $data["lname"]; ?>" id="lname" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Mobile</label>
                                                <input type="text" class="form-control" value="<?php echo $data["mobile"]; ?>" id="mobile" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" readonly value="<?php echo $data["password"]; ?>" />
                                                    <span class="input-group-text bg-primary" id="basic-addon2">
                                                        <i class="bi bi-eye-slash-fill text-white"></i>
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Email</label> <!-- edit karanna beri wenna readonly denwa -->
                                                <input type="text" class="form-control" readonly value="<?php echo $data["email"]; ?>" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Register Date</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $data["joined_date"]; ?>" />
                                            </div>

                                            <?php

                                            //address eka empty da balnwa, empty nm fill karanna denwa nethtan eka disable karnwa
                                            if (!empty($address_data["line1"])) {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 1</label>
                                                    <input type="text" class="form-control" value="<?php echo $address_data["line1"]; ?>" id="line1" />
                                                </div>
                                            <?php
                                            } else { //empty nm 
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 1</label>
                                                    <input type="text" class="form-control" id="line1" />
                                                </div>

                                            <?php
                                            }
                                            if (!empty($address_data["line2"])) { //empty nethtan
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 2</label>
                                                    <input type="text" class="form-control" value="<?php echo $address_data["line2"]; ?>" id="line2" />
                                                </div>
                                            <?php

                                            } else { //empty nm
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 2</label>
                                                    <input type="text" class="form-control" id="line2" />
                                                </div>
                                            <?php
                                            }

                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");

                                            ?>

                                            <div class="col-6">
                                                <label for="form-label">Province</label>
                                                <select class="form-select" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php
                                                    //reg wela inna user kenek nm eya select karla thina province eka pennanwa, nethtan dropdown eka normal view wenwa
                                                    $province_num = $province_rs->num_rows;
                                                    for ($x = 0; $x < $province_num; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["id"]; ?>" <?php
                                                                                                            if (!empty($address_data["province_id"])) {
                                                                                                                if ($province_data["id"] == $address_data["province_id"]) {
                                                                                                            ?>selected<?php
                                                                                                                            }
                                                                                                                        }
                                                                                                                                ?>><?php echo $province_data["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label for="form-label">District</label>
                                                <select class="form-select" id="district">
                                                    <option value="0">Select District</option>
                                                    <?php
                                                    //reg wela inna user kenek nm eya select karla thina provine eka pennanwa, nethtan dropdown eka normal view wenwa
                                                    $district_num = $district_rs->num_rows;
                                                    for ($x = 0; $x < $district_num; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $district_data["id"]; ?>" <?php
                                                                                                            if (!empty($address_data["district_id"])) {
                                                                                                                if ($district_data["id"] == $address_data["district_id"]) {
                                                                                                            ?>selected<?php
                                                                                                                            }
                                                                                                                        } ?>><?php echo $district_data["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label for="form-label">City</label>
                                                <select class="form-select" id="city">
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    //reg wela inna user kenek nm eya select karla thina provine eka pennanwa, nethtan dropdown eka normal view wenwa
                                                    $city_rs = Database::search("SELECT * FROM `city`");
                                                    $city_num = $city_rs->num_rows;
                                                    for ($x = 0; $x < $city_num; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["id"]; ?>" <?php
                                                                                                    if (!empty($address_data["city_id"])) {
                                                                                                        if ($city_data["id"] == $address_data["city_id"]) {
                                                                                                    ?>selected<?php
                                                                                                                } 
                                                                                                            } ?>><?php echo $city_data["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <?php
                                            if (!empty($address_data["postal_code"])) {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label">Postal-Code</label>
                                                    <input type="text" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" id="pcode" />
                                                </div>
                                            <?php
                                            } else{
                                                ?>
                                                <div class="col-6">
                                                    <label class="form-label">Postal-Code</label>
                                                    <input type="text" class="form-control" id="pcode" />
                                                </div>
                                            <?php 
                                            }
                                            ?>



                                            <div class="col-12">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $data["gender_name"]; ?>" />
                                            </div>

                                            <div class="col-12 d-grid mt-3">
                                                <button class="btn btn-primary" onclick="updateProfile();">Update My Profile</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Create the user Profile Details Form -->

                                <div class="col-md-4 text-center">
                                    <div class="row">
                                        <span class="mt-5 fw-bold text-black-50">Display ads</span>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            <?php
            } else {
                header("Location:http://localhost/Jins PHP/e-commerce/e shop/home.php"); //sign in wela nethuwa my profile giyma home ektma redirect wenwa
            }

            ?>


            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>


</html>