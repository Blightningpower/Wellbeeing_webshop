<?php

session_start();

require_once('../php/products.php');
require_once('../php/createDb.php');

$database = new createDb(dbname: "Productdb", tablename: "Producttb");

if (isset($_POST['add'])) {
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], "product_id");
        if (in_array($_POST['product_id'], $item_array_id)) {
            echo "<script>alert('Product is al toegevoegd')</script>";
            echo "<script>window.location = 'index.php'</script>";
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
    <link rel="apple-touch-icon" sizes="180x180" href="https://i484476.hera.fhict.nl/Wellbeeing%20webshop/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://i484476.hera.fhict.nl/Wellbeeing%20webshop/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://i484476.hera.fhict.nl/Wellbeeing%20webshop/img/favicon-16x16.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <script src="https://kit.fontawesome.com/4b14647f69.js" crossorigin="anonymous"></script>

    <!-- Webshop stylesheet -->
    <link rel="stylesheet" href="../css/index.css">

    <title>Wellbeeing Webshop</title>

</head>
<body>

<!--This code is for the header-->
<header class="header">

<div class="navHeader">
    <a href="#">Alle producten</a>
    <a href="#">Smart Beehives</a>
    <a href="#">Bloemenzaden</a>
    <a href="#">Honing</a>
</div>
<br><br>
<div class="overNavHeader">
    <img class="headerimage" src="https://i484476.hera.fhict.nl/Wellbeeing%20webshop/img/Logo wellbeeing 7.0 - cut.png">
    <a href="#" class="logo"> Well<span>bee</span>ing</a>

    <!--Navigation searchbar-->
    <div class="searchbar">
        <label>
            <input class="searchBarfield" type="text" placeholder="Zoeken..">
            <img class="searchBarIcon" src="https://i484476.hera.fhict.nl/OPP_Webshop/Public/img/searchbarIcon.png"
                 alt="searchBarIcon">
        </label>
    </div>

    <nav class="navbar">
      <div id="close-navbar" class="fas fa-times"></div>
      <a href="https://i484476.hera.fhict.nl/Wellbeeing%20webshop/html/index.html" target="_blank">HOMEPAGINA</a>
      <a href="http://i511976.hera.fhict.nl/index.html" target="_blank">WEBSITE</a>
      <a href="https://i484476.hera.fhict.nl/Wellbeeing%20webshop/html/contact.html" target="_blank">CONTACT</a>
	  <a href="shoppingCart.html" id="shoppingCartButton"><img class="shoppingCartImage"
                                                                src="https://i484476.hera.fhict.nl/OPP_Webshop/Public/img/shoppingCartIcon.png"
                                                                alt="ShoppingCart"/></a> <!--Navigation shoppingcart-->
    </nav>

    <div class="icons">
      <div id="menu-btn" class="fas fa-bars"></div>
    </div>
</div>

</header>



<!--This code is for the products-->
<section class="bodysection">
    <details class="SortList">
        <summary class="SortListHead">Sorteer</summary>
        <button class="SortListItem1"><a href="#" class="SortListParagraph">Populairste</a></button>
        <button class="SortListItem2"><a href="#" class="SortListParagraph">Prijs: Laag - Hoog</a></button>
        <button class="SortListItem3"><a href="#" class="SortListParagraph">Prijs: Hoog - Laag</a></button>
    </details>

    <table>
            <tr>
                <?php
                $result = $database->getData();
                while ($row = mysqli_fetch_assoc($result)) {
                    products($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                }
                ?>
            </tr>
        </table>
</section>

<!-- footer -->
<section class="footer">

        <div class="box-container">
          <div class="scroll-down" onclick="scroll"></div>
          <div class="box">
            <h3> <i class="fas fa-lightbulb"></i> Well<span>bee</span>ing </h3>
            <p>Bavli, Stan, Allert, Daniël, Semmy.</p>
            <div class="share">
              <a href="#" class="fab fa-facebook-f"></a>
              <a href="#" class="fab fa-twitter"></a>
              <a href="#" class="fab fa-instagram"></a>
              <a href="#" class="fab fa-linkedin"></a>
            </div>
          </div>
          <div class="box">
            <h3>navigatie links</h3>
            <a class="link" href="https://i484476.hera.fhict.nl/Wellbeeing%20webshop/html/index.html" target="_blank">HOMEPAGINA</a>
            <a class="link" href="http://i511976.hera.fhict.nl/index.html" target="_blank">WEBSITE</a>
            <a class="link" href="http://i511976.hera.fhict.nl/contact.html" target="_blank">CONTACT</a>
          </div>
        </div>
        <div class="credit"> gemaakt door <span>Bavli Armanyous</span> | Wellbeeing. 2023 Â© </div><br>

      </section>

<script>
  let navbar = document.querySelector('.header .navbar')

  document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.add('active');
  }

  document.querySelector('#close-navbar').onclick = () => {
    navbar.classList.remove('active');
  };

  document.querySelector('#shoppingCartButton').onclick = () => {
    accountForm.classList.add('active');
  }

  document.querySelector('#shoppingCartButton').onclick = () => {
    accountForm.classList.remove('active');
  };

</script>

        
    </section>
    <footer>Lorem Ipsum dolor</footer>

</body>

</html>