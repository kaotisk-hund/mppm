<?php
// Prints total number of projects
function noProjects(){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    // Read notes to get array range
    $query="SELECT * FROM projects";
    $result=mysql_query($query);
    $range=mysql_numrows($result);
    mysql_close();
    echo $range;
}
?>
