<?php

function new_project(){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');

    // Read notes to get array range
    $query="SELECT * FROM projects";
    $result=mysql_query($query);
    $range=mysql_numrows($result);

    // Create unique ID
    $last_record=$range-1;
    $tmp=mysql_result($result,$last_record,"ID");
        
    // Initiate values
    $id=$tmp+1;
    $title=  mysql_real_escape_string($_POST['title']);
    $description=mysql_real_escape_string($_POST['description']);
    $start_date=mysql_real_escape_string($_POST['start_date']);
    $estend_date=mysql_real_escape_string($_POST['estend_date']);
    $end_date=mysql_real_escape_string($_POST['end_date']);
    
    // Insert note
    $query = "INSERT INTO projects VALUES('$id','$title','$description','$start_date','$estend_date','$end_date')";
    mysql_query($query);
    mysql_close();
    header("refresh:0;url=index.php");
}

function show_projects(){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    $query = "SELECT * FROM `projects`";
    $result=mysql_query($query);
    $num_rows=mysql_numrows($result);
    mysql_close();
    for ($index = 0; $index < $num_rows; $index++) {
        echo '<div class="panel">';
        $id=mysql_result($result,$index,"ID");
        $title=mysql_result($result,$index,"title");
        echo '<div class="row">';
        echo '<div class="large-9 column"><h4><a href="?menu=1,2&pr=',$id,'">',$title,"</a></h4>";
        $description=mysql_result($result,$index,"description");
        echo '<p>';echo $description;echo "</p></div>";
        $start_date=mysql_result($result,$index,"start_date");
        echo '<div class="large-3 column">';
        echo '<small>START DATE:<p>';echo $start_date;echo '</p></small>';
        $estend_date=mysql_result($result,$index,"estend_date");
        echo '<small>EST. DATE:<p>';echo $estend_date;echo '</p></small>';
        $end_date=mysql_result($result,$index,"end_date");
        echo '<small>END DATE:<p>';echo $end_date;echo '</p></small></div>';
        echo '</div></div>';
    }
}

function show_project($pr){
    include 'settings.php';
    include 'get_project_title.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    $query = "SELECT * FROM `projects` WHERE `projects`.`ID`='$pr'";
    $result=mysql_query($query);
    $num_rows=mysql_numrows($result);
    mysql_close();
    // Collects data for project
    $id=mysql_result($result,0,"ID");
    $title=mysql_result($result,0,"title");
    $description=mysql_result($result,0,"description");
    $start_date=mysql_result($result,0,"start_date");
    $estend_date=mysql_result($result,0,"estend_date");
    $end_date=mysql_result($result,0,"end_date");
    
    // Creates the table and data
    echo '<form action="edit_project.php" method="post">
    <fieldset>
        <legend>Edit ',$title,'</legend>
        <input type="hidden" name="id" value="',$id,'"/>
        <input class="larg-4 column" type="text" name="title" value="',$title,'"/>
        <textarea name="description">',$description,'</textarea>
        <input type="date" name="start_date" value="',$start_date,'"/>
        <input type="date" name="estend_date" value="',$estend_date,'"/>
        <input type="date" name="end_date" value="',$end_date,'"/>
        <input class="button success" type="submit" value="Update"/>
        <input class="button alert" type="reset" value="Revert"/>
        <a class="button" href="?menu=1,3&pr=',$pr,'">DELETE</a>
    </fieldset>
</form>';
    
    
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    $query = "SELECT * FROM `tickets` WHERE `project_assigned`='$pr'";
    $result=mysql_query($query);
    $num_rows=mysql_numrows($result);
    mysql_close();

    echo '<table><thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Title</th>';
    echo '<th>Description</th>';
    echo '<th>Project Assigned to</th>';
    echo '<th>Done</th>';
    echo '</tr></thead><tbody>';
    $pr=$id;
    for ($index = 0; $index < $num_rows; $index++) {
        $project_assigned=mysql_result($result,$index,"project_assigned");
        //if($pr==$project_assigned){
            echo "<tr>";
            $id=mysql_result($result,$index,"ID");
            echo "<td>";echo $id;echo"</td>";
            $title=mysql_result($result,$index,"title");
            echo '<td><a href="?menu=2,2&tk=',$id,'">',$title,'</td>';
            $description=mysql_result($result,$index,"description");
            echo"<td>";echo $description;echo"</td>";
            $project_assigned=mysql_result($result,$index,"project_assigned");
            echo"<td>";get_project_title($project_assigned);echo"</td>";
            $status=mysql_result($result,$index,"status");
            echo '<td>',$status,'</td>';
            echo"</tr>";
        //}
    }
    echo '</tbody></table>';
}
function delete_project($pr){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    echo '<p>Are you sure you want to delete ',$pr,' project?</p>';
    echo '<center><a class="small button" href="?menu=1,3&pr=',$pr,'&conf=1">YES</a> <a class="small button" href="?menu=1,3&pr=',$pr,'&conf=2">NO</a></center>';
    if($_GET['conf']==1){
        $query="DELETE FROM `mppm`.`projects` WHERE `projects`.`ID` = '$pr'";
        $result= mysql_query($query);
        echo 'DELETED';
        header("refresh:0;url=index.php?menu=1,0");
    }
    else if($_GET['conf']==2){
        echo 'RETURNS';
        header("refresh:0;url=index.php?menu=1,2&pr=$pr");
    }
}
?>