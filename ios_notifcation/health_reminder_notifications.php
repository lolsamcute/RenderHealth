<?php
$msg = $argv[1];   
$type = $argv[2];   
$device_token = $argv[3]; 

require_once '/var/www/html/projects/renderhealth/ios_notifcation/apn/push_notification.php';

ReminderHealthNotification($device_token,base64_decode($msg),$type); 