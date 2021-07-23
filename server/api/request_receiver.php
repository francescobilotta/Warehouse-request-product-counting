<?php
$query_name = $_POST['q_name'];
$query_name = $_POST['q_data'];

if (isset($query_name))
{
    $url_data = http_build_query(array("q_name"=>$query_name.".q.json", "q_data"=>$query_name));
    header("Location: core/dispatcher.php?$url_data");
}
else {
    echo json_encode(array('status'=>'bad_name'));
}
exit();
