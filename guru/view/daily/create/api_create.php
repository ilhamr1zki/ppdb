<?php  

	require '../../../../php/config.php';

	$arr = [];
	$description = "";

	// $description = $_POST['editor_catatan'];

	// echo "Isi " . $description;exit;

	if (isset($_POST['simpan_daily'])) {

		$judulDaily  		= mysqli_real_escape_string($con, htmlspecialchars($_POST['jdl_daily']) );
		$dataNIS      		= htmlspecialchars($_POST['nis_siswa']); 
		$dataNIP     		= htmlspecialchars($_POST['nipguru']); 
		$isData 			= mysqli_real_escape_string($con, htmlspecialchars($_POST['editor_catatan'])) . "empty_or_no";

	  	$patternXSS         = "/script/i";
	  	$patternXSS2        = "/src/i";
	  	$patternXSS3        = "/href/i";
	  	$patternXSS4        = "/iframe/i";
	  	$patternXSS5        = "/javascript/i";

	  	$findDepartemenSD   = "/SD/i";
	  	$findDepartemenPAUD = "/PAUD/i";

	  	$foundThreat        = preg_match($patternXSS, $isData);
	  	$foundThreat2       = preg_match($patternXSS2, $isData);
	  	$foundThreat3       = preg_match($patternXSS3, $isData);
	  	$foundThreat4       = preg_match($patternXSS4, $isData);
	  	$foundThreat5       = preg_match($patternXSS5, $isData);

	  	$isDepartemenSD  	= preg_match($findDepartemenSD, $_SESSION['c_guru']);
	  	$isDepartemenPAUD  	= preg_match($findDepartemenPAUD, $_SESSION['c_guru']);

	  	if ($dataNIS == '') {

	  		$_SESSION['nis_empty'] = "gagal";
			header("Location:". "$basegu" ."createdaily");

	  	} elseif ($dataNIS != '') {

	  		if ($judulDaily == '') {

				$_SESSION['title_empty'] = "gagal";
				header("Location:". "$basegu" ."createdaily");

			} elseif($judulDaily != '') {

				if ($isData == 'empty_or_no') {

					$_SESSION['main_daily_empty'] = "gagal";
					header("Location:". "$basegu" ."createdaily");

				} elseif ($isData != 'empty_or_no') {

					$isData = str_replace(["empty_or_no"], "", $isData);

					if ($foundThreat == 1) {

				  		$_SESSION['fail_form'] = "threat";
						header("Location:". "$basegu" ."createdaily");
				  		exit;

				  	} elseif($foundThreat2 == 1) {

				  		$_SESSION['fail_form'] = "threat";
						header("Location:". "$basegu" ."createdaily");
				  		exit;

				  	} elseif($foundThreat3 == 1) {

				  		$_SESSION['fail_form'] = "threat";
						header("Location:". "$basegu" ."createdaily");
				  		exit;

				  	} elseif($foundThreat4 == 1) {

				  		$_SESSION['fail_form'] = "threat";
						header("Location:". "$basegu" ."createdaily");
				  		exit;

				  	} elseif($foundThreat5 == 1) {

				  		$_SESSION['fail_form'] = "threat";
						header("Location:". "$basegu" ."createdaily");
				  		exit;

				  	} else {

						$namaFile       = $_FILES['banner']['name'];
						$tmpName 		= $_FILES['banner']['tmp_name'];

						$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];

						$ekstensiGambar = explode('.', $namaFile);
						$ekstensiGambar = strtolower(end($ekstensiGambar) );

						if ($tmpName == '') {
							$_SESSION['fail_img'] = "no_foto";
							header("Location:". "$basegu" ."createdaily");
						} else if ($tmpName != '') {

							if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
								echo "<script>
										alert('Yang Anda Upload Bukan File Gambar !');
									  </script>";
								return false;  
							}

							$namaFileBaru 	= uniqid();
							$namaFileBaru  .= '.';
							$namaFileBaru  .= $ekstensiGambar;

							date_default_timezone_set("Asia/Jakarta");

			  				$tglSkrng       = date("Y-m-d H:i:s");

							move_uploaded_file($tmpName, '../../../../image_uploads/' . $namaFileBaru);

							if ($isDepartemenSD == 1) {

								// echo "SD";exit;

								mysqli_query($con, "
									INSERT INTO daily_siswa_approved 
									SET 
									departemen 		= 'SD',
									from_nip 		= '$dataNIP',
									nis_siswa 		= '$dataNIS',
									title_daily     = '$judulDaily',
									isi_daily 		= '$isData',
									image           = '$namaFileBaru',
									tanggal_dibuat  = '$tglSkrng',
									status_approve	= 0
								");

							} else if ($isDepartemenPAUD == 1) {
								
								// echo "PAUD";exit;

								mysqli_query($con, "
									INSERT INTO daily_siswa_approved 
									SET 
									departemen 		= 'PAUD',
									from_nip 		= '$dataNIP',
									nis_siswa 		= '$dataNIS',
									title_daily     = '$judulDaily',
									isi_daily 		= '$isData',
									image           = '$namaFileBaru',
									tanggal_dibuat  = '$tglSkrng',
									status_approve	= 0
								");

							}

					  		$_SESSION['sukses'] = "berhasil";
							header("Location:". "$basegu" ."createdaily");

						}

				  	}

				}

			}

	  	}

	} else {

		header("Location:". "$basegu" ."createdaily");

	}

?>