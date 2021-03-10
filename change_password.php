<html>
    <?php include './head.php'; ?>
<body>
    <!-- Header -->
    <?php include './header_nav.php'; ?>
    
    <!-- Central part -->
    <div class="container-fluid">
        <div class="row content">
            <div class="col-xs-12 col-sm-4 col-lg-11" id="mainDiv" name="mainDiv">
                <?php
                if(isset($_SESSION["username"])){
                    include './db_connection.php';
                    $curPassError = "";
                    $cfmPassError = "";
                    
                    $username = $_SESSION["username"];
                    $querySelect = "SELECT * FROM `administratori` WHERE `korisnicko_ime`='$username'";
                    $result = mysqli_query($connection, $querySelect);
                    $numrows = mysqli_num_rows($result);
                    if($numrows!=0)
                    {
                        $row = mysqli_fetch_array($result);
                        $id = $row['admin_id'];
                        $lozinka = $row['lozinka'];
                    }
                    else{
                        echo '<script>alert("Nisu pronadjeni podaci u bazi")</script>';
                    }
                    
                    if(isset($_POST["changePassword"]))
                    {
                        if($_POST["currentPassword"] != $_POST["oldPassword"]){
                            $curPassError = "Pogrešna lozinka!";
                        }
                        else if($_POST["newPassword"] != $_POST["confirmPassword"]){
                            $cfmPassError = "Lozinke se ne poklapaju!";
                        }
                        else{
                            $hashPass = md5($_POST["newPassword"]);
                            $query = "UPDATE `administratori` SET `lozinka`='$hashPass' WHERE `admin_id`='$_POST[id]'";
                            if(mysqli_query($connection, $query))
                            {
                                echo '<script> alert("Uspješna promjena lozinke!")</script>';
                                echo '<script> location.href="./index.php"; </script>';
                            }
                            else
                            {
                                "Not Update!";
                            }
                        }
                    }
                ?>
                <h2>Promjena lozinke</h2><br>
                <form id="formPassword" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>"></input>
                    <input type="hidden" name="oldPassword" value="<?php echo $lozinka; ?>"></input>
                    <div class="form-group">
                        <label for="currentPassword">Trenutna lozinka: </label>
                        <input type="password" name="currentPassword" class="form-control inputGroup" value="" placeholder="Trenutna lozinka" required></input>
                        <span class="error"><?php echo $curPassError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Nova lozinka: </label>
                        <input type="password" name="newPassword" id="newPassword" class="form-control inputGroup" value="" placeholder="Nova lozinka"required></input>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Potvrda lozinke: </label>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control inputGroup" value="" placeholder="Potvrda lozinke" required></input>
                        <span class="error"><?php echo $cfmPassError;?></span>
                    </div>
                    <input type="submit" name="changePassword" class="btn button myButtons" value="Sačuvaj"></input>
                </form>
                <?php
                }
                else{
                ?>
                <br>
                <strong>Da biste vidjeli informacije, morate biti ulogovani.</strong>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include './footer.php'; ?>
</body>
</html>
