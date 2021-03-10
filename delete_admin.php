<?php 
include './db_connection.php';
if(isset($_POST["deleteAdmin"]))
{
    $query = "DELETE FROM `administratori` WHERE `admin_id`='$_POST[id]'";        
    if(mysqli_query($connection, $query))
    {
        echo '<script> location.href="./admins.php"; </script>';
    }
    else
    {
        "Not Delete!";
    }      
}