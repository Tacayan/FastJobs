<?php

require 'class/authenticate.class.php';
require 'class/announcement.class.php';

$authenticate = new authenticate($_COOKIE['token']);
$announcement = new announcement();

$announcement -> deletingAnnouncement($_GET['id']);