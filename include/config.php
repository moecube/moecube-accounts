<?php
ini_set("display_errors", false);
ini_set("log_errors", true);
require_once "vendor/autoload.php";
require_once 'include/sendmail.php';

//$dotenv = new Dotenv\Dotenv(__DIR__);
//$dotenv->load();


define("OSS_ACCESS_ID", getenv("OSS_ACCESS_ID"));

define("OSS_ACCESS_KEY", getenv("OSS_ACCESS_KEY"));

define("OSS_BUCKET", getenv("OSS_BUCKET"));

define("OSS_ENDPOINT", getenv("OSS_ENDPOINT"));

$default_avatar = 'https://r.my-card.in/accounts/images/default_avatar.jpg';

$db = new PDO(getenv("DATABASE"));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$upload_target = "uploads";
