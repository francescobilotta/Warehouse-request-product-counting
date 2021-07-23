<?php
$data = array("results"=>$_GET['q_result']);

$data['status'] = 'ok';
// todo add checks
echo json_encode($data);
