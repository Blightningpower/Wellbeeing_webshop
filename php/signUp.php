<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--Webshop stylesheet-->
  <link rel="stylesheet" href="../css/signUp.css">

  <title>OPP Webshop Aanmelden</title>

</head>
<body>

<!--This code is for the navigation bar-->

<<!--This code is for the header-->

<header>
  <img class="logo" src="../img/Logo%20wellbeeing%207.0%20-%20cut.png" alt="Wellbeeinglogo">
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
                                                              src="https://i484476.hera.fhict.nl/OPP_Webshop/Public/img/shoppingCartIcon.png"
                                                              alt="ShoppingCart"/></a>
</header>
<div class="bodysection">
<h2>Vul je gegevens in</h2>

<table>

  <thead>

  <tr>
    <td><label for="fName">Voornaam:</label><br>
      <input type="text" id="fName" name="fName">
    </td>
    <td><label for="insertion">Tussenvoegsel:</label><br>
      <input type="text" id="insertion" name="insertion">
    </td>
    <td><label for="lName">Achternaam:</label><br>
      <input type="text" id="lName" name="lName">
    </td>
  </tr>

  <tr>
    <td><label for="eMail">E-mailadres:</label><br>
      <input type="text" id="eMail" name="eMail">
    </td>
    <td><label for="pNumber">Telefoonnummer:</label><br>
      <input type="number" id="pNumber" name="pNumber">
    </td>
  </tr>

  </thead>
  <tbody>

  <tr>
    <td><label for="country">Land:</label><br>
      <input type="text" id="country" name="country">
    </td>
    <td><label for="province">Provincie:</label><br>
      <input type="text" id="province" name="province">
    </td>
  </tr>
  <tr>
    <td><label for="city">Stad:</label><br>
      <input type="text" id="city" name="city">
    </td>
    <td><label for="street">Straat:</label><br>
      <input type="text" id="street" name="street">
    </td>
    <td><label for="hNumber">Huisnummer:</label><br>
      <input type="number" id="hNumber" name="hNumber">
    </td>
    <td><label for="pCode">Postcode:</label><br>
      <input type="text" id="pCode" name="pCode">
    </td>
  </tr>

  </tbody>
  <tfoot>

  <tr>
    <td><label for="pWord">Nieuw wachtwoord:</label><br>
      <input type="password" id="pWord" name="pWord">
    </td>
    <td><label for="ConfirmpWord">Bevestig wachtwoord:</label><br>
      <input type="password" id="ConfirmpWord" name="ConfirmpWord">
    </td>

  </tfoot>

</table>

<input type="submit" class="sButton" value="Aanmelden">
</div>
<!-------Footer------>
<div class="footer-dark">
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-3 item">
          <h3>Well<span>bee</span>ing</h3>
          <ul>
            <li><a href="#">Care</a></li>
            <li><a href="#">For</a></li>
            <li><a href="#">The</a></li>
            <li><a href="#">World!</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-md-3 item">
          <h3>Team
          </h3>
          <ul>
            <li><a href="#">Allert</a></li>
            <li><a href="#">Bavli</a></li>
            <li><a href="#">Stan</a></li>
            <li><a href="#">Daniel</a></li>
            <li><a href="#">Semmy</a></li>
          </ul>
        </div>
        <div class="col-md-6 item text">
          <h3>Well<span>bee</span>ing.</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
            laboris nisi ut aliquip ex ea commodo consequat</p>
        </div>
        <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i
                class="icon ion-social-twitter"></i></a><a href="#"><i
                class="icon ion-social-snapchat"></i></a><a href="#"><i
                class="icon ion-social-instagram"></i></a></div>
      </div>
      <p class="copyright">Well<span>bee</span>ing inc © 2022</p>
    </div>

  </footer>
</div>

</body>
</html>
