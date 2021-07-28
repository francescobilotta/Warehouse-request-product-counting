<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_destroy();
session_start();

$_SESSION['q_name'] = $_GET['q_name'];
$_SESSION['q_data'] = $_GET['q_data'];

if (isset($_SESSION['q_name']))
{
    header("Location: core/dispatcher.php");
    exit();
}
else {
    echo json_encode(array('status'=>'bad_name, q_name is ' . $_SESSION['q_name']));
    session_destroy();
}

exit();