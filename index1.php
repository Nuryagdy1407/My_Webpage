<?php
session_set_cookie_params(0);
session_start();
if (!isset($_SESSION['loggedin'])) 
{
    header('Location: index.html');
    exit;
}
$baglan= mysqli_connect("localhost", "root", "", "bgn");
$no = $_SESSION['no'];
$wezipe = $_SESSION['wezipe'];
$harby_cin = $_SESSION['harby_cin'];
$ady = $_SESSION['ady'];
$status = $_SESSION['status'];

// Ulanyjy tanamak;
if(isset($_GET['no']))
{
    $admin = mysqli_query($baglan, "SELECT * from ulanyjylar where no = '". $_GET['no'] ."'");
    while($row = mysqli_fetch_array($admin))
    { 
        $no=$row['no'];
        $wezipe = $row['wezipe'];
        $harby_cin = $row['harby_cin'];
        $ady = $row['at'];	
    }  
            
// sahypa refresh
$sec = "30";
header("Refresh: $sec; url='index1.php?no=".$no."'");
}       
// pagination;
$per_page_record = 20;     
if (isset($_GET["page"])) { $page  = $_GET["page"];}    
else { $page=1; } 
    
$start_from = ($page-1) * $per_page_record;       
$netije = mysqli_query ($baglan, "SELECT * FROM isgarler ORDER BY tertibi ASC "); 
$_SESSION['sany']=mysqli_num_rows($netije);

// sanaw almak;
$gelen_al = mysqli_query ($baglan, "SELECT * FROM isgarler WHERE gatnasyk='1' ");
$_SESSION['gelen']=mysqli_num_rows($gelen_al);

$gelmedik_al = mysqli_query ($baglan, "SELECT * FROM isgarler WHERE gatnasyk='0' ");
$_SESSION['gelmedik']=mysqli_num_rows($gelmedik_al);
?>

<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Işgärleri hasaba alyş ulgamy</title>
            <link rel="stylesheet" href="css/assets/css/style.css">
            <link rel="stylesheet" href="css1/css/bootstrap.min.css" />
	</head>

    <body style="background-color: white;">
    
        <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark shadow" style="background-color: #3E5871;">
            <div class="col-md-2"></div>
                <div class="col-md-7">
                    <h4 class="text-center" style="font-family:Century Gothic; color:white">Türkmenistanyň Goranmak Ministrliginiň B.Annaýew adyndaky 1-nji ýöriteleşdirilen harby mekdebi</h4>	
                </div>
                <div class="col-md-1"></div>
                <div class="col-sm-1">
                    <div class="input-group">
                        <div class="input-group-append">
                            <a href="index1.php"><button class="btn btn-primary" type="submit" name="main" style="font-family:Century Gothic;font-weight:bold; background-color:#3E5871;border-color:#3E5871" ><i class="feather mr-2 icon-home" title = "Esasy Menýu"></i>Esasy Menýu</button></a>
                        </div>
                    </div>    
                </div>

                <div class="col-sm-1"> 
                    <div class="input-group">
                        <div class="input-group-append">
                            <a href="index.php"><button class="btn btn-primary" type="submit" name="home" style="font-family:Century Gothic;font-weight:bold; background-color:#3E5871;border-color:#3E5871"><i class="feather mr-2 icon-lock" title="Ulgamy ýap"></i> Ulgamy ýap</button></a>
                        </div>
                    </div>
                </div>
            </div>			
	    </header>

        <?php
            if(isset($_POST['gozle']))
            {
                $searchKey=$_POST['gornus'];
                $sql="SELECT * FROM isgarler WHERE status='". $_POST['gornus'] ."'";
                $netije=mysqli_query($baglan,$sql); 

                $_SESSION['sany']=mysqli_num_rows($netije);
                $_SESSION['gornus']=$_POST['gornus'];
                
                $admin = mysqli_query($baglan, "SELECT * from ulanyjylar where no = '". $_POST['no'] ."'");
                while($row = mysqli_fetch_array($admin))
                { 
                    $no=$_POST['no'];
                    $wezipe = $row['wezipe'];
                    $harby_cin = $row['harby_cin'];
                    $ady = $row['at'];	
                    
                    // sahypa refresh
                    $sec = "30";
                    header("Refresh: $sec; url='index1.php?no=".$no."'");
                }    
            }
        ?><br>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <div class="dropdown mega-menu">
                                <a class="dropdown-toggle h-drop" href="index1.php" data-toggle="dropdown" style="font-weight:bold;color: black;font-family:Century Gothic"><i class="feather icon-user"></i><?=$wezipe?></a>&nbsp;&nbsp;
                                <!-- <a class="dropdown-toggle h-drop" href="index1.php" data-toggle="dropdown" style="font-weight:bolder;color: black;font-family:Century Gothic"> : <?//=$harby_cin?></a>&nbsp;&nbsp; -->
                                <a class="dropdown-toggle h-drop" href="index1.php" data-toggle="dropdown" style="font-weight:bolder;font-family:Century Gothic"><?=$ady?></a>&nbsp;&nbsp;
                                <?php
                                    $barlag = mysqli_query ($baglan, "SELECT * FROM ulanyjylar WHERE no='".$no."'"); 
                                    if( mysqli_num_rows($barlag)==0) {header('Location: index.php');}
                                ?> 
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row"> 
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card header"><br> 
                            <h4 class="text-center" style="font-family:Century Gothic">Mekdep işgärleriniň giriş-çykyş hasabaty</h4>
                            <div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4"> <br>
                                    <form action="index1.php" method="post">
                                        <div class="input-group">
                                                <input type="hidden" name="no" value="<?php echo $no; ?>">
                                                <select name="gornus" id="inputGroupSelect05" class="custom-select" style="font-family:Century Gothic">
                                                <?php 
                                                    if (isset($_POST['gozle'])) { $_SESSION['gornus'] = $_POST['gornus']; }
                                                    else { $_SESSION['gornus']='Görnüş... ';}
                                                ?>
                                                <option value="<?php echo $_SESSION['gornus'];?>"><?php echo $_SESSION['gornus'];?></option>
                                                <option value=" "> </option>
                                                <option value="Mugallym">Mugallym</option>
                                                <!-- <option value="Borçnama boýunça h/g">Borçnama boýunça h/g</option> -->
                                                <!-- <option value="Raýat gullukçy">Raýat gullukçy</option> -->
                                                <option value="Myhman">Myhman</option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-warning" type="submit" name="gozle" ><i class="feather mr-2 icon-users" style="font-family:Century Gothic;font-weight:bold"></i></button>
                                            </div> 
                                        </div><br>
                                    </form>
                                </div>
                            </div>
                        </div> 

                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <div class="table-responsive">
                                                <div class="form-inline" style="float: right;">
                                                    
                                                    <form action="index2.php" method="POST">
                                                        <input type="hidden" name="no" value="<?php echo $no; ?>">
                                                        <button class="btn btn-warning" type="submit" style="float: right; color:white;font-family:Century Gothic; font-weight:bolder" name="bugunki_hasabat" ><i class="feather mr-2 icon-file"></i>Bugünki hasabat</button>
                                                    </form>&nbsp;&nbsp;

                                                    <form action="index3.php" method="POST">
                                                        <input type="hidden" name="no" value="<?php echo $no; ?>">
                                                        <button class="btn btn-warning" type="submit" style="float: right; color:white;font-family:Century Gothic; font-weight:bolder" name="ayratyn_hasabat" ><i class="feather mr-2 icon-file"></i>Aýratyn hasabat</button><br>    
                                                    </form>

                                                </div>
                                                <br><br>
                                            <table class="table table-hover"  style="cursor: pointer;">
                                                    <tbody>
                                                        <?php
                                                            $n=0;
                                                            while($row=mysqli_fetch_assoc($netije)) 
                                                            {
                                                                $n++;
                                                                $no=$row['no'];
                                                                $id=$row['id'];
                                                                $harby_cin=$row['harby_cin'];
                                                                $F_A_A_a=$row['F_A_A_a'];
                                                                $wezipe=$row['wezipe']; 
                                                                $status=$row['status'];
                                                                $Gatnasyk=$row['gatnasyk'];
                                                                $Wagty=$row['Wagty'];      
                                                        ?> 
                                                            <div class="container-fluid">
                                                                <?php if($Gatnasyk==1)  { ?>
                                                                    <tr style="color: LimeGreen; height: 15px;"><a href="index1.php?no=<?php echo $no; ?>">
                                                                        <td style="font-family:Century Gothic;font-weight:bolder"><?php echo $n ?></td>
                                                                        <td style="font-family:Century Gothic;font-weight:bolder"><?php echo $row['harby_cin']; ?></td>
                                                                        <td style="font-family:Century Gothic;font-weight:bolder"><a name="link" style="color: LimeGreen;" href="ayratyn_gozleg.php?no=<?php echo $no; ?>" class="editbtn"><?php echo $row['F_A_A_a']; ?></a></td>
                                                                        <td style="font-family:Century Gothic;font-weight:bold"><h5> &nbsp;<span class="badge badge-secondary" ><?php echo $row['wezipe']; ?></span></h5></td>
                                                                        <td style="font-family:Century Gothic;font-weight:bold"><h5> &nbsp;<a href=""><span class="badge badge-info"><i class="feather mr-2 icon-user-minus"></i>&nbsp;<?php echo $row['Wagty']; ?></span></a></h5></td>
                                                                    </tr>
                                                                <?php }
                                                                    else if($Gatnasyk==0) { ?>
                                                                        <tr style="color: Silver; height: 15px;"><a href="index1.php?no=<?php echo $no; ?>">
                                                                            <td style="font-family:Century Gothic;font-weight:bolder"><?php echo $n ?></td>
                                                                            <td style="font-family:Century Gothic;font-weight:bolder"><?php echo $row['harby_cin']; ?></td>
                                                                            <td style="font-family:Century Gothic;font-weight:bolder"><a name="link" style="color: Silver; height: 10px;" href="ayratyn_gozleg.php?no=<?php echo $no; ?>" class="editbtn"><?php echo $row['F_A_A_a']; ?></a></td>
                                                                            <td style="font-family:Century Gothic;font-weight:bold"><h5> &nbsp;<span class="badge badge-secondary" ><?php echo $row['wezipe']; ?></span></h5></td>
                                                                            <td style="font-family:Century Gothic;font-weight:bold"><h5> &nbsp;<a href=""><span class="badge badge-info" ><i class="feather mr-2 icon-user-minus"></i>&nbsp;<?php echo $row['Wagty']; ?></span></a></h5></td>
                                                                        </tr>
                                                            </div>
                                                                <?php  } } ?>
                                                    </tbody>
                                                </table>
                                            </div>      
                                        </div>
                                    </div>
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
	</body>
</html>

