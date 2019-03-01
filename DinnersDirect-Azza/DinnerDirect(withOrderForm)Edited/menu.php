<?php
session_start();
require_once("dbConnect.php");
$db_handle = new DBConnect();
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {
                $orderItem = $db_handle->runQuery("SELECT * FROM mealdeal WHERE code='" . $_GET["code"] . "'");
                $orderItemArray = array($orderItem[0]["code"]=>array('name'=>$orderItem[0]["name"], 'code'=>$orderItem[0]["code"], 'description'=>$orderItem[0]["description"], 'quantity'=>$_POST["quantity"], 'price'=>$orderItem[0]["price"], 'image'=>$orderItem[0]["image"]));

                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($orderItem[0]["code"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($orderItem[0]["code"] == $k) {
                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$orderItemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $orderItemArray;
                }
            }
            print_r($orderItemArray);
            break;

        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menu</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/menu.css" rel="stylesheet">

</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.html">Dinners Direct</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="index.html" collapse="navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="phpdata/pullorderdata.php">MyAccount</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="createnewaccount.html">Create Account</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="order.php">Order</a>
                    <span class="sr-only">(current)</span>
                    <!--<a class="nav-link text-uppercase text-expanded" href="products.html">Products</a>!-->
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- /.Navigation -->


<div class="container">


<!-- Side Bar -->
<div class="row">
    <div class="col-lg-3">

    <br><br>
    <br><br>
    <div class="list-group">
        <a href="menu.php" class="list-group-item">Menu</a>
        <a href="order.php" class="list-group-item">Custom Order</a>
    </div>

</div>
<!-- /.Side Bar -->

<!-- Menu -->
<div class="col-lg-9">
    <br><br>
    <br><br>


<div id="product-grid">
    <div class="txt-heading">Products</div>
    <div class="row">
    <?php
    $product_array = $db_handle->runQuery("SELECT * FROM mealdeal ORDER BY id ASC");
    if (!empty($product_array)) {
        foreach($product_array as $key=>$value){
            ?>
            <!--<div class="product-item">-->
        <div class="col-lg-4 col-md-6 mb-4" >
            <div class="card" style="height: 23rem;">
                <form method="post" action="menu.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                    <img class="card-img-top" style="height: 200px;" src="<?php echo $product_array[$key]["image"]; ?>">
                    <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                    <div class="product-description"><?php echo $product_array[$key]["description"]; ?></div>
                    <div class="product-tile-footer">
                        <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                        <div class="cart-action">
                            <select class="product-quantity" name="quantity">
                                <option selected="selected">1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                            <input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                    </div>
                </form>
            </div>
        </div>
            <!--</div>-->
            <?php
        }
    }
    ?>

</div>

    <!-- Shopping Cart -->
    <div id="shopping-cart">
        <div class="txt-heading">Shopping Cart</div>

        <a id="btnEmpty" href="menu.php?action=empty">Empty Cart</a>
        <?php
        if(isset($_SESSION["cart_item"])){
            $total_quantity = 0;
            $total_price = 0;
            ?>
            <table class="tbl-cart" cellpadding="10" cellspacing="1">
                <tbody>
                <tr>
                    <th style="text-align:left;">Name</th>
                    <th style="text-align:left;">Code</th>
                    <th style="text-align:right;" width="5%">Quantity</th>
                    <th style="text-align:right;" width="10%">Unit Price</th>
                    <th style="text-align:right;" width="10%">Price</th>
                    <th style="text-align:center;" width="5%">Remove</th>
                </tr>
                <?php
                foreach ($_SESSION["cart_item"] as $item){
                    $item_price = $item["quantity"]*$item["price"];
                    ?>
                    <tr>
                        <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                        <td><?php echo $item["code"]; ?></td>
                        <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                        <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
                        <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                        <td style="text-align:center;"><a href="menu.php?action=remove&code=<?php echo $item["code"]; ?>" ><img class="btnRemoveAction" src="img/delete.png" alt="Remove Item" /></a></td>
                    </tr>
                    <?php
                    $total_quantity += $item["quantity"];
                    $total_price += ($item["price"]*$item["quantity"]);
                }
                ?>

                <tr>
                    <td colspan="2" align="right">Total:</td>
                    <td align="right"><?php echo $total_quantity; ?></td>
                    <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <?php
        } else {
            ?>
            <div class="no-records">Your Cart is Empty</div>
            <?php
        }

        if(!empty($_SESSION["cart_item"])) {
            ?>
            <a href="checkout.php" class="btnCheckout" style=" background-color: #ffffff;
            border: #21d000 1px solid;
            padding: 5px 10px;
            color: #21d000;
            float: right;
            text-decoration: none;
            border-radius: 3px;
            margin: 10px 0px;">Checkout</a>


            <?php
        }
        ?>




    </div>
    <!-- /.Shopping Cart -->
</div>

</div>
<!-- /.col-lg-9 -->
</div>
<!-- row -->
</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>