<?php
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');

    // Initiate values
    $id=  mysql_real_escape_string($_POST['id']);
    $title=mysql_real_escape_string($_POST['title']);
    $description=mysql_real_escape_string($_POST['description']);
    $project_assigned=mysql_real_escape_string($_POST['project_assigned']);
    $status=mysql_real_escape_string($_POST['status']);
    
    // Update values
    $query = "UPDATE `mppm`.`tickets` SET `title`='$title',`description`='$description',`project_assigned`='$project_assigned',`status`='$status' WHERE `ID`='$id'";
    $result = mysql_query($query);
    mysql_close();

    header("refresh:0;url=index.php?menu=2,0");
?>