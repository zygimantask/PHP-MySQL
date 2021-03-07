<h1>Krepselis</h1>
<ul>
    <?php
    $sqlToSelectAllDataFromItems = "SELECT * FROM cart_userid where username='" . $_COOKIE["username"] . "'";
    $queryResult = mysqli_query($mysqli_connection, $sqlToSelectAllDataFromItems);
    if ($queryResult) {
        $suma = 0;
        while ($row = mysqli_fetch_array($queryResult, MYSQLI_ASSOC)) {
            $suma += (double) $row["suma"];
            ?>
            <li>
                <?php echo $row["preke"] . " - " . $row["ammount"] . "vnt. - " . $row["suma"] . "EUR" ?>
            </li>
            <?php
        }
    }
    ?>
    <p>Bendra suma: <?php echo $suma ?> Eur</p>
</ul>
<form action="index.php" method="GET">
    <input name="dashboardAction" type="submit" value="uzsakyti">
</form>