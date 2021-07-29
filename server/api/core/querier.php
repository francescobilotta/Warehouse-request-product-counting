<?php

function format($raw_data) {
    return array("results" => $raw_data, "status" => "ok");
}

function fill_query_data($query, $data) {
    // using regex replaces all patterns like: {<d||f>.<name>} with the value passed to the api in q_data
    $pattern = '/\{((\w)\.(.+?))\}/i';

    return preg_replace_callback($pattern,
        function($matches) use($data) {
            if (!in_array($matches[1], array_keys($data))) {
                echo json_encode(array("status"=>"bad_data. Not all values have been given. Missing: " . $matches[1]));
                exit();
            }
            return $data[$matches[1]];
        },
        $query);
}
