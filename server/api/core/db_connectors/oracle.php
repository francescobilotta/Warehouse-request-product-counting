<?php
namespace oracleDB;
use Exception;

class OracleDB {
    static function init()
    {
        $host = $_GET['host'];
        $port = $_GET['port'];
        $username = $_GET['username'];
        $password = $_GET['password'];

        $db="(DESCRIPTION = 
                (ADDRESS = (PROTOCOL = TCP)(HOST = $host)(PORT = $port))
                (CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = ferrari.ferrari.locale))
            )";

        $conn = oci_pconnect($username, $password, $db);
        if (!$conn) {
            $e = oci_error();
            echo json_encode(array("status"=>"bad_connection.db"));
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
            die("Could not execute query");
        }


    }

    static function close($db) {
        oci_close($db);
    }

}

?>


