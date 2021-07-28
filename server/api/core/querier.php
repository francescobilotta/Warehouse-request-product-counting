<?php
session_start();
use mysql\MYSQL;
use oracleDB\OracleDB;

require 'db_connectors/mysql.php';
require 'db_connectors/oracle.php';

$query = $_SESSION['query'];
$dialect = $_SESSION['dialect'];
$q_data = $_SESSION['q_data'];


function redirect($data) {
    $_SESSION['q_result'] = $data;
    header("Location: formatter.php");
    exit();
}

function fill_query_data($query, $data) {
    // using regex replaces all patterns like: {<d||f>.<name>} with the value passed to the api in q_data
    return preg_replace_callback('/\{((\w)\.(.+?))\}/i',
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
        var_dump($query);
        var_dump($data);
//        redirect($data);
    },
    "oracle" => function ($query) {
        $db_conn = OracleDB::init();
        $data = OracleDB::query($db_conn, $query);
        OracleDB::close($db_conn);
        var_dump($query);
        var_dump($data);
//        redirect($data);
    },
];
var_dump($q_data);

if ($q_data) {
    $filled_query = fill_query_data($query, $q_data);
}
else {
    $filled_query = $query;
}
    var_dump($filled_query);
$ROUTES[$dialect]($filled_query);
