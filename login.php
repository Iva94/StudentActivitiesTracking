<?php
include './db_connection.php';
session_start();
?>
<html>
    <?php include './head.php'; ?>
<body>
    <!--Header--> 
    <div id="header" class="container-fluid"> 
        <h1 class="title">Evidencija aktivnosti studenata</h1>
    </div>
     <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#"></a>
          </div>
          <ul class="nav navbar-nav">
              <li><a id="indexPg" href="index.php">Početna</a></li>
            <li><a id="studentsPg" href="students.php">Studenti</a></li>
            <li><a id="activitiesPg" href="activities.php">Aktivnosti</a></li>
          </ul>
        </div>
    </nav>
    
    <!--Central part--> 
    <div class="container-fluid">
        <div class="row content">
            <div class="col-xs-12 col-sm-4 col-lg-11" id="mainDiv" name="mainDiv">
                <div class="col-xs-12 col-sm-4 col-lg-11" id="loginDiv" name="loginDiv" id="loginDiv">
                    <h2 id="loginTitle">Prijava</h2><hr><br>
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Korisničko ime: </label>
                            <input type="text" name="username" class="form-control inputGroup" value="" placeholder="Korisničko ime" required></input>
                        </div>
                        <div class="form-group">
                            <label for="password">Lozinka: </label>
                            <input type="password" name="password" class="form-control inputGroup" value="" placeholder="Lozinka" required></input>
                        </div>
                        
                        <div><p class="errorMsg" id="errorMsg" style="visibility: hidden;">Pogrešno korisničko ime ili lozinka.</p>
                        </div>
                        
                        <input type="submit" name="checkLogin" id="checkLoginBtn" class="btn button myButtons" value="Prijava"></input>
                        <br>
                        
                    <?php 
                     //Login
                    if(isset($_POST["checkLogin"]))
                    {
                        $query = "SELECT * FROM `administratori` WHERE `korisnicko_ime` = '".$_POST["username"]."' AND `lozinka` = '".$_POST["password"]."' ";
                        $result = mysqli_query($connection, $query);
                        if(mysqli_num_rows($result)){
                            $_SESSION["username"] = $_POST["username"];
                            echo '<script> location.href="./index.php"; </script>';
                        }
                        else{
                            echo '<br><hr><div class="errorMsg" id="errorMsg">Pogrešno korisničko ime ili lozinka!</div>';
                        }
                    }?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include './footer.php'; ?>

    <?php
    //Logout
    if(isset($_POST["logout"]))
    {
        unset($_SESSION["username"]);
    }
    ?>  
</body>
</html>
