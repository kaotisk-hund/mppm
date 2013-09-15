<?php
// Include lines
include 'functions.php';
include 'projects.php';
include 'tickets.php';
include 'forms.php';
include 'head.php';
include 'footer.php';
// Initiate variables
$menu=$_GET['menu'];
$pr=$_GET['pr'];
$tk=$_GET['tk'];
//NAVIGATOR
$we_are_at=navigation($menu);
//HEAD
head();
//BODY
echo '<div class="row">';


//MENU
include 'menu.php';
echo '<div class="large-11 large-centered column">';

// We are at
echo '<nav class="breadcrumbs">
  ',$we_are_at,'
</nav><br>';

//CONTENT PART
echo '<div class="row">';
echo '<div class="large-8 column">';

if(!isset($_COOKIE["mppm_cookie"])){
    echo '<h1>Access denied</h1><p>You have to login to see the content.</p>';
}
else{
//DISPLAY CONTENT BASED ON MENU SELECTION
if($menu==""){
    header("refresh:0;url=index.php?menu=0,0");
}
elseif($menu=="0,0"){
    echo'
            <h3>Projects</h3>
            <p>';
    show_projects();
    echo '</p>

            <h3>Tickets</h3>
            <p>';
    show_tickets();
    echo '</p>
';
}

// PROJECT MENU
elseif($menu=="1,0"){
    show_projects();    
}
    // -New
    elseif($menu=="1,1"){
        new_project_form();
    }
    // -Edit
    elseif($menu=="1,2") {
        show_project($pr);
    }
    // -Delete
    elseif($menu=="1,3") {
        delete_project($pr);
    }

// TICKET MENU
elseif($menu=="2,0") {
    show_tickets();
}
    // -New
    elseif($menu=="2,1") {
        new_ticket_form();
    
    }
    // -Edit
    elseif($menu=="2,2") {
        show_ticket($tk);
    }
    // -Delete
    elseif($menu=="2,3") {
        delete_ticket($tk);
    }
    elseif($menu=="2,4") {
        show_all_tickets();
    }
// NOT PART OF MENU BUT FOR DEBUGING
elseif($menu=="debug"){
    debug();
    
}

else {
    header("refresh:0;url=index.php?menu=0,0");
}
}
//END OF CONTENT PART
echo '</div>';
//SIDEBAR
echo '<div class="large-4 column">
        <div class="panel">';
include 'sidebar.php';
//Closing div section for sidebar
echo '</div></div></div>';
//FOOTNOTES
include 'footnotes.php';

//FOOTER
footer();
?>
