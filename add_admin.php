<html>
    <?php include './head.php'; ?>
<body>
    <!-- Header -->
    <?php include './header_nav.php'; ?>
    
    <!-- Central part -->
    <div class="container-fluid">
        <div class="row content">
            <div class="col-xs-12 col-sm-4 col-lg-11" id="mainDiv" name="mainDiv">
                <?php if(isset($_SESSION["username"])){ 
                    include './db_connection.php';
                    $usernameError = "";
                    $cfmPassError = "";
                    
                    if(isset($_POST["insertAdmin"]))
                    {
                        $querySelect = "SELECT * FROM `administratori` WHERE `korisnicko_ime`='$_POST[username]'";
                        $result = mysqli_query($connection, $querySelect);
                        $numrows = mysqli_num_rows($result);
                        if($numrows!=0){
                            $usernameError = "Korisničko ime je zauzeto!";
                        }
                        else if($_POST["password"] != $_POST["cfmPassword"]){
                            $cfmPassError = "Lozinke se ne poklapaju!";
                        }
                        else{
                            $queryInsert = "INSERT INTO `administratori`(`admin_id`,`admin_ime`, `admin_prezime`, `korisnicko_ime`, `email`, `lozinka`) VALUES (NULL, '$_POST[fName]','$_POST[lName]','$_POST[username]','$_POST[email]','$_POST[password]')";
                            if(mysqli_query($connection, $queryInsert))
                            {
                                echo '<script> alert("Uspješan unos!")
                                    location.href="./index.php"; </script>';
                            }
                            else
                            {
                                echo '<script> 
                                        document.getElementById("msgBox").innerHtml = "<strong>Unos nije moguć! Molimo, pokušajte kasnije.</strong>";
                                        document.getElementById("msgBox").classList.add("alert-danger");
                                        document.getElementById("msgBox").style.visibility = visible;
                                     </script>';
                            }
                        }
                    }
                    ?>
                <h2>Unos podataka o administratoru</h2>
                <br>
                <form method="post">
                    <div class="form-group">
                        <label for="fName">Ime: </label>
                        <input type="text" name="fName" class="form-control inputGroup" value="" placeholder="Ime" required></input>
                    </div>
                    <div class="form-group">
                        <label for="lName">Prezime: </label>
                        <input type="text" name="lName" class="form-control inputGroup" value="" placeholder="Prezime"required></input>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail: </label>
                        <input type="text" name="email" class="form-control inputGroup" value="" placeholder="E-mail" required></input>
                    </div>
                    <div class="form-group">
                        <label for="username">Korisničko ime: </label>
                        <input type="text" name="username" class="form-control inputGroup" value="" placeholder="Korisničko ime" required></input>
                        <span class="error"><?php echo $usernameError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Lozinka: </label>
                        <input type="password" name="password" class="form-control inputGroup" value="" placeholder="Lozinka" required></input>
                    </div>
                    <div class="form-group">
                        <label for="cfmPassword">Potvrda lozinke: </label>
                        <input type="password" name="cfmPassword" class="form-control inputGroup" value="" placeholder="Potvrda lozinke" required></input>
                        <span class="error"><?php echo $cfmPassError;?></span>
                    </div>

                    <input type="submit" name="insertAdmin" class="btn button myButtons" value="Sačuvaj"></input>
                </form>
                <?php }
                else{ ?>
                <br>
                <div id="msgDiv"><strong>Da biste vidjeli informacije, morate biti ulogovani.</strong></div>
                <?php } ?>
            </div>
        </div>
    </div>
   
    <!-- Footer -->
    <?php include './footer.php'; ?>
</body>
</html>
