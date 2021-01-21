<?php
$doctor_id = $argv[1];   
$type = $argv[2];   
$appoint_id = $argv[3];
$api_key = $argv[4]; 
$device_token = $argv[5]; 
$doctor_first_name = $argv[6];

require_once '/var/www/html/projects/renderhealth/ios_notifcation/apn/push_notification.php';
PushNotificationCall($device_token,$doctor_id,$type,$appoint_id,$api_key,$doctor_first_name); 