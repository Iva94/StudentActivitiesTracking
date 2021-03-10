<?php
include './db_connection.php';
if(isset($_POST["updateType"]))
{
    $query = "UPDATE `tip_aktivnosti` SET `tip_naziv`='$_POST[tipNaziv]' WHERE `tip_id`='$_POST[tipId]'";
    if(mysqli_query($connection, $query))
    {
        echo '<script> alert("Uspješna izmjena tipa aktivnosti!")</script>';
        echo '<script> location.href="./activity_types.php"; </script>';
    }
    else
    {
        "Not Update";
    }
}