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
                <h2>Unos aktivnosti studenta</h2><br>
                <?php
                    include './db_connection.php';
                    $studentId = $_GET['id'];?>
                    <form method=post name="insert">
                        <input type="hidden" name="id" value=""></input>
                        <input type="hidden" name="student" value="<?php echo $studentId;?>"></input>
                        <div class="form-group">
                            <label for="tip">Tip aktivnosti: </label> <br>
                            <select name="tip" class="form-control inputGroup" required>
                                <option value="" selected>Izaberite tip aktivnosti...</option>
                                <?php                       
                                $query = "SELECT * from tip_aktivnosti";
                                $result = mysqli_query($connection, $query); 
                                while($row = mysqli_fetch_array($result)) 
                                { ?>
                                    <option value=" <?php echo $row['tip_id']?>"> <?php echo $row['tip_naziv'] ?></option>';
                                <?php
                                } 
                                ?>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="datum">Datum: </label>
                            <input type="date" name="datum" class="form-control inputGroup" value="" placeholder="Datum" required></input>
                        </div>

                        <div class="form-group">
                            <label for="mjesto">Mjesto: </label>
                            <input type="text" name="mjesto" class="form-control inputGroup" value="" placeholder="Mjesto"required></input>
                        </div>

                        <div class="form-group">
                            <label for="opis">Opis: </label>
                            <input type="text" name="opis" class="form-control inputGroup" value="" placeholder="Opis" required></input>
                        </div>
                        <input type="submit" name="insert" class="btn button myButtons" value="Sačuvaj"></input>
                    </form>
            
            <?php }
            else { ?>
                <br>
                <strong>Da biste vidjeli informacije, morate biti ulogovani.</strong>
            <?php } ?> 
            </div>
        </div>
    </div>
   
    <!-- Footer -->
    <?php include './footer.php'; ?>
    
    <?php 
        if(isset($_POST["insert"]))
        {
            $queryInsert = "INSERT INTO `aktivnosti`(`aktivnost_id`, `student_id`, `tip_id`, `aktivnost_datum`, `aktivnost_mjesto`, `aktivnost_opis`) VALUES (NULL, '$_POST[student]', '$_POST[tip]','$_POST[datum]','$_POST[mjesto]', '$_POST[opis]')";
            if(mysqli_query($connection, $queryInsert))
            {
                echo '<script> alert("Uspješan unos!")</script>';
                echo '<script> location.href="./activities.php"; </script>';
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
