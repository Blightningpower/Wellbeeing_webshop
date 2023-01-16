<?php

function component($productname, $productprice, $productimage, $productid, $productpage)
{
    $element =
        "<form action=\"index.php\" method=\"post\">
        <div class=\"divProductImg1\"><img class=\"productImg1\"
    src=\"$productimage\"
    alt=\"productimage\"><span
    class=\"flexProductsText1\">$productname<br> &#8364 $productprice</span>
    </div>
    <button type=\"submit\" class=\"productLookButton1\" name=\"add\">Toevoegen aan winkelmand</button>
    <input type='hidden' name='product_id' value='$productid'></form>";
    echo $element;
}

?>