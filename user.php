<?php
$logout=$_POST["logout"];
// Username
$username = $_POST["username"];
// MD5 password
$password = md5($_POST["password"]);

if($username<>""){
    include 'settings.php';
//    $con=mysqli_connect($ip,$user,$pass,"mppm");
//    // Check connection
//    if (mysqli_connect_errno($con)){
//        echo "Failed to connect to MySQL: " . mysqli_connect_error();
//    }
//    
//    //$link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
//    //mysql_select_db($db) or die('Could not select database');
//    
//    // Find username
//    $query = "SELECT * FROM users WHERE `username`='$username'";
//    $result = mysqli_query($con,$query);
//    echo $;
    


// CONNECT TO THE DATABASE

    $mysqli = new mysqli($ip, $user, $pass, "mppm");
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

// A QUICK QUERY ON A FAKE USER TABLE
    $query = "SELECT * FROM `users` WHERE `username`='$username'";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);

    $tmppass;
// GOING THROUGH THE DATA
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tmppass = stripslashes($row['password']);	
        }
    }
    else {
        echo ' ';	
    }
    // CLOSE CONNECTION
    mysqli_close($mysqli);


    
    if($password == $tmppass){
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