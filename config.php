<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51LZov4AV0Z8Tapio9RLk6MuuCIdqBgbTozRx2BfERrE6pnyGgFmNTbQByze795rQJQchzVA3NznpdeF01Dicjd8F00PdQBQd7N","publishableKey" => "pk_test_51LZov4AV0Z8Tapioq6xCQJV0QQdBtqhaYydx3qH2A1qwLGZexQiq9JlOWkI0WHaI8sGJqOApeEQoAkmNHpoEeiHK00kIZl7qGw"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>