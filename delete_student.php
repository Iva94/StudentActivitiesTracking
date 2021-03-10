<?php 
include './db_connection.php';
if(isset($_POST["deleteStud"]))
{
    $query = "DELETE FROM `studenti` WHERE `student_id`='$_POST[id]'";        
    if(mysqli_query($connection, $query))
    {
        echo '<script> location.href="./students.php"; </script>';
    }
    else
    {
        "Not Delete!";
    }      
}
?>