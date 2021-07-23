<?php
$query_name = $_GET['q_name'];
if (isset($query_name))
{
    header("Location: core/dispatcher.php" . "?q_file=" . $query_name . ".q.json");
    exit();
}
else {
    echo json_encode(array('status'=>'bad_name'));
}
?>