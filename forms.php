<?php

function new_project_form(){
echo '
<form data-abide action="create_project.php" method="post">
    <fieldset>
        <legend>New project</legend>
        <input class="larg-4 column" type="text" name="title" value="Title"/>
        <textarea name="description">Description</textarea>
        <input type="date" required name="start_date" value="Start Date"/>
        <small class="error">Start date is required for new project</small>
        <input type="date" name="estend_date" value="Est. End Date"/>
        <input type="date" name="end_date" value="End Date"/>
        <input class="button success" type="submit" value="Submit"/>
        <input class="button alert" type="reset" value="Reset form"/>
    </fieldset>
</form>';
}

function new_ticket_form(){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    // Read notes to get array range
    $query="SELECT * FROM projects";
    $result=mysql_query($query);
    $range=mysql_numrows($result);
    mysql_close();
    $id_pr[$range];
    $title[$range];
    for ($index = 0; $index < $range; $index++) {
        $id_pr[$index]= mysql_result($result, $index, "ID");
        $title[$index]=mysql_result($result,$index,"title");
    }
    $status_index[0]='new';
    $status_index[1]='active';
    $status_index[2]='pending';
    $status_index[3]='closed';
    echo '
<form class="custom" action="create_ticket.php" method="post">
    <fieldset>
        <legend>New ticket</legend>
        <input type="text" name="title" value="Title"/>
        <textarea type="text" name="description">Description</textarea>
        <div class="row"><div class="large-6 column"><select id="customDropdown1" name="project_assigned">
            <option DISABLED>Project assigned</option>';
    for ($index = 0; $index < $range; $index++){
        echo '<option value="',$id_pr[$index],'">',$title[$index],'</option>';
    }
    echo '</select></div>
    <div class="large-6 column"><select id="customDropdown1" name="status">
            <option DISABLED>Status</option>';
    
    for ($index = 0; $index < 4; $index++){
        echo '<option value="',$status_index[$index],'">',$status_index[$index],'</option>';
    }
    echo '</select></div></div>
        <input class="button success" type="submit" value="Submit"/>
        <input class="button alert" type="reset" value="Reset form"/>
    </fieldset>
</form>';
}
function login_form(){
    echo '<form class="custom" method="post">';
    echo '<div class="row">Username</div>';
    echo '<div class="row"><input type="text" name="username"></div>';
    echo '<div class="row">Password</div>';
    echo '<div class="row"><input type="password" name="password"></div>';
    echo '<div class="row"><input class="button small success" type="submit" value="Login"></div>';
    echo '</form>';
}



function debug(){
    echo md5("123456");
}
?>