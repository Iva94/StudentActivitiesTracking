<html>
    <?php include './head.php'; ?> 
<body>
    <!-- Header -->
    <?php include './header_nav.php'; ?>
    
    <!-- Central part -->
    <div class="container-fluid">
        <div class="row content">
            <div class="col-xs-12 col-sm-4 col-lg-11" id="mainDiv" name="mainDiv">  
                <div id="tableStudent">
                    <h2>Studenti
                    <?php if(isset($_SESSION["username"])){ ?>
                    <input type="submit" class="btn btn-primary myButtons hiddenButtons" style="float: right" name="addStud" id="addStud" onclick="location.href = 'add_student.php'" value="Dodaj studenta">                                             
                    <hr>
                    <?php } 
                    else{ ?>
                    <hr width="510px" style="margin-left: 0px">
                    <?php } ?>
                    </h2>
                    <div id="search" class="search search-container form-inline">
                        <label for="search">Pretražite tabelu: </label>
                        <input id="studentSearchInput" type="text" class="form-control" placeholder="Unesite pojam..." name="search">
                    </div>
                    <?php if(isset($_SESSION["username"])){ ?>
                    <hr>
                    <?php } 
                     else{ ?>
                    <hr width="510px" style="margin-left: 0px">
                    <?php } ?>
                    <div class="tableDiv table-responsive">
                    <?php
                    include './db_connection.php';
                    if(isset($_GET['order'])){
                        $order = $_GET['order'];
                    }
                    else{
                        $order = 'student_prezime';
                    }

                    if(isset($_GET['sort'])){
                        $sort = $_GET['sort'];
                    }
                    else{
                        $sort = 'ASC';
                    } 
                    $query = "SELECT * FROM `studenti` ORDER BY $order $sort";
                    $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';
                    ?>
                    <table class="table table-striped table-hover" id="studentsTable">
                        <thead>
                            <tr>
                                <th class="table_header"><h4 class="columnName">Prezime</h4><a href="?order=student_prezime&&sort=<?php echo $sort; ?>"><input type="image" class="sort_img" src="css/sort_img.png"/></a></th>
                                <th class="table_header"><h4 class="columnName">Ime</h4><a href="?order=student_ime&&sort=<?php echo $sort; ?>"><input type="image" class="sort_img" src="css/sort_img.png"/></a></th>
                                <th class="table_header"><h4 class="columnName">Indeks</h4><a href="?order=student_index&&sort=<?php echo $sort; ?>"><input type="image" class="sort_img" src="css/sort_img.png"/></a></th>
                                <?php
                                    if(isset($_SESSION["username"])){
                                ?>
                                <th><input type="hidden"></th>
                                <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>        
                        <?php
                        $result = mysqli_query($connection, $query);
                        if($result){
                            $numrows = mysqli_num_rows($result);
                            if($numrows != 0){
                                for($i = 1; $i <= $numrows; $i++){
                                    $row = mysqli_fetch_array($result);
                                    $id = $row['student_id'];
                                    $studPrezime = $row['student_prezime'];
                                    $studIme = $row['student_ime'];
                                    $studIndex = $row['student_index'];
                                    if($i%2 == 0){ 
                                    ?>
                                        <tr class="alt">
                                    <?php
                                    }
                                    else{   
                                    ?>
                                        <tr>
                                    <?php
                                    }
                                    ?>
                                    <td id="studPrezime"><?php echo $studPrezime; ?></td>
                                    <td id="studIme"><?php echo $studIme; ?></td>
                                    <td id="studIndex"><?php echo $studIndex; ?></td>
                                    <?php
                                        if(isset($_SESSION["username"])){
                                    ?>
                                    <td class="text-right">
                                        <input type="image" src="css/add.png" class="hiddenButtons tableButtons" name="addAct" id="addAct" onclick="javascript:location.href='./add_activity.php?id=<?php echo $id; ?>'" value="Dodaj aktivnost">
                                        <input type="image" src="css/edit.png" class="hiddenButtons tableButtons" name="updateStud" id="updateStud" onclick="javascript:location.href='./update_student.php?id=<?php echo $id; ?>'" value="Izmjena">
                                        <form method='post' action="delete_student.php" style="float: right">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>"></input>
                                            <input type="image" src="css/delete.png" class="hiddenButtons tableButtons" name="deleteStud" id="deleteStud" onclick="return confirm('Ukoliko obrišete podatke o studentu, podaci o aktivnostima odabranog studenta biće obrisani. Da li ste sigurni da želite nastaviti?');" value="Brisanje">
                                        </form>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php } 
                            }
                            else{
                                echo '<script>alert("Nema podataka u bazi!")</script>';
                            }
                        }
                        else{
                            echo '<script>alert("Došlo je do greške!")</script>';
                        }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Footer -->
    <?php include './footer.php'; ?>
</body>
</html>
