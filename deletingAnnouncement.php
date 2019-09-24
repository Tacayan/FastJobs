<?php

require 'class/Authenticate.class.php';
require 'class/Announcement.class.php';

$authenticate = new Authenticate($_COOKIE['token']);
$announcement = new Announcement();

$announcement -> deletingAnnouncement($_GET['id']);