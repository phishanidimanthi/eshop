<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Product | eshop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />
</head>

<body style="background-color: #E9EBEE;">

    <div class="container-fluid">
        <div class="row">
            <!-- header -->
            <div class="col-12 bg-primary">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12 col-lg-4 mt-1 mb-1 text-center">
                                <img src="resource/profile_img/newuser.svg" width="90px" height="90px" class="rounded-circle" />
                            </div>
                            <div class="col-12 col-lg-8">
                                <div class="row text-center text-lg-start">
                                    <div class="col-12 mt-0 mt-lg-4">
                                        <span class="text-white fw-bold">Ishani Dimanthi</span>
                                    </div>
                                    <div class="col-12">
                                        <span class="text-black-50 fw-bold">ishani@gmail.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-2 my-lg-4">
                                <h1 class="offset-4 offset-lg-3 text-white fw-bold">My Products</h1>
                            </div>
                            <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid">
                                <button class="btn btn-warning fw-bold">Add Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header -->

            <!-- body -->
            <div class="col-12">
                <div class="row">
                    <div class="col-11 col-lg-2 mx-3 my-3 border-primary rounded">
                        <div class="row">
                            <div class="col-12 mt-3 fs-5">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fw-bold fs-3">Sort Products</label>
                                    </div>
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="text" placeholder="Search..." class="form-control" />
                                            </div>
                                            <div class="col-1 p-1">
                                                <label class="form-label"><i class="bi bi-search fs-5"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">Active Time</label>
                                    </div>
                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r1" id="n" >
                                            <label class="form-check-label" for="n">
                                                Newest to oldest
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r1" id="o" >
                                            <label class="form-check-label" for="o">
                                                Oldest to newest
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>