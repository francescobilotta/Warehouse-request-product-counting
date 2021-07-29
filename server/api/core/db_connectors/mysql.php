<?php
namespace mysql;
use mysqli;
///  Received post variables:
///  host, port, username, password, dialect, database, query, data
class MYSQL {
    static function init() {
        $host = $_POST['host'];
        $port = $_POST['port'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new mysqli($host, $username, $password, null, $port);
        if ($db->connect_error) {
            echo json_encode(array("status"=>"bad_connection.db"));
            die("Could not create database object$db->connect_error");
        }
        else {
            return $db;
        }
    }

    static function query($db, $query) {
        $query_string = mysqli_real_escape_string($db, $query);
        $result =  $db->query($query_string);
        if (is_bool($result)) {
            if ($result) {
                return array();
            }
            else {
                echo json_encode(array("status"=>"Query execution by database has not succeeded. query: $query_string"));
                die("Could not execute query");
            }
        }
        else {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    static function close($db) {
        mysqli_close($db);
    }
}
?>