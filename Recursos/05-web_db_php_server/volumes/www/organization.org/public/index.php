<?php

/** 
 * PHP Version 7.4
 * @package /
 * @author Giancarlo
 * @version 1.0
 * @copyright 2020 GNC
 */


$author = "@gncdev";
$version = "0.1.0.alpha";
$webpage = "https://twitter.com/gncdev";

$contador = file_get_contents('contador.txt');
file_put_contents('contador.txt', $contador+1);

$salt = rand(0,80);
$red = round(255 - $salt);
$green = round(128 + $salt);
$blue = round(80 - $salt);

$bk_color="rgb(" . $red  . "," . $green . "," . $blue .")";

$height = 33;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="img/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {background-color: <?php echo $bk_color; ?>; text-align: center;}
    </style>
</head>

<body>
<?php require_once("../sources/templates/header.php");?>

<?php 
$items = 5;
require("../sources/templates/list.php");
?>

<?php require_once("../sources/templates/footer.php");?>

</body>

</html>