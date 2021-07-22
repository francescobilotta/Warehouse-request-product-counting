<?php
$query_name = $_GET['q_name'];
if (isset($query_name))
{
    header("Location: core/dispatcher.php" . "?q_file=" . $query_name . ".q.json");
    exit();
}
?>