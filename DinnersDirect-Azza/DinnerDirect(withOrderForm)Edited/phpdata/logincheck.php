<?php

//making this a function

require_once('databasephp.php');
session_start();

//ALTER THE TABLE DEFAULT VALUES FOR ALL THE REQUIRED COLUMNS 05/02/2019
mysqli_query($link,"ALTER TABLE customers
/*ALTER COLUMN store_id SET DEFAULT NULL,
ALTER COLUMN address_id SET DEFAULT NULL,
ALTER COLUMN active SET DEFAULT '1',
ALTER COLUMN create_date SET DEFAULT CURRENT_TIMESTAMP*/
))");

//$firstName = $_POST['first_name'] ?? '1'; //dataphp 7.0
//$familyName = $_POST['last_name'] ?? '1';
$emailSql=$_POST['email']; //want to retrieve email
$passwordSQL=$_POST['password'];
/*$qryAdd = "INSERT INTO customer (first_name, last_name, email) VALUES (";
$qryAdd .= "'" . $firstName . "', '" . $familyName . "', '" . $emailSql . "')";*/

$qryFind = "SELECT * FROM customers ";
$qryFind .= " WHERE password = '" . $passwordSQL ."' AND email = '" . $emailSql . "'";

$connection = connectToDb();

//Check if the name exists
$result = mysqli_query($connection, $qryFind);
if (empty($result)){
    echo "The result is empty";
}
if (mysqli_num_rows($result) > 0) {

    echo '<script type="text/javascript"> alert("You are logged in!") </script>';
    $user = mysqli_fetch_assoc($result);
    //echo "Welcome";
    //echo $user['first_name'];
    //echo $user['last_name'];
    $userID=$user['customerID'];
    $_SESSION['userID']=$userID;
    //echo $userID; //test to make sure customer id in sql database corresponds
    //header('Location: http://localhost/DinnersDirecHuiEn/startbootstrap-shop-homepage-gh-pages/index.html');
    //exit;
} else {
        echo "Cannot find the selected user. Please try again or create a new account.";
        echo "$emailSql, $passwordSQL";
        closeDb($connection);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome to DinnersDirect </title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/shop-homepage.css" rel="stylesheet">

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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../about.html">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../phpdata/pullorderdata.php">MyAccount</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../createnewaccount.html">Create Account</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="order.php">Order</a>
                    <!--<a class="nav-link text-uppercase text-expanded" href="products.html">Products</a>!-->
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">
    <h1> login to your account </h1>
    <form method="post" action="logincheck.php">
        Your Email:<br>
        <input type="email" name="email" required><br>
        Your password:<br>
        <input type="password" name="password" required><br>
        <br><br>
        <input type="submit" class="btn btn-primary" value="Submit" required>
    </form>

    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">DinnersDirect</h1>
            <div class="list-group">
                <a href="menu.php" class="list-group-item">Menu</a>
                <a href="order.php" class="list-group-item">Order</a>
                <a href="#" class="list-group-item">Category 3</a>
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="../img/frontpage900.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="row">

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="https://i.imgur.com/9TwJKfV.jpg" alt="Croissant"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="menu.php">Croissant</a>
                            </h4>
                            <h5>£1.30</h5>
                            <p class="card-text">Breakfast pastry, prefect for a rush morning!</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9733;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="https://i.imgur.com/ncYf27F.jpg" alt="Donuts"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Donuts</a>
                            </h4>
                            <h5>£2.00</h5>
                            <p class="card-text">Colourful glazed donuts for sweet cravings.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="https://i.imgur.com/opKASPl.jpg" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Fruit Cake</a>
                            </h4>
                            <h5>£3.50</h5>
                            <p class="card-text">Delicious creamy layered cake topped with a strawberry !</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="https://i.imgur.com/pt2WDxj.jpg" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Stir Fried Flat Rice Noodles</a>
                            </h4>
                            <h5>£7.00</h5>
                            <p class="card-text">Stir fried over high heat with soy sauce</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="https://i.imgur.com/lDyqZbg.jpg" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Gamberi Spaghetti</a>
                            </h4>
                            <h5>£9.50</h5>
                            <p class="card-text">Pasta with tomato sauce with gently cooked prawns</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="https://i.imgur.com/400kbjs.jpg?1" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Kimchi Fried Rice</a>
                            </h4>
                            <h5>£8.50</h5>
                            <p class="card-text">Stir fried well-fermented kimchi with chilled rice topped with a sunny side up!</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

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
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

