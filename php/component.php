<?php

function component($productname, $productprice, $productimage, $productid){
    $element = 
    "<form action=\"homepage.php\" method=\"post\">
    <div class=\"divProductImg1\"><img class=\"productImg1\"
    src=\"$productimage\"
    alt=\"productimage\"><span
class=\"flexProductsText1\">$productname<br> &#8364 $productprice</span>
</div>
<button class=\"productLookButton1\" name=\"add\">Product bekijken</button>
<input type='hidden' name='product_id' value='$productid'>
</form>";
echo $element;
}
