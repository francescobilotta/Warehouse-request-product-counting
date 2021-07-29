<?php

require "./core/querier.php";
require "./core/db_connectors/mysql.php";
require "./core/db_connectors/oracle.php";

use mysql\MYSQL;
use oracleDB\OracleDB;

if ($_GET['debug']) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

/**
 * @throws Exception bad_json.q
 */
function get_query_data($query_file) {
    $q_details = file_get_contents("./queries/$query_file");
    if (!$q_details) { throw new Exception("bad_json.q. File name = $query_file"); };
    return json_decode($q_details);
}

/**
 * @throws Exception bad_json.db
 */
function get_db_data($db_file) {
    $db_data = file_get_contents("./databases/$db_file");
    if (!$db_data){ throw new Exception("bad_json.db"); }
    return json_decode($db_data);
}

///  fields: host, port, username, password, dialect, database, query, data
$ROUTES = [
    "mysql" => function ($query, $fields) {
        $db_conn = MYSQL::init($fields['host'], $fields['port'], $fields['username'], $fields['password']);
        $data = MYSQL::query($db_conn, $query);
        MYSQL::close($db_conn);
        return format($data);
    },
    "oracle" => function ($query, $fields) {
        $db_conn = OracleDB::init($fields['host'], $fields['port'], $fields['username'], $fields['password']);
        $data = OracleDB::query($db_conn, $query);
        OracleDB::close($db_conn);
        return format($data);
    },
];


try {
    if (isset($_GET['q_name'])) { $query_name = $_GET['q_name']; }
    else {
        { throw new Exception("Have not received a query name."); }
    }
    if (isset($_GET['q_data'])) { $query_data = $_GET['q_data']; }
    else {
        $query_data = [];
    }

    $query_info = get_query_data("$query_name.q.json");
    $database_info = get_db_data($query_info->{'database'}.".db.json");
    $fields = ['data' => $query_data] + [$query_info] + [$database_info];
    if ($_GET['debug']) {
        echo "<hr>DEBUG DATA<br>The following data will be sent to querrier:<br>"; var_export($fields);
        echo "<hr>The following has been received:<br>"; var_export($_GET); echo "<hr>";
    }

    if (!in_array($fields['dialect'], array_keys($ROUTES), false))
    {
        throw new Exception("Database dialect '".$fields['dialect']."' not supported" );
    }

    echo json_encode($ROUTES[$fields['dialect']](fill_query_data($fields['query'], $fields['data']), $fields));

}
catch (Exception $e) {
    echo json_encode(array("status"=>$e->getMessage()));
}
finally {
    exit();
}