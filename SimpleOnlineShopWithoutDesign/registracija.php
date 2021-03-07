<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registracija</title>
        <style>
            input, label { display: block; }
            input { margin-bottom: 5px; }
        </style>
    </head>
    <body>
        <h1>Registracija</h1>
        <form method="POST" action="prisijungimas.php">
            <label for="vardas">Vardas:</label>
            <input type="text" name="vardas">
            <label for="pavarde">Pavarde:</label>
            <input type="text" name="pavarde">
            <label for="username">
                Vartotojo vardas (prisijungimas):
            </label>
            <input type="text" name="username">
            <label for="slaptazodis">Slaptazodis:</label>
            <input type="password" name="slaptazodis">
            <input name="registracija" type="submit" value="Registruotis">
        </form>
    </body>
</html>
