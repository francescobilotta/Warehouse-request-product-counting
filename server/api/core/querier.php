<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use mysql\MYSQL;
use oracleDB\OracleDB;

require 'db_connectors/mysql.php';
require 'db_connectors/oracle.php';


function format($raw_data) {
    $formatted_data = array("results"=>$raw_data);
    if (!$raw_data['status']) { $formatted_data["status"] = "ok"; }
    echo json_encode($formatted_data);
    exit();
}

function fill_query_data($query, $data) {
    // using regex replaces all patterns like: {<d||f>.<name>} with the value passed to the api in q_data
    $pattern = '/\{((\w)\.(.+?))\}/i';

    return preg_replace_callback($pattern,
        function($matches) use($data) {
            if (!in_array($matches[1], array_keys($data))) {
                echo json_encode(array("status"=>"bad_data. Not all values have been given. Missing: " . $matches[1]));
                exit();
            }
            return $data[$matches[1]];
        },
        $query);
}

$ROUTES = [
    "mysql" => function ($query) {
        $db_conn = MYSQL::init();
        $data = MYSQL::query($db_conn, $query);
        MYSQL::close($db_conn);
        format($data);
    },
    "oracle" => function ($query) {
        $db_conn = OracleDB::init();
        $data = OracleDB::query($db_conn, $query);
        OracleDB::close($db_conn);
        format($data);
    },
];

///  Received post variables:
///  host, port, username, password, dialect, database, query, data

$ROUTES[$_POST['dialect']](fill_query_data($_POST['query'], $_POST['data']));
