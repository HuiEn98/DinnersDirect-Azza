<?php
session_start();
require_once("dbConnect.php");
$db_handle = new DBConnect();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menu</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/menu.css" rel="stylesheet" />

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

                <!-- Shopping Cart -->
                <div id="shopping-cart">
                    <div class="txt-heading">View Summary</div>
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
                    }
                    ?>

                </div>
                <!-- /.Shopping Cart -->

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