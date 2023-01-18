<?php

/* Functie met de parameters naam, prijs, afbeelding en id. Wordt gebruikt om de producten met de juiste gegevens op de webshop
weer te geven. Deze gegevens worden uit de database gehaald. */
function products($productname, $productprice, $productimage, $productid)
{
    $element =
        "<form action=\"homepage.php\" method=\"post\">
    <div class=\"divProductImg1\"><img class=\"productImg1\"
    src=\"$productimage\"
    alt=\"productimage\"><span
class=\"flexProductsText1\">$productname<br> &#8364 $productprice</span>
</div>
<button class=\"productLookButton1\" name=\"add\">Toevoegen aan winkelmand</button>
<input type='hidden' name='product_id' value='$productid'>
</form>";
    echo $element;
}

/* Functie met de parameters naam, prijs, afbeelding en id. Wordt gebruikt om de producten met de juiste gegevens in de winkelmand
weer te geven. */
function cartProducts($productimg, $productname, $productprice, $productid)
{
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <br>
                                <h5 class=\"pt-2\">€ $productprice</h5>
                                <br>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Verwijder</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                                    <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    ";
    echo $element;
}