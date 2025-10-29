<?php  

	require './php/config.php'; 

	header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
	header("Pragma: no-cache"); // HTTP 1.0
	header("Expires: 0"); // Proksi

	$showMessage = "";

	// Cek apakah akses lewat POST
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	    // Jika tidak lewat POST, arahkan ke form
	    header("Location: $base");
	    exit;
	} else {

		$data 			= mysqli_real_escape_string($con, htmlspecialchars($_POST['form_token']));
		$token 			= $_POST['is_token'];

		// check form token apakah sudah ada
		$queryCheckFormToken = mysqli_query($con, "
			SELECT f_token FROM token
			WHERE f_token = '$data'
		"); 

		$getDataFormToken = mysqli_num_rows($queryCheckFormToken);

		if ($getDataFormToken == 0) {

			$queryUpdateSession = mysqli_query($con, "
				UPDATE token
		        SET
		        f_token = '$data'
		        WHERE is_token = '$token'; 
			");

			if ($queryUpdateSession == true) {

				$showMessage 	= "success";

			}

		}

	}

?>

<!DOCTYPE html>
	<html>
	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
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

			#infaq {
				margin-top: -14px;
				padding: 31px;
			}

			#rp {
				margin-top: -30px;
			}

			#nmsklh {
				color: white;
				margin-left: 10px;
				font-size: 20px;
				font-family: poppins;
				margin-top: 17px;
			}

			#swal2-html-container {
				font-size: 17px;
			}

			.swal2-popup .swal2-modal {
				width: auto !important;
			}

			legend {
				font-weight: bold;
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

			#nomorhpibux {
				margin-top: 2px;
			}

			#pdt_otm {
				margin-top: -15px;
			}

			#mts,
			#divpdh,
			.add10px {
				margin-top: 10px;
			}

			.add8px {
				margin-top: 8px;
			}

			#rwyt_penyakit {
				margin-top: 9px;
			}

			.adik_kakak {
				margin-top: 10px;
			}

			#pendapatan_ortu_review {
				margin-top: -10px;
			}

			@media (max-width: 992px) {

				.container {
					width: 95% !important;
				}

				#status_form {
					font-size: 15px;
				}

				#mts,
				#divpdh,
				#rwyt_penyakit,
				.adik_kakak,
				.add8px,
				.add10px {
					margin-top: 0px;
				}

				#rp {
					margin-top: -10px;
				}

				#rp,
				#terbilang {
					margin-left: -11px;
				}

				#iptrp {
					margin-top: -5px;
				}

				#pdt_otm {
					margin-top: 0px;
				}

				#nomorhpibux {
					margin-top: 0px;
				}

				.navbar-header {
					margin-top: 5px !important;
				}

				#infaq {
					margin-top: 23px;
					padding: 1px;
				}

				.outside {
					display: grid;
					width: 70%;
					margin-left: auto;
					margin-right: auto;
					gap: 10px;
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
	    			<h3 class="text-center" id="jdl" style="font-weight: bold;">
	    				FORM PENDAFTARAN AKHYAR INTERNATIONAL ISLAMIC SCHOOL - SD
	    			</h3>
	    			<div class="panel-heading"><h4 id="tahunajar" class="text-center">Tahun Ajaran : <strong>2026 - 2027</strong></h4></div>
		    	</div>
	    	</div>

	    	<div class="container document">
		    	<div class="row">
			    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			    		<div class="panel panel-default">
								<!-- <div class="panel-heading"><h4 id="tahunajar" class="text-center">Tahun Ajaran Aktif : <strong><?php echo $ta_aktif; ?></strong></h4></div> -->
							<div class="panel-body">
								<input type="hidden" value="simpan_calon_siswa" name="aksi" id="aksi">

								<div class="form-group">
									<!-- <label class="col-md-3 control-label"> PENDAFTARAN UNTUK KELAS<sup style="color: red;">*</sup> : </label> -->
									<div class="col-md-12">
										<center> <h1 id="status_form"> PENDAFTARAN BERHASIL </h1> </center>
									</div>
								</div>
								
							</div>

						</div>
			    	</div>
		    	</div>
			</div>

    	</div>
</body>
</html>
<!-- Aditional Script -->
<script type="text/javascript" src="./assets/js/jquery-1.11.3.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap -->
<script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
<!-- Pace -->
<script type="text/javascript" src="./assets/plugins/pace/pace.js"></script>
<script type="text/javascript" src="theme/datetime/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="theme/datetime/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<!-- Datepicker -->
<script type="text/javascript" src="./assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">

	if (`<?= $showMessage; ?>` == 'success') {

		Swal.fire({
		  title: "BERHASIL",
		  text: "PENDAFTARAN PPDB BERHASIL, SILAHKAN CHECK NOTIFIKASI WHATSAPP!",
		  icon: "success"
		});

	} else {

		window.location.href = `<?= $base; ?>`

	}

	

</script>

<link rel="stylesheet" type="text/css" href="./assets/plugins/datepicker/css/bootstrap-datepicker.min.css">