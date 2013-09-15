<?php
$logout=$_POST["logout"];
// Username
$username = mysql_real_escape_string($_POST["username"]);
// MD5 password
$password = md5(mysql_real_escape_string($_POST["password"]));

if($username<>""){
    include 'settings.php';
    $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
    mysql_select_db($db) or die('Could not select database');
    
    // Find username
    $query = "SELECT * FROM users WHERE `username`='$username'";
    $result = mysql_query($query);
    if($password ==  mysql_result($result, 0, "password")){
        setcookie("mppm_cookie", $username, time()+3600);
        echo "Connecting...";
        header("refresh:0;url=index.php?menu=0,0");
    }
    else{
        echo "wrong username/password";
        header("refresh:1;url=index.php?menu=0,0");
    }
}
elseif(isset ($_COOKIE["mppm_cookie"])){
    echo '<p>Welcome ',$_COOKIE["mppm_cookie"],' !
        <form class="custom" method="post">
        <input type="hidden" value="1" name="logout"/>
        <input class="small button" type="submit" value="Log out"/></form></p>';
}


else{
    login_form();
}

// LOGOUT
if($logout=="1"){
    setcookie("mppm_cookie","",time()-3600);
    $logout="0";
    echo 'Logging out...';
    header("refresh:1;url=index.php?menu=0,0");

}
?>