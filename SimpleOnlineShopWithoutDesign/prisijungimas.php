<?php
if (isset($_POST["registracija"])) {
    include "prisijungimasDB.php";
    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
    } else {
        $registracijaVardas = filter_input(INPUT_POST, "vardas");
        $registracijaPavarde = filter_input(INPUT_POST, "pavarde");
        $registracijaVartotojoVardas = filter_input(INPUT_POST, "username");
        $registracijaSlaptazodis = password_hash(filter_input(INPUT_POST, "slaptazodis"), PASSWORD_DEFAULT);

        $sqlToInsertDataVartotojai = "INSERT INTO vartotojai "
                . "(vardas, pavarde, username, slaptazodis) "
                . "VALUES ("
                . "'" . $registracijaVardas . "',"
                . "'" . $registracijaPavarde . "',"
                . "'" . $registracijaVartotojoVardas . "',"
                . "'" . $registracijaSlaptazodis . "')";


        mysqli_query($mysqli_connection, $sqlToInsertDataVartotojai);

        if (mysqli_errno($mysqli_connection)) {
            if (mysqli_errno($mysqli_connection) == 1062) {
                echo "Toks vartotojas jau egzistuoja.<br>";
            } else {
                echo mysqli_error($mysqli_connection);
            }
        } else {
            echo "Registracija sėkminga!<br>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Prisijungimas</title>
        <style>
            input, label { display: block; }
            input { margin-bottom: 5px; }
        </style>
    </head>
    <body>
        <h1>Prisijungimas</h1>
        <form method="POST" action="index.php">
            <label for="username">Vartotojo vardas:</label>
            <input type="username" name="username">
            <label for="slaptazodis">Slaptazodis:</label>
            <input type="password" name="slaptazodis">
            <input name="prisijungimas" type="submit" value="Login">
        </form>
    </body>
</html>
