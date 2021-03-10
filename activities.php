<html>
    <?php include './head.php'; ?>
<body>
    <!-- Header -->
    <?php include './header_nav.php'; ?>
    
    <!-- Central part -->
    <div class="container-fluid">
        <div class="row content">
            <div class="col-xs-12 col-sm-4 col-lg-11" id="mainDiv" name="mainDiv">
                <div id="tableActivity">
                    <h2>Aktivnosti studenata
                    <?php if(isset($_SESSION["username"])){ ?>
                    <input class="btn btn-primary myButtons" style="float: right" type="submit" id="typeActBtn" onclick="location.href = 'activity_types.php'" value="Pregled tipova aktivnost"> 
                    <hr>
                    <?php }
                    else { ?> 
                    <hr width="850px" style="margin-left: 0px">
                    <?php }
                    ?>
                    </h2>
                    
                    <div id="search" class="search search-container form-inline">
                        <label for="search">Pretražite tabelu: </label>
                        <input id="activitySearchInput" type="text" class="form-control" placeholder="Unesite pojam..." name="search">
                    </div>
                    <?php if(isset($_SESSION["username"])){ ?>
                    <hr>
                    <?php }
                    else { ?> 
                    <hr width="850px" style="margin-left: 0px">
                    <?php }
                    ?>
                    <div class="tableDiv table-responsive">
                    <?php
                        include './db_connection.php';
                        if(isset($_GET['order'])){
                            $order = $_GET['order'];
                        }
                        else{
                            $order = 'aktivnost_datum';
                        }

                        if(isset($_GET['sort'])){
                            $sort = $_GET['sort'];
                        }
                        else{
                            $sort = 'DESC';
                        } 
                        $query = "SELECT s.student_ime AS ime, s.student_prezime AS prezime, t.tip_naziv AS tip, a.aktivnost_id, a.aktivnost_datum, a.aktivnost_mjesto, a.aktivnost_opis
                                        FROM aktivnosti a
                                        JOIN studenti s ON s.student_id = a.student_id
                                        JOIN tip_aktivnosti t ON t.tip_id = a.tip_id
                                        ORDER BY $order $sort";
                        $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';
                    ?>
                        <table class="table table-striped" id="activitiesTable">
                            <thead>
                                <tr>
                                    <th class="table_header"><h4 class="columnName">Student</h4><a href="?order=student_ime&&sort=<?php echo $sort; ?>"><input type="image" class="sort_img" src="css/sort_img.png"/></a></th>
                                    <th class="table_header"><h4 class="columnName">Aktivnost</h4><a href="?order=t.tip_naziv&&sort=<?php echo $sort; ?>"><input type="image" class="sort_img" src="css/sort_img.png"/></a></th>
                                    <th class="table_header"><h4 class="columnName">Datum</h4><a href="?order=a.aktivnost_datum&&sort=<?php echo $sort; ?>"><input type="image" class="sort_img" src="css/sort_img.png" /></a></th>
                                    <th class="table_header"><h4 class="columnName">Mjesto</h4><a href="?order=a.aktivnost_mjesto&&sort=<?php echo $sort; ?>"><input type="image" class="sort_img" src="css/sort_img.png" /></a></th>
                                    <th class="table_header"><h4 class="columnName">Opis</h4></th>
                                    <?php
                                        if(isset($_SESSION["username"])){
                                    ?>
                                    <th class="table_header"><input type="hidden"></th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>        
                            <?php
                            $result = mysqli_query($connection, $query);
                            if($result)
                            {
                            $numrows = mysqli_num_rows($result);
                            if($numrows != 0)
                            {
                                for($i = 1; $i <= $numrows; $i++)
                                {
                                    $row = mysqli_fetch_array($result);
                                    $id = $row["aktivnost_id"];
                                    $ime = $row["ime"];
                                    $prezime = $row["prezime"];
                                    $tip = $row['tip'];
                                    $datum = $row['aktivnost_datum'];
                                    $mjesto = $row['aktivnost_mjesto'];
                                    $opis = $row['aktivnost_opis'];        
                                    if($i%2 == 0){ ?>
                                <tr class="alt">
                                <?php }
                                else{ ?> 
                                <tr>
                                <?php } ?>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>"></input>
                                    <td id="student"><?php echo $ime; echo " "; echo $prezime; ?></td>
                                    <td id="aktivnost"><?php echo $tip; ?></td>
                                    <td id="datum"><?php echo $datum; ?></td>
                                    <td id="mjesto"><?php echo $mjesto; ?></td>
                                    <td id="opis"><?php echo $opis; ?></td>
                                    <?php
                                        if(isset($_SESSION["username"])){
                                    ?>
                                    <td class="text-right">
                                        <input type="image" src="css/edit.png" class="hiddenButtons tableButtons" name="updateAct" onclick="javascript:location.href='./update_activity.php?id=<?php echo $id; ?>&act=<?php echo $tip; ?>'" value="Izmjena">

                                        <form method='post' action="delete_activity.php" style="float: right">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>"></input>
                                            <input type="image" src="css/delete.png" class="hiddenButtons tableButtons" name="deleteAct" onclick="return confirm('Da li ste sigurni da želite obrisati ovu aktivnost?');" value="Brisanje">
                                        </form>
                                    </td>
                                    <?php } ?>
                                </tr>
                            <?php } 
                            }
                            else
                            {
                                echo '<script>alert("Nema podataka u bazi!")</script>';
                            }
                            }
                            else
                            {
                                    echo '<script>alert("Došlo je do greške!")</script>';
                            } ?>
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

