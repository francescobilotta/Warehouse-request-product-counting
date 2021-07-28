<?php
$data = array("results"=>$_SESSION['q_result']);

$data['status'] = 'ok';
echo json_encode($data);
