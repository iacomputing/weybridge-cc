<?php
include "../priv/config.php";
session_start();
include "captcha.class.php";
$captcha = new captcha;
$captcha->create();
?>