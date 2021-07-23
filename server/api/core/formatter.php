<?php
$data = array("results"=>$_GET['q_result']);

if ($data['results']) { $data['status'] = 'ok'; }
else { $data["status"] = "bad_result"; }

echo json_encode($data);