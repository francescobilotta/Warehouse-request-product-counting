<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function get_results($url, $fields_string) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

    // return content instead of echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    return curl_exec($ch);
}

/**
 * @throws Exception bad_json.q
 */
function get_query_data($query_file) {
    $q_details = file_get_contents("../queries/$query_file");
    if (!$q_details) { throw new Exception("bad_json.q. File name = $query_file"); };
    return json_decode($q_details);
}

/**
 * @throws Exception bad_json.db
 */
function get_db_data($db_file) {
    $db_data = file_get_contents("../databases/$db_file");
    if (!$db_data){ throw new Exception("bad_json.db"); }
    return json_decode($db_data);
}

// Script beginning

$query_file = $_GET['q_name'];
$query_data = $_GET['q_data'];

try {
    if (!isset($query_file)) { throw new Exception("bad_name, query name is: $query_file"); }

    $url = "core/querier.php";

    $query_info = get_query_data("$query_file.q.json");
    $database_info = get_db_data($query_info['database'].".db.json");

    $fields_string = http_build_query(['data' => $query_data] +
                                            (array)$query_info +
                                            (array)$database_info);

    $results = get_results($url, $fields_string);
    echo $results;
}
catch (Exception $e) {
    echo json_encode(array("status"=>$e->getMessage()));
}
finally {
    exit();
}