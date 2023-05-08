


<!--view vom Cart-->
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        <?php
            include "cartcss.css";
        ?>
    </style>
    <script>

    </script>
</head>
<body>

<div class="CartContainer" style="margin-left: 5%; width:90%;">
    <div class="Header">
        <h3 class="Heading">Shopping Cart</h3>
        <form method="post">
            <h5>
                <button class="btn btn-info btn-lg" type="submit" name="removeAll" style="background-color: dodgerblue">Remove all</button>
            </h5>
        </form>
    </div>

    <?php

      foreach ($games as $game):  ?>

        <div class="Cart-Items">
            <div class="image-box">
                <?php echo
                    ' <img id=ImgGame src= "data: img;base64 ,' . base64_encode($game ['image']) . ' " class=media-object style=width:120px  id=showImg> ' ?>
            </div>
            <div class="about">
                <h1 class="title"><?php echo $game->name ?></h1>
            </div>
            <div class="prices">
                <div class="amount"><?php echo $game->price ." €" ?></div>
                <form method="post">
                    <div class="remove">
                      <u>
                          <button style="background-color: dodgerblue" class="btn btn-info" type="submit" name=<?php echo
                                "remove" . $game->id;
                                $itemCount = $itemCount + 1;
                                $priceCount = $priceCount + $game->price;?>>Remove
                            </button>
                        </u>
                      </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <hr>
    <div class="checkout">
        <div class="total">
            <div>
                <div class="Subtotal">Sub-Total</div>
                <div class="items"><?php echo "Total Items: " . $itemCount ?></div>
            </div>
            <div class="total-amount"><?php echo $priceCount . "€";$_SESSION['totalPrice']=$priceCount?></div>
        </div>
        <form method="post"><a href="/Website/public/index.php/payment">
            <button class="btn btn-info btn-lg" style="background-color: dodgerblue" name="payButton">
                Checkout</button></a></form>
    </div>
</div>


<?php

if ($itemCount == 0) {
    header('location:/Website/public/index.php/index');
} ?>
</body>

</html>
