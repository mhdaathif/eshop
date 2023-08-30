<?php

require "connection.php";

$from = $_POST["f"];
$to = $_POST["t"];

$product_rs = Database::search("SELECT * FROM `invoice` ");
$product_num = $product_rs->num_rows;

for ($x = 0; $x < $product_num; $x++) {
    $product_data = $product_rs->fetch_assoc();
    $sold_date = $product_data["date"];

    $date = explode(" ", $sold_date);

    $d = $date[0];
    // $t = $date[1];

    if (!empty($from) && empty($to)) {
        if ($from <= $d) {

?>
            <div class="col-12 mt-1">
                <div class="row" id="loadResults">
                    <div class="col-12">
                        <div class="row" id="box">

                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label fw-bold fs-5 text-white"><?php echo $product_data["id"]; ?></label>
                            </div>
                            <?php

                            // $item_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "' ");
                            // $item_data = $item_rs->fetch_assoc();

                            $item = Database::search("SELECT * FROM `product` WHERE `id`='" . $product_data["product_id"] . "' ");
                            $item_da = $item->fetch_assoc();

                            ?>
                            <div class="col-3 bg-body text-end">
                                <label class="form-label fw-bold fs-5 text-black"><?php echo $item_da["title"]; ?></label>
                            </div>
                            <?php
                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "' ");
                            $user_data = $user_rs->fetch_assoc();
                            ?>
                            <div class="col-3 bg-secondary text-end">
                                <label class="form-label fw-bold fs-5 text-white"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></label>
                            </div>
                            <div class="col-2 bg-body text-end">
                                <label class="form-label fw-bold fs-5 text-black">Rs. <?php echo $product_data["total"]; ?> .00</label>
                            </div>
                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label fw-bold fs-5 text-white"><?php echo $product_data["qty"]; ?></label>
                            </div>
                            <div class="col-2 bg-white d-grid">

                                <?php

                                $x = $product_data["status"];
                                if ($x == 0) {
                                ?>
                                    <button class="btn btn-success my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');">Confirm Order</button>

                                <?php
                                } else if ($x == 1) {
                                ?>
                                    <button class="btn btn-warning my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');">Packing</button>

                                <?php
                                } else if ($x == 2) {
                                ?>
                                    <button class="btn btn-info my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');">Dispatch</button>

                                <?php
                                } else if ($x == 3) {
                                ?>
                                    <button class="btn btn-primary my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');">Shopping</button>

                                <?php
                                } else if ($x == 4) {
                                ?>
                                    <button class="btn btn-danger my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');" disabled>Delivered</button>

                                <?php
                                } else {
                                ?>
                                    <button class="btn btn-danger my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');" disabled>Delivered</button>

                                <?php
                                }

                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } else if (!empty($to) && empty($from)) {
        if ($to >= $d) {
        ?>
            <div class="col-12 mt-1">
                <div class="row" id="loadResults">
                    <div class="col-12">
                        <div class="row" id="box">

                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label fw-bold fs-5 text-white"><?php echo $product_data["id"]; ?></label>
                            </div>
                            <?php

                            $item_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "' ");
                            $item_data = $item_rs->fetch_assoc();

                            ?>
                            <div class="col-3 bg-body text-end">
                                <label class="form-label fw-bold fs-5 text-black"><?php echo $product_data["title"]; ?></label>
                            </div>
                            <?php
                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "' ");
                            $user_data = $user_rs->fetch_assoc();
                            ?>
                            <div class="col-3 bg-secondary text-end">
                                <label class="form-label fw-bold fs-5 text-white"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></label>
                            </div>
                            <div class="col-2 bg-body text-end">
                                <label class="form-label fw-bold fs-5 text-black">Rs. <?php echo $product_data["total"]; ?> .00</label>
                            </div>
                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label fw-bold fs-5 text-white"><?php echo $product_data["qty"]; ?></label>
                            </div>
                            <div class="col-2 bg-white d-grid">

                                <?php

                                $x = $product_data["status"];
                                if ($x == 0) {
                                ?>
                                    <button class="btn btn-success my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');">Confirm Order</button>

                                <?php
                                } else if ($x == 1) {
                                ?>
                                    <button class="btn btn-warning my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');">Packing</button>

                                <?php
                                } else if ($x == 2) {
                                ?>
                                    <button class="btn btn-info my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');">Dispatch</button>

                                <?php
                                } else if ($x == 3) {
                                ?>
                                    <button class="btn btn-primary my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');">Shopping</button>

                                <?php
                                } else if ($x == 4) {
                                ?>
                                    <button class="btn btn-danger my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');" disabled>Delivered</button>

                                <?php
                                }

                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } else if (!empty($from) && !empty($to)) {
        if ($from <= $d && $to >= $d) {
        ?>

            <div class="col-12 mt-1">
                <div class="row" id="loadResults">
                    <div class="col-12">
                        <div class="row" id="box">

                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label fw-bold fs-5 text-white"><?php echo $product_data["id"]; ?></label>
                            </div>
                            <?php

                            $item_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "' ");
                            $item_data = $item_rs->fetch_assoc();

                            ?>
                            <div class="col-3 bg-body text-end">
                                <label class="form-label fw-bold fs-5 text-black"><?php echo $product_data["title"]; ?></label>
                            </div>
                            <?php
                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "' ");
                            $user_data = $user_rs->fetch_assoc();
                            ?>
                            <div class="col-3 bg-secondary text-end">
                                <label class="form-label fw-bold fs-5 text-white"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></label>
                            </div>
                            <div class="col-2 bg-body text-end">
                                <label class="form-label fw-bold fs-5 text-black">Rs. <?php echo $product_data["total"]; ?> .00</label>
                            </div>
                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label fw-bold fs-5 text-white"><?php echo $product_data["qty"]; ?></label>
                            </div>
                            <div class="col-2 bg-white d-grid">

                                <?php

                                $x = $results_data["status"];
                                if ($x == 0) {
                                ?>
                                    <button class="btn btn-success my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');">Confirm Order</button>

                                <?php
                                } else if ($x == 1) {
                                ?>
                                    <button class="btn btn-warning my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');">Packing</button>

                                <?php
                                } else if ($x == 2) {
                                ?>
                                    <button class="btn btn-info my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');">Dispatch</button>

                                <?php
                                } else if ($x == 3) {
                                ?>
                                    <button class="btn btn-primary my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');">Shopping</button>

                                <?php
                                } else if ($x == 4) {
                                ?>
                                    <button class="btn btn-danger my-2 fw-bold" id="btn<?php echo $product_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $product_data['id']; ?>');" disabled>Delivered</button>

                                <?php
                                }

                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

<?php
}

?>