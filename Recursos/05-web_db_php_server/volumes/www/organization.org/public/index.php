<?php

/** 
 * PHP Version 7.4
 * @package /
 * @author Giancarlo
 * @version 1.0
 * @copyright 2020 GNC
 */

$author = "@gncdev";
$version = "1.0";
$webpage = "https://twitter.com/gncdev"

echo "<h1>hola mundo</h1>";
echo "<p>La suma es: </p>";
echo 1+1;
echo "<p><b>Autor:</b><a href="$webpage"> $author.</a></p>";

?>

<p><b>Version:</b> <?php $version ?></p>
<p><b>Date:</b> <?php echo date("d.m.Y");?></p>
<p><b>Time:</b> <?php echo date("H:i:s");?></p>