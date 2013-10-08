<?php
include 'project.php';
include '../settings.php';

$db = new mysqli('localhost', 'root', 'xoktokpok20072318', 'mppm');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
$sql = "SELECT * FROM `projects`";

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
$index=0;
while($row = $result->fetch_assoc()){
    
    $a = $row['ID'];
    $b = $row['title'];
    $c = $row['description'];
    $d = $row['start_date'];
    $e = $row['estend_date'];
    $f = $row['end_date'];
    $project[$index] = new project($a, $b, $c, $d, $e, $f);
    $project[$index]->showProject();
    $index = $index + 1;
}

echo 'Total results: ' . $result->num_rows;
echo 'Total rows updated: ' . $db->affected_rows;
$result->free();


?>
