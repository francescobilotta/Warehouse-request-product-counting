<?php

/**
 * Inserts raw data into another array adding status
 * @param array $raw_data Raw query results that need to be inserted into the array
 * @return array Array containing formatted data and status
 */
function format($raw_data)
{
    return array("results" => $raw_data, "status" => "ok");
}

/**
 * Fills the query placeholders with the data provided by the user if present otherwise exits with an error
 * @param string $query Query string to be executed
 * @param array $data Data needed to fill the query, can be NULL
 * @return string|null Query with filled data, on error NULL
 */
function fill_query_data($query, $data)
{
    // using regex replaces all patterns like: {<d||f>.<name>} with the value passed to the api in q_data
    $pattern = '/\{((\w)\.(.+?))\}/i';

    return preg_replace_callback(
        $pattern,
        function ($matches) use ($data) {
            if (!in_array($matches[1], array_keys($data))) {
                echo json_encode(array("status" => "bad_data. Not all values have been given. Missing: " . $matches[1]));
                exit();
            }
            return $data[$matches[1]];
        },
        $query
    );
}
