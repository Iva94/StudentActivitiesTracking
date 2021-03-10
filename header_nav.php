<?php
session_start();
?>
<html>
    <?php include './head.php'; ?>
<body>
    <div id="header" class="container-fluid"> 
        <h1 class="title">Evidencija aktivnosti studenata</h1>
        <?php
            if(isset($_SESSION["username"])){
        ?>
        <div id="dropdownBtn" class="dropdown" style="float: right">
            <button id="adminBtn" class="btn btn-default btn-primary headerBtn dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_SESSION["username"]; ?>
            <span class="caret"></span></button>
            <ul class="dropdown-menu" style="left: -110px;">
                <li><a href="#" onclick="javascript:location.href='./edit_profile.php'">Uredi profil</a></li>
                <li><a href="#" onclick="javascript:location.href='./change_password.php'">Promijeni lozinku</a></li>
                <li><a href="#" onclick="javascript:location.href='./admins.php'">Pregled administratora</a></li>
                <li><a href="#" onclick="javascript:location.href='./logout.php'">Odjava</a></li>
            </ul>
        </div>
         <?php
        }
        else{
        ?>
                <input type="button" class="btn btn-primary headerBtn" name="loginBtn" id="loginBtn" onclick="javascript:location.href='./login.php'" value="Prijavi se">
                <?php
            }
        ?>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#"></a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">Početna</a></li>
                <li><a href="students.php">Studenti</a> </li>
                <li><a href="activities.php">Aktivnosti</a></li>
            </ul>
        </div>
    </nav>
</body>
</html>