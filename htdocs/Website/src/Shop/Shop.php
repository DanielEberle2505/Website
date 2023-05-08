<?php

namespace App\Shop;


class Shop {
    public function __construct() {
    }

    public function render($view, $params) {
        extract($params);
        include __DIR__ . "/../../views/{$view}.php";
    }

    public function showCart() {
        session_start();
        $products=$_SESSION['cart'];
        $user=$_SESSION['id'];
        $this->render("shop/cart",[
            'products' => $products ,
            'user' => $user
            ]);
    }
}
