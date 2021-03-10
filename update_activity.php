<html>
    <?php include './head.php'; ?>
<body>
    <!-- Header -->
    <?php include './header_nav.php'; ?>
    
    <!-- Central part -->
    <div class="container-fluid">
        <div class="row content">
            <?php 
            if(isset($_SESSION["username"])){
            ?>
            <div class="col-xs-12 col-sm-4 col-lg-11" id="mainDiv" name="mainDiv">
                <h2>Izmjena podataka o aktivnosti studenta</h2><br>
                <?php
                    include './db_connection.php';
                    $id = $_GET['id'];
                    $selected = $_GET['act'];
                    $querySelect = "SELECT * FROM `aktivnosti` WHERE `aktivnost_id`=$id";
                    $result = mysqli_query($connection, $querySelect);
                    $numrows = mysqli_num_rows($result);
                    if($numrows!=0)
                    {
                        $row = mysqli_fetch_array($result);
                        $studentId = $row["student_id"];
                        $aktivnostId = $row["aktivnost_id"];
                        $datum = $row["aktivnost_datum"];
                        $mjesto = $row["aktivnost_mjesto"];
                        $opis = $row["aktivnost_opis"];
                        $query1 = "SELECT * FROM `studenti` WHERE `student_id`=$studentId";
                        $result1 = mysqli_query($connection, $query1);
                        $numrows1 = mysqli_num_rows($result1);
                        if($numrows1!=0)
                        {
                            while($row1 = mysqli_fetch_array($result1)){
                                $ime = $row1["student_ime"];
                                $prezime = $row1["student_prezime"];
                            }
                        }
                        ?>
                        <form method=post>
                            <input type="hidden" name="id" value="<?php echo $aktivnostId; ?>"</input>
                            <div class="form-group">
                                <label for="student">Student: </label>
                                <input type="text" name="student" class="form-control inputGroup" value="<?php echo $ime.' '.$prezime;?>" disabled="true"></input>
                            </div>
                            <div class="form-group">
                                <label for="activity">Aktivnost: </label> <br>
                                <select name="activity" class="form-control inputGroup">
                                   <option value="">Izaberite aktivnost...</option>
                                <?php                   
                                $querySelect2 = "SELECT * FROM tip_aktivnosti";
                                $result2 = mysqli_query($connection, $querySelect2); 
                                while($row2 = mysqli_fetch_array($result2)) 
                                { 
                                    if($selected == $row2['tip_naziv']){ ?>
                                    <option value="<?php echo $row2['tip_id']; ?>" selected><?php echo $row2['tip_naziv']; ?></option>
                                    <?php
                                    }
                                    else {
                                        ?>
                                        <option value="<?php echo $row2['tip_id']; ?>"><?php echo $row2['tip_naziv']?></option>
                                        <?php
                                    }
                                }  ?>
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="datum">Datum: </label>
                                <input type="date" name="datum" class="form-control inputGroup" value="<?php echo $datum; ?>" placeholder="Datum" required></input>
                            </div>
                            <div class="form-group">
                                <label for="mjesto">Mjesto: </label>
                                <input type="text" name="mjesto" class="form-control inputGroup" value="<?php echo $mjesto; ?>" placeholder="Mjesto" required></input>
                            </div>

                            <div class="form-group">
                                <label for="opis">Opis: </label>
                                <input type="text" name="opis" class="form-control inputGroup" value="<?php echo $opis; ?>" placeholder="Opis" required></input>
                            </div>
                            <input type="submit" name="update" class="btn button myButtons" id="update" value="Sačuvaj"></input>
                        </form>
                    <?php
                    }
                    else {
                        echo '<script>alert("Nisu pronadjeni podaci u bazi")</script>';
                    }
                ?>
            </div>
            <?php }
            else {
            ?>
                <br><br>
                <div class="errorMsg" id="errorMsg" style="padding-left: 400px; color: red; border: 1px solid red; border-radius: 3px;">Nije dozvoljen pristup!</div>
            <?php    
            }?> 
        </div>
    </div>
   
    <!-- Footer -->
    <?php include './footer.php'; ?>
    
    <?php 
        if(isset($_POST["update"]))
        {
            $queryUpdate = "UPDATE `aktivnosti` SET `aktivnost_datum`='$_POST[datum]', `aktivnost_mjesto`='$_POST[mjesto]', `aktivnost_opis`='$_POST[opis]' WHERE `aktivnost_id`='$_POST[id]'";

            if(mysqli_query($connection, $queryUpdate))
            {
                echo '<script> alert("Uspješna izmjena podatka!")</script>';
                echo '<script> location.href="./activities.php"; </script>';
            }
            else
            {
                "Not Update!";
            }
        }
    ?>
</body>
</html>
