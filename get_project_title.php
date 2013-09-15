<?php
function get_project_title($project_assigned){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    $tquery = "SELECT title FROM `projects` WHERE `ID`='$project_assigned'";
    $tresult=mysql_query($tquery);
    $tnum_rows=mysql_numrows($tresult);
    mysql_close();

    $project_assigned_title=mysql_result($tresult,0,"title");
    echo $project_assigned_title;


}
?>