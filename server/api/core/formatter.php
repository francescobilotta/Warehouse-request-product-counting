<?php
$data = $_GET['q_result'];

if ($data) { $data['status'] = 'ok'; }
else { $data = array("status"=>"bad_result"); }

echo json_encode($data);