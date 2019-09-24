<?php
require 'database/connection.php';
require 'class/accountLogin.class.php';

$accountRegister = new AccountLogin();

$accountRegister->registration();
