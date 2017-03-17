<?php
ini_set("display_erros", false);
require_once "vendor/autoload.php";
require_once 'include/sendmail.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$db = new PDO(getenv("DATABASE"));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$upload_target = "uploads";
