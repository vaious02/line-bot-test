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
$result = file_get_contents($url);
$obj = var_dump(json_decode($result, true));


$arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
$arrayPostData['messages'][0]['type'] = "text";
$arrayPostData['messages'][0]['text'] = strval($result);
replyMsg($arrayHeader,$arrayPostData);

// $arrayPostData = array();
// $arrayPostDataDetail = array();
// $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
//
//
// if(count($obj) === 1) {
//   $arrayPostData['messages'][0]['type'] = "flex";
//   $arrayPostData['messages'][0]['altText'] = "ส่งสตอคสินค้า";
//   $arrayPostData['messages'][0]['contents']['type'] = "carousel";
//   for ($i=0; $i < 1 ; $i++) {
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['type'] = "bubble";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['type'] = "box";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['layout'] = "vertical";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['spacing'] = "md";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['action']['type'] = "uri";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['action']['label'] = "Action";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['action']['uri'] = "http://www.stylhunt.com/Sellboard24/check_stock/index.html?p_name=" . $obj[$i]['product_name'];
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['type'] = "text";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['text'] = $obj[$i]['product_name'];
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['size'] = "lg";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['weight'] = "bold";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][1]['type'] = "separator";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['type'] = "box";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['layout'] = "vertical";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['spacing'] = "sm";
//     for ($j=0; $j < count($obj); $j++) {
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['type'] = "box";
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['layout'] = "baseline";
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['contents'][0]['type'] = "icon";
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['contents'][0]['url'] = "https://img.icons8.com/color/48/000000/star.png";
//
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['contents'][1]['type'] = "text";
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['contents'][1]['text'] = $obj[$i]['stock'][$j]['name'];
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['contents'][1]['flex'] = "0";
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['contents'][1]['margin'] = "sm";
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['contents'][1]['weight'] = "bold";
//
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['contents'][2]['type'] = "text";
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['contents'][2]['text'] = $obj[$i]['stock'][$j]['qty'] . ' ชิ้น';
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['contents'][1]['size'] = "sm";
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['contents'][1]['align'] = "end";
//       $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][2]['contents'][$j]['contents'][1]['color'] = "#AAAAAA";
//     }
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['footer']['type'] = "box";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['footer']['layout'] = "vertical";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['footer']['contents'][0]['type'] = "button";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['footer']['contents'][0]['action']['type'] = "uri";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['footer']['contents'][0]['action']['label'] = "ดูรายละเอียด";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['footer']['contents'][0]['action']['uri'] = "http://www.stylhunt.com/Sellboard24/check_stock/index.html?p_name=" . $obj[$i]['product_name'];
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['footer']['contents'][0]['color'] = "#8D769D";
//     $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['footer']['contents'][0]['style'] = "primary";
//   }
//
//   replyMsg($arrayHeader,$arrayPostData);
//
// }
//
// if(count($obj) > 1) {
//   $arrayPostData['messages'][0]['type'] = "flex";
//   $arrayPostData['messages'][0]['altText'] = "ส่งสตอคสินค้า";
//   $arrayPostData['messages'][0]['contents']['type'] = "carousel";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['type'] = "bubble";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['direction'] = "ltr";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['type'] = "box";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['layout'] = "vertical";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['flex'] = "0";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][0]['type'] = "text";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][0]['text'] = $message;
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][0]['size'] = "lg";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][0]['weight'] = "bold";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][0]['wrap'] = true;
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][1]['type'] = "separator";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][2]['type'] = "box";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][3]['layout'] = "baseline";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][3]['spacing'] = "sm";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][3]['contents'][0]['type'] = "text";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][3]['contents'][0]['text'] = "สินค้าที่ค้นหามีมากกว่า 1 ชิ้น";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][3]['contents'][0]['flex'] = 0;
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][3]['contents'][0]['margin'] = "sm";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['body']['contents'][3]['contents'][0]['weight'] = "regular";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['footer']['type'] = "box";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['footer']['layout'] = "vertical";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['footer']['contents'][0]['type'] = "button";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['footer']['contents'][0]['action']['type'] = "uri";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['footer']['contents'][0]['action']['label'] = "ดูทั้งหมด";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['footer']['contents'][0]['action']['uri'] = "http://www.stylhunt.com/Sellboard24/check_stock/index.html?p_name=" . $message;
//   $arrayPostData['messages'][0]['contents']['contents'][0]['footer']['contents'][0]['color'] = "#8D769D";
//   $arrayPostData['messages'][0]['contents']['contents'][0]['footer']['contents'][0]['style'] = "primary";
//
//   replyMsg($arrayHeader,$arrayPostData);
//
// } else if(count($obj) === 0) {
//   $arrayPostData['messages'][0]['type'] = "text";
//   $arrayPostData['messages'][0]['text'] = "ไม่มีสินค้าที่คุณค้นหาค่ะ";
//   replyMsg($arrayHeader,$arrayPostData);
// }
//

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
