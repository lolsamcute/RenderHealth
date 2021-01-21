<?php

function PushNotificationCall($device_token,$dId,$t,$aid,$ak,$dfs)
{	 

	$sound = 'default';
	$development = true;//make it false if it is not in development mode
	$passphrase='welcome';//your passphrase live
	$payload = array();
	date_default_timezone_set('UTC');
	$dt = strtotime('now');	
	$message = ['ty'=>'1','title'=>"Dr. ".$dfs." is calling",'dId'=>$dId,'ct'=>$t,'time'=>$dt,'aid'=>$aid,'ak'=>$ak];
	$payload['aps'] = array('alert'=>$message,'badge'=>1,'sound'=>$sound,'mutable-content'=>1);
	$payload = json_encode($payload);	
	$apns_url = NULL;
	$apns_cert = NULL;
	$apns_port = 2195;
	if($development)
	{
		$apns_url = 'gateway.sandbox.push.apple.com';
		$apns_cert = getcwd().'/ios_notifcation/apn/RenderHealthDev.pem';
	}else{
		$apns_url = 'gateway.push.apple.com';
		$apns_cert = getcwd().'/ios_notifcation/apn/RenderHealthDev.pem';
	}
	$stream_context = stream_context_create();
	stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
	stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);
	$apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
	$device_tokens=  str_replace("<","",$device_token);
	$device_tokens1=  str_replace(">","",$device_tokens);
	$device_tokens2= str_replace(' ', '', $device_tokens1);
	$device_tokens3= str_replace('-', '', $device_tokens2);
	$apns_message = chr(0) . pack('n', 32) . pack('H*', $device_tokens3) . chr(0) . chr(strlen($payload)) . $payload;
	$msg=fwrite($apns, $apns_message);	
	if (!$msg){
	   echo 'Message not delivered' . PHP_EOL;
	}else{	
	   echo 'Message successfully delivered' . PHP_EOL;
	}
	@socket_close($apns);
	@fclose($apns);
}

function AllNotification($device_token,$msg,$nid,$t)
{	 

	$sound = 'default';
	$development = true;//make it false if it is not in development mode
	$passphrase='welcome';//your passphrase live
	$payload = array();
	date_default_timezone_set('UTC');
	$dt = strtotime('now');	
	$message = ['ty'=>'0','title'=>$msg,'nid'=>$nid,'ct'=>$t,'time'=>$dt];
	$payload['aps'] = array('alert'=>$message,'badge'=>1,'sound'=>$sound,'mutable-content'=>1);
	$payload = json_encode($payload);	
	$apns_url = NULL;
	$apns_cert = NULL;
	$apns_port = 2195;
	if($development)
	{
		$apns_url = 'gateway.sandbox.push.apple.com';
		$apns_cert = getcwd().'/ios_notifcation/apn/RenderHealthDev.pem';
	}else{
		$apns_url = 'gateway.push.apple.com';
		$apns_cert = getcwd().'/ios_notifcation/apn/RenderHealthDev.pem';
	}
	$stream_context = stream_context_create();
	stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
	stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);
	$apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
	$device_tokens=  str_replace("<","",$device_token);
	$device_tokens1=  str_replace(">","",$device_tokens);
	$device_tokens2= str_replace(' ', '', $device_tokens1);
	$device_tokens3= str_replace('-', '', $device_tokens2);
	$apns_message = chr(0) . pack('n', 32) . pack('H*', $device_tokens3) . chr(0) . chr(strlen($payload)) . $payload;
	$msg=fwrite($apns, $apns_message);	
	if (!$msg){
	   echo 'Message not delivered' . PHP_EOL;
	}else{	   
	   echo 'Message successfully delivered' . PHP_EOL;
	}
	@socket_close($apns);
	@fclose($apns);
}

function PaymentNotification($device_token)
{	 
	
	$sound = 'default';
	$development = true;//make it false if it is not in development mode
	$passphrase='welcome';//your passphrase live
	$payload = array();
	date_default_timezone_set('UTC');
	$dt = strtotime('now');	
	$message = ['ty'=>'2','time'=>$dt];
	$payload['aps'] = array('alert'=>$message,'badge'=>1,'sound'=>$sound,'mutable-content'=>1);
	$payload = json_encode($payload);	
	$apns_url = NULL;
	$apns_cert = NULL;
	$apns_port = 2195;
	if($development)
	{
		$apns_url = 'gateway.sandbox.push.apple.com';
		$apns_cert = getcwd().'/ios_notifcation/apn/RenderHealthDev.pem';
	}else{
		$apns_url = 'gateway.push.apple.com';
		$apns_cert = getcwd().'/ios_notifcation/apn/RenderHealthDev.pem';
	}
	$stream_context = stream_context_create();
	stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
	stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);
	$apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
	$device_tokens=  str_replace("<","",$device_token);
	$device_tokens1=  str_replace(">","",$device_tokens);
	$device_tokens2= str_replace(' ', '', $device_tokens1);
	$device_tokens3= str_replace('-', '', $device_tokens2);
	$apns_message = chr(0) . pack('n', 32) . pack('H*', $device_tokens3) . chr(0) . chr(strlen($payload)) . $payload;
	$msg=fwrite($apns, $apns_message);	
	if (!$msg){
	   echo 'Message not delivered' . PHP_EOL;
	}else{	   
	   echo 'Message successfully delivered' . PHP_EOL;
	}
	@socket_close($apns);
	@fclose($apns);
}


function PushNotificationBack($device_token,$aid)
{	 

	$sound = 'default';
	$development = true;//make it false if it is not in development mode
	$passphrase='welcome';//your passphrase live
	$payload = array();
	date_default_timezone_set('Asia/Kolkata');
	$dt = date('Y-m-d H:i:s');		
	$payload['aps'] = array('alert'=>'You have missed a call','sound'=>$sound,'content-available'=>1,'aid'=>$aid);
	$payload = json_encode($payload);	
	$apns_url = NULL;
	$apns_cert = NULL;
	$apns_port = 2195;
	if($development)
	{
		$apns_url = 'gateway.sandbox.push.apple.com';
		$apns_cert = getcwd().'/ios_notifcation/apn/RenderHealthDev.pem';
	}else{
		$apns_url = 'gateway.push.apple.com';
		$apns_cert = getcwd().'/ios_notifcation/apn/RenderHealthDev.pem';
	}
	$stream_context = stream_context_create();
	stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
	stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);
	$apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
	$device_tokens=  str_replace("<","",$device_token);
	$device_tokens1=  str_replace(">","",$device_tokens);
	$device_tokens2= str_replace(' ', '', $device_tokens1);
	$device_tokens3= str_replace('-', '', $device_tokens2);
	$apns_message = chr(0) . pack('n', 32) . pack('H*', $device_tokens3) . chr(0) . chr(strlen($payload)) . $payload;
	$msg=fwrite($apns, $apns_message);	
	if (!$msg){
	   echo 'Message not delivered' . PHP_EOL;
	}else{	
	   echo 'Message successfully delivered' . PHP_EOL;
	}
	@socket_close($apns);
	@fclose($apns);
}

function ReminderHealthNotification($device_token,$msg,$t)
{	 

	$sound = 'default';
	$development = true;//make it false if it is not in development mode
	$passphrase='welcome';//your passphrase live
	$payload = array();
	date_default_timezone_set('UTC');
	$dt = strtotime('now');	
	$message = ['ty'=>'0','title'=>$msg,'nid'=>$nid,'ct'=>$t,'time'=>$dt];
	$payload['aps'] = array('alert'=>$message,'badge'=>1,'sound'=>$sound,'mutable-content'=>1);
	$payload = json_encode($payload);	
	$apns_url = NULL;
	$apns_cert = NULL;
	$apns_port = 2195;
	if($development)
	{
		$apns_url = 'gateway.sandbox.push.apple.com';
		$apns_cert = getcwd().'/ios_notifcation/apn/RenderHealthDev.pem';
	}else{
		$apns_url = 'gateway.push.apple.com';
		$apns_cert = getcwd().'/ios_notifcation/apn/RenderHealthDev.pem';
	}
	$stream_context = stream_context_create();
	stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
	stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);
	$apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
	$device_tokens=  str_replace("<","",$device_token);
	$device_tokens1=  str_replace(">","",$device_tokens);
	$device_tokens2= str_replace(' ', '', $device_tokens1);
	$device_tokens3= str_replace('-', '', $device_tokens2);
	$apns_message = chr(0) . pack('n', 32) . pack('H*', $device_tokens3) . chr(0) . chr(strlen($payload)) . $payload;
	$msg=fwrite($apns, $apns_message);	
	if (!$msg){
	   echo 'Message not delivered' . PHP_EOL;
	   //file_put_contents('demo1.txt','fail');
	}else{
	  // mail('iapptech23@gmail.com',"Message successfully delivered","Message successfully delivered".$device_token);
	   echo 'Message successfully delivered' . PHP_EOL;
	   //file_put_contents('demo1.txt','success');
	}
	@socket_close($apns);
	@fclose($apns);
}
//PushNotificationnew('42e5d799457cd4a930f3d195184709ca24602bf6d84358a1687362377f7b853e','test','tes','test');

?>