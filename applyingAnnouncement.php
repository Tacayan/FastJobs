<?php
require 'class/Announcement.class.php';
require 'database/connection.php';

$userId = $_GET['user'];
$announcementId = $_GET['announcement'];
echo $announcementId;
echo $userId;

$applying = new Announcement();
$applying->announcementApplying($userId, $announcementId);