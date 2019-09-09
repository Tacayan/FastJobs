<?php
require 'class/authenticate.class.php';
require 'class/accountRegister.class.php';

$authenticate = new authenticate($_COOKIE['token']);
$userId = $authenticate->getID();
$updating = new accountRegister();

$updating->updateAccount($userId);
