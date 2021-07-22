<?php

use mysql\MYSQL;
use oracleDB\OracleDB;

require 'db_connectors/mysql.php';
require 'db_connectors/oracle.php';

$query = $_GET['query'];
$type = $_GET['type'];

function redirect($rows) {
    $query = http_build_query(array('q_result' => $rows));
    header("Location: formatter.php?$query");
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