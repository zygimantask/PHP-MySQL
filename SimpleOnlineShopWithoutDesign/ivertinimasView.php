
<?php
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
} else {
    include "prisijungimasDB.php";

    $getUserIdByUsername = "SELECT id from vartotojai where username='" . $_COOKIE["username"] . "'";
    $result = mysqli_query($mysqli_connection, $getUserIdByUsername);

    if (isset($_GET) && !array_key_exists("dashboardAction", $_GET)) {
        $sum = 0;
        $count = 0;
        foreach ($_GET as $val) {
            $sum += (int) $val;
            $count++;
        }
        $avg = (double) $sum / $count;

        if ($avg != 0) {
            $sqlToInsertDataOrders = "INSERT INTO vertinimas "
                    . "(vartotojo_id, vidurkis) "
                    . "VALUES ("
                    . "'" . $result->fetch_row()[0] . "',"
                    . "" . $avg
                    . ")";
            mysqli_query($mysqli_connection, $sqlToInsertDataOrders);
        }
    }
}
?>


<form action="ivertinimasView.php">
    <?php if (isset($_GET) && !array_key_exists("dashboardAction", $_GET)) {
        ?> 
        <h1>Jusu ivertinimas - <?php echo $avg ?> /5</h1>
        <a href="index.php">Grizti i bendra puslapi</a>
        <?php
    } else {
        ?> 
        <?php
        $klausimai_list = [
            "Puslapio funkcionalumas",
            "Pristatymo terminas",
            "Prekiu kokybe",
            "Aptarnavimo kokybe",
            "Komunikacija"
        ];

        foreach ($klausimai_list as $value) {
            ?>
            <label for="<?php echo $value ?>"><?php echo $value ?></label>
            <select name="<?php echo $value ?>">
                <option value="1">L.Prastai</option>
                <option value="2">Prastai</option>
                <option value="3">Vidutiniskai</option>
                <option value="4">Gerai</option>
                <option value="5">L.Gerai</option>
            </select>
            <?php
        }
        ?>
        <input type="submit">
    <?php } ?>
</form>
