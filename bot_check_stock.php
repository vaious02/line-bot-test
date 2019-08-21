<?php



$accessToken = "8JqAA77f7BO7iNwJtB4GsZGvtdvjaH7AOk/B+mz3/UvVu2iBKDEtWMJgp3f6OhaWSuvKszTSvgpqYer1n2bwHuljIAiY/OWs/Ld6nqvmKePBmTM/uAuI24UdvI7ijR/+BTGLHm6OsbPnNS/ZLT99LQdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
$content = file_get_contents('php://input');
$arrayJson = json_decode($content, true);

$arrayHeader = array();
$arrayHeader[] = "Content-Type: application/json";
$arrayHeader[] = "Authorization: Bearer {$accessToken}";

//รับข้อความจากผู้ใช้
// $message = $arrayJson['events'][0]['message']['text'];
$message = 'ลีวายลิซ่า';
$url = "http://www.stylhunt.com/Sellboard24/module/line/api/api_get_detailproduct_with_name.php?p_name=" . $message;
$result = file_get_contents($url);
$obj = json_decode($result, true);

$arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
// $arrayPostData['messages'][0]['type'] = "text";
// $arrayPostData['messages'][0]['text'] = count($obj);
// replyMsg($arrayHeader,$arrayPostData);
if(count($obj) > 0) {
  $arrayPostData['messages'][0]['type'] = "flex";
  $arrayPostData['messages'][0]['altText'] = "Flex Message";
  if(count($obj) == 1) {
    $arrayPostData['messages'][0]['contents']['type'] = "bubble";
    $arrayPostData['messages'][0]['contents']['body']['type'] = "box";
    $arrayPostData['messages'][0]['contents']['body']['layout'] = "vertical";
    $arrayPostData['messages'][0]['contents']['body']['spacing'] = "md";
    $arrayPostData['messages'][0]['contents']['body']['action']['type'] = "uri";
    $arrayPostData['messages'][0]['contents']['body']['action']['label'] = "Action";
    $arrayPostData['messages'][0]['contents']['body']['action']['uri'] = "https://linecorp.com";
    $arrayPostData['messages'][0]['contents']['body']['contents'][0]['type'] = "text";
    $arrayPostData['messages'][0]['contents']['body']['contents'][0]['text'] = $obj[0]['product_name'];
    $arrayPostData['messages'][0]['contents']['body']['contents'][0]['size'] = "lg";
    $arrayPostData['messages'][0]['contents']['body']['contents'][0]['weight'] = "bold";
    $arrayPostData['messages'][0]['contents']['body']['contents'][1]['type'] = "separator";
    $arrayPostData['messages'][0]['contents']['body']['contents'][2]['type'] = "box";
    $arrayPostData['messages'][0]['contents']['body']['contents'][2]['layout'] = "vertical";
    $arrayPostData['messages'][0]['contents']['body']['contents'][2]['spacing'] = "sm";
    for ($i=0; $i < count($obj[0]['stock']); $i++) {
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['type'] = "box";
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['layout'] = "baseline";
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['contents'][0]['type'] = "icon";
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['contents'][0]['url'] = "https://img.icons8.com/color/48/000000/star.png";
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['contents'][1]['type'] = "text";
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['contents'][1]['text'] = $obj[0]['stock'][$i]['name'];
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['contents'][1]['flex'] = 0;
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['contents'][1]['margin'] = "sm";
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['contents'][1]['weight'] = "weight";
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['contents'][2]['type'] = "text";
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['contents'][2]['text'] = $obj[0]['stock'][$i]['qty'];
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['contents'][2]['size'] = "sm";
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['contents'][2]['align'] = "end";
      $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][$i]['contents'][2]['color'] = "#AAAAAA";

    }

  } else {

    $arrayPostData['messages'][0]['contents']['type'] = "bubble";
    $arrayPostData['messages'][0]['contents']['body']['type'] = "box";
    $arrayPostData['messages'][0]['contents']['body']['layout'] = "vertical";
    $arrayPostData['messages'][0]['contents']['body']['spacing'] = "md";
    $arrayPostData['messages'][0]['contents']['body']['action']['type'] = "uri";
    $arrayPostData['messages'][0]['contents']['body']['action']['label'] = "Action";
    $arrayPostData['messages'][0]['contents']['body']['action']['uri'] = "https://linecorp.com";
    $arrayPostData['messages'][0]['contents']['body']['contents'][0]['type'] = "text";
    $arrayPostData['messages'][0]['contents']['body']['contents'][0]['text'] = $message;
    $arrayPostData['messages'][0]['contents']['body']['contents'][0]['size'] = "lg";
    $arrayPostData['messages'][0]['contents']['body']['contents'][0]['weight'] = "bold";
    $arrayPostData['messages'][0]['contents']['body']['contents'][1]['type'] = "separator";
    $arrayPostData['messages'][0]['contents']['body']['contents'][2]['type'] = "box";
    $arrayPostData['messages'][0]['contents']['body']['contents'][2]['layout'] = "vertical";
    $arrayPostData['messages'][0]['contents']['body']['contents'][2]['spacing'] = "sm";
    $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][0]['type'] = "box";
    $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][0]['layout'] = "vertical";
    $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][0]['spacing'] = "sm";
    $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][0]['contents'][0]['type'] = "text";
    $arrayPostData['messages'][0]['contents']['body']['contents'][2]['contents'][0]['contents'][0]['text'] = "สินค้ามีมากกว่า 1 ชิ้น";
  }

  $arrayPostData['messages'][0]['contents']['footer']['type'] = "box";
  $arrayPostData['messages'][0]['contents']['footer']['layout'] = "vertical";
  $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['type'] = "button";
  $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['action']['type'] = "uri";
  $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['action']['label'] = "ดูรายละเอียด";
  $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['action']['uri'] = "https://linecorp.com";
  $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['color'] = "#905C44";
  $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['style'] = "primary";

  // replyMsg($arrayHeader,$arrayPostData);

  echo $message;


} else {

  $arrayPostData['messages'][0]['type'] = "text";
  $arrayPostData['messages'][0]['text'] = "ไม่มีสินค้าที่คุณค้นหาค่ะ";
  // replyMsg($arrayHeader,$arrayPostData);
  echo $message;

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
