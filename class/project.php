<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of project
 *
 * @author kaotisk-hund
 */
class project {
    public $id,$title,$description,$start_date,$estend_date,$end_date;
    function __construct($a,$b,$c,$d,$e,$f) {
        $this->id = $a;
        $this->title = $b;
        $this->description = $c;
        $this->start_date = $d;
        $this->estend_date = $e;
        $this->end_date = $f;
        echo __CLASS__ . " initiated";
    }
    function showProject(){
        // Creates the table and data
        echo '<form action="edit_project.php" method="post">
        <fieldset>
            <legend>Edit ',  $this->title,'</legend>
            <input type="hidden" name="id" value="',$this->id,'"/>
            <input class="larg-4 column" type="text" name="title" value="',$this->title,'"/>
            <textarea name="description">',$this->description,'</textarea>
            <input type="date" name="start_date" value="',$this->start_date,'"/>
            <input type="date" name="estend_date" value="',$this->estend_date,'"/>
            <input type="date" name="end_date" value="',$this->end_date,'"/>
            <input class="button success" type="submit" value="Update"/>
            <input class="button alert" type="reset" value="Revert"/>
            <a class="button" href="?menu=1,3&pr=',$pr,'">DELETE</a>
        </fieldset>
        </form>';
    }
//    function delete_project($pr){
//        include 'settings.php';
//        $link = mysql_connect($ip, $user, $pass) or die('Could not connect: ' . mysql_error());
//        mysql_select_db($db) or die('Could not select database');
//        echo '<p>Are you sure you want to delete ',$pr,' project?</p>';
//        echo '<center><a class="small button" href="?menu=1,3&pr=',$pr,'&conf=1">YES</a> <a class="small button" href="?menu=1,3&pr=',$pr,'&conf=2">NO</a></center>';
//        if($_GET['conf']==1){
//            $query="DELETE FROM `mppm`.`projects` WHERE `projects`.`ID` = '$pr'";
//            $result= mysql_query($query);
//            echo 'DELETED';
//            header("refresh:0;url=index.php?menu=1,0");
//        }
//        else if($_GET['conf']==2){
//            echo 'RETURNS';
//            header("refresh:0;url=index.php?menu=1,2&pr=$pr");
//        }
//    }
    function updateProject(){
        
    }
}

?>
