<?php
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
} else {
    include "prisijungimasDB.php";
    if (isset($_GET["dashboardAction"])) {
        switch ($_GET['dashboardAction']) {
            case 'atsijungti':
                setcookie("username", "username", time() - 60 * 60 * 4);
                setcookie("slaptazodis", "slaptazodis", time() - 60 * 60 * 4);
                header('Location: index.php');
                break;
            case "pateikti":
                $preke = $_GET["preke"];
                $prekesKiekis = $_GET["prekes_kiekis"];
                $sqlToSelectItems = "SELECT * FROM prekes WHERE pavadinimas = '" . $preke . "'";
                if ($result = mysqli_query($mysqli_connection, $sqlToSelectItems)) {
                    if (mysqli_num_rows($result) > 0) {
                        for ($i = 0; $i < $prekesKiekis; $i++) {
                            $sqlToInsertDataOrders = "INSERT INTO orders "
                                    . "(preke, vartotojas) "
                                    . "VALUES ("
                                    . "'" . $preke . "',"
                                    . "'" . $_COOKIE["username"]
                                    . "')";
                            mysqli_query($mysqli_connection, $sqlToInsertDataOrders);
                        }
                    } else {
                        echo "Item not found in our stock!";
                    }
                } else {
                    echo "Query failed to run!";
                }
                break;
            case "uzsakyti":
                $sqlToSelectOrders = "SELECT * FROM cart_userid WHERE username = '" . $_COOKIE["username"] . "'";
                if ($result = mysqli_query($mysqli_connection, $sqlToSelectOrders)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $sqlToInsertDataKrepselis = "INSERT INTO uzsakymai "
                                    . "(preke, username, kiekis, kaina) "
                                    . "VALUES ("
                                    . "'" . $row["preke"] . "',"
                                    . "'" . $_COOKIE["username"] . "',"
                                    . "'" . $row["ammount"] . "',"
                                    . "" . $row["suma"]
                                    . ")";
                            $sqlToDelete = "DELETE FROM cart_userid where username= '" . $_COOKIE["username"] . "' and preke='" . $row["preke"] . "'";
                            mysqli_query($mysqli_connection, $sqlToDelete);
                            mysqli_query($mysqli_connection, $sqlToInsertDataKrepselis);
                        }
                    }
                }
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Internetinė parduotuvė</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            label, input { 
                display: block;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <?php
        if (!isset($_GET["dashboardAction"])) {
            include 'prekesView.php';
        } else {
            if ($_GET["dashboardAction"] === "krepselis") {
                include 'krepselisView.php';
            } elseif ($_GET["dashboardAction"] === "ivertinimas") {
                include 'ivertinimasView.php';
            } else {
                include 'prekesView.php';
            }
        }
        ?>
    </body>
</html>
