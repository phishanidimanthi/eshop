<?php

require "connection.php"; //connection.php class eka mekta export kanrwa

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eShop</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />
</head>

<body class="main-body">

    <div class="container-fluid vh-100 d-flex justify-content-center">
        <!-- justify-content-center---vertically center kanrwa -->
        <div class="row align-content-center">
            <!-- align-content-center---horizontally center karnwa -->

            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title1">Hi, Welcome to eShop</p>
                    </div>
                </div>
            </div>
            <!-- header -->

            <!-- content -->
            <div class="col-12 p-3">
                <!-- p-3 is padding 3 -->
                <div class="row">
                    <div class="col-6 d-none d-lg-block background"></div>
                    <!-- 'd-none' is small screen waldi meywa pennanna eka 
                                                                    'd-lg-block' kiyanne large screen waldi pennanna kiyna eka -->
                    <div class="col-12 col-lg-6" id="signUpBox">
                        <!-- d-none -> display none -->
                        <!-- large screen waldi col 6k -->
                        <div class="row g-2">
                            <!-- 'g' gutter colomns atare samana idk thiyanwa -->
                            <div class="col-12">
                                <p class="title2">Create New Account</p>
                            </div>

                            <!-- alert msges-->
                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" role="alert">
                                    <!-- get the danger alert -->
                                    <i class="bi bi-x-octagon-fill fs-5" id="msg">
                                        <!-- alert icon eka gannawa -->

                                    </i>

                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" id="f" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="l" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="e" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="p" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="m" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="g">
                                    <!-- db eke table eke meke options deka dapu nisa metanin ain karnwa -->

                                    <?php

                                    $rs = Database::search("SELECT * FROM `gender`"); //meya connection.php eke search function ekta yanwa 
                                    // $q kiyanne me query eka
                                    $n = $rs->num_rows; //result eke thina rows gana balnwa

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc(); //eka row eka gane aragena value eka gannawa

                                    ?>
                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option> <!-- gender value add wenwa -->
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <!-- api add karna colomn eka sampurna column eka athule view karnwa -->
                                <button class="btn btn-primary" onclick="signUp();">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <!-- api add karna colomn eka sampurna column eka athule view karnwa -->
                                <button class="btn btn-dark" onclick="changeView();">Already have an account?Sign In</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 d-none" id="signInBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title2">Sign In</p>
                                <span class="text-danger" id="msg2"></span>
                            </div>

                            <?php
                            //cookie eke thina email,psw signin ekta load karnwa
                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) { //email eka cookie eka tinwda balnwa
                                $email = $_COOKIE["email"]; //eka $email ekta gannwa
                            }
                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }
                            ?>

                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email2" value="<?php echo $email; ?>" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password2" value="<?php echo $password; ?>" />
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="rememberme"> <!-- remember me check karla nm value eka 1 -->
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password?</a>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signIn();">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="changeView();">New to eShop?Join Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content -->

            <!-- modal  -->
            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="npi" />
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="ShowPassword1();"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp" />
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="ShowPassword2();"><i id="e2" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vc" />
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->

            <!-- footer -->

            <div class="col-12 fixed-bottom d-none d-lg-block">
                <p class="text-center">&copy; 2022 eShop.lk || All Right Reserved</p>
            </div>

            <!-- footer -->
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>