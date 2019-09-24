<?php
require 'class/authenticate.class.php';
require 'class/accountLogin.class.php';

$authenticate = new authenticate($_COOKIE['token']);
$codUser = $authenticate->getId();

$updating = new AccountLogin();
$updating->updateAccount($codUser);
