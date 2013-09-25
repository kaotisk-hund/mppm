<?php


$stage=$_POST["stage"];
include 'head.php';
include 'footer.php';
head();
function title(){
    echo '<h1>Installation</h1>';
}
function welcome(){
    echo '<h2>Welcome</h2><p>This is the installation procedure/page for MPPM.</p>';
    echo '<form method=post><input type="hidden" value="1" name="stage"/><input class="button" type="submit" value="Next >"></form>';
    
}
function readme(){
    echo '<h2>Readme</h2><p>';
    include 'README';
    echo '</p>';
    echo '<form method=post><input type="hidden" value="2" name="stage"/><input class="button" type="submit" value="Next >"></form>';
}
function create_tables($db_server,$db_user,$db_pass,$db_name){
    $link = mysql_connect($db_server,$db_user,$db_pass);
    if (!$link) {
    die('Could not connect: ' . mysql_error());
    }
    mysql_select_db($db_name) or die('Could not select database');
    // Table projects
    $sql = "CREATE TABLE projects(
        ID INT(11) NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (ID),
        title VARCHAR(500),
        description VARCHAR(2000),
        start_date DATE,
        estend_date DATE,
        end_date DATE)";
    if (mysql_query($sql, $link)) {
        echo "Table \"projects\" created successfully<br>";
    }
    else {
        echo 'Error creating database: ' . mysql_error() . "\n";
    }
    // Table tickets
    $sql = "CREATE TABLE tickets(
        ID INT(11) NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (ID),
        title VARCHAR(500),
        description VARCHAR(2000),
        project_assigned INT(11),
        status ENUM('new','active','pending','closed'))";
    if (mysql_query($sql, $link)) {
        echo "Table \"tickets\" created successfully<br>";
    }
    else {
        echo 'Error creating database: ' . mysql_error() . "\n";
    }
    // Table users
    $sql = "CREATE TABLE users(
        user  VARCHAR(20),
        PRIMARY KEY (user),
        password  VARCHAR(32))";
    if (mysql_query($sql, $link)) {
        echo "Table \"users\" created successfully<br>";
    }
    else {
        echo 'Error creating database: ' . mysql_error() . "\n";
    }
}
function create_database($db_server,$db_user,$db_pass,$db_name){
    $link = mysql_connect($db_server,$db_user,$db_pass);
    if (!$link) {
    die('Could not connect: ' . mysql_error());
    }
    $sql = 'CREATE DATABASE '.$db_name.' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci';
    if (mysql_query($sql, $link)) {
        echo "Database created successfully\n";
    }
    else {
        echo 'Error creating database: ' . mysql_error() . "\n";
    }
}
function database_form(){
    echo '<h2>Set up database</h2>';
    echo '<p><form class="custom" method="post">
          mySQL server: <input type="text" name="db_server"><br>
          Database name: <input type="text" name="db_name"><br>
          Username: <input type="text" name="db_user"><br>
          Password: <input type="password" name="db_pass"><br>
          Site username: <input type="text" name="user"><br>
          Site password: <input type="password" name="pass"><br>
          <input type="hidden" name="stage" value="3">
          <input class="button" type="submit" value="Next >">
          </form></p>';
}
function register_user($db_server,$db_user,$db_pass,$db_name,$user,$pass){
    $link = mysql_connect($db_server,$db_user,$db_pass);
    if (!$link) {
    die('Could not connect: ' . mysql_error());
    }
    mysql_select_db($db_name) or die('Could not select database');
    $sql = "INSERT INTO `users` (`user`, `password`) VALUES ('$user','$pass')";
    if (mysql_query($sql, $link)) {
        echo "User ",$user," created successfully<br>";
    }
    else {
        echo 'Error creating database: ' . mysql_error() . "\n";
    }
}
function create_settings_file($db_server,$db_user,$db_pass,$db_name){
     $file=fopen("settings.php","w");
     $string='<?php
$ip = "'.$db_server.'";
$user = "'.$db_user.'";
$pass = "'.$db_pass.'";
$db = "'.$db_name.'";
?>
';
     fwrite($file, $string);
     fclose($file);
}
echo '<div class="large-9 large-centered column">';
title();
// First step, README
if($stage=="1"){
    readme();
}
// Second step, getting data
elseif($stage=="2"){
    database_form();
}
// Creating database
elseif($stage=="3"){
    // Variables
    $db_user=mysql_real_escape_string($_POST["db_user"]);
    $db_pass=mysql_real_escape_string($_POST["db_pass"]);
    $db_name=mysql_real_escape_string($_POST["db_name"]);
    $db_server=mysql_real_escape_string($_POST["db_server"]);
    $user=mysql_real_escape_string($_POST["user"]);
    $pass=md5(mysql_real_escape_string($_POST["pass"]));

    create_database($db_server,$db_user,$db_pass,$db_name);
    create_tables($db_server,$db_user,$db_pass,$db_name);
    register_user($db_server,$db_user,$db_pass,$db_name,$user,$pass);
    create_settings_file($db_server,$db_user,$db_pass,$db_name);
    echo '<form method=post><input type="hidden" value="4" name="stage"/><input class="button" type="submit" value="Next >"></form>';
}
// Creating settings file
elseif($stage=="4"){
    echo '<p> DONE!!!! </p>
        <a href="./index.php">to the project manager!!!</a>';
}

// Else welcome!!!
else{
    welcome();
}
echo '</div>';
footer();
?>
