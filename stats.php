<?php
include_once './modules.php';
if(isset($_COOKIE["mppm_cookie"])){
    echo '<p>No.Projects: ';
    noProjects();
    echo '</p><p>No.Tickets: ';
    noTickets();
    echo '</p><p>Oldest project: ';
    oldestProject();
    echo '</p><p>Newest project: ';
    newestProject();
    echo '</p>';
}
?>