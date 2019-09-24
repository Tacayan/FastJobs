<?php
require 'database/connection.php';
require 'class/AccountLogin.class.php';

$accountLogin = new AccountLogin();

$accountLogin->loggingIn();
