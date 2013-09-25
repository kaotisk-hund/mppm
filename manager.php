<?php

$manager = $_POST['manager'];

if($manager == 1){
    include 'projects.php';
    new_project();
}
elseif($manager == 2){
    include 'tickets.php';
    new_ticket();
}
else{
    echo 'Something went terribly wrong... redirecting to homepage';
    header("refresh:1;url=index.php?menu=0,0");
}
?>
