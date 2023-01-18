<?php

session_start();

require_once('../php/component.php');
require_once('../php/CreateDb.php');

$database = new CreateDb(dbname: "Productdb", tablename: "Producttb");

if (isset($_POST['add'])) {
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], "product_id");
        if (in_array($_POST['product_id'], $item_array_id)) {
            echo "<script>alert('Product is al toegevoegd')</script>";
            echo "<script>window.location = 'homepage.php'</script>";
        } else {
            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );
            $_SESSION['cart'][$count] = $item_array;
        }
    } else {
        $item_array = array(
            'product_id' => $_POST['product_id']
        );
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Webshop stylesheet-->
    <link rel="stylesheet" href="../css/homepage.css">

    <title>OPP Webshop</title>

</head>

<body>

    <!--This code is for the header-->

    <header>
        <img class="logo"
            src="https://blightningpower.github.io/Wellbeeing_webshop/img/Logo%20wellbeeing%207.0%20-%20cut.png"
            alt="Wellbeeinglogo">
        <h1 class="WellbeeingHeaderTitle"><span class="WellbeeingTitleWord">Wellbeeing</span>Webshop</h1>
        <!--Navigation searchbar-->
        <div class="searchbar">
            <label>
                <input class="searchBarfield" type="text" placeholder="Zoeken..">
                <img class="searchBarIcon" src="https://i484476.hera.fhict.nl/OPP_Webshop/Public/img/searchbarIcon.png"
                    alt="searchBarIcon">
            </label>
        </div>


        <div class="navbarButton">
            <a href="homepage.php">Webshop</a>
            <a href="signUp.php">Aanmelden</a>
            <a href="logIn.php">Inloggen</a>
        </div>

        <!--Navigation shoppingcart-->
        <a href="cart.php" class="shoppingCartButton"><img class="shoppingCartImage"
                src="https://i484476.hera.fhict.nl/OPP_Webshop/Public/img/shoppingCartIcon.png" alt="ShoppingCart" />
            <h5 class="px-5 cart">
                <i class="fas fa-shopping-cart"></i> Winkelmand
                <?php

                if (isset($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                    echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
                } else {
                    echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
                }

                ?>
            </h5>
        </a>
        <div class="navHeader">
            <a href="#">Alle producten</a>
            <a href="#">Smart Beehives</a>
            <a href="#">Beehives</a>
            <a href="#">Losse producten</a>
        </div>

    </header>


    <!--This code is for the products-->
    <section class="bodysection">
        <form action="register_script.php" name="frm" method="post">
            <details class="SortList">
                <summary class="SortListHead">Sorteer</summary>
                <button class="SortListItem1"><a href="#" class="SortListParagraph">Populairste</a></button>
                <button class="SortListItem2"><a href="#" class="SortListParagraph">Prijs: Laag - Hoog</a></button>
                <button class="SortListItem3"><a href="#" class="SortListParagraph">Prijs: Hoog - Laag</a></button>
            </details>
        </form>

        <table>
            <tr>
                <?php
                $result = $database->getData();
                while ($row = mysqli_fetch_assoc($result)) {
                    component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                }
                ?>
            </tr>
        </table>
    </section>
    <footer>Lorem Ipsum dolor</footer>

</body>

</html>