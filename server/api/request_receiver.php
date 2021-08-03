<?php

require "./core/querier.php";
require "./core/db_connectors/mysql.php";
require "./core/db_connectors/oracle.php";

use mysql\MYSQL;
use oracleDB\OracleDB;

/**
 * Checks for the debug flag and if sets enables debug mode globally
 */
$debug = isset($_GET['debug']);

if ($debug) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

/**
 * Reads data from a query file and returns it formatted as a php object
 * @param mixed $query_file File name from which the json data will be extracted
 * @return mixed Object containing the data read from the file
 * @throws Exception If the file cannot be read throws a bad_json.q exception
 */
function get_query_data($query_file)
{
    $q_details = file_get_contents("./queries/$query_file");
    if (!$q_details) {
        throw new Exception("bad_json.q. File name = $query_file");
    };
    return json_decode($q_details);
}

/**
 * Reads data from a database file and returns it formatted as a php object
 * @param string $db_file File name from which the json data will be extracted
 * @return mixed Object containing the data read from the file
 * @throws Exception If the file cannot be read throws a bad_json.db exception
 */
function get_db_data($db_file)
{
    $db_data = file_get_contents("./databases/$db_file");
    if (!$db_data) {
        throw new Exception("bad_json.db. File name = $db_data");
    }
    return json_decode($db_data);
}

///  fields available: host, port, username, password, dialect, database, query, data
$ROUTES = [
    "mysql" => /**
     * @param string $query The query to be executed
     * @param array $fields Formatted data read from files and combined into an array
     * @return array Returns an array containing the data received from the database not yet parsed
     */
        function ($query, $fields) {
        $db_conn = MYSQL::init($fields['host'], $fields['port'], $fields['username'], $fields['password']);
        $data = MYSQL::query($db_conn, $query);
        MYSQL::close($db_conn);
        return format($data);
    },
    "oracle" => /**
     * @param string $query The query to be executed
     * @param array $fields Formatted data read from files and combined into an array
     * @return array Returns an array containing the data received from the database not yet parsed
     */
        function ($query, $fields) {
        $db_conn = OracleDB::init($fields['host'], $fields['port'], $fields['username'], $fields['password']);
        $data = OracleDB::query($db_conn, $query);
        OracleDB::close($db_conn);
        return format($data);
    },
];

/**
 * Initializes all necessary variables and sends requests for query and database data
 * All necessary information is packed into an array and sent to the querier
 * The query results are then parsed, formatted into json and echoed to the screen
 */
function main() {
    global $debug;
    global $ROUTES;
    try {
        if (isset($_GET['q_name'])) {
            $query_name = $_GET['q_name'];
        } else {
            throw new Exception("Have not received a query name.");
        }

        if (isset($_GET['q_data'])) {
            $query_data = $_GET['q_data'];
        } else {
            $query_data = [];
        }


        $query_info = get_query_data("$query_name.q.json");
        $database_info = get_db_data($query_info->{'database'} . ".db.json");
        $fields = ['data' => $query_data] + (array)$query_info + (array)$database_info;
        if ($debug) {
            echo "<hr>DEBUG DATA<br>The following data will be sent to querrier:<br>";
            var_export($fields);
            echo "<hr>The following has been received:<br>";
            var_export($_GET);
            echo "<hr>";
        }

        if (!in_array($fields['dialect'], array_keys($ROUTES), false)) {
            throw new Exception("Database dialect '" . $fields['dialect'] . "' not supported");
        }

        echo json_encode($ROUTES[$fields['dialect']](fill_query_data($fields['query'], $fields['data']), $fields));

    } catch (Exception $e) {
        echo json_encode(array("status" => $e->getMessage()));
    } finally {
        exit();
    }
}

main();