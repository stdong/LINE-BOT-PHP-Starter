<?php
$access_token = '1wPzgok0V+INNx5+eMuBL7myc0FZGfhCPAdiy5VrJy/yguDQbgRhWoceBEBCnxo0yWs/Aj33C/Ddm5V6qKvD9/Mz4qw6TaFtdBWbzWiwLgk6qPkvCQ46eSwmBEATMUahXbEy97sl27H97JLsmwBR0QdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];



			if($text == "สวัสดี"){ 
			  // Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => "สวัสดี ID คุณคือ ".$event['source']['userId']
				];
			}else if($text == "ชื่ออะไร"){
			  // Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => "ฉันยังไม่มีชื่อนะ"
				];
			}else if($text == "ทำอะไรได้บ้าง"){ 
			  // Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => "ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ"
				];
			}else{
			  // Build message to reply back
				//$messages = [
				//	'type' => 'text',
				//	'text' => "ฉันไม่เข้าใจคำสั่ง ".$text." \uDBC0\uDC84 LINE emoji"
				//];
				
				$messages = [
					{
					'type' => 'text',
					'text' => "ฉันไม่เข้าใจคำสั่ง ".$text	
					},
					{
				        "type": "text",
				        "text": "\uDBC0\uDC84 LINE emoji"
					}
				];
				
			}
 
 
			
			// Build message to reply back
			//$messages = [
			//	'type' => 'text',
			//	'text' => $text
			//];



			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
	}
}
echo "OK";
