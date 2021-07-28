<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$data = array("results"=>$_SESSION['q_result']);

$data['status'] = 'ok';
echo json_encode($data);
session_destroy();
exit();
