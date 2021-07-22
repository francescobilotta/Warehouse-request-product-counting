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
        if ($db->connect_error) { die("Could not create database object$db->connect_error"); }
        else {
            return $db;
        }
    }

    static function query($db, $query) {
        $q_results = $db->query($query);

        if (!$q_results) { trigger_error("Wrong ($query).\nError: $db->error", E_USER_ERROR); }
        else { return $q_results->fetch_all(MYSQLI_ASSOC); }
    }
}
?>