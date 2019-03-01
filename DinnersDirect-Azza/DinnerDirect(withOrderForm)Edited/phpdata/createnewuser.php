<?php

//making this a function

require_once('databasephp.php');

$firstName = $_POST['first_name'] ?? '1'; //dataphp 7.0
$familyName = $_POST['last_name'] ?? '1';
$emailSql=$_POST['email'] ?? '1'; //want to retrieve email
$passwordSql=$_POST['password'] ?? '1'; //retrieving password
$schoolSql=$_POST['schoolID'] ?? '1';//

$qryAdd = "INSERT INTO customers (first_name, last_name, email, password, schoolID) VALUES (";
$qryAdd .= "'" . $firstName . "', '" . $familyName . "', '" . $emailSql . "','" . $passwordSql . "', '" . $schoolSql . "')";

$qryFind = "SELECT * FROM customers ";
$qryFind .= "WHERE first_name= '" . $firstName . "' AND last_name = '" . $familyName ."' AND email = '" . $emailSql . "'";

$connection = connectToDb();

//Check if the name exists
$result = mysqli_query($connection, $qryFind);
if (mysqli_num_rows($result) > 0) {
    echo "An account already exists.";
    closeDb($connection);
} else {
    $result = mysqli_query($connection, $qryAdd);
    // check the query worked
    if ($result) {
        echo "Success, your account has been registered";
        closeDb($connection);
    } else {
        echo mysqli_error($connection);
        closeDb($connection);
        exit;
    }
}