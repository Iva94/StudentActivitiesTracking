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
                ?>
                <h2>Podaci o administratoru</h2><br>
                <?php
                    include './db_connection.php';
                    $username = $_SESSION["username"];
                    $querySelect = "SELECT * FROM `administratori` WHERE `korisnicko_ime`='$username'";
                    $result = mysqli_query($connection, $querySelect);
                    $numrows = mysqli_num_rows($result);
                    if($numrows!=0) {
                        $row = mysqli_fetch_array($result);
                        $id = $row['admin_id'];
                        $prezime = $row['admin_prezime'];
                        $ime = $row['admin_ime'];
                        $kor_ime = $row['korisnicko_ime'];
                        $email = $row['email'];
                        ?>
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>"></input>
                            <div class="form-group">
                                <label for="firstName">Ime: </label>
                                <input type="text" name="firstName" class="form-control inputGroup" value="<?php echo $ime; ?>" placeholder="Ime" required></input>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Prezime: </label>
                                <input type="text" name="lastName" class="form-control inputGroup" value="<?php echo $prezime; ?>" placeholder="Prezime"required></input>
                            </div>
                            <div class="form-group">
                                <label for="username">Korisnicko ime: </label>
                                <input type="text" name="username" class="form-control inputGroup" value="<?php echo $kor_ime; ?>" placeholder="Korisnicko ime" required></input>
                            </div>
                            <div class="form-group">
                                <label for="email">Email: </label>
                                <input type="text" name="email" class="form-control inputGroup" value="<?php echo $email; ?>" placeholder="Email" required></input>
                            </div>
                            <input type="submit" name="editProfile" class="btn button myButtons" value="Sačuvaj"></input>
                        </form>
                <?php
                    }
                    else {
                        echo '<script>alert("Nisu pronadjeni podaci u bazi")</script>';
                    }
                }
                else {
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
    
    <?php 
        if(isset($_POST["editProfile"]))
        {
            $query = "UPDATE `administratori` SET `admin_ime`='$_POST[firstName]', `admin_prezime`='$_POST[lastName]', `korisnicko_ime`='$_POST[username]', `email`='$_POST[email]' WHERE `admin_id`='$_POST[id]'";
            if(mysqli_query($connection, $query))
            {
                echo '<script> alert("Uspješna izmjena podatka!")</script>';
                echo '<script> location.href="./index.php"; </script>';
            }
            else
            {
                "Not Update!";
            }
        }
    ?>
</body>
</html>
