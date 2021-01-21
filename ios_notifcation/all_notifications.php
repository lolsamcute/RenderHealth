<?php
$msg = $argv[1];   
$type = $argv[3];   
$nid = $argv[2];
$device_token = $argv[4]; 

require_once getcwd().'/ios_notifcation/apn/push_notification.php';

AllNotification($device_token,$msg,$nid,$type); 