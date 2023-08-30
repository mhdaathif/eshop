<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eShop | Home</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php

            require "header.php";

            ?>

            <!-- body -->

            <hr class="hr-break-1" />

            <div class="col-12 justify-content-center">
                <div class="row mb-3">

                    <div class="col-4 col-lg-1 offset-4 offset-lg-1 logo-img"></div>
                    <div class="col-8 col-lg-6">
                        <div class="input-group input-group-lg mt-3 mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">

                            <select class="btn btn-outline-primary" id="basic_search_select">
                                <option value="0" readonly>Select Category</option>

                                <?php

                                $rs = Database::search("SELECT * FROM `category`");
                                $n = $rs->num_rows;

                                for ($x = 0; $x < $n; $x++) {
                                    $fa = $rs->fetch_assoc();

                                ?>

                                    <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>

                                <?php

                                }

                                ?>

                            </select>
                        </div>

                    </div>

                    <div class="col-2 d-grid gap-2">
                        <button class="btn btn-primary mt-3 search-btn" onclick="basicSearch(0);">Search</button>
                    </div>

                    <div class="col-2 mt-4">
                        <a href="advancedSearch.php" class="link-secondary link-1">Advanced</a>
                    </div>

                </div>

            </div>

            <hr class="hr-break-1" />

            <div class="col-12" id="basicSearchResult">

                <div class="col-12 d-none d-lg-block">
                    <div class="row">

                        <div id="carouselExampleIndicators" class="carousel slide col-8 offset-2" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="resources/slider images/posterimg.jpg" class="d-block poster-img-1">
                                    <div class="carousel-caption d-none d-md-block poster-caption">
                                        <h5 class="poster-title">Welcome to eShop</h5>
                                        <p class="poster-text">The world's Best online Store By One Click.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="resources/slider images/posterimg2.jpg" class="d-block poster-img-1">
                                </div>
                                <div class="carousel-item">
                                    <img src="resources/slider images/posterimg3.jpg" class="d-block poster-img-1">
                                    <div class="carousel-caption d-none d-md-block poster-caption-1">
                                        <h5 class="poster-title">Be Free...</h5>
                                        <p class="poster-text">Experience the Lowest Delivery Costs With Us.</p>
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

                <!-- body -->

                <?php

                $rs = Database::search("SELECT * FROM `category`");
                $n = $rs->num_rows;

                for ($x = 0; $x < $n; $x++) {
                    $cat = $rs->fetch_assoc();
                ?>

                    <!-- Category name -->

                    <div class="col-12">
                        <a href="#" class="link-dark link2"><?php echo $cat["name"]; ?></a>&nbsp;&nbsp;
                        <a href="#" class="link-dark link3">See All&nbsp; &rarr;</a>
                    </div>

                    <!-- Category name -->

                    <?php

                    $resultset = Database::search("SELECT * FROM `product` WHERE `category` = '" . $cat["id"] . "' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0 ");
                    $norows = $resultset->num_rows;

                    ?>
                    <!-- Products -->

                    <div class="col-12">
                        <div class="row border border-primary">
                            <div class="col-12 col-lg-12">
                                <div class="row justify-content-center gap-2">

                                    <?php
                                    for ($y = 0; $y < $norows; $y++) {
                                        $product = $resultset->fetch_assoc();
                                    ?>
                                        <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">

                                            <?php

                                            $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "'");
                                            $img = $pimage->fetch_assoc();

                                            ?>
                                            <img src="<?php echo $img["code"]; ?>" class="card-img-top card-img-top">
                                            <div class="card-body ms-0 m-0">
                                                <h5 class="card-title"><?php echo $product["title"]; ?>&nbsp;&nbsp;<span class="badge bg-info">New</span></h5>
                                                <span class="card-text text-primary"><?php echo $product["price"]; ?></span>
                                                <br />

                                                <?php

                                                if ($product["qty"] > 0) {
                                                ?>
                                                    <span class="card-text text-warning"><b>In Stock</b></span>
                                                    <br />
                                                    <span class="card-text text-success fw-bold"><b><?php echo $product["qty"]; ?> Items Available</b></span>
                                                    <a href='<?php echo "singleProductView.php?id=" . ($product["id"]) ?>' class="btn btn-success col-12">Buy Now</a>
                                                    <a href="cart.php" class="btn btn-danger col-12 mt-1" onclick="addToCart(<?php echo $product['id'] ?>);">Add to Cart</a>

                                                <?php 
                                                } else {
                                                ?>
                                                    <span class="card-text text-danger"><b>Out of Stock</b></span>
                                                    <br />
                                                    <span class="card-text text-danger fw-bold"><b>0 Items Available</b></span>
                                                    <a class="btn btn-success col-12 disabled">Buy Now</a>
                                                    <a class="btn btn-danger col-12 mt-1 disabled">Add to Cart</a>

                                                    <?php
                                                }
                                                if (isset($_SESSION["u"])) {
                                                    $usd = $_SESSION["u"]["email"];



                                                    $watchrs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $product["id"] . "'
                                                AND `user_email`='" . $usd . "'");

                                                    if ($watchrs->num_rows == 1) {
                                                    ?>

                                                        <a onclick='addToWatchlist(<?php echo $product["id"]; ?>);' class="btn btn-secondary col-12 mt-1"><i class="bi bi-heart-fill fs-5 text-danger" id="heart"></i></a>

                                                    <?php
                                                    } else {

                                                    ?>

                                                        <a onclick='addToWatchlist(<?php echo $product["id"]; ?>);' class="btn btn-secondary col-12 mt-1"><i class="bi bi-heart-fill fs-5" id="heart"></i></a>

                                                <?php
                                                    }
                                                }

                                                ?>

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

            <?php

            require "footer.php";

            ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>