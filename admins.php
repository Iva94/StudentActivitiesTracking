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
                <div id="tableAdmin">
                    <h2>Administratori
                    <input type="submit" class="btn btn-primary myButtons hiddenButtons" style="float: right" name="addAdmin" onclick="location.href = 'add_admin.php'" value="Dodaj novog administratora">                                      
                    </h2>   
                    <hr>
                    <div class="tableDiv table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="table_header"><h4 class="columnName">Ime i prezime</h4></th>
                                    <th class="table_header"><h4 class="columnName">Korisničko ime</h4></th>
                                    <th class="table_header"><h4 class="columnName">E-mail</h4></th>
                                    <th><input type="hidden"></th>
                                </tr>
                            </thead>
                            <tbody>        
                            <?php
                            include './db_connection.php';
                            $query = "SELECT * FROM `administratori`";
                            $result = mysqli_query($connection, $query);
                            if($result){
                                $numrows = mysqli_num_rows($result);
                                if($numrows != 0){
                                    for($i = 1; $i <= $numrows; $i++){
                                        $row = mysqli_fetch_array($result);
                                        $id = $row['admin_id'];
                                        $adminPrezime = $row['admin_prezime'];
                                        $adminIme = $row['admin_ime'];
                                        $adminKorIme= $row['korisnicko_ime'];
                                        $adminEmail = $row['email'];
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
                                    <td><?php echo $adminIme.' '.$adminPrezime; ?></td>
                                    <td><?php echo $adminKorIme; ?></td>
                                    <td><?php echo $adminEmail; ?></td>
                                    <td class="text-right">
                                        <form method='post' action="delete_admin.php" style="float: right">
                                            <input type="hidden" name="id" value="<?php echo $id;?>"></input>
                                            <input type="submit" class="btn btn-primary button myButtons" name="deleteAdmin" onclick="return confirm('Da li ste sigurni da želite obrisati podatke o administratoru?');" value="Ukloni">
                                        </form>
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
                            } ?>
                            </tbody>
                        </table>
                    </div>
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
