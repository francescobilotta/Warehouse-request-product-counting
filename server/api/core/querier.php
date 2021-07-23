<?php

use mysql\MYSQL;
use oracleDB\OracleDB;

require 'db_connectors/mysql.php';
require 'db_connectors/oracle.php';

$query = $_GET['query'];
$type = $_GET['type'];

function redirect($rows) {
    $url_data = http_build_query(array('q_result' => $rows));
    header("Location: formatter.php?$url_data");
    exit();
}

$ROUTES = [
    "mysql" => function ($query) {
        redirect(MYSQL::query(MYSQL::init(), $query));
    },
    "oracle" => function ($query) {
        redirect(OracleDB::query(OracleDB::init(), $query));
    },
];

$ROUTES[$type]($query);