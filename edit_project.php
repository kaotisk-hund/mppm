<?php
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');

    // Initiate values
    $id=$_POST['id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $start_date=$_POST['start_date'];
    $estend_date=$_POST['estend_date'];
    $end_date=$_POST['end_date'];
    
    // Update values
    $query = "UPDATE `mppm`.`projects` SET `title`='$title',`description`='$description',`start_date`=
        '$start_date',`estend_date`='$estend_date',`end_date`='$end_date' WHERE `projects`.`ID`='$id'";
    $result = mysql_query($query);
    mysql_close();

    header("refresh:0;url=index.php?menu=1,0");
?>
