<?php
        $baglan= mysqli_connect("localhost", "root", "", "bgn");
        session_start();  
        
        if(isset($_GET['no']))
        {
            $_SESSION['no']=$_GET['no'];
        }


        $per_page_record = 10;     
        if (isset($_GET["page"])) { $page  = $_GET["page"];}    
        else { $page=1; } 
    
        $start_from = ($page-1) * $per_page_record;       
        $netije = mysqli_query ($baglan, "SELECT * FROM isgarler where no='".$_SESSION['no']."' LIMIT $start_from, $per_page_record"); 
        $_SESSION['sany']=mysqli_num_rows($netije);
?>

<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Işgärleri hasaba alyş ulgamy</title>
            <script src="css1/css/jquery.min.js"></script>
            <link rel="stylesheet" href="css1/css/bootstrap.min.css" />
            <script src="css1/css/bootstrap.min.js"></script>
            <link rel="stylesheet" href="css1/assets/css/style.css">
	</head>
	<body style="background-color: white;">

                <div class="">
                    <div class="row animate">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <h2>Barlag goýberiş nokady</h2>
                            <p>Barlag goýberiş nokadyndan işgärleriň giriş/çykyş maglumatlaryny kabul etmek </p>
                        </div>
                    </div>
                </div>
                <?php 
                                        if(isset($_POST['gozle']))
                                        {
                                                $searchKey=$_POST['gozlenyan'];
                                                if($_POST['gornus']=='Gelen wagty')         {$sql="SELECT t1.harby_cin,t1.F_A_A_a, t2.id, t2.giren_wagty, t2.cykan_wagty FROM isgarler AS t1 LEFT JOIN sanaw AS t2 ON t1.id = t2.id
                                                                                                 where t1.no='".$_SESSION['no']."' and t2.giren_wagty LIKE '%$searchKey%' ";}
                                                else if($_POST['gornus']=='Giden wagty')    {$sql="SELECT t1.harby_cin,t1.F_A_A_a, t2.id, t2.giren_wagty, t2.cykan_wagty FROM isgarler AS t1 LEFT JOIN sanaw AS t2 ON t1.id = t2.id
                                                                                                where t1.no='".$_SESSION['no']."' and t2.cykan_wagty LIKE '%$searchKey%'";}
                                                else                                        {$sql="SELECT * FROM isgarler limit 20";$searchKey="";}
                                               
                                                $netije=mysqli_query($baglan,$sql); 

                                                $_SESSION['sany']=mysqli_num_rows($netije);
                                                $_SESSION['gornus']=$_POST['gornus'];
                                        }
                                    ?>
                <div class="row">
                    <div class="col-md-2">
                                   
                    </div>
                    <div class="col-md-8">
                        
                    <form action="ayratyn_gozleg.php" method="post">
						<div class="row form-group">
							<div class="form-group">
								<select name="gornus" id="" class="custom-select">
                                <?php 
                                                    if (isset($_POST['gozle'])) 
                                                    {
                                                    $_SESSION['gornus'] = $_POST['gornus'];
                                                    echo $_SESSION['gornus'];
                                                    }
                                                    else {
                                                    echo 'Görnüş... ';
                                                    }
                                                ?>
                                    <option value=""></option>
                                    <option value="Gelen wagty">Gelen wagty</option>
                                    <option value="Giden wagty">Giden wagty</option>
                                </select>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="gozlenyan" placeholder="...">
							</div>
                       
                        <div class="form-group">
							<input type="submit" value="Gözle..." class="btn btn-primary" name="gozle">
						</div> </div>
                    </form>

                        <?php 
                            $result0=mysqli_query($baglan,"SELECT t1.harby_cin,t1.F_A_A_a, t2.id, t2.giren_wagty, t2.cykan_wagty FROM isgarler AS t1 LEFT JOIN sanaw AS t2 ON t1.id = t2.id ");
                            echo '<h3>'.$_SESSION['gornus'].'-giriş/çykyş maglumatlary</h3>'; ?>
                            <table class="table table-hover" style="table-border: none;">
                            <thead class="thead-light">
                                <tr>
                                    <th>Harby çini</th>
                                    <th>F.A.A</th>
                                    <th>Gelen wagty</th> 
                                    <th>Giden wagty</th>                                      
                                </tr>
                            </thead>
                            <?php
                                while($row = $result0->fetch_assoc()): 
                                   ?>
                                    <tr>
                                        <td ><?php echo $row['harby_cin']; ?></td>
                                        <td ><?php echo $row['F_A_A_a']; ?></td>
                                        <td><?php echo $row['giren_wagty']; ?></td>
                                        <td ><?php echo $row['cykan_wagty']; ?></td>
                                    </tr>

                                <?php endwhile;?>
                        </table>
                    
                    </div>
                </div>
        
                <footer id="fh5co-footer" >
            <!-- <div class="container"> -->
                <div class="row copyright">
                    <div class="col-md-12 text-center">
                        <p style="font-family:Century Gothic;  font-size: 24px;">
                            <small class="block">&copy; 2022 B.Annaýew adyndaky 1-nji ýöriteleşdirilen harby mekdebi</small>
                            <br>
                            <small class="block">Taýarlanyldy: <a href="#" target="_blank">1-ÝHM</a> Ýeri: <a href="#" target="_blank">Innowasion tehnologiýalary we bilim merkezi</a></small>
                            <br>
                            <small class="block">Habarlaşmak üçin: 405712</small>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
<!-- 
        <div class="gototop js-top">
            <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
        </div> -->
	
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>
        <!-- jQuery Easing -->
        <script src="js/jquery.easing.1.3.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Waypoints -->
        <script src="js/jquery.waypoints.min.js"></script>
        <!-- Stellar Parallax -->
        <script src="js/jquery.stellar.min.js"></script>
        <!-- Carousel -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- countTo -->
        <script src="js/jquery.countTo.js"></script>
        <!-- Magnific Popup -->
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/magnific-popup-options.js"></script>
        <!-- Main -->
        <script src="js/main.js"></script>
	</body>
</html>

