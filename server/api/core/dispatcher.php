<?php

$query_file = $_SESSION['q_name'] . ".q.json";
$q_data = $_SESSION['q_data'];

try {
    $q_details = file_get_contents("../queries/" . $query_file);
    if (!$q_details) { throw new Exception("bad_json.q. File name = '$query_file'"); };

    $db_data = file_get_contents("../databases/" . json_decode($q_details)->{'database'} . ".db.json");
    if (!$db_data){ throw new Exception("bad_json.db"); }


    $_SESSION = $_SESSION + array("q_data"=>$q_data) + (array) json_decode($q_details) + (array) json_decode($db_data);


    header("Location: querier.php");

}
catch (Exception $e) {
    echo json_encode(array("status"=>$e->getMessage()));
    session_destroy();
}

exit();