<?php
session_start();
$data = array("results"=>json_encode($_SESSION['q_result']));

$data['status'] = 'ok';
echo json_encode($data);
session_destroy();
exit();
