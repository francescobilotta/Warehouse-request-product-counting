<?php
session_start();
echo $_SESSION['q_result'];
$data = array("results"=>json_encode($_SESSION['q_result']));

$data['status'] = 'ok';
echo json_encode($data);
