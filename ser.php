<!DOCKTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>First</title>
</head>

<body>
<form method="get" action="ser.php">
    What is your name: <input type="text" name="username"> <br>
</form>
<form method="post" action="ser.php">
    Apples: <input type="checkbox" name="fruits[]" value="apples"> <br>
    Melons: <input type="checkbox" name="fruits[]" value="melons"> <br>
    Peaches: <input type="checkbox" name="fruits[]" value="peaches"> <br>
    Potatoes: <input type="checkbox" name="vegetables[]" value="potatoes"> <br>
    Carrots: <input type="checkbox" name="vegetables[]" value="carrots"> <br>
    <input type="submit">
</form>
<br>
<?php
$username = $_GET["username"];
$fruits = $_POST["fruits"];
$vegetables = $_POST["vegetables"];
?>
php part: <br>
<?php echo $username; ?> likes <br>
fruits <?php echo count($fruits); ?> <br>
vegetables <?php echo count($vegetables);?>

</body>
</html>