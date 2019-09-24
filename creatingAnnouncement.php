<?php
require 'class/authenticate.class.php';
require 'class/Announcement.class.php';

$authenticate = new Authenticate($_COOKIE['token']);
$codUser = $authenticate->getId();
$userName = $authenticate->getUser();

$createAnnoucement = new Announcement();
$createAnnoucement->createAnnouncement($codUser, $userName);
