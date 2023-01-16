<?php

function add_to_cart($item, $quantity): void
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    if (isset($_SESSION['cart'][$item])) {
        $_SESSION['cart'][$item] += $quantity;
    } else {
        $_SESSION['cart'][$item] = $quantity;
    }
}

function remove_from_cart($item): void
{
    if (isset($_SESSION['cart'][$item])) {
        unset($_SESSION['cart'][$item]);
    }
}

function update_cart($item, $quantity): void
{
    if (isset($_SESSION['cart'][$item])) {
        $_SESSION['cart'][$item] = $quantity;
    }
}

function display_cart(): void
{
    if (empty($_SESSION['cart'])) {
        echo "Your cart is empty.";
    } else {
        echo "<table>";
        echo "<tr><th>Item</th><th>Quantity</th></tr>";
        foreach ($_SESSION['cart'] as $item => $quantity) {
            echo "<tr>";
            echo "<td>" . $item . "</td>";
            echo "<td>" . $quantity . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
