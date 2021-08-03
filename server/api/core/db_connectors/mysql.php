<?php

namespace mysql;

use mysqli;

/**
 *
 */
class MYSQL
{
    /**
     * Initializes the connection to the database
     * @param string $host
     * @param string $port
     * @param string $username
     * @param string $password
     * @return mysqli mysql connection object
     */
    static function init($host, $port, $username, $password)
    {
        $db = new mysqli($host, $username, $password, null, $port);
        if ($db->connect_error) {
            echo json_encode(array("status" => "bad_connection.db"));
            die("Could not create database object$db->connect_error");
        } else {
            return $db;
        }
    }

    /**
     * Executes the query and returns the results
     * @param mixed $db Mysql database object
     * @param string $query Query to be executed
     * @return array|mixed|void Returns all data if present, otherwise returns an empty array
     */
    static function query($db, $query)
    {
        $query_string = $query;
        $result = $db->query($query_string);
        if (is_bool($result)) {
            if ($result) {
                return array();
            } else {
                echo json_encode(array("status" => "Query execution by database has not succeeded. query: $query_string"));
                die("Could not execute query");
            }
        } else {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    /**
     * Closes the connection
     * @param mixed $db Mysql database object
     */
    static function close($db)
    {
        mysqli_close($db);
    }
}

?>