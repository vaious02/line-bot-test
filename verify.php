<?php 
  $access_token = '/qDWtmrbjLtQoXiBUL5edNsyDiOIont0wclSJZ2z9vdEaTuelky5+1RKIsEGggU9hwxxD4Nio4we0qOHAgXXe+qm+FqlI1qAPs4vJzX18LDwFGgymzP43aGMnJT64O+t/9ctf/7F0vmwA5jggaTwTgdB04t89/1O/w1cDnyilFU=';
  $url = 'https://api.line.me/v2.1/oauth/verify';
  $headers = array('Authorization: Bearer ' . $access_token);
  $ch = curl_init($url);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $result = curl_exec($ch);curl_close($ch);
  echo $result;
