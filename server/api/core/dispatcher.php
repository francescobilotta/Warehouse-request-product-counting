<?php

$query_file = $_GET['q_file'];
$q_data = $_GET['q_data'];

try {
    $q_details = file_get_contents("../queries/" . $query_file);
    if (!$q_details) { throw new Exception("bad_json.q. File name = '$query_file'"); };

    $db_data = file_get_contents("../databases/" . json_decode($q_details)->{'database'} . ".db.json");
    if (!$db_data){ throw new Exception("bad_json.db"); }


//    $data_array = array_merge(array("q_data"=>$q_data), (array) json_decode($q_details), (array) json_decode($db_data));
    $data_array = array("q_data"=>$q_data) + (array) json_decode($q_details) + (array) json_decode($db_data);
    $http_data = http_build_query($data_array);
    header("Location: querier.php?$http_data");

}
catch (Exception $e) {
    echo json_encode(array("status"=>$e->getMessage()));
}

exit();