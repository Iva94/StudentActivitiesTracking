<?php
include './db_connection.php';
if(isset($_POST["deleteType"]))
{
    $query = "DELETE FROM `tip_aktivnosti` WHERE `tip_id`='$_POST[id]'";        
    if(mysqli_query($connection, $query))
    {
        echo '<script> location.href="./activity_types.php"; </script>';
    }
    else
    {
        "Not Delete!";
    }      
}