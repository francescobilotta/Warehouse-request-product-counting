<?php
namespace mysql;
use mysqli;

class MYSQL {
    static function init() {
        $host = $_GET['host'];
        $port = $_GET['port'];
        $username = $_GET['username'];
        $password = $_GET['password'];
        $schema = $_GET['schema'];

        $db = new mysqli($host, $username, $password, $schema, $port);
        if ($db->connect_error) {
            echo json_encode(array("status"=>"bad_connection.db"));
            die("Could not create database object$db->connect_error");
        }
        else {
            return $db;
        }
    }

    static function query($db, $query) {
        return $db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    static function close($db) {
        mysqli_close($db);
    }
}
?>