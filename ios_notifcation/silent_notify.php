<?php
$appoint_id = $argv[1];
$device_token = $argv[2]; 

require_once '/var/www/html/projects/renderhealth/ios_notifcation/apn/push_notification.php';
PushNotificationBack($device_token,$appoint_id); 