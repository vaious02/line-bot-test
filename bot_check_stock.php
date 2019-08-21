<?php



$accessToken = "8JqAA77f7BO7iNwJtB4GsZGvtdvjaH7AOk/B+mz3/UvVu2iBKDEtWMJgp3f6OhaWSuvKszTSvgpqYer1n2bwHuljIAiY/OWs/Ld6nqvmKePBmTM/uAuI24UdvI7ijR/+BTGLHm6OsbPnNS/ZLT99LQdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
$content = file_get_contents('php://input');
$arrayJson = json_decode($content, true);

$arrayHeader = array();
$arrayHeader[] = "Content-Type: application/json";
$arrayHeader[] = "Authorization: Bearer {$accessToken}";

//รับข้อความจากผู้ใช้
$message = $arrayJson['events'][0]['message']['text'];

$url = "http://www.stylhunt.com/Sellboard24/module/line/api/api_get_detailproduct_with_name.php?p_name=" . $message;
$json = file_get_contents($url);
$obj = json_decode($json);

$arrayPostData = array();
$arrayPostDataCard = array();
$arrayPostDataDetail = array();
$arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];

if(count($obj) === 1) {
  for ($i=0; $i < 1 ; $i++) {
    for ($j=0; $j < count($obj); $j++) {
      $arrayPostDataDetail['type'] = "box";
      $arrayPostDataDetail['layout'] = "baseline";
      $arrayPostDataDetail['contents'][0]['type'] = "icon";
      $arrayPostDataDetail['contents'][0]['url'] = "https://img.icons8.com/color/48/000000/star.png";

      $arrayPostDataDetail['contents'][1]['type'] = "text";
      $arrayPostDataDetail['contents'][1]['text'] = $obj[$i]['stock'][$j]['name'];
      $arrayPostDataDetail['contents'][1]['flex'] = "0";
      $arrayPostDataDetail['contents'][1]['margin'] = "sm";
      $arrayPostDataDetail['contents'][1]['weight'] = "bold";

      $arrayPostDataDetail['contents'][2]['type'] = "text";
      $arrayPostDataDetail['contents'][2]['text'] = $obj[$i]['stock'][$j]['qty'] . ' ชิ้น';
      $arrayPostDataDetail['contents'][1]['size'] = "sm";
      $arrayPostDataDetail['contents'][1]['align'] = "end";
      $arrayPostDataDetail['contents'][1]['color'] = "#AAAAAA";
    }
    $arrayPostDataCard['type'] = "bubble";
    $arrayPostDataCard['body']['type'] = "box";
    $arrayPostDataCard['body']['layout'] = "vertical";
    $arrayPostDataCard['body']['spacing'] = "md";
    $arrayPostDataCard['body']['action']['type'] = "uri";
    $arrayPostDataCard['body']['action']['label'] = "Action";
    $arrayPostDataCard['body']['action']['uri'] = "http://www.stylhunt.com/Sellboard24/check_stock/index.html?p_name=" . $obj[$i]['product_name'];
    $arrayPostDataCard['body']['contents'][0]['type'] = "text";
    $arrayPostDataCard['body']['contents'][0]['text'] = $obj[$i]['product_name'];
    $arrayPostDataCard['body']['contents'][0]['size'] = "lg";
    $arrayPostDataCard['body']['contents'][0]['weight'] = "bold";
    $arrayPostDataCard['body']['contents'][1]['type'] = "separator";
    $arrayPostDataCard['body']['contents'][2]['type'] = "box";
    $arrayPostDataCard['body']['contents'][2]['layout'] = "vertical";
    $arrayPostDataCard['body']['contents'][2]['spacing'] = "sm";
    $arrayPostDataCard['body']['contents'][2]['contents'] = $arrayPostDataDetail;
    $arrayPostDataCard['body']['footer']['type'] = "box";
    $arrayPostDataCard['body']['footer']['layout'] = "vertical";
    $arrayPostDataCard['body']['footer']['contents'][0]['type'] = "button";
    $arrayPostDataCard['body']['footer']['contents'][0]['action']['type'] = "uri";
    $arrayPostDataCard['body']['footer']['contents'][0]['action']['label'] = "ดูรายละเอียด";
    $arrayPostDataCard['body']['footer']['contents'][0]['action']['uri'] = "http://www.stylhunt.com/Sellboard24/check_stock/index.html?p_name=" . $obj[$i]['product_name'];
    $arrayPostDataCard['body']['footer']['contents'][0]['color'] = "#8D769D";
    $arrayPostDataCard['body']['footer']['contents'][0]['style'] = "primary";

  }

  $arrayPostData['messages'][0]['type'] = "flex";
  $arrayPostData['messages'][0]['altText'] = "ส่งสตอคสินค้า";
  $arrayPostData['messages'][0]['contents']['type'] = "carousel";
  $arrayPostData['messages'][0]['contents']['contents'] = $arrayPostDataCard;

  replyMsg($arrayHeader,$arrayPostData);

}

if(count($obj) > 1) {
  $arrayPostDataCard['type'] = "bubble";
  $arrayPostDataCard['direction'] = "ltr";
  $arrayPostDataCard['body']['type'] = "box";
  $arrayPostDataCard['body']['layout'] = "vertical";
  $arrayPostDataCard['body']['flex'] = "0";
  $arrayPostDataCard['body']['contents'][0]['type'] = "text";
  $arrayPostDataCard['body']['contents'][0]['text'] = $message;
  $arrayPostDataCard['body']['contents'][0]['size'] = "lg";
  $arrayPostDataCard['body']['contents'][0]['weight'] = "bold";
  $arrayPostDataCard['body']['contents'][0]['wrap'] = true;
  $arrayPostDataCard['body']['contents'][1]['type'] = "separator";
  $arrayPostDataCard['body']['contents'][2]['type'] = "box";
  $arrayPostDataCard['body']['contents'][3]['layout'] = "baseline";
  $arrayPostDataCard['body']['contents'][3]['spacing'] = "sm";
  $arrayPostDataCard['body']['contents'][3]['contents'][0]['type'] = "text";
  $arrayPostDataCard['body']['contents'][3]['contents'][0]['text'] = "สินค้าที่ค้นหามีมากกว่า 1 ชิ้น";
  $arrayPostDataCard['body']['contents'][3]['contents'][0]['flex'] = 0;
  $arrayPostDataCard['body']['contents'][3]['contents'][0]['margin'] = "sm";
  $arrayPostDataCard['body']['contents'][3]['contents'][0]['weight'] = "regular";
  $arrayPostDataCard['footer']['type'] = "box";
  $arrayPostDataCard['footer']['layout'] = "vertical";
  $arrayPostDataCard['footer']['contents'][0]['type'] = "button";
  $arrayPostDataCard['footer']['contents'][0]['action']['type'] = "uri";
  $arrayPostDataCard['footer']['contents'][0]['action']['label'] = "ดูทั้งหมด";
  $arrayPostDataCard['footer']['contents'][0]['action']['uri'] = "http://www.stylhunt.com/Sellboard24/check_stock/index.html?p_name=" . $message;
  $arrayPostDataCard['footer']['contents'][0]['color'] = "#8D769D";
  $arrayPostDataCard['footer']['contents'][0]['style'] = "primary";


  $arrayPostData['messages'][0]['type'] = "flex";
  $arrayPostData['messages'][0]['altText'] = "ส่งสตอคสินค้า";
  $arrayPostData['messages'][0]['contents']['type'] = "carousel";
  $arrayPostData['messages'][0]['contents']['contents'] = $arrayPostDataCard;

    replyMsg($arrayHeader,$arrayPostData);
} else if(count($obj) === 0) {
  $arrayPostData['messages'][0]['type'] = "text";
  $arrayPostData['messages'][0]['text'] = "ไม่มีสินค้าที่คุณค้นหาค่ะ";
  replyMsg($arrayHeader,$arrayPostData);
}



function replyMsg($arrayHeader,$arrayPostData){
  $strUrl = "https://api.line.me/v2/bot/message/reply";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$strUrl);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
  curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close ($ch);
}
exit;


?>
