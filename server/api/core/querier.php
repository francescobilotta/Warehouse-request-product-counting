<?php

use mysql\MYSQL;
use oracleDB\OracleDB;

require 'db_connectors/mysql.php';
require 'db_connectors/oracle.php';

$query = $_GET['query'];
$dialect = $_GET['dialect'];
$q_data = $_GET['q_data'];


function redirect($data) {
    $url_data = http_build_query(array('q_result' => $data));
    header("Location: formatter.php?$url_data");
    exit();
}

function fill_query_data($query, $data) {
    // using regex replaces all patterns like: {<d||f>.<name>} with the value passed to the api in q_data
    return preg_replace_callback('/\{(\w)\.(.+?)\}/i',
        function($matches) use($data) { return $data[$matches[0]]; },
        $query);
}

$ROUTES = [
    "mysql" => function ($query) {
        $db_conn = MYSQL::init();
        $data = MYSQL::query($db_conn, $query);
        MYSQL::close($db_conn);
        redirect($data);
    },
    "oracle" => function ($query) {
        redirect(array());
    },
];

$ROUTES[$dialect](fill_query_data($query, $q_data));