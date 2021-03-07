<?php

if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
} else {
    include "prisijungimasDB.php";

    $sqlToInsertDataKrepselis = "INSERT INTO cart_userid "
            . "(preke, username, ammount, suma) "
            . "VALUES ("
            . "'" . $_GET["pavadinimas"] . "',"
            . "'" . $_COOKIE["username"] . "',"
            . "'" . $_GET["kiekis"] . "',"
            . $_GET["kaina"] * $_GET["kiekis"]
            . ")";
    echo $sqlToInsertDataKrepselis;
    mysqli_query($mysqli_connection, $sqlToInsertDataKrepselis);

    header("Location: http://localhost/InternetineParduotuve/index.php");
    exit();
}
?>