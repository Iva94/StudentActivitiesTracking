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
                <h2>Izmjena podataka o studentu</h2><br>
                <?php
                    include './db_connection.php';
                    $id = $_GET['id'];
                    $querySelect = "SELECT * FROM `studenti` WHERE `student_id`=$id";
                    $result = mysqli_query($connection, $querySelect);
                    $numrows = mysqli_num_rows($result);
                    if($numrows!=0)
                    {
                        $row = mysqli_fetch_array($result);
                        $id = $row['student_id'];
                        $studPrezime = $row['student_prezime'];
                        $studIme = $row['student_ime'];
                        $studIndex = $row['student_index'];
                        ?>
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>"></input>
                            <div class="form-group">
                                <label for="firstName">Ime: </label>
                                <input type="text" name="firstName" class="form-control inputGroup" value="<?php echo $studIme; ?>" placeholder="Ime" required></input>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Prezime: </label>
                                <input type="text" name="lastName" class="form-control inputGroup" value="<?php echo $studPrezime; ?>" placeholder="Prezime"required></input>
                            </div>
                            <div class="form-group">
                                <label for="index">Indeks: </label>
                                <input type="text" name="index" class="form-control inputGroup" value="<?php echo $studIndex; ?>" placeholder="Indeks" required></input>
                            </div>
                            <input type="submit" name="updateStudent" class="btn button myButtons" value="Sačuvaj"></input>
                        </form>
                <?php
                    }
                    else {
                        echo '<script>alert("Nisu pronadjeni podaci u bazi")</script>';
                    }
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
    
    <?php 
        if(isset($_POST["updateStudent"]))
        {
            $query = "UPDATE `studenti` SET `student_ime`='$_POST[firstName]', `student_prezime`='$_POST[lastName]', `student_index`='$_POST[index]' WHERE `student_id`='$_POST[id]'";
            if(mysqli_query($connection, $query))
            {
                echo '<script> alert("Uspješna izmjena podatka!")</script>';
                echo '<script> location.href="./students.php"; </script>';
            }
            else
            {
                "Not Update!";
            }
        }
    ?>
</body>
</html>
