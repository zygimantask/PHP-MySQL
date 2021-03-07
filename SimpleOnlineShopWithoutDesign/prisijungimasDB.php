<?php

$mysqli_connection = mysqli_connect('localhost', 'root', '', 'internetineparduotuve');

if
 ($mysqli_connection === false) {
    die("Prisijungti nepavyko. " . mysqli_connect_error());
}
?>