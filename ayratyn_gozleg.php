<?php
        $baglan= mysqli_connect("localhost", "root", "", "bgn");
        session_start();  
        
        if(isset($_GET['no']))
        {
            $_SESSION['no']=$_GET['no'];

        $result=mysqli_query($baglan,"select * from isgarler where no='".$_SESSION['no']."'");
        while ($row=mysqli_fetch_assoc($result)) 
        {
            $_SESSION['id']=$row['id'];
            $_SESSION['cin']=$row['harby_cin'];
            $_SESSION['faa']=$row['F_A_A_a'];
            $_SESSION['no']=$row['no'];
        } 
        $netije=mysqli_query($baglan,"SELECT giren_wagty, cykan_wagty FROM sanaw where id='".$_SESSION['id']."' ORDER BY no DESC");}

if (isset($_POST['gozle'])) {
    $sene=$_POST['sene'];
    $sql="SELECT * FROM sanaw WHERE  id='".$_SESSION['id']."' AND (giren_wagty LIKE '%$sene%' OR cykan_wagty LIKE '%$sene%')  ORDER BY no DESC";
    $netije=mysqli_query($baglan,$sql);
  
}
if (isset($_POST['home'])) {
header('Location: index1.php');
  
}

?>

<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Işgärleri hasaba alyş ulgamy</title>
            <script src="css1/css/jquery.min.js"></scriptk>
            <link rel="stylesheet" href="css1/css/bootstrap.min.css" />
            <script src="css1/css/bootstrap.min.js"></script>
            <link rel="stylesheet" href="css1/assets/css/style.css">
	</head>
    <body style="background-color: white;">
    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark shadow" style="background-color: #3E5871;">
            <div class="col-md-2"></div>
                <div class="col-md-7">
                    <h4 class="text-center" style="font-family:Century Gothic; color:white">Türkmenistanyň Goranmak Ministrliginiň B.Annaýew adyndaky 1-nji ýöriteleşdirilen harby mekdebi</h4>	
                </div>
                <div class="col-md-1"></div>
                <div class="col-sm-1.5">
                    <div class="input-group">
                        <div class="input-group-append">
                            <a href="index1.php?no=1"><button class="btn btn-primary" type="submit" name="main" style="font-family:Century Gothic;font-weight:bold; background-color:#3E5871;border-color:#3E5871" ><i class="feather mr-2 icon-home" title = "Esasy Menýu"></i>Esasy Menýu</button></a>
                        </div>
                    </div>    
                </div>

                <div class="col-sm-1.5"> 
                    <div class="input-group">
                        <div class="input-group-append">
                            <a href="index.php"><button class="btn btn-primary" type="submit" name="home" style="font-family:Century Gothic;font-weight:bold; background-color:#3E5871;border-color:#3E5871"><i class="feather mr-2 icon-lock" title="Ulgamy ýap"></i> Ulgamy ýap</button></a>
                        </div>
                    </div>
                </div>
            </div>			
	    </header>
	<!-- [ Header ] end -->




<br>
    <div class="container-fluid">
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card header">
                                    <br>
                                <h4 class="text-center" style="font-family:Century Gothic">Mekdep işgärleriniň giriş-çykyş hasabaty</h4>
                                <br>
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-2">
                                        <form action="ayratyn_gozleg.php" method="POST">
                                            <div class="input-group">                      
                                                    <input type="text" class="form-control" name="sene" id="" style="font-family:Century Gothic;font-weight:bold;">
                                                <div class="input-group-append">
                                                   <button class="btn btn-warning" type="submit" name="gozle" ><i class="feather mr-2 icon-clock" style="font-family:Century Gothic;font-weight:bold"></i></button>
                                                </div>  
                                                
                                            </div>
                                            <br>
                                        </form>
                                        
                                    </div>
                                           
                                </div>
                            </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                                <div class="col-md-6">
                                                <?php 
                                                    ?>
                                                   <?php  echo '<h3 style="font-size:2,5em; font-family:Century Gothic;font-weight:bold;color:SeaGreen">'.$_SESSION['cin'].' &nbsp; '.$_SESSION['faa'].'</h3>'; ?>
                                                    <table class="table table-hover" style="table-border: none;">
                                                    <thead class="thead-dark">
                                <tr>
                                    <th style="font-size:2em; font-family:Century Gothic;font-weight:bold; color: white">Gelen wagty</th> 
                                    <th style="font-size:2em;font-family:Century Gothic;font-weight:bold; color: white">Giden wagty</th>                                      
                                </tr>
                            </thead>
                            <?php
                                while($row = $netije->fetch_assoc()): 
                                   ?>
                                    <tr>
                                        <td style="font-size:1.5em;font-family:Century Gothic;font-weight:bolder; color: black"><?php echo $row['giren_wagty']; ?></td>
                                        <td style="font-size:1.5em;font-family:Century Gothic;font-weight:bolder; color: black"><?php echo $row['cykan_wagty']; ?></td>
                                    </tr>

                                <?php endwhile;?>
                        </table>
                                                </div>
                                                <div class="col-md-1"></div>
                                            <div class="col-md-4">
                                                   <?php echo '<p><img style="margin-middle: 10px;" src="hmSuratlar/'.$_SESSION['faa'].'.jpg" alt="image_Name" width="450" height="600" /></p>';?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                    </div> 
                    
                </div>
	</body>
</html>

