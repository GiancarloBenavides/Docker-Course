<?php

//require_once("../config/databases.php");
//require_once("../config/messages.php");
//require_once("../config/const.php");
//$config = include('../config/const.php');

//header('Content-Type: application/json');
//echo json_encode($config->dev->host, JSON_PRETTY_PRINT | JSON_UNESCAPED_LINE_TERMINATORS);


$arrFiles = array();
$handle = opendir('../config');

if ($handle) {
    while (($entry = readdir($handle)) !== FALSE) {
        $arrFiles[] = $entry;
    }
}

closedir($handle);
//echo var_dump($arrFiles);


$phats = glob("../config/*.php");
$index = array_search("../config/databases.php", $phats);
$path = $phats[0];

?>

<pre>
<?php

//print_r($arrFiles);
echo print_r($phats);
echo "<br>";
echo "<br>";
echo "<br>";
echo "Index: " . $index; 



$file = explode(".", basename($path))[0];

$config = array(); 

$config = array_merge($config, array($file => include($path)));

print_r(json_encode($config, JSON_PRETTY_PRINT));

echo "<br>";
echo "<br>";

$path = glob("../config/*.php")[1];
$file = explode(".", basename($path))[0];

$config = array_merge($config, array($file => include($path)));


print_r(json_encode($config, JSON_PRETTY_PRINT));



print_r($GLOBALS[$file]);



// echo var_dump($_ENV);

// echo "<br><br>variable ex: ";

// echo var_dump($_ENV);


// echo "<br><br>globals: ";

// echo var_dump(get_defined_constants());

?>
</pre>
