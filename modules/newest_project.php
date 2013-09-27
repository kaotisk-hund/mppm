<?php
// Prints newest project
function newestProject(){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    $query = "SELECT * FROM `projects` ORDER BY `projects`.`start_date` DESC";
    $result=mysql_query($query);
    $range=mysql_numrows($result);
    mysql_close();
    $title=mysql_result($result,"0","title");
    $start_date=mysql_result($result, "0", "start_date");
    $id=mysql_result($result, "0", "ID");
    echo '<a href="?menu=1,2&pr=',$id,'">',$title,'</a>';
    echo ' <sup>[',$start_date,']</sup>';
}

?>
