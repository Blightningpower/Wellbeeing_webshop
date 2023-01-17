<?php

function component($productname, $productprice, $productimage, $productid)
{
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

function cartElement($productimg, $productname, $productprice, $productid)
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
                                <small class=\"text-secondary\">Seller: dailytuition</small>
                                <h5 class=\"pt-2\">$$productprice</h5>
                                <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
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