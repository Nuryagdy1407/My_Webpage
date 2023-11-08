<?php 
	$baglan= mysqli_connect("localhost", "root", "", "bgn");
	session_start();
	if(isset($_POST['iceri_gir']))
	{ 
		$username = $_POST['ulanjy_ady'];
		$password = $_POST['parol'];


		$admin = mysqli_query($baglan, "SELECT * from ulanyjylar where u_ad = '". $username ."' and parol = '". $password ."'");
		$numrow = mysqli_num_rows($admin);
		if($numrow > 0)
		{
			while($row = mysqli_fetch_array($admin))
			{
				session_regenerate_id();
			 	$_SESSION['loggedin'] = TRUE;
				$_SESSION['no'] = $row['no'];
				$_SESSION['wezipe'] = $row['wezipe'];
				$_SESSION['harby_cin'] = $row['harby_cin'];
				$_SESSION['ady'] = $row['at'];
				$_SESSION['status'] = $row['status'];
		 	}
			if($_SESSION['status'] == "admin")
			{
				header('Location: admin/index1.php?no=1');
			}
			else
				header('Location: index1.php');	
		}
		else
			{
				header('Location: index.php?err=1');
			}
	}
	
  ?>