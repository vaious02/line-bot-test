<?php

$url = "http://www.stylhunt.com/Sellboard24/module/line/api/api_get_detailproduct_with_name.php?p_name=Couple%20bow";
$json = file_get_contents($url);
$obj = json_decode($json);
echo $json;

?>
