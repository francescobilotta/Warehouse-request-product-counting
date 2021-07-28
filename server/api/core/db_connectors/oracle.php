<?php
namespace oracleDB;
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use Exception;

class OracleDB {
    static function init()
    {
        $host = $_SESSION['host'];
        $port = $_SESSION['port'];
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];

        $db="(DESCRIPTION = 
                (ADDRESS = (PROTOCOL = TCP)(HOST = $host)(PORT = $port))
                (CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = ferrari.ferrari.locale))
            )";

        $conn = oci_pconnect($username, $password, $db);
        if (!$conn) {
            $e = oci_error();
            echo json_encode(array("status"=>"bad_connection.db"));
            session_destroy();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        return $conn;
    }

    static function query($db, $query)
    {
        try {
            $q_obj = oci_parse($db, $query);

            if (!$q_obj) {
                throw new Exception("bad_query. Query: $query");
            }

            $q_status = oci_execute($q_obj);
            if (!$q_status) { throw new Exception("bad_query_exec. Query: $query");}

            $q_results = array();
            oci_fetch_all($q_obj, $q_results);
            return $q_results;
        }
        catch (Exception $e) {
            echo json_encode(array("status"=>"$e"));
            session_destroy();
            die("Could not execute query");
        }


    }

    static function close($db) {
        oci_close($db);
    }

}

?>


