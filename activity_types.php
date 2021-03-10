<html>
    <?php include './head.php'; ?> 
<body>
    <!-- Header -->
    <?php include './header_nav.php'; ?>
    
    <!-- Central part -->
    <div class="container-fluid">
        <div class="row content">
            <div class="col-xs-12 col-sm-4 col-lg-11" id="mainDiv" name="mainDiv">
                <?php if(isset($_SESSION["username"])){ ?>
                <h2>Tipovi aktivnosti</h2>
                <hr>
                <div class="table-responsive">	
                    <table class="table table-striped" id="tableTypes">
                        <thead>
                            <tr>
                                <th class="table_header"><h4 class="columnName">Tip aktivnosti</h4></th>
                                <th class="table_header"><input type="hidden"></th>
                            </tr>
                        </thead>
                        <tbody>        
                        <?php
                        include './db_connection.php';
                        $query = "SELECT * FROM tip_aktivnosti ORDER BY tip_naziv ASC";
                        $result = mysqli_query($connection, $query);
                        if($result){
                            $numrows = mysqli_num_rows($result);
                            if($numrows != 0){
                                for($i = 1; $i <= $numrows; $i++){
                                    $isInUse = false;
                                    $row = mysqli_fetch_array($result);
                                    $id = $row["tip_id"];
                                    $tip = $row["tip_naziv"];      
                                    if($i%2 == 0){ ?>
                                        <tr class="alt">
                                    <?php }
                                    else{ ?> 
                                        <tr>
                                    <?php } ?>
                                    <td><?php echo $tip; ?></td>
                                    <td id="kolonaOpcije" class="text-right">
                                        <input type="image" src="css/edit.png" class="hiddenButtons tableButtons" onclick="EditType(<?php echo $id; ?>,'<?php echo $tip; ?>')" value="Izmjena">
                                        <?php
                                        $query2 = "SELECT * FROM aktivnosti"; 
                                        $result2 = mysqli_query($connection, $query2);
                                        $numrows2 = mysqli_num_rows($result);
                                        if($numrows2 != 0){
                                            for($j = 1; $j <= $numrows2; $j++){
                                                $row2 = mysqli_fetch_array($result2);
                                                if($id == $row2["tip_id"]){
                                                    $isInUse = true;
                                                }
                                            }
                                            if($isInUse == false){ ?>
                                             <form method='post' action="delete_type.php" style="float: right">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>"></input>
                                                <input type="image" src="css/delete.png" class="hiddenButtons tableButtons" name="deleteType" id="deleteType" onclick="return confirm('Da li ste sigurni da želite obrisati tip aktivnosti?');" value="Brisanje">
                                            </form>
                                            <?php } 
                                        } ?>
                                    </td>
                                </tr>
                            <?php } 
                            }
                            else{
                                echo '<script>alert("Nema podataka u bazi!")</script>';
                            }
                        }
                        else{
                            echo '<script>alert("Došlo je do greške!")</script>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div id="addTypeDiv" class="typeDiv">
                    <h4><strong>Dodaj novi tip aktivnosti</strong></h4>
                    <form method="post" action="add_type.php">
                        <input type="hidden" name="id" value=""></input>
                        <div class="form-group">
                            <input type="text" name="tip" class="form-control inputGroup" value="" placeholder="Naziv" required></input>
                        </div>
                        <input type="submit" name="insertType" class="btn button myButtons" id="insert" value="Sačuvaj"></input>
                    </form>
                </div>

                <div id="updateTypeDiv" class="typeDiv" style="visibility: hidden">
                    <h4><strong>Izmjena</strong></h4>
                    <form method="post" action="update_type.php">
                        <input type="hidden" name="tipId" id="tipId" value=""></input>
                        <div class="form-group">
                            <input type="text" name="tipNaziv" id="tipNaziv" class="form-control inputGroup" value="" placeholder="Naziv" required></input>
                        </div>
                        <input type="submit" name="updateType" class="btn button myButtons" value="Sacuvaj"></input>
                    </form>
                </div>
            <?php }
             else{
              ?>
            <br>
            <strong>Da biste vidjeli informacije, morate biti ulogovani.</strong>
            <?php } ?>
            </div>
        </div>
    </div>
  
    <!-- Footer -->
    <?php include './footer.php'; ?>
</body>
</html>

