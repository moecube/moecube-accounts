<?php
	define('MODE_NAME', 'rest');
	define('APP_DEBUG',TRUE);
	define('APP_PATH','../application/');

    //header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header("HTTP/1.1 204 No Content");
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        exit;
    }
	require '../framework/ThinkPHP.php';