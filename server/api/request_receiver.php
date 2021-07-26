<?php
$query_name = $_GET['q_name'];
$query_data = $_GET['q_data'];

if (isset($query_name))
{
    $url_data = http_build_query(array(
        'q_file' => ($query_name . '.q.json'),
        'q_data' => $query_data
    ));
    header("Location: core/dispatcher.php?$url_data");
}
else {
    echo json_encode(array('status'=>'bad_name, q_name is ' . $query_name));
}
exit();
