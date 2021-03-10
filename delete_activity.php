<?php 
include './db_connection.php';

if(isset($_POST["deleteAct"]))
{
    $query = "DELETE FROM `aktivnosti` WHERE `aktivnost_id`='$_POST[id]'";        
    if(mysqli_query($connection, $query))
    {
        echo '<script> location.href="./activities.php"; </script>';
    }
    else
    {
        "Not Delete!";
    }      
}
?>