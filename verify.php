<?php 
  $access_token = '8JqAA77f7BO7iNwJtB4GsZGvtdvjaH7AOk/B+mz3/UvVu2iBKDEtWMJgp3f6OhaWSuvKszTSvgpqYer1n2bwHuljIAiY/OWs/Ld6nqvmKePBmTM/uAuI24UdvI7ijR/+BTGLHm6OsbPnNS/ZLT99LQdB04t89/1O/w1cDnyilFU=';
  $url = 'https://api.line.me/v1/oauth/verify';
  $headers = array('Authorization: Bearer ' . $access_token);
  $ch = curl_init($url);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $result = curl_exec($ch);curl_close($ch);
  echo $result;
