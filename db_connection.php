<?php
DEFINE ("host", "localhost");
DEFINE ("user", "root");
DEFINE ("pass", "");
DEFINE ("db", "itp_db");

$connection = mysqli_connect(host, user, pass, db);
mysqli_set_charset($connection, "utf8");
if(mysqli_connect_errno())
{
    echo '<script>alert("Doslo je do greske prilikom povezivanja na bazu!!!");</script>';
    exit;
}