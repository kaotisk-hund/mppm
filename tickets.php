<?php
function new_ticket(){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    // Read notes to get array range
    $query="SELECT * FROM tickets";
    $result=mysql_query($query);
    $range=mysql_numrows($result);
    
    // Create unique ID
    $last_row=$range-1;
    $tmp=  mysql_result($result, $last_row, "ID");
    
    // Initiate values
    $id=$tmp+1;
    $title=mysql_real_escape_string($_POST['title']);
    $description=mysql_real_escape_string($_POST['description']);
    $project_assigned=mysql_real_escape_string($_POST['project_assigned']);
    $status=mysql_real_escape_string($_POST['status']);

    // Insert note
    $query = "INSERT INTO tickets VALUES('$id','$title','$description','$project_assigned','$status')";
    mysql_query($query);
        
    // End and redirect
    mysql_close();
    header("refresh:0;url=index.php");
}
function show_tickets(){
    include 'settings.php';
    include 'get_project_title.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    $query = "SELECT * FROM `tickets`";
    $result=mysql_query($query);
    $num_rows=mysql_numrows($result);
    mysql_close();

    echo '<table><thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Title</th>';
//    echo 'Description</th>';
    echo '<th>Project Assigned to</th>';
    echo '<th>Status</th>';
    echo '</tr></thead><tbody>';

    for ($index = 0; $index < $num_rows; $index++) {
        $temp=mysql_result($result,$index,"status");
        if($temp<>"closed"){
            echo "<tr>";
            $id=mysql_result($result,$index,"ID");
            echo "<td>";echo $id;echo"</td>";
            $title=mysql_result($result,$index,"title");
            $description=mysql_result($result,$index,"description");
            echo '<td><a href="?menu=2,2&tk=',$id,'">',$title,'</a></td>';


        //    echo"<td>";echo $description;echo"</td>";
            $project_assigned=mysql_result($result,$index,"project_assigned");

            echo"<td>";get_project_title($project_assigned);echo"</td>";
            $status=mysql_result($result,$index,"status");

            echo '<td>',$status,'</td>';
            echo"</tr>";
        }
    }
    echo '</tbody></table>';
}
function show_ticket($tk){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    // Read notes to get array range
    $query="SELECT * FROM projects";
    $result=mysql_query($query);
    $range=mysql_numrows($result);
    mysql_close();
    $pr_index[$range];
    for ($index = 0; $index < $range; $index++) {
        $id_pr[$index]= mysql_result($result, $index, "ID");
        $pr_index[$index]=mysql_result($result,$index,"title");
    }
    include 'get_project_title.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    $query = "SELECT * FROM `tickets` WHERE `ID`='$tk'";
    $result=mysql_query($query);
    $num_rows=mysql_numrows($result);
    mysql_close();
    // Collects data for ticket
    $id=mysql_result($result,0,"ID");
    $title=mysql_result($result,0,"title");
    $description=mysql_result($result,0,"description");
    $project_assigned= mysql_result($result, 0, "project_assigned");
    $status=mysql_result($result,0,"status");

    echo '<form class="custom" action="edit_ticket.php" method="post">
    <fieldset>
        <legend>Edit ticket</legend>
        <input type="hidden" name="id" value="',$id,'"/>
        <p>Title
        <input type="text" name="title" value="',$title,'"/></p>
        <p>Description
        <textarea type="text" name="description">',$description,'</textarea></p>
        <div class="row"><div class="large-6 column"><p>Project assigned
        <select id="customDropdown1" name="project_assigned" value="',$project_assigned,'">';
        for ($index = 0; $index < $range; $index++){
            $selected_prass="";
            if($index==$project_assigned){
                $selected_prass="selected";
            }
            echo '<option ',$selected_prass,' value="',$id_pr[$index],'">',$pr_index[$index],'</option>';
        }
        echo '</select></p></div>
            <div class="large-6 column"><p>Status
              <select id="customDropdown1" name="status">';
        $status_index[0]='new';
        $status_index[1]='active';
        $status_index[2]='pending';
        $status_index[3]='closed';
        for ($index = 0; $index < 4; $index++){
            $selected_status="";
            if($status_index[$index]==$status){
                $selected_status="selected";
            }
            echo '<option ',$selected_status,' value="',$status_index[$index],'">',$status_index[$index],'</option>';
        }
        echo '</select></p>
        </div></div>
        <input class="button success" type="submit" value="Submit"/>
        <input class="button alert" type="reset" value="Reset form"/>
        <a class="button" href="?menu=2,3&tk=',$tk,'">Delete</a>
    </fieldset>
    </form>';
}
function delete_ticket($tk){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    echo '<p>Are you sure you want to delete ',$tk,' project?</p>';
    echo '<center><a class="small button" href="?menu=2,3&tk=',$tk,'&conf=1">YES</a> <a class="small button" href="?menu=2,3&tk=',$tk,'&conf=2">NO</a></center>';
    if($_GET['conf']==1){
        $query="DELETE FROM `mppm`.`tickets` WHERE `tickets`.`ID` = '$tk'";
        $result= mysql_query($query);
        echo 'DELETED';
        header("refresh:0;url=index.php?menu=2,0");
    }
    else if($_GET['conf']==2){
        echo 'RETURNS';
        header("refresh:0;url=index.php?menu=2,2&tk=$tk");
    }
}
function show_all_tickets(){
    include 'settings.php';
    include 'get_project_title.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    $query = "SELECT * FROM `tickets`";
    $result=mysql_query($query);
    $num_rows=mysql_numrows($result);
    mysql_close();

    echo '<table><thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Title</th>';
//    echo 'Description</th>';
    echo '<th>Project Assigned to</th>';
    echo '<th>Status</th>';
    echo '</tr></thead><tbody>';

    for ($index = 0; $index < $num_rows; $index++) {
        echo "<tr>";
        $id=mysql_result($result,$index,"ID");
        echo "<td>";echo $id;echo"</td>";
        $title=mysql_result($result,$index,"title");
        $description=mysql_result($result,$index,"description");
        echo '<td><a href="?menu=2,2&tk=',$id,'">',$title,'</a></td>';


    //    echo"<td>";echo $description;echo"</td>";
        $project_assigned=mysql_result($result,$index,"project_assigned");

        echo"<td>";get_project_title($project_assigned);echo"</td>";
        $status=mysql_result($result,$index,"status");

        echo '<td>',$status,'</td>';
        echo"</tr>";
    }
    echo '</tbody></table>';
}
?>