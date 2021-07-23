<?php

$query_file = $_GET['q_file'];
$query_data = $_GET['q_data'];

try {
    $q_data = json_decode(file_get_contents("../queries/" . $query_file));
    if (!$q_data) { throw new Exception("bad_json.q"); };

    $db_data = json_decode(file_get_contents("../databases/" . $q_data->{'database'} . ".db.json"));
    if (!$db_data){ throw new Exception("bad_json.db"); }


    $http_data = http_build_query(array($db_data, $q_data, "q_data"=>$query_data));
    header("Location: querier.php?$http_data");

}
catch (Exception $e) {
    echo json_encode(array("status"=>$e));
}

exit();