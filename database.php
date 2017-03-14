<?php

$pdo = new PDO('pgsql:host=localhost;dbname=mycard;', 'mycard','dn8aSm9yAJx23qWn');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$upload_target = "uploads";