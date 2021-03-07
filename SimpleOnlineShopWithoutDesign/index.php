<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Internetinė parduotuvė</title>
    </head>
    <body>
        <?php
        include "prisijungimasDB.php";
        if (isset($_POST["prisijungimas"])) {
            $prisijungimasVartotojoVardas = filter_input(INPUT_POST, "username");
            $prisijungimasSlaptazodis = filter_input(INPUT_POST, "slaptazodis");

            $sqlToSelectVartotojas = "SELECT * FROM vartotojai WHERE username = '" . $prisijungimasVartotojoVardas . "'";

            if ($result = mysqli_query($mysqli_connection, $sqlToSelectVartotojas)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $rowPassword = $row["slaptazodis"];
                        if (password_verify($prisijungimasSlaptazodis, $rowPassword)) {
                            setcookie("username", $row["username"], time() + 60 * 60 * 4);
                            setcookie("slaptazodis", $row["slaptazodis"], time() + 60 * 60 * 4);
                            echo "Sveiki, " . $row["username"] . ", atvykę į internetinę parduotuvę!<br>";
                            header("Location: http://localhost/InternetineParduotuve/index.php");
                            exit();
                        } else {
                            echo "Neteisingas vartotojo vardas arba slaptazodis.<br>";
                            include "actions1.html";
                        }
                    }
                } else {
                    echo "Neteisingas vartotojo vardas arba slaptazodis.<br>";
                    include "actions1.html";
                }
            } else {
                echo "Query failed to run!";
            }
        } elseif (array_key_exists("username", $_COOKIE)) {
            $sqlToSelectVartotojas = "SELECT * FROM vartotojai WHERE username = '" . $_COOKIE["username"] . "'";
            if ($result = mysqli_query($mysqli_connection, $sqlToSelectVartotojas)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $rowPassword = $row["slaptazodis"];
                        if ($_COOKIE["slaptazodis"] == $row["slaptazodis"]) {
                            echo "Sveiki, " . $row["username"] . ", atvyke į internetinę parduotuvę!<br>";
                            include "vidus.php";
                            exit;
                        } else {
                            echo "Neteisingas vartotojo vardas arba slaptazodis.<br>";
                            include "actions1.html";
                        }
                    }
                }
            }
        } else {
            echo "Sveiki atvyke į internetinę parduotuvę!<br>";
            include "actions1.html";
        }
        ?>
    </body>
</html>
