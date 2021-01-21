<?php
$device_token = $argv[1]; 

require_once '/var/www/html/projects/renderhealth/ios_notifcation/apn/push_notification.php';

PaymentNotification($device_token); 