<?php

$url = "http://www.stylhunt.com/Sellboard24/module/line/api/api_get_detailproduct_with_name.php?p_name=" + encodeURIComponent(product_name);
$json = file_get_contents($url);
$obj = json_decode($json);
echo $obj->access_token;

?>
