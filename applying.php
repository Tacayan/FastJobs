<?php
require 'class/announcement.class.php';
require 'database/connection.php';

$userId = $_GET['user'];
$announcementId = $_GET['announcement'];
echo $announcementId;
echo $userId;

$applying = new announcement;
$applying->announcementApplying($userId, $announcementId);