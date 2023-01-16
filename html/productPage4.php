<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>OPP Webshop Standaard Verzenddoos</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>

    /*This code is applied on the whole page*/

    body {
      margin-top: 25px;
      padding: 0;
      background-color: #242F35;
      height: 75vh;
      justify-content: center;
    }

    .Header {
      margin: auto;
      width: 90%;
      height: 15%;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .Cart-Container {
      width: 80%;
      height: 85%;
      background-color: #ffffff;
      border-radius: 20px;
      box-shadow: 0 25px 40px #1687d933;
      margin-right: 0;
      margin-top: 60px;
      margin-left: 125px;
      padding-bottom: 36px;
    }

    ol.navBorder {
      background-color: #00A6FF;
      border: 2px solid black;
      margin-top: -25px;
      margin-left: -8px;
      width: 100%;
      float: left;
      position: absolute;
      white-space: nowrap;
      line-height: 125%;
      list-style-type: none;
      padding: 0;
      overflow: hidden;
    }

    li {
      margin: 5px;
      display: inline;
    }

    li a {
      background-color: black;
      text-align: center;
      border: 1px solid black;
      border-radius: 8px;
      padding: 6px;
      color: white !important;
      font-family: bold, Impact, sans-serif;
      font-size: 15px !important;
      position: relative;
      top: -25px;
    }

    li a:hover {
      background-color: #555;
      color: white;
    }

    img.logo {
      width: 140px;
      height: 80px;
      margin-top: -5px;
    }

    .productName {
      float: right;
      margin-right: 5%;
      width: 10%;
      display: flex;
      justify-content: space-between;
      line-height: 5px;
    }

    .sButton {
      background-color: white;
      color: #033483;
      border: 3px solid #033483;
      border-radius: 12px;
      font-weight: bold;
      font-size: 15px;
      overflow: hidden;
      margin-top: 147px;
      margin-left: 38em;
    }

    .sButton:hover {
      background-color: #033483;
      color: white;
    }

    ol.productName {
      display: inline;
      margin-right: 50px;
      background-color: #D9D9D9;
      border: 2px solid black;
      width: 150px;
      height: 5em;
    }

    li {
      display: inline-flex;
      margin-top: 10px;
    }

    li.productText {
      font-size: 13px;
    }

    p.productName1 {
      display: inline-flex;
      margin-left: -13px;
      margin-top: 2em;
      font-size: 10px;
      font-family: bold, sans-serif;
      font-weight: 600;
    }

    p.productPrice {
      display: inline-flex;
      font-size: 11px;
      font-family: bold, sans-serif;
      font-weight: 600;
      margin-left: -1em;
    }

    ol.productDescription {
      display: inline;
      margin-right: 3em;
      background-color: #FDC43F;
      border: 2px solid black;
      width: 150px;
      height: 5em;
      float: right;
      padding-bottom: 75px;
    }

    p.productText {
      font-family: bold, sans-serif;
      font-weight: 700;
      color: #202020;
      flex-wrap: nowrap;
      float: left;
      margin-left: -2em;
      margin-top: 5px;
    }

    p.productText1 {
      font-size: small;
      float: left;
      margin-left: -33px;
    }

    img.productImage {
      float: left;
      position: absolute;
      bottom: 8em;
      width: 23%;
      border: 2px solid black;
    }

    div.numberInput {
      padding-left: 30em;
      position: absolute;
      bottom: 15em;
    }

    /*This code is for the footer*/

    footer {
      background-color: #00A6FF;
      border: 2px solid black;
      list-style-type: none;
      padding: 0;
      overflow: hidden;
      height: 21px;
      margin-top: 89px;
      margin-left: -8px;
      float: left;
      position: absolute;
      bottom: 0;
      width: 100%;
      white-space: nowrap;
      line-height: 300%;
    }

    [alt="noStyle1"] {
      text-decoration: none;
      color: white;
    }

  </style>
</head>
<body>

<ol class="navBorder">

  <li><img class="logo" src="https://i484476.hera.fhict.nl/OPP_Webshop/Public/img/Logo%202.5%20cut.png" alt=""></li>
  <li><a href="index.html" alt="noStyle1">Webshop</a></li>
  <li><a href="signUp.html" alt="noStyle1">Aanmelden</a></li>
  <li><a href="logIn.html" alt="noStyle1">Inloggen</a></li>
</ol>

<br><br>

<div class="Cart-Container">
  <div class="Header">
    <img src="https://i484476.hera.fhict.nl/OPP_Webshop/Public/img/Verzenddoos%20-%20Postdoos.png" class="productImage" alt="">
  </div>

  <div class="numberInput"><label for="myNumber"></label><input type="number" id="myNumber" value="1" style="
    width: 30%;"></div>

  <script>
    {
      document.getElementById("").innerHTML = document.getElementById("myNumber").value;
    }
  </script>

  <ol class="productName">
    <p class="productName1">Verzenddoos - Postdoos</p>
    <p class="productPrice">Prijs: €0,50</p>
  </ol>

  <form action="shoppingCart.html">
    <button class="sButton" type="submit">Plaats in Winkelmand</button>
  </form>

  <ol class="productDescription">
    <p class="productText">Productbeschrijving:</p>
    <p class="productText1">Deze doos heeft een afmeting van 55mm x 55mm x 15mm en is momenteel alleen verkrijgbaar in
      het grijs.</p>
  </ol>

</div>

<footer></footer>

</body>
</html>

