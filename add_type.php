<?php
include './db_connection.php';
if(isset($_POST["insertType"]))
{
    $query = "INSERT INTO `tip_aktivnosti`(`tip_id`,`tip_naziv`) VALUES (NULL, '$_POST[tip]')";
    if(mysqli_query($connection, $query))
    {
        echo '<script> alert("Uspješan unos!")
            location.href="./activity_types.php"; </script>';
    }
    else
    {
        "Not Insert";
    }
}