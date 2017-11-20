<?php
$access_token = '1wPzgok0V+INNx5+eMuBL7myc0FZGfhCPAdiy5VrJy/yguDQbgRhWoceBEBCnxo0yWs/Aj33C/Ddm5V6qKvD9/Mz4qw6TaFtdBWbzWiwLgk6qPkvCQ46eSwmBEATMUahXbEy97sl27H97JLsmwBR0QdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
