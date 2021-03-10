<html>
    <?php include './head.php'; ?>
<body>
    <!-- Header -->
    <?php include './header_nav.php'; ?>
    
    <!-- Central part -->
    <div class="container-fluid">
        <div class="row content">
            <div class="col-xs-12 col-sm-4 col-lg-11" id="mainDiv" name="mainDiv">
                <h2>Unos podataka o studentu</h2><br>
                <?php include './db_connection.php'; ?>
                    <form method="post" name="insert">
                        <div class="form-group">
                            <label for="firstName">Ime: </label>
                            <input type="text" name="firstName" class="form-control inputGroup" value="" placeholder="Ime" required></input>
                        </div>

                        <div class="form-group">
                            <label for="lastName">Prezime: </label>
                            <input type="text" name="lastName" class="form-control inputGroup" value="" placeholder="Prezime"required></input>
                        </div>

                        <div class="form-group">
                            <label for="index">Indeks: </label>
                            <input type="text" name="indeks" class="form-control inputGroup" value="" placeholder="Indeks" required></input>
                        </div>

                        <input type="submit" name="insert" class="btn button myButtons" id="insert" value="Sačuvaj"></input>
                    </form>
                    
                    <div id="msgBox" class="alert"></div>
            </div>
        </div>
    </div>
   
    <!-- Footer -->
    <?php include './footer.php'; ?>
    
    <?php 
        if(isset($_POST["insert"]))
        {
            $queryInsert = "INSERT INTO `studenti`(`student_id`,`student_ime`, `student_prezime`, `student_index`) VALUES (NULL, '$_POST[firstName]','$_POST[lastName]','$_POST[indeks]')";
            if(mysqli_query($connection, $queryInsert))
            {
                //SKONTATI KAKO ISPISATI PORUKU!
                echo '<script> alert("Uspješan unos!")
                    location.href="./students.php"; </script>';
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
    ?>
    
</body>
</html>
