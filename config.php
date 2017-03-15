<?php
ini_set("display_erros", 0);
require_once "vendor/autoload.php";

$dotenv = new Dotenv\Dotenv(__DIR__); 
$dotenv->load();

$pdo = new PDO(getenv("DATABASE"));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$upload_target = "uploads";