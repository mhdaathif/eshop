<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>eShop | User Profile</title>

        <link rel="icon" href="resources/logo.svg" />

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="bg-primary">

        <div class="container-fluid bg-body rounded mt-4 mb-4">
            <div class="row">

                <div class="col-md-3 border-end">

                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                        <?php
                        $profileImg = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' ");
                        $pn = $profileImg->num_rows;

                        if ($pn == 1) {
                            $p = $profileImg->fetch_assoc();
                        ?>

                            <img class="rounded mt-5" width="150px" src="<?php echo $p["code"]; ?>" id="prev0" />

                        <?php

                        } else {
                        ?>

                            <img class="rounded mt-5" width="150px" src="resources/demoProfileImg.jpg" id="prev0" />

                        <?php
                        }

                        ?>


                        <span class="fw-bold"><?php echo $_SESSION["u"]["lname"]; ?></span>
                        <span><?php echo $_SESSION["u"]["email"]; ?></span>
                        <input class="d-none" type="file" id="profileimg" accept="img/*" />
                        <label class="btn btn-primary mt-3" for="profileimg" onclick="changeImage();">Update Profile Images</label>
                    </div>

                </div>

                <div class="col-md-5 border-end">
                    <div class="p3 py-5">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Profile Settings</h4>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" id="fname" class="form-control" placeholder="First Name" value="<?php echo $_SESSION["u"]["fname"] ?>" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" id="lname" class="form-control" placeholder="Last Name" value="<?php echo $_SESSION["u"]["lname"] ?>" />
                            </div>
                        </div>

                        <div class="row mt-3">

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Mobile no.</label>
                                <input type="text" id="mobile" class="form-control" placeholder="enter your mobile number" value="<?php echo $_SESSION["u"]["mobile"] ?>" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group mb-3">
                                    <input readonly type="password" class="form-control" placeholder="enter your password" id="show_text" aria-label="enter your password" aria-describedby="button-addon2" value="<?php echo $_SESSION["u"]["password"] ?>">
                                    <button class="btn btn-outline-secondary" id="button-addon2" type="button" onclick="pswd_addon();"><i class="bi bi-eye-fill" id="img_show"></i><i class="bi bi-eye-slash-fill d-none" id="img_hide"></i></button>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email Address</label>
                                <input readonly type="email" class="form-control" placeholder="enter your email address" value="<?php echo $_SESSION["u"]["email"] ?>">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Registered Date</label>
                                <input readonly type="text" class="form-control" placeholder="enter your registered date" value="<?php echo $_SESSION["u"]["register_date"] ?>">
                            </div>

                            <?php

                            $usermail = $_SESSION["u"]["email"];
                            $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $usermail . "' ");
                            $n = $address->num_rows;

                            if ($n > 0) {
                                $d = $address->fetch_assoc();

                                $city = Database::search("SELECT * FROM `city` WHERE `id`='" . $d["city_id"] . "'");
                                $cf = $city->fetch_assoc();

                                $district = Database::search("SELECT * FROM `district` WHERE `id`='" . $cf["district_id"] . "'");
                                $df = $district->fetch_assoc();

                                $province = Database::search("SELECT * FROM `province` WHERE `id`='" . $df["province_id"] . "'");
                                $pf = $province->fetch_assoc();

                            ?>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 01</label>
                                    <input type="text" id="addline1" class="form-control" placeholder="address line 01" value="<?php echo $d["line1"] ?>" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 02</label>
                                    <input type="text" id="addline2" class="form-control" placeholder="address line 02" value="<?php echo $d["line2"] ?>" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Province</label>
                                    <select class="form-select">
                                        <option value="<?php echo $pf["id"]; ?>"><?php echo $pf["name"]; ?></option>
                                        <?php

                                        $pall = Database::search("SELECT * FROM `province` WHERE `name` != '" . $pf["name"] . "' ");
                                        $num1 = $pall->num_rows;

                                        for ($x = 1; $x <= $num1; $x++) {
                                            $row1 = $pall->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $row1["id"] ?>"><?php echo $row1["name"] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">District</label>
                                    <select class="form-select">
                                        <option value="<?php echo $df["id"]; ?>"><?php echo $df["name"]; ?></option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <select class="form-select" id="usercity">
                                        <option value="<?php echo $cf["id"]; ?>"><?php echo $cf["name"]; ?></option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" placeholder="postal code" />
                                </div>

                                <div class="mt-3 text-center">
                                    <button class="btn btn-primary" onclick="updateprofile();">Update Profile</button>
                                </div>

                            <?php

                            } else {

                            ?>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 01</label>
                                    <input type="text" id="addline1" class="form-control" placeholder="address line 01" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 02</label>
                                    <input type="text" id="addline2" class="form-control" placeholder="address line 02" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Province</label>
                                    <select class="form-select">
                                        <option>Select Your Province</option>

                                        <?php
                                        $pall = Database::search("SELECT * FROM `province`");
                                        $num1 = $pall->num_rows;

                                        for ($x = 1; $x <= $num1; $x++) {
                                            $row1 = $pall->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $row1["id"] ?>"><?php echo $row1["name"] ?></option>

                                        <?php

                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">District</label>
                                    <select class="form-select">
                                        <option>Select Your District</option>

                                        <?php

                                        $pall = Database::search("SELECT * FROM `district`");
                                        $num1 = $pall->num_rows;

                                        for ($y = 0; $y <= $num1; $y++) {
                                            $row1 = $pall->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $row1["id"] ?>"><?php echo $row1["name"] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <select class="form-select" id="usercity">
                                        <option>Select Your City</option>
                                        <?php

                                        $pall = Database::search("SELECT * FROM `city`");
                                        $num1 = $pall->num_rows;

                                        for ($z = 0; $z <= $num1; $z++) {
                                            $row1 = $pall->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $row1["id"] ?>"><?php echo $row1["name"] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" placeholder="postal code" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gender</label>
                                    <?php

                                    $gid = $_SESSION["u"]["gender"];
                                    $g = Database::search("SELECT * FROM `gender` WHERE `id`='" . $gid . "' ");
                                    $gf = $g->fetch_assoc();

                                    ?>
                                    <input readonly type="text" class="form-control" placeholder="gender" value="<?php echo $gf["name"] ?>" />

                                    </select>
                                </div>

                                <div class="mt-3 text-center">
                                    <button class="btn btn-primary" onclick="updateprofile();">Update Profile</button>
                                </div>

                            <?php
                            }

                            ?>

                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="col-md-12">
                            <span class="header">User Rating</span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <p>4.1 average based on 254 reviews.</p>
                            <hr class="hr-break-1" />
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span>5 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>150</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span>4 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>63</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span>3 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>15</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span>2 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>6</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span>1 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <?php

                require "footer.php";

                ?>

            </div>

        </div>

        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </body>

    </html>

<?php

} else {

?>

    <script>
        window.location = "index.php"
    </script>

<?php
}

?>