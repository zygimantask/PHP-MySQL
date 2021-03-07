<h1>Prekės</h1>
<?php
$prekiu_tipai = [
    "Laisvalaikio",
    "Maisto",
    "Statybines"
];
foreach ($prekiu_tipai as $value) {
    $sqlToSelectAllDataFromItems = "SELECT * FROM prekes where tipas='" . $value . "'";
    $queryResult = mysqli_query($mysqli_connection, $sqlToSelectAllDataFromItems);
    if ($queryResult) {
        if (mysqli_num_rows($queryResult) == 0) {
            continue;
        }
        ?>
        <h2><?php echo $value ?></h2>
        <?php if ($value === "Maisto") {
            ?> <dl> <?php
            } else {
                ?> <ul> <?php }
            ?>
                <?php
                while ($row = mysqli_fetch_array($queryResult, MYSQLI_ASSOC)) {
                    ?>

                    <?php if ($value === "Maisto") {
                        ?> 
                        <dt><?php echo $row["storage_conditions"] ?></dt>
                        <dd> 
                            <?php
                        } else {
                            ?> <li> <?php }
                        ?>
                            <?php echo $row["pavadinimas"] . " - " . $row["kaina"] . "EUR" ?>
                        <form action="krepselis.php">
                            <input type="hidden" name="pavadinimas" value="<?php echo $row["pavadinimas"] ?>">

                            <input name="kiekis" placeholder="Iveskite kieki"
                                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                   accept=""type = "number"
                                   accesskey="" maxlength = "3"
                                   />

                            <input type="hidden" name="kaina" value="<?php echo $row["kaina"]; ?>">
                            <input type="submit" value="Į krepšelį">
                        </form>
                        <?php if ($value === "Maisto") {
                            ?> </dt> <?php
                        } else {
                            ?> </li> <?php }
                        ?>
                    <?php
                }
            }
            ?>
            <?php if ($value === "Maisto") {
                ?> </dd> <?php
                } else {
                    ?> </ul> <?php }
                ?>
    <?php } ?>
    <form action="index.php" method="GET">
        <?php
        $sqlVartotojoKrepselis = "Select * from cart_userid where username='" . $_COOKIE["username"] . "'";
        $queryResult1 = mysqli_query($mysqli_connection, $sqlVartotojoKrepselis);
        if (mysqli_num_rows($queryResult1) > 0) {
            ?>
            <input name="dashboardAction" type="submit" value="krepselis">
            <?php
        }
        ?>
        <input name="dashboardAction" type="submit" value="atsijungti">
        <input name="dashboardAction" type="submit" value="ivertinimas">
    </form>