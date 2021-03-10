<html>
    <?php include './head.php'; ?>
<body>
    <!--Header and navigation bar--> 
    <?php include './header_nav.php'; ?>

    <!--Central part--> 
    <div class="container-fluid">
        <div class="row content">
            <div class="col-xs-12 col-sm-4 col-lg-11" id="mainDiv" name="mainDiv">
                <div class="col-xs-12 col-sm-4 col-lg-12" id="home" name="home">
                    <h2 id="welcomeMsg">Dobro došli na sajt za evidenciju aktivnosti studenata!</h2>
                    <br> 
                    <input type="image" class="indexImages" src="css/students2.jpg" onclick="javascript:location.href='./students.php'">
                    <input type="image" class="indexImages" src="css/activities2.jpg" onclick="javascript:location.href='./activities.php'">
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include './footer.php'; ?>
</body>
</html>
