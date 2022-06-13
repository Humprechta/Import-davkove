<?php
require_once 'connect.php';
?>

<!DOCTYPE html>
<html>
<body>

<h1>Ukladani do databaze</h1>

<h3>Vložte soubor typu csv.</h3>
<form action="insert.php" method="post">
  <label for="myfile">Select a file:</label>
  <input type="file" id="myfile" name="files"><br><br>
  <input type="submit">
</form>
<h3>Může to i chvíli trvat...</h3>
</body>
</html>
