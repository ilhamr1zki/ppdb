<?php  
	
	// $arrJenjangPilihan = [
	// 	"paud",
	// 	"sd"
	// ];

	require 'php/config.php';

	header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
	header("Pragma: no-cache"); // HTTP 1.0
	header("Expires: 0"); // Proksi
	
	$error = "";

	// Cek status login user jika ada session
  	if ($user->isLoggedInPendaftarPpdb()) {
    	header("location: calon_siswa"); //redirect ke index
  	} 

	if(isset($_POST['password_lg'])){
	    $password   = mysqli_real_escape_string($con, htmlspecialchars($_POST['password_lg']));
	    // echo $password;exit;
		if ($user->loginDaftarPpdb($password)) {
	        header("location: calon_siswa");
      	} else {
	        
        	$error      = $user->getLastError();

      	} 

    }

	$arrJenjangPilihanSd  = [
		"3SD",
		"4SD",
		"5SD"
	];

	$arrJenisKelamin = [
		"LAKI-LAKI",
		"PEREMPUAN"
	];

	$arrAsalSekolah = [
		"sdmi"
	];

	$arrIsiTahsin = [
		"KURANG",
		"CUKUP",
		"SEDANG",
		"BAIK",
		"SANGAT_BAIK"
	];

	$arrIsiPddAyah = [
		"SD/MI",
		"SMP/MTS",
		"SMA/SMK/MA",
		"D1",
		"D2",
		"D3",
		"S1",
		"S2",
		"S3"
	];

	$arrJobFather = [
		"GURU",
		"DOSEN",
		"pegawai_pns",
		"pegawai_bumn",
		"karyawan_swasta",
		"POLRI",
		"TNI",
		"WIRASWASTA",
		"WIRAUSAHA",
		"LAINNYA"
	];

	$arrJobMother = [
		"GURU",
		"DOSEN",
		"pegawai_pns",
		"pegawai_bumn",
		"karyawan_swasta",
		"POLRI",
		"TNI",
		"WIRASWASTA",
		"WIRAUSAHA",
		"IRT",
		"LAINNYA"
	];

	$getDataTahunAjarAktif = mysqli_query($con, "SELECT * FROM tahun_ajaran WHERE status = 'aktif' ");
	$dataTahunAjaranAktif  = mysqli_fetch_array($getDataTahunAjarAktif);

?>

<!DOCTYPE html>
	<html>
	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
		<title>
			AIIS - PPDB
		</title>
		<!-- Styling -->
		<link rel="stylesheet" type="text/css" href="./assets/css/site-default.min.css">
		<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./assets/plugins/pace/pace.css">
		<link rel="stylesheet" href="theme/bootstrap/css/bootstrap.min.css">
  	
		  <!-- Font Awesome -->
		  <!-- DataTables -->
		  <link rel="stylesheet" href="theme/plugins/datatables/dataTables.bootstrap.css">
		  
		  <!-- jvectormap -->

		  <!-- Theme style -->
		  <link rel="stylesheet" href="theme/dist/css/AdminLTE.min.css">
		  <link href="theme/datetime/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<link rel="icon" href="./assets/images/favicon.jpg">
		<style type="text/css">

			.navbar-default .navbar-brand {
				color: black !important;
			}
			
			.navbar-custom .navbar-brand {
				padding: 5px 15px !important;
				opacity: 1 !important;
			}

			#nmsklh {
				color: white;
				margin-left: 10px;
				font-size: 20px;
				font-family: poppins;
				margin-top: 17px;
			}

			#yys {
				margin-left: -420px;
				color: white;
				font-family: poppins;
				font-size: 15px;
				margin-top: 42px;
			}

			.pace {
				display: none;
			}

			#navright {
				display: none;
			}

			#iconsklh {
				height: 70px;
				margin-top: 4px;
			}

			#navbrand {
				display: flex;
			}

			#navcus {
				height: 90px;
			}

			#spacediv {
				margin-top: 90px;
			}

			@media (max-width: 992px) {

				.container {
					width: 95% !important;
				}

				.navbar-header {
					margin-top: 5px !important;
				}

				#navbrand {
					display: flex;
					margin-top: 2px;
					flex-direction: column;
				}

				.navbar-custom .navbar-brand {
				 	width: auto !important;
				 	overflow: unset !important;
				}

				#navcollapse {
					display: none;
				}

				#tahunajar {
					font-size: 17px;
				}

				#nmsklh {
					margin-top: -46px;
					margin-left: 41px;
					font-size: 14px;
				}

				#navcus {
					height: 75px !important;
				}

				#iconsklh {
					margin-top: 0px;
					margin-left: -16px;
					width: 50px;
					height: 50px;
				}

				#spacediv {
					margin-top: 80px;
				}

				#jdl {
					font-size: 31px;
				}

				#yys {
					margin-left: 42px;
					color: white;
					font-family: poppins;
					font-size: 14px;
					margin-top: -1px;
				}

			}

			@media (max-width: 376px) {

				.container {
					width: 95% !important;
				}

				.navbar-header {
					margin-top: 5px !important;
				}

				#navbrand {
					display: flex;
					margin-top: 2px;
					flex-direction: column;
				}

				.navbar-custom .navbar-brand {
				 	width: auto !important;
				 	overflow: unset !important;
				}

				#navcollapse {
					display: none;
				}

				#tahunajar {
					font-size: 10px;
				}

				#nmsklh {
					margin-top: -46px;
					margin-left: 41px;
					font-size: 12px;
				}

				#navcus {
					height: 75px !important;
				}

				#iconsklh {
					margin-top: 0px;
					margin-left: -16px;
					width: 50px;
					height: 50px;
				}

				#spacediv {
					margin-top: 70px;
				}

				#jdl {
					font-size: 23px;
				}

				#yys {
					margin-left: 42px;
					color: white;
					font-family: poppins;
					font-size: 14px;
					margin-top: -1px;
				}

			}

		</style>
	</head>
	<body background="./assets/images/backgrounds/symphony.png">
		<div class="header">
			<!--nav-->
			<nav id="navcus" class="navbar navbar-default navbar-custom navbar-fixed-top" role="navigation" style="background-color: blue;">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" id="navcollapse" data-toggle="collapse" data-target=".navbar-collapse" style="background-color: aliceblue;">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" id="navbrand" href="#">
							<img src="./assets/images/logoaiis.png" id="iconsklh">
							<span id="nmsklh"> AKHYAR INTERNATIONAL ISLAMIC SCHOOL </span>
							<p id="yys">Yayasan Quantum Akhyar Institute</p>
						</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right" id="navright">
							<li><a class="nav-link" href="index.php">Beranda</a></li>
							<?php if (isset($_SESSION['psb_username']) && isset($_SESSION['psb_level']) && $_SESSION['psb_username']!="" && $_SESSION['psb_level']!=""): ?>
								<li><a class="nav-link" href="dashboard.php">Dashboard</a></li>
								<li><a class="nav-link" href="laporan.php">Laporan</a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["psb_nama_depan"]." ".$_SESSION["psb_nama_belakang"]; ?> <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="pengguna.php">Pengaturan User</a></li>
										<li><a href="logout.php" onclick="return confirm('Yakin Keluar Sistem?')">Logout</a></li>
									</ul>
								</li>
							<?php endif ?>
						</ul>
					</div>
				</div>
			</nav>
		</div>

		<div id="spacediv"></div>

		<div class="container document">
	    	<div class="row">
		    	<div class="col-md-12">
	    			<h3 class="text-center" id="jdl">
	    				<strong> FORM PENDAFTARAN AKHYAR INTERNATIONAL ISLAMIC SCHOOL - SD </strong>
	    			</h3>
	    			<div class="panel-heading"><h4 id="tahunajar" class="text-center">Tahun Ajaran : <strong><?= $dataTahunAjaranAktif['thn_ajaran']; ?></strong></h4></div>
		    	</div>
	    	</div>
    	</div>
