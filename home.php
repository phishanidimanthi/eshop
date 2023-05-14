<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />

</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>
            <!-- header saha footer deka ekma page ekakta gannawa -->

            <div class="col-12 justify-content-center">
                <div class="row mb-3">
                    <div class="offset-4 offset-lg-1 col-4 col-lg-1 logo" style="height: 60px;"></div> <!-- logo eke icon eka add kara gatha -->
                    <div class="col-8 col-lg-6">
                        <div class="input-group mt-3 mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button">
                            <select class="form-select" style="max-width: 250px;">
                                <option value="0">All Categories</option>

                                <!-- categories select karanna db eken categories tika gannawa -->
                                <?php

                                require "connection.php";

                                $category_rs = Database::search("SELECT * FROM `category`"); //db eke thina category tika gannawa
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) { // category tika thina piliwelta gannawa ekin eka
                                    $category_data = $category_rs->fetch_assoc(); //val eka gannawa

                                ?>
                                    <!-- category data tika drop down eke pennanwa -->
                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                <?php

                                }

                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-lg-2 d-grid">
                        <button class="btn btn-primary mt-3 mb-3">Search</button>
                    </div>
                    <div class="col-12 col-lg-2 mt-2 mt-lg-4 text-center text-lg-start">
                        <a href="#" class="link-secondary text-decoration-none fw-bold">Advanced</a>
                    </div>
                </div>
            </div>
            <hr />
            <div class="col-12">
                <div class="row">
                    <!-- carousal -->
                    <div class="col-12 d-none d-lg-block mb-3">
                        <div class="row">

                            <div id="carouselExampleIndicators" class="offset-2 col-8 carousel slide carousel-fade" data-bs-ride="true">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="resource/slider images/posterimg.jpg" class="d-block poster-img-1" />
                                        <div class="carousel-caption d-none d-md-block poster-caption">
                                            <h5 class="poster-title">Welcome to eShop</h5>
                                            <p class="poster-txt">The World's Best Online Store By One Click</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/slider images/posterimg2.jpg" class="d-block poster-img-1" />
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/slider images/posterimg3.jpg" class="d-block poster-img-1" />
                                        <div class="carousel-caption d-none d-md-block poster-caption-1">
                                            <h5 class="poster-title">Be Free...</h5>
                                            <p class="poster-txt">Experience the Lowest Delivery Cost With Us</p>
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                        </div>
                    </div>
                    <!-- carousal -->

                    <?php
                    // see all kiyana ekkta category tika add kara gannawa
                    $c_rs = Database::search("SELECT * FROM `category`"); //db eke thina category tika gannawa
                    $c_num = $category_rs->num_rows;

                    for ($y = 0; $y < $c_num; $y++) {
                        $cdata = $c_rs->fetch_assoc();
                    ?>

                        <!-- category name -->
                        <div class="col-12 mt-3 mb-5">
                            <a href="#" class="text-decoration-none link-dark fs-3 fw-bold"><?php echo $cdata["name"] ?></a> &nbsp; &nbsp;
                            <!-- category name tika methakta gannaw -->
                            <a href="#" class="text-decoration-none link-dark fs-6">See All &nbsp; &rarr;</a> <!-- &rarr -> arrow eka -->
                        </div>

                        <!-- category name -->

                        <!-- Products -->
                        <div class="col-12 mb-3">
                            <div class="row border border-primary">
                                <div class="col">
                                    <div class="row justify-content-center gap-2">

                                        <?php

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $cdata["id"] . "' 
                                    AND `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0"); //DESC -> Decending Order  
                                        // add karapu dateTime eken decesnding order ekta order karanna
                                        // result limit eka thami 4 kiyanne
                                        //OFFSET -> kiyla thina rows gana atharinwa ena results

                                        $product_num = $product_rs->num_rows;

                                        for ($z = 0; $z < $product_num; $z++) {
                                            $product_data = $product_rs->fetch_assoc();
                                        ?>

                                            <div class="card col-6 col-lg-2 mt-4 mb-4" style="width: 18rem;">
                                                <?php
                                                //product id eken search karla image eka gannawa
                                                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                $image_data = $image_rs->fetch_assoc();

                                                ?>
                                                <!-- img data eka laga thina code eka pennanna -->
                                                <img src="<?php echo $image_data["code"]; ?>" class="card-img-top img-thumbnail mt-2" style="height:180px;" />

                                                <div class="card-body ms-0 m-0 text-center">
                                                    <h5 class="card-title fs-6 fw-bold"><?php echo $product_data["title"]; ?> <span class="badge bg-info">New</span></h5>
                                                    <span class="card-text text-primary">Rs. <?php echo $product_data["price"]; ?> .00</span> <br />

                                                    <?php

                                                    if ($product_data["qty"] > 0) { //product data eke qty eka 0ta wada wedida balnwa
                                                    ?>
                                                    <!-- stock eke products thinwa nm view wena widiya --> 
                                                        <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                        <span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br /> <!-- qty eka update karnwa db eken arn -->
                                                        <button class="col-12 btn btn-success">Buy Now</button>
                                                        <button class="col-12 btn btn-danger mt-2">Add to Cart</button>

                                                    <?php
                                                    }else{
                                                        ?>
                                                        <!-- stock eke products nethtan view wena widiya -->  
                                                        <span class="card-text text-warning fw-bold">Out of Stock</span><br />
                                                        <span class="card-text text-success fw-bold"> No Items Available</span><br /><br /> <!-- qty eka update karnwa db eken arn -->
                                                        <button class="col-12 btn btn-success disabled">Buy Now</button> <!-- button eka disable karnwa -->
                                                        <button class="col-12 btn btn-danger mt-2 disabled">Add to Cart</button>
                                                        
                                                        <?php 
                                                    }

                                                    ?>

                                                    <button class="col-12 btn btn-secondary mt-2 border border-info"><i class="bi bi-heart-fill text-danger fs-5"></i></button>
                                                </div>
                                            </div>


                                        <?php


                                        }

                                        ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Products -->

                    <?php
                    }

                    ?>
                </div>
            </div>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>