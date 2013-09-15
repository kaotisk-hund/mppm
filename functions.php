<?php

function navigation($menu){
    if($menu==""){
        $we_are_at='<a href="?menu=0,0">Overview</a>';
    }
    elseif($menu=="0,0"){
        $we_are_at='<a href="?menu=0,0">Overview</a>';
    }

    // PROJECT MENU
    elseif($menu=="1,0"){
        $we_are_at='<a href="?menu=1,0">Projects</a>';
    }
        // -New
        elseif($menu=="1,1"){
        $we_are_at='<a href="?menu=1,0">Projects</a><a href="?menu=1,1">New</a>';
        }
        // -Edit
        elseif($menu=="1,2") {
        $we_are_at='<a href="?menu=1,0">Projects</a><a href="">Edit</a>';
        }
        // -Delete
        elseif($menu=="1,3") {
        $we_are_at='<a href="?menu=1,0">Projects</a><a href="?menu=1,3">Delete</a>';
        }

    // TICKET MENU
    elseif($menu=="2,0") {
        $we_are_at='<a href="?menu=2,0">Tickets</a>';
    }
        // -New
        elseif($menu=="2,1") {
            $we_are_at='<a href="?menu=2,0">Tickets</a><a href="?menu=2,1">New</a>';
        }
        // -Edit
        elseif($menu=="2,2") {
            $we_are_at='<a href="?menu=2,0">Tickets</a><a href="">Edit</a>';
        }
        // -Delete
        elseif($menu=="2,3") {
            $we_are_at='<a href="?menu=2,0">Tickets</a><a href="?menu=2,3">Delete</a>';
        }
        // -Show all
        elseif ($menu=="2,4") {
            $we_are_at='<a href="?menu=2,0">Tickets</a><a href="?menu=2,4">Show all</a>';
    }
    // NOT PART OF MENU BUT FOR TESTING
    elseif($menu=="debug"){
        $we_are_at='<a href="?menu=debug">Debug</a>';
    }
    return $we_are_at;
}

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
function noTickets(){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    // Read notes to get array range
    $query="SELECT * FROM tickets";
    $result=mysql_query($query);
    $range=mysql_numrows($result);
    mysql_close();
    echo $range;
}
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
function oldestProject(){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    $query = "SELECT * FROM `projects` ORDER BY `projects`.`start_date` ASC";
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
