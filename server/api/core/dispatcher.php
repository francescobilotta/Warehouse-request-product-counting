<?php
$query_file = $_GET['q_file'];
try {
    $query_string_data = file_get_contents("../queries/" . $query_file);
    if (!$query_string_data) { throw new Exception("bad_file.q"); };

    $query_json_data = json_decode($query_string_data);
    if (!$query_json_data) { throw new Exception("bad_json.q"); };

    $query_database = $query_json_data->{"database"};
    $query = $query_json_data->{'query'};
    $schema = $query_json_data->{'schema'};

    $db_data = json_decode(file_get_contents("../databases/" . $query_database . ".db.json"));
    if (!$db_data){ throw new Exception("bad_json.db"); }

    $host = $db_data->{'host'};
    $port = $db_data->{'port'};
    $username = $db_data->{'username'};
    $password = $db_data->{'password'};
    $type = $db_data->{'type'};
}
catch (Exception $e) {
    echo json_encode(array("status"=>$e));
    exit();
}


$url =
"querier.php?&".
"query=$query&".
"host=$host&".
"port=$port&".
"username=$username&".
"password=$password&".
"schema=$schema&".
"type=$type";
header("Location: $url");
exit();