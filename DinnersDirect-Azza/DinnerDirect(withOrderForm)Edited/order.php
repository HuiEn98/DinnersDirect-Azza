<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../order_js.js" defer> </script>
    <title>Shop Homepage - Start Bootstrap Template</title>

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
                <li class="nav-item ">
                    <a class="nav-link" href="index.html">Home</a>
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
                    <a class="nav-link" href="order.html">Order</a>
                    <span class="sr-only">(current)</span>
                    <!--<a class="nav-link text-uppercase text-expanded" href="products.html">Products</a>!-->
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <br><br>
            <br><br>
            <div class="list-group">
                <a href="menu.php" class="list-group-item">Menu</a>
                <a href="#" class="list-group-item">Category 2</a>
                <a href="#" class="list-group-item">Category 3</a>
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
            <h1 class="my-4">Select Your Meal Set</h1>
            <p>Select an item as your starter, main, dessert and drink to complete your set</p>

            <form action="" method="post" name="Meal">
                <p class="my-4">Select your starter</p>
                <select name = "starter" id="starterIN" style="width:150px" required>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "root";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    mysqli_select_db($conn,"dinnersdirect"); //set the database name

                    $menu=" ";

                    $sql="SELECT starter_name FROM starter"; //selection query
                    $result = mysqli_query($conn, $sql);//odbc_exec($conn,$sql);


                    if (mysqli_num_rows($result) > 0) {
                        echo '<option disabled selected value></option>';
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            $menu .= "<option value=".$row['starter_name'].">" . $row['starter_name']. "</option>";
                        }
                    }

                    echo $menu;

                    mysqli_close($conn);

                    ?>
                </select>

                <p class="my-4">Select your main</p>
                <select name = "main" id="mainIN" style="width:150px" required>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "root";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    mysqli_select_db($conn,"dinnersdirect"); //set the database name

                    $menu=" ";

                    $sql="SELECT main_name FROM main"; //selection query
                    $result = mysqli_query($conn, $sql);//odbc_exec($conn,$sql);


                    if (mysqli_num_rows($result) > 0) {
                        echo '<option disabled selected value></option>';
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            $menu .= "<option value=".$row['main_name'].">" . $row['main_name']. "</option>";
                        }
                    }

                    echo $menu;

                    mysqli_close($conn);

                    ?>
                </select>

                <p class="my-4">Select your dessert</p>
                <select name = "dessert" id="dessertIN" style="width:150px" required>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "root";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    mysqli_select_db($conn,"dinnersdirect"); //set the database name

                    $menu=" ";

                    $sql="SELECT dessert_name FROM dessert"; //selection query
                    $result = mysqli_query($conn, $sql);//odbc_exec($conn,$sql);


                    if (mysqli_num_rows($result) > 0) {
                        echo '<option disabled selected value></option>';
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            $menu .= "<option value=".$row['dessert_name'].">" . $row['dessert_name']. "</option>";
                        }
                    }

                    echo $menu;

                    mysqli_close($conn);

                    ?>
                </select>

                <p class="my-4 ">Select your drink</p>
                <select name = "drink" id="drinkIN" style="width:150px" required>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "root";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    mysqli_select_db($conn,"dinnersdirect"); //set the database name

                    $menu=" ";

                    $sql="SELECT drink_name FROM drink"; //selection query
                    $result = mysqli_query($conn, $sql);//odbc_exec($conn,$sql);


                    if (mysqli_num_rows($result) > 0) {
                        echo '<option disabled selected value></option>';
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            $menu .= "<option value=".$row['drink_name'].">" . $row['drink_name']. "</option>";
                        }
                    }

                    echo $menu;

                    mysqli_close($conn);

                    ?>
                </select>

                <br><br>
                <div class="row" >
                    <button  class="mr-2" type = "submit" formaction="Add2Cart.php" >Add to Basket</button>
                    <button type = "submit"  formaction="Checkout.php">Checkout</button>
                </div>

                <br><br>
            </form>


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
