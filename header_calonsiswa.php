<?php  
	
	// $arrJenjangPilihan = [
	// 	"paud",
	// 	"sd"
	// ];

	require './php/config.php'; 

	header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
	header("Pragma: no-cache"); // HTTP 1.0
	header("Expires: 0"); // Proksi

	$n = 10;

	function getRandomString($n) {
	    return bin2hex(random_bytes($n / 2));
	}

	$arrPernahTerapi = [
		'PERNAH',
		'TIDAK'
	];

	$showPopUp 		= "";
	$sesi       	= 0;
	$tahfidzQuran  	= "";
	$pilihanTahfidz = "";

	$akteKosong 	= 0;
	$fileAkteValid 	= 0;
	$sizeAkte		= 0;

	$kartu_kk_empty = 0;
	$fileKkValid 	= 0;
	$sizeKK 		= 0;

	$ktpAyahKosong 	= 0;
	$ktpAyahValid 	= 0;
	$sizeKtpAyah	= 0;

	$ktpIbuKosong 	= 0;
	$ktpIbuValid 	= 0;
	$sizeKtpIbu		= 0;

	$invalidInfaq 	= 0;

	$sertifTahsinValid 	= 0;

	$sertifTahfidzValid = 0;                                                                                                  

	$invalidAkte 	= 0;
	$invalidKK  	= 0;
	$invalidKtpAyah = 0;
	$invalidKtpIbu 	= 0;

	$totalInvalid   = 0;

	function format_tgl_indo($date){  
	    $tanggal_indo = date_create($date);
	    date_timezone_set($tanggal_indo,timezone_open("Asia/Jakarta"));
	    $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
	    $date = strtotime($date);
	    $tanggal = date ('d', $date);
	    $bulan = $array_bulan[date('n',$date)];
	    $tahun = date('Y',$date); 

	    $H     = date_format($tanggal_indo, "H");
	    $i     = date_format($tanggal_indo, "i");
	    $s     = date_format($tanggal_indo, "s");
	    // $jamIndo = date("h:i:s", $date);
	    // $jamIndo = date_format($tanggal_indo, "H:i:s");
	    // echo $jamIndo;
	    $result = $tanggal ." ". $bulan ." ". $tahun;       
	    return($result);  
	}

	$simpanDataAwal = [];
	  
  	// Cek status login user jika tidak ada session
  	if (!$user->isLoggedInPendaftarPpdb()) { 

    	header("location:$base_pendaftar_ppdb"); //Redirect ke halaman login  
  	
  	}

	if (isset($_POST['proses'])) {

		// Buat token baru jika belum ada
		if (empty($_SESSION['form_token'])) {
		    $_SESSION['form_token'] = bin2hex(random_bytes(32));
		}

		// echo $_POST['nominal_infaq'] . " & " . $_POST['nominal_terbilang'] ;exit;

		$target_dir_akte 	= "upload/akte_kelahiran/";
		$namaFileUploadAkte = $_FILES['berkas_akte']['name'];
		$fileAkte 			= str_replace(['.pdf'], "", $namaFileUploadAkte);
		$namaFileBaruAkte 	= basename($_FILES["berkas_akte"]["tmp_name"]);

		$target_dir_kk 		= "upload/kartu_keluarga/";
		$namaFileUploadKK 	= $_FILES['berkas_kk']['name'];
		$fileKK 			= str_replace(['.pdf'], "", $namaFileUploadKK);
		$namaFileBaruKK 	= basename($_FILES["berkas_kk"]["tmp_name"]);

		$targetdir_ktpayah 	= "upload/ktp_ayah/";
		$namaFileUploadKtp1 = $_FILES['berkas_ktp_ayah']['name'];
		$fileKtpAyah 		= str_replace(['.pdf'], "", $namaFileUploadKtp1);
		$namaFileBaruKtp1	= basename($_FILES["berkas_ktp_ayah"]["tmp_name"]);

		$targetdir_ktpibu 	= "upload/ktp_ibu/";
		$namaFileUploadKtp2 = $_FILES['berkas_ktp_ibu']['name'];
		$fileKtpIbu 		= str_replace(['.pdf'], "", $namaFileUploadKtp2);
		$namaFileBaruKtp2	= basename($_FILES["berkas_ktp_ibu"]["tmp_name"]);

		$targetdir_sertif1 	= "upload/sertif_tahsin/";
		$namaFileUpdSertif1 = $_FILES['sertif_tahsin']['name'];
		$fileSertif1 		= str_replace(['.pdf'], "", $namaFileUpdSertif1);
		$namaFileBaruSertif1 = basename($_FILES["sertif_tahsin"]["tmp_name"]);

		$targetdir_sertif2 	= "upload/sertif_tahfidz/";
		$namaFileUpdSertif2 = $_FILES['sertif_tahfidz']['name'];
		$fileSertif2 		= str_replace(['.pdf'], "", $namaFileUpdSertif2);
		$namaFileBaruSertif2 = basename($_FILES["sertif_tahfidz"]["tmp_name"]);

		// echo $namaFileUploadKtp1 . ' & ' . $namaFileUploadKtp2;exit;

		$nisnCalonSiswa		= htmlspecialchars($_POST['nisn_calon_siswa']);
		$asalSekolah 		= htmlspecialchars($_POST['asal_sekolah']);

		if ($asalSekolah == "kosong") {
			$asalSekolah = "kosong";
		} elseif ($asalSekolah == "PAUD_AIIS") {
			$asalSekolah = str_replace(["_"], " ", htmlspecialchars($asalSekolah));
		} else {
			$asalSekolah = htmlspecialchars($_POST['nama_sekolah_lainnya']);
		}

		$calonNamaSiswa    	= htmlspecialchars(strtoupper($_POST['nama_calon_siswa']));
		$namaPanggilan		= htmlspecialchars(strtoupper($_POST['namapanggilan_calon_siswa']));
		$jenisKelamin    	= htmlspecialchars($_POST['jenis_kelamin']);
		$tempatLahir       = htmlspecialchars($_POST['tempat_lahir_calon_siswa']);
		$tanggalLahirSiswa 	= htmlspecialchars($_POST['tanglahir_anak_sd']);
		
		$anak_ke            = htmlspecialchars($_POST['anak_ke']);
		$dari_berapa_sdr    = htmlspecialchars($_POST['daribrp_saudara']);

		$adaAdikAtauKakakDiAiis 	= strtoupper(htmlspecialchars($_POST['ada_adik_kakak']));

		if ($adaAdikAtauKakakDiAiis == "ADA") {
			$tingkatKelasAdikAtauKakak	= strtoupper(htmlspecialchars($_POST['tingkat_kelas_adik_kakak']));
			$namaAdikAtauKK 			= strtoupper(htmlspecialchars($_POST['nama_adik_kakak']));
		} else {
			$tingkatKelasAdikAtauKakak	= "TIDAK ADA";
			$namaAdikAtauKK 			= "TIDAK ADA";
		}

		$riwayatPenyakit    = mysqli_real_escape_string($con, htmlspecialchars($_POST['rwyt_penyakit'])) . "tidakaadapenyakit";
		$riwayatPenyakit1   = htmlspecialchars($_POST['rwyt_penyakit']);

		if ($riwayatPenyakit == "tidakaadapenyakit") {
			$riwayatPenyakit = "TIDAK ADA RIWAYAT PENYAKIT";
		} else {
			$riwayatPenyakit = str_replace(["tidakaadapenyakit"], "", $riwayatPenyakit);
		}

		$dicari 			= "script";
		$dicari1 			= 'window';
		$dicari2 			= 'prompt';

        if(preg_match("/$dicari/i", $tanggalLahirSiswa)) {

        	$showPopUp = "found_threat";
        	session_unset();

        } else if (preg_match("/$dicari1/i", $tanggalLahirSiswa)) {

        	$showPopUp = "found_threat";
        	session_unset();

        } else if (preg_match("/$dicari2/i", $tanggalLahirSiswa)) {

        	$showPopUp = "found_threat";
        	session_unset();

        }  else {

        	$tanggalLahirSiswa 	=  date("Y-m-d", strtotime(htmlspecialchars($_POST['tanglahir_anak_sd'])));
        	$tanggalLahirSiswa1 = format_tgl_indo($tanggalLahirSiswa);

        	$tahsinQuran        = htmlspecialchars($_POST['bacaan_tahsin']);
			$jumlahJuzDihafal   = htmlspecialchars($_POST['berapajuzhafal']);
			$juzBerapaSaja      = htmlspecialchars($_POST['isi_juz']);
			$tahfidzQuran       = htmlspecialchars($_POST['pilihan_tahfidz']);
			// echo $tahfidzQuran;exit;

			if ($tahfidzQuran != "belumtahfidz") {

				$isiSuratSkr  	= mysqli_real_escape_string($con, htmlspecialchars($_POST['isi_surat']));
				$suratTerakhir1 = htmlspecialchars($_POST['isi_surat']);

			} else {

				$tahfidzQuran;

			}

			########## RIWAYAT PERKEMBANGAN ##########

				$dapatBerjalan 		= htmlspecialchars($_POST['usia_anak_dapat_berjalan']);
	        	$dapatBerbicara 	= htmlspecialchars($_POST['anak_dapat_bicara']);
	        	$pernahTerapi 		= htmlspecialchars($_POST['pernah_terapi']);
	        	$jenisTerapi 		= "";
	        	$alasanTerapi 		= "";
	        	$durasiTerapi 		= "";
	        	$mulaiSelesaiTrp  	= "";
	        	$masihTerapi 		= "";

	        	if ($pernahTerapi == "PERNAH") {

	        		$pernahTerapi 		= htmlspecialchars($_POST['pernah_terapi']);
	        		$jenisTerapi  		= htmlspecialchars($_POST['jenis_terapi']);
	        		$alasanTerapi 		= htmlspecialchars($_POST['alasan_terapi']);
	        		$durasiTerapi 		= htmlspecialchars($_POST['durasi_terapi']);
	        		$mulaiSelesaiTrp 	= htmlspecialchars($_POST['waktu_mulai_akhir_terapi']);
	        		$masihTerapi        = htmlspecialchars($_POST['masih_atau_tidak_terapi']);

	        		if ($masihTerapi == "masih") {
	        			$masihTerapi = "IYA MASIH";
	        		} else if ($masihTerapi == "tidak") {
	        		 	$masihTerapi = "SUDAH TIDAK";
	        		}

	        	} 

	        	$terlambatBerkembang 	= htmlspecialchars($_POST['keterlambatan_perkembangan']). "kosong";

	        	if ($terlambatBerkembang == "kosong") {
	        		$terlambatBerkembang = "TIDAK";
	        	} else {
	        		$terlambatBerkembang = str_replace(["kosong"], "", $terlambatBerkembang);
	        	}

	        	$trSolat	= htmlspecialchars($_POST['solat_option']);

	        	$tahsinOrtu 			= htmlspecialchars($_POST['ayah_bunda_bacaquran']);

	        	if ($tahsinOrtu == "SANGAT_BAIK") {
	        		$tahsinOrtu = "SANGAT BAIK";
	        	} else {
	        		$tahsinOrtu = htmlspecialchars($_POST['ayah_bunda_bacaquran']);
	        	}

	        	$tahfidzOrtu 			= htmlspecialchars($_POST['hafalan_ortu']);
	        	$peranOrtu 				= htmlspecialchars($_POST['peran_ortu']);
	        	$terbiasaGadget 		= htmlspecialchars($_POST['terbiasa_gadget']);
	        	$waktuBermainGadget 	= "";
	        	$waktuBermainGadget 	= htmlspecialchars($_POST['waktu_bermain_gadget']);

	        	if ($terbiasaGadget == "IYA") {
	        		$waktuBermainGadget = htmlspecialchars($_POST['waktu_bermain_gadget']);
	        	} else {
	        		$waktuBermainGadget = "TIDAK";
	        	}

			########## AKHIR RIWAYAT PERKEMBANGAN ##########

			########## Ayah ###########
			$namaAyah   		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($_POST['nama_ayah_wali'])));
			$namaAyah1 			= htmlspecialchars(strtoupper($_POST['nama_ayah_wali']));
			$tempatLahirAyah   	= htmlspecialchars($_POST['temlahir_ayah']);
			$tanggalLahirAyah   = htmlspecialchars($_POST['tanglahir_ayah']);

			if(preg_match("/$dicari/i", $tanggalLahirAyah)) {

	        	$showPopUp = "found_threat";
	        	session_unset();

	        } else if (preg_match("/$dicari1/i", $tanggalLahirAyah)) {

	        	$showPopUp = "found_threat";
	        	session_unset();
	        	
	        } else if (preg_match("/$dicari2/i", $tanggalLahirAyah)) {

	        	$showPopUp = "found_threat";
	        	session_unset();

	        } else {

	        	$tanggalLahirAyah   = date("Y-m-d", strtotime(htmlspecialchars($_POST['tanglahir_ayah'])));
	        	$tanggalLahirAyah1  = format_tgl_indo($tanggalLahirAyah);

	        	$agamaAyah   		= strtoupper(htmlspecialchars($_POST['agama_ayah']));

				if ($agamaAyah == "LAINNYA") {
					$agamaAyah = strtoupper(htmlspecialchars($_POST['agamalainayah']));
				}

				$pendTerakhirAyah 	= htmlspecialchars($_POST['pend_ayah']);
				$pekerjaanAyah  	= str_replace(["_"], " ", strtoupper(htmlspecialchars($_POST['pekerjaan_ayah'])));

				if($pekerjaanAyah == "LAINNYA") {
					$pekerjaanLainAyah =  strtoupper(htmlspecialchars($_POST['pekerjaanlainayah']));
				}

				$alamatAyah 		= mysqli_real_escape_string($con, htmlspecialchars($_POST['alamat_ayah']));
				$alamatAyah1 		= htmlspecialchars($_POST['alamat_ayah']);
				$nomorHpAyah  		= htmlspecialchars($_POST['nomorhpayah']);

				########## Ibu ###########
				$namaIbu 	  		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($_POST['nama_ibu'])));
				$namaIbu1	 		= htmlspecialchars($_POST['nama_ibu']);
				$tempatLahirIbu 	= htmlspecialchars($_POST['temlahir_ibu']);
				$tanggalLahirIbu   	= htmlspecialchars($_POST['tanglahir_ibu']);

				if(preg_match("/$dicari/i", $tanggalLahirIbu)) {

		        	$showPopUp = "found_threat";
		        	session_unset();

		        } else if (preg_match("/$dicari1/i", $tanggalLahirIbu)) {

		        	$showPopUp = "found_threat";
		        	session_unset();
		        	
		        }  else if (preg_match("/$dicari2/i", $tanggalLahirIbu)) {

		        	$showPopUp = "found_threat";
		        	session_unset();
		        	
		        } else {

		        	// $nominal_infaq		= htmlspecialchars($_POST['nominal_infaq']);
		        	// $nominal_terbilang 	= strtoupper(htmlspecialchars($_POST['nominal_terbilang']));

	        		$invalidInfaq 		= 4;

	        		$sesi 				= 3;

		        	$tanggalLahirIbu   	= date("Y-m-d", strtotime(htmlspecialchars($_POST['tanglahir_ibu'])));
		        	$tanggalLahirIbu1   = format_tgl_indo($tanggalLahirIbu);

		        	$agamaIbu   		= htmlspecialchars($_POST['agama_ibu']);
		        	// echo $agamaIbu;exit;
					if ($agamaIbu == "LAINNYA") {
						$agamaIbu = strtoupper(htmlspecialchars($_POST['agamalainibu']));
					}

					$pendTerakhirIbu 	= htmlspecialchars($_POST['pend_ibu']);
					$pekerjaanIbu  		= str_replace(["_"], " ", strtoupper(htmlspecialchars($_POST['pekerjaan_ibu'])));

					if($pekerjaanIbu == "LAINNYA") {
						$pekerjaanLainIbu 	=  strtoupper(htmlspecialchars($_POST['pekerjaanlainibu']));
					}

					$alamatIbu 			= mysqli_real_escape_string($con, htmlspecialchars($_POST['alamat_ibu']));
					$alamatIbu1 		= htmlspecialchars($_POST['alamat_ibu']);
					$nomorHpIbu  		= htmlspecialchars($_POST['nomorhpibu']);

					$pendapatanOrtu     = htmlspecialchars($_POST['pendapatan_ortu']);
					$rencanaMutasi 		= htmlspecialchars($_POST['rencana_mutasi']);

					if ($rencanaMutasi == "ada") {
						$alasanMutasi = htmlspecialchars($_POST['alasan_pindah']);
					} else {
						$alasanMutasi  = "TIDAK ADA ALASAN UNTUK RENCANA MUTASI";
					}

					if ($pendapatanOrtu == "pen1") {
						$pendapatanOrtu = "1 - 5 JUTA RUPIAH";
					} else if ($pendapatanOrtu == "pen2") {
						$pendapatanOrtu = "6 - 10 JUTA RUPIAH";
					} else if ($pendapatanOrtu == "pen3") {
						$pendapatanOrtu = "11 - 15 JUTA RUPIAH";
					} else if ($pendapatanOrtu == "pen4") {
						$pendapatanOrtu = "DI ATAS 15 JUTA RUPIAH";
					} else {
						$pendapatanOrtu = "-";
					}

					if ($_FILES['berkas_akte']['name'] == null) {

						$akteKosong 	= 1;
						$invalidAkte 	= 1;
						session_unset();

					} else if ($_FILES['berkas_kk']['name'] == null) {

						$kartu_kk_empty = 1;
						$invalidKK 		= 1;
						session_unset();

					} else if ($_FILES['berkas_ktp_ayah']['name'] == null) {

						$ktpAyahKosong 	= 1;
						$invalidKtpAyah	= 1;
						session_unset();

					} else if ($_FILES['berkas_ktp_ibu']['name'] == null) {

						$ktpIbuKosong 	= 1;
						$invalidKtpIbu	= 1;
						session_unset();

					} else {

						$ekstensiFileValid 	= ['pdf'];

						// Check file size
						// 500000 	= 500 KB
						// 2500000 	= 2,5 MB
						
						// ========================= AKTE KELAHIRAN =========================
						$namaFileAkte       = $_FILES['berkas_akte']['name'];
						$tmpNameAkte 		= $_FILES['berkas_akte']['tmp_name'];

						$ekstensiFileAkte 	= explode('.', $namaFileAkte);
						$ekstensiFileAkte 	= strtolower(end($ekstensiFileAkte) );

						// ========================= KARTU KELUARGA =========================
						$namaFileKK       	= $_FILES['berkas_kk']['name'];
						$tmpNameKK 			= $_FILES['berkas_kk']['tmp_name'];

						$ekstensiFileKK 	= explode('.', $namaFileKK);
						$ekstensiFileKK 	= strtolower(end($ekstensiFileKK) );

						// ========================= KTP AYAH =========================
						$namaFileKtpAyah    = $_FILES['berkas_ktp_ayah']['name'];
						$tmpNameKtpAyah 	= $_FILES['berkas_ktp_ayah']['tmp_name'];

						$xtensiFileKtpAyah 	= explode('.', $namaFileKtpAyah);
						$xtensiFileKtpAyah 	= strtolower(end($xtensiFileKtpAyah) );

						// ========================= KTP IBU =========================
						$namaFileKtpIbu    	= $_FILES['berkas_ktp_ibu']['name'];
						$tmpNameKtpIbu 		= $_FILES['berkas_ktp_ibu']['tmp_name'];

						$xtensiFileKtpIbu 	= explode('.', $namaFileKtpIbu);
						$xtensiFileKtpIbu 	= strtolower(end($xtensiFileKtpIbu) );

						// ========================= SERTIF TAHSIN =========================
						$namaFileBaruSertif1	= $_FILES['sertif_tahsin']['name'];
						$tmpNameSertif1 		= $_FILES['sertif_tahsin']['tmp_name'];

						$xtensiFileSertif1 		= explode('.', $namaFileBaruSertif1);
						$xtensiFileSertif1 		= strtolower(end($xtensiFileSertif1) );

						// ========================= SERTIF TAHFIDZ =========================
						$namaFileBaruSertif2	= $_FILES['sertif_tahfidz']['name'];
						$tmpNameSertif2 		= $_FILES['sertif_tahfidz']['tmp_name'];

						$xtensiFileSertif2 		= explode('.', $namaFileBaruSertif2);
						$xtensiFileSertif2 		= strtolower(end($xtensiFileSertif2) );

						// Validasi file akte
						if( !in_array($ekstensiFileAkte, $ekstensiFileValid) ) {
							$fileAkteValid = 1;
							// echo "<script>
							// 		alert('Yang Anda Upload Bukan File Pdf !');
							// 	  </script>";
							session_unset();
							// header("Location:$base");

						// Validasi file KK
						} else if (!in_array($ekstensiFileKK, $ekstensiFileValid)) {

							$fileKkValid = 1;
							session_unset();

						// Validasi File KTP Ayah
						} else if (!in_array($xtensiFileKtpAyah, $ekstensiFileValid)) {

							$ktpAyahValid = 1;
							session_unset();

						// Validasi File KTP Ibu
						} else if (!in_array($xtensiFileKtpIbu, $ekstensiFileValid)) {

							$ktpIbuValid = 1;
							session_unset();

						} else {

							if ($fileAkteValid == 1 || $fileKkValid == 1 || $ktpAyahValid == 1 || $ktpIbuValid == 1) {

								return true;

							} else {

								// Jika Ukuran File Akte Lebih Besar dari 2,5 MB
								if ($_FILES["berkas_akte"]["size"] > 2500000) {
								 	$sizeAkte = 1;
								} else {

									// Sertif Tahsin
									if ($namaFileUpdSertif1 != null && $namaFileUpdSertif2 == null) {

										// $namaFileUpdSertif2 = "TIDAK ADA UPLOAD BERKAS";

										// Validasi file Tahsin
										if( !in_array($xtensiFileSertif1, $ekstensiFileValid) ) {
											$sertifTahsinValid = 1;
											session_unset();
										} else { 

											$namaFileBaruAkte  	= getRandomString($n). '_' . $fileAkte;
											$namaFileBaruAkte  .= '.' . $ekstensiFileValid[0];
											move_uploaded_file($tmpNameAkte, $target_dir_akte . $namaFileBaruAkte);

											$namaFileBaruKK  	= getRandomString($n). '_' . $fileKK;
											$namaFileBaruKK    .= '.' . $ekstensiFileValid[0];
											move_uploaded_file($tmpNameKK, $target_dir_kk . $namaFileBaruKK);

											$namaFileBaruKtp1  	= getRandomString($n). '_' . $fileKtpAyah;
											$namaFileBaruKtp1  .= '.' . $ekstensiFileValid[0];
											move_uploaded_file($tmpNameKtpAyah, $targetdir_ktpayah . $namaFileBaruKtp1);

											$namaFileBaruKtp2  	= getRandomString($n). '_' . $fileKtpIbu;
											$namaFileBaruKtp2  .= '.' . $ekstensiFileValid[0];
											move_uploaded_file($tmpNameKtpIbu, $targetdir_ktpibu . $namaFileBaruKtp2);

											$namaFileBaruSertif1  	= getRandomString($n). '_' . $fileSertif1;
											$namaFileBaruSertif1   .= '.' . $ekstensiFileValid[0];
											move_uploaded_file($tmpNameSertif1, $targetdir_sertif1 . $namaFileBaruSertif1);

										}

									} else if ($namaFileUpdSertif1 == null && $namaFileUpdSertif2 != null) {

										// $namaFileUpdSertif1 = "TIDAK ADA UPLOAD BERKAS";

										// Validasi file Tahfidz
										if( !in_array($xtensiFileSertif2, $ekstensiFileValid) ) {
											$sertifTahfidzValid = 1;
											// echo "Tahfidz Bukan PDF";exit;
											session_unset();
										} else {

											$namaFileBaruAkte  	= getRandomString($n). '_' . $fileAkte;
											$namaFileBaruAkte  .= '.' . $ekstensiFileValid[0];
											move_uploaded_file($tmpNameAkte, $target_dir_akte . $namaFileBaruAkte);

											$namaFileBaruKK  	= getRandomString($n). '_' . $fileKK;
											$namaFileBaruKK    .= '.' . $ekstensiFileValid[0];
											move_uploaded_file($tmpNameKK, $target_dir_kk . $namaFileBaruKK);

											$namaFileBaruKtp1  	= getRandomString($n). '_' . $fileKtpAyah;
											$namaFileBaruKtp1  .= '.' . $ekstensiFileValid[0];
											move_uploaded_file($tmpNameKtpAyah, $targetdir_ktpayah . $namaFileBaruKtp1);

											$namaFileBaruKtp2  	= getRandomString($n). '_' . $fileKtpIbu;
											$namaFileBaruKtp2  .= '.' . $ekstensiFileValid[0];
											move_uploaded_file($tmpNameKtpIbu, $targetdir_ktpibu . $namaFileBaruKtp2);

											$namaFileBaruSertif2  	= getRandomString($n). '_' . $fileSertif2;
											$namaFileBaruSertif2   .= '.' . $ekstensiFileValid[0];
											move_uploaded_file($tmpNameSertif2, $targetdir_sertif2 . $namaFileBaruSertif2);

										}

									} else if ($namaFileUpdSertif1 == null && $namaFileUpdSertif2 == null) {

										$namaFileBaruAkte  	= getRandomString($n). '_' . $fileAkte;
										$namaFileBaruAkte  .= '.' . $ekstensiFileValid[0];
										move_uploaded_file($tmpNameAkte, $target_dir_akte . $namaFileBaruAkte);

										$namaFileBaruKK  	= getRandomString($n). '_' . $fileKK;
										$namaFileBaruKK    .= '.' . $ekstensiFileValid[0];
										move_uploaded_file($tmpNameKK, $target_dir_kk . $namaFileBaruKK);

										$namaFileBaruKtp1  	= getRandomString($n). '_' . $fileKtpAyah;
										$namaFileBaruKtp1  .= '.' . $ekstensiFileValid[0];
										move_uploaded_file($tmpNameKtpAyah, $targetdir_ktpayah . $namaFileBaruKtp1);

										$namaFileBaruKtp2  	= getRandomString($n). '_' . $fileKtpIbu;
										$namaFileBaruKtp2  .= '.' . $ekstensiFileValid[0];
										move_uploaded_file($tmpNameKtpIbu, $targetdir_ktpibu . $namaFileBaruKtp2);

									} else {

										$namaFileBaruAkte  	= getRandomString($n). '_' . $fileAkte;
										$namaFileBaruAkte  .= '.' . $ekstensiFileValid[0];
										move_uploaded_file($tmpNameAkte, $target_dir_akte . $namaFileBaruAkte);

										$namaFileBaruKK  	= getRandomString($n). '_' . $fileKK;
										$namaFileBaruKK    .= '.' . $ekstensiFileValid[0];
										move_uploaded_file($tmpNameKK, $target_dir_kk . $namaFileBaruKK);

										$namaFileBaruKtp1  	= getRandomString($n). '_' . $fileKtpAyah;
										$namaFileBaruKtp1  .= '.' . $ekstensiFileValid[0];
										move_uploaded_file($tmpNameKtpAyah, $targetdir_ktpayah . $namaFileBaruKtp1);

										$namaFileBaruKtp2  	= getRandomString($n). '_' . $fileKtpIbu;
										$namaFileBaruKtp2  .= '.' . $ekstensiFileValid[0];
										move_uploaded_file($tmpNameKtpIbu, $targetdir_ktpibu . $namaFileBaruKtp2);

										$namaFileBaruSertif1  	= getRandomString($n). '_' . $fileSertif1;
										$namaFileBaruSertif1   .= '.' . $ekstensiFileValid[0];
										move_uploaded_file($tmpNameSertif1, $targetdir_sertif1 . $namaFileBaruSertif1);

										$namaFileBaruSertif2  	= getRandomString($n). '_' . $fileSertif2;
										$namaFileBaruSertif2   .= '.' . $ekstensiFileValid[0];
										move_uploaded_file($tmpNameSertif2, $targetdir_sertif2 . $namaFileBaruSertif2);

									}

								}

							}

						}

					}

					// Jika mengisi uang infaq beserta nominal terbilang maka nyalakan baris kode di bawah ini

			        	// if ($nominal_infaq == "" && $nominal_terbilang == "") {

			        	// 	$invalidInfaq 	= 1;
			        	// 	session_unset();

			        	// } else if ($nominal_infaq != "" && $nominal_terbilang == "") {

			        	// 	$invalidInfaq 	= 2;
			        	// 	session_unset();

			        	// } else if ($nominal_infaq == "" && $nominal_terbilang != "") {

			        	// 	$invalidInfaq 	= 3;
			        	// 	session_unset();

			        	// }  else {

			        		

			        	// }

		        }

	        }

        }

	} 

	if (isset($_POST['simpan_ppdb'])) {

		// Cek token valid & belum pernah dipakai
	    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['form_token']) {
	        echo "⚠️ Permintaan tidak valid atau form sudah pernah dikirim.";
	        exit;
	    }
	    
	    $insToken = mysqli_query($con, "
	    	INSERT INTO token 
	    	SET
	    	is_token 	= '$_POST[token]',
	    	is_expired 	= 0
	    ");

	    if ($insToken) {

	    	// Bagian Final Data
			// echo $_POST['nama_calon_siswa_review'] . " Tahsin : " . $_POST['tahsin_rev'];exit;
			// $finalJenjangSekolah 		= htmlspecialchars($_POST['jenjang_sekolah_review']);

			$finalNISN  			= htmlspecialchars($_POST['nisn_calon_siswa_rev']);

			if ($finalNISN == null) {
				$finalNISN = "BELUM ADA NISN";
			}

			$finalAsalSekolah 			= mysqli_real_escape_string($con, htmlspecialchars($_POST['asal_sekolah_review']));
			$finalCalonNamaSiswa     	= mysqli_real_escape_string($con, htmlspecialchars(strtoupper($_POST['nama_calon_siswa_review'])));
			$finalNamaPanggilan			= mysqli_real_escape_string($con, htmlspecialchars(strtoupper($_POST['namapanggilan_calon_siswa_review'])));
			$finalJenisKelamin    		= htmlspecialchars($_POST['jenis_kelamin_review']);
			$finalTempatLahir        	= mysqli_real_escape_string($con, htmlspecialchars($_POST['tempat_lahir_calon_siswa_review']));
			$finalTanggalLahirSiswa  	= date("Y-m-d", strtotime(htmlspecialchars($_POST['tanglahir_anak_review'])));

			$finalAnak_ke            	= htmlspecialchars($_POST['anak_ke_review']);
			$finalDari_berapa_sdr    	= htmlspecialchars($_POST['daribrp_saudara_review']);
			$finalAdaAdik_KakakDiAiis 	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($_POST['ada_adik_kakak_rev'])));

			if ($finalAdaAdik_KakakDiAiis == "ADA") {
				$finalTingkatKelasAdikAtauKakak	= strtoupper(htmlspecialchars($_POST['tingkat_kelas_adik_kakak_rev']));
				$finalNamaAdikAtauKK 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($_POST['nama_adik_kakak_rev'])));
			} else {
				$finalTingkatKelasAdikAtauKakak	= "TIDAK ADA";
				$finalNamaAdikAtauKK 			= "TIDAK ADA";
			}

			$finalRiwayatPenyakit    	= mysqli_real_escape_string($con, htmlspecialchars($_POST['rwyt_penyakit_review'])) . "tidakaadapenyakit";

			if ($finalAsalSekolah == null) {
				$finalAsalSekolah = "-";
			} else {
				$finalAsalSekolah;
			}

			// echo $finalAsalSekolah;exit;

			if ($finalRiwayatPenyakit == "tidakaadapenyakit") {
				$finalRiwayatPenyakit = "TIDAK ADA RIWAYAT PENYAKIT";
			} else {
				$finalRiwayatPenyakit = str_replace(["tidakaadapenyakit"], "", $finalRiwayatPenyakit);
			}

			// echo $finalRiwayatPenyakit;exit;

			$finalTahsinQuran 			= htmlspecialchars($_POST['tahsin_rev']);
			$finalPilihanTahfidz 		= htmlspecialchars($_POST['pilihan_tahfidz_review']);

			if ($finalPilihanTahfidz != "BELUM") {

				$finalJumlahJuzDihafal      = htmlspecialchars($_POST['berapajuzhafal_review']);
				$finalJuzYangDiHafal       	= htmlspecialchars($_POST['isi_juz_review']);
				$finalSuratYangDihafal      = htmlspecialchars($_POST['isi_surat_review']);

			} else {

				$finalJumlahJuzDihafal      = "BELUM ADA";
				$finalJuzYangDiHafal       	= "BELUM ADA";
				$finalSuratYangDihafal      = "BELUM ADA";

			}

			### Riwayat Perkembangan ###

				$finalDapatBerjalan 		= mysqli_real_escape_string($con, htmlspecialchars($_POST['usia_anak_dapat_berjalan_rev']));
				$finalDapatBerbicara  		= mysqli_real_escape_string($con, htmlspecialchars($_POST['anak_dapat_bicara_rev']));
				$finalPernahTerapi 			= mysqli_real_escape_string($con, htmlspecialchars($_POST['pernah_terapi_rev']));
				$finalJenisTerapi 			= "";
		    	$finalAlasanTerapi 			= "";
		    	$finalDurasiTerapi 			= "";
		    	$finalMulaiSelesaiTrp  		= "";
		    	$finalMasihTerapi 			= "";

				if ($finalPernahTerapi == "PERNAH") {
					
					$finalJenisTerapi 		= mysqli_real_escape_string($con, htmlspecialchars($_POST['jenis_terapi_rev']));
					$finalAlasanTerapi 		= mysqli_real_escape_string($con, htmlspecialchars($_POST['alasan_terapi_rev']));
					$finalDurasiTerapi 		= mysqli_real_escape_string($con, htmlspecialchars($_POST['durasi_terapi_rev']));
					$finalMulaiSelesaiTrp   = mysqli_real_escape_string($con, htmlspecialchars($_POST['waktu_mulai_akhir_terapi_rev']));
					$finalMasihTerapi 	 	= mysqli_real_escape_string($con, htmlspecialchars($_POST['masih_atau_tidak_terapi_rev']));

				} else {

					$finalPernahTerapi      = "BELUM";
		    		$finalJenisTerapi 		= "TIDAK ADA";
		        	$finalAlasanTerapi 		= "TIDAK ADA";
		        	$finalDurasiTerapi 		= "TIDAK ADA";
		        	$finalMulaiSelesaiTrp  	= "TIDAK ADA";
		        	$finalMasihTerapi 		= "TIDAK";

				}

				$finalKeterlambatan 		= mysqli_real_escape_string($con, htmlspecialchars($_POST['keterlambatan_perkembangan_rev']));
				$finalTerbiasaSolat 		= mysqli_real_escape_string($con, htmlspecialchars($_POST['solat_option_rev']));
				$finalTahsinOrtu 			= mysqli_real_escape_string($con, htmlspecialchars($_POST['ayah_bunda_bacaquran_rev']));
				$finalTahfidzOrtu 			= mysqli_real_escape_string($con, htmlspecialchars($_POST['hafalan_ortu_rev']));
				$finalPeranOrtu 			= mysqli_real_escape_string($con, htmlspecialchars($_POST['peran_ortu_rev']));

				$finalWaktuBermainGadget 	= "";
				$finalTerbiasaGadget    	= mysqli_real_escape_string($con,htmlspecialchars($_POST['terbiasa_gadget_rev']));

				if ($finalTerbiasaGadget == "IYA") {
					$finalWaktuBermainGadget = mysqli_real_escape_string($con, htmlspecialchars($_POST['waktu_bermain_gadget_rev']));
				} else {
					$finalWaktuBermainGadget = "TIDAK";
				}

			### Akhir Riwayat Perkembangan ###

			########## Ayah ###########
			$finalNamaAyah   		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($_POST['nama_ayah_wali_review'])));
			$finalTempatLahirAyah 	= mysqli_real_escape_string($con, htmlspecialchars($_POST['temlahir_ayah_review']));
			$finalTanggalLahirAyah  = date("Y-m-d", strtotime(htmlspecialchars($_POST['tanglahir_ayah_review'])));
			$finalAgamaAyah   		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($_POST['agama_ayah_review'])));

			if ($finalAgamaAyah == "LAINNYA") {
				$finalAgamaAyah = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($_POST['agamalainayah_review'])));
			}

			$finalPendTerakhirAyah 	= htmlspecialchars($_POST['pend_ayah_review']);
			$finalPekerjaanAyah  	= mysqli_real_escape_string($con, str_replace(["_"], " ", strtoupper(htmlspecialchars($_POST['pekerjaan_ayah_review']))));
			// echo $finalPekerjaanAyah;exit;
			$finalAlamatAyah 		= mysqli_real_escape_string($con, htmlspecialchars($_POST['alamat_ayah_review']));
			$finalNomorHpAyah  		= htmlspecialchars($_POST['nomorhpayah_review']);

			########## Ibu ###########
			$finalNamaIbu 	  		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($_POST['nama_ibu_review'])));
			$finalTempatLahirIbu 	= mysqli_real_escape_string($con, htmlspecialchars($_POST['temlahir_ibu_review']));
			$finalTanggalLahirIbu   = date("Y-m-d", strtotime(htmlspecialchars($_POST['tanglahir_ibu_review'])));
			$finalAgamaIbu   		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($_POST['agama_ibu_review'])));

			if ($finalAgamaIbu == "LAINNYA") {
				$finalAgamaIbu = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($_POST['agamalainibu_review'])));
			}

			$finalPendTerakhirIbu 	= htmlspecialchars($_POST['pend_ibu_review']);
			$finalPekerjaanIbu  	= mysqli_real_escape_string($con, str_replace(["_"], " ", strtoupper(htmlspecialchars($_POST['pekerjaan_ibu_review']))));

			$finalAlamatIbu 		= mysqli_real_escape_string($con, htmlspecialchars($_POST['alamat_ibu_review']));
			$finalNomorHpIbu  		= htmlspecialchars($_POST['nomorhpibu_review']);

			$finalPendapatanOrtu    = htmlspecialchars($_POST['pendapatan_ortu_review']);
			$finalRencanaMutasi 	= htmlspecialchars($_POST['rencana_mutasi_review']);

			// echo $finalRencanaMutasi;exit;
			if ($finalRencanaMutasi == "ADA") {
				$finalRencanaMutasi = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($_POST['alasan_pindah_review'])) );
			} else {
				$finalRencanaMutasi = htmlspecialchars("TIDAK ADA RENCANA UNTUK MUTASI");
			}

			$finalUploadAkte		= mysqli_real_escape_string($con, htmlspecialchars($_POST['berkas_akte_rev']));
			$finalUploadKK			= mysqli_real_escape_string($con, htmlspecialchars($_POST['berkas_kk_rev']));
			$finalUploadKtpAyah		= mysqli_real_escape_string($con, htmlspecialchars($_POST['berkas_ktp_ayah_rev']));
			$finalUploadKtpIbu		= mysqli_real_escape_string($con, htmlspecialchars($_POST['berkas_ktp_ibu_rev']));
			$finalUploadSertif1 	= mysqli_real_escape_string($con, htmlspecialchars($_POST['sertif_tahsin_rev']));
			$finalUploadSertif2 	= mysqli_real_escape_string($con, htmlspecialchars($_POST['sertif_tahfidz_rev']));
			// $finalNominalInfaq 		= mysqli_real_escape_string($con, str_replace(["."], "", htmlspecialchars($_POST['nominal_infaq_rev'])));
			// $finalNominalInfaqTrbg  = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($_POST['nominal_terbilang_rev'])));
			// error_reporting(1);exit;

			if ($finalUploadSertif1 == null && $finalUploadSertif2 == null) {
				$finalUploadSertif1 = NULL;
				$finalUploadSertif2 = NULL;
			}

			$allDataNumber 	= [];

			// echo "Hp Ayah : " . $finalNomorHpAyah .  " & Hp Ibu : " . $finalNomorHpIbu;exit;

			$allDataNumber[] = $finalNomorHpAyah;
			$allDataNumber[] = $finalNomorHpIbu;

			$destination_number = implode(",", $allDataNumber);

			// echo $destination_number;exit;

			// Insert DB
			$queryInsertDBx = mysqli_query($con, "
				INSERT INTO data_pendaftaran_siswa
				SET
				pendaftaran_kelas 									= '1SD',
				nama_calon_siswa  									= '$finalCalonNamaSiswa',
				panggilan_calon_siswa								= '$finalNamaPanggilan',
				nisn 												= '$finalNISN',
				asal_sekolah 										= '$finalAsalSekolah',
				jenis_kelamin          								= '$finalJenisKelamin',
				tempat_lahir 										= '$finalTempatLahir',
				tanggal_lahir  										= '$finalTanggalLahirSiswa',
				anak_ke 											= '$finalAnak_ke',
				dari_berapa_saudara 								= '$finalDari_berapa_sdr',
				kk_atau_adik_di_aiis 								= '$finalAdaAdik_KakakDiAiis',
				tingkat_kelas_kk_atau_adik  						= '$finalTingkatKelasAdikAtauKakak',
				nama_kk_atau_adik 									= '$finalNamaAdikAtauKK',
				riwayat_penyakit 									= '$finalRiwayatPenyakit',
				bacaan_tahsin 										= '$finalTahsinQuran',
				jumlah_juz_dihafal 									= '$finalJumlahJuzDihafal',
				juz_dihafal   										= '$finalJuzYangDiHafal',
				hafalan_surat 										= '$finalSuratYangDihafal',
				dapat_berjalan_pada_usia 							= '$finalDapatBerjalan',
				dapat_berbicara_bermakna_pada_usia					= '$finalDapatBerbicara',
				pernah_menjalani_terapi 							= '$finalPernahTerapi',
				jenis_terapi 										= '$finalJenisTerapi',
				alasan_menjalani_terapi 							= '$finalAlasanTerapi',
				durasi_terapi 										= '$finalDurasiTerapi',
				waktu_mulai_dan_waktu_selesai_terapi				= '$finalMulaiSelesaiTrp',
				saat_ini_masih_menjalani_terapi 					= '$finalMasihTerapi',
				keterlambatan_perkembangan 							= '$finalKeterlambatan',
				terbiasa_solat_lima_waktu 							= '$finalTerbiasaSolat',
				orangtua_sudah_lancar_dalam_tahsin					= '$finalTahsinOrtu',
				hafalan_tahfidz_orangtua							= '$finalTahfidzOrtu',
				peran_orangtua_membantu_anak_menghafal				= '$finalPeranOrtu',
				anak_terbiasa_menonton_tv_atau_gadget 				= '$finalTerbiasaGadget',
				berapa_lama_menonton_tv_atau_gadget_dalam_sehari	= '$finalWaktuBermainGadget',
				nama_ayah 											= '$finalNamaAyah',
				tempat_lahir_ayah 									= '$finalTempatLahirAyah',
				tanggal_lahir_ayah 									= '$finalTanggalLahirAyah',
				agama_ayah 											= '$finalAgamaAyah',
				pendidikan_terakhir_ayah							= '$finalPendTerakhirAyah',
				pekerjaan_ayah 										= '$finalPekerjaanAyah',
				domisili_ayah_saat_ini 								= '$finalAlamatAyah',
				nomor_hp_ayah 										= '$finalNomorHpAyah',
				nama_ibu 											= '$finalNamaIbu',
				tempat_lahir_ibu 									= '$finalTempatLahirIbu',
				tanggal_lahir_ibu 									= '$finalTanggalLahirIbu',
				agama_ibu 											= '$finalAgamaIbu',
				pendidikan_terakhir_ibu								= '$finalPendTerakhirIbu',
				pekerjaan_ibu 										= '$finalPekerjaanIbu',
				domisili_ibu_saat_ini 								= '$finalAlamatIbu',
				nomor_hp_ibu 										= '$finalNomorHpIbu',
				pendapatan_orangtua 								= '$finalPendapatanOrtu',
				rencana_mutasi 										= '$finalRencanaMutasi',
				file_pdf_akte 										= '$finalUploadAkte',
				file_pdf_kk 										= '$finalUploadKK',
				ktp_ayah 											= '$finalUploadKtpAyah',
				ktp_ibu 											= '$finalUploadKtpIbu',
				sertif_tahsin  										= '$finalUploadSertif1',
				sertif_tahfidz  									= '$finalUploadSertif2'
			");  

			if ($queryInsertDBx == true) {
				// echo "Benar";exit;

			    $apiFonnte 	= "https://api.fonnte.com/send";

				$curl 		= curl_init();

				$tkn    	= "XW5PKf2275Ee3ZxzVowToUGTQELJQJksh9DoMzeyd3BLkL3";

				$pesan  	= "Pendaftaran PPDB Atas Nama _*". $_POST['nama_calon_siswa_review'] ."*_ telah berhasil." . "\n" . "\n" . "_*AKHYAR INTERNATIONAL ISLAMIC SCHOOL*_";

	          	curl_setopt_array($curl, array(
		            CURLOPT_URL => $apiFonnte,
		            CURLOPT_RETURNTRANSFER => true,
		            CURLOPT_ENCODING => '',
		            CURLOPT_MAXREDIRS => 10,
		            CURLOPT_TIMEOUT => 0,
		            CURLOPT_FOLLOWLOCATION => true,
		            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		            CURLOPT_CUSTOMREQUEST => 'POST',
		            CURLOPT_POSTFIELDS => array(
		              'target' 	=> $destination_number,
		              'message' => $pesan,
		              'delay' 	=> '5'
		            ),
		            CURLOPT_HTTPHEADER => array(
		              'Authorization:v5daG91JX3QJnsDeSYnc' //change TOKEN to your actual token => v5daG91JX3QJnsDeSYnc
		            ),
	          	));

	          	$response = curl_exec($curl);

	          	if ($response) {

	          		// Hapus token agar tidak bisa dikirim ulang
	          		session_unset();
	          		header("Location: proses?id=" . $_POST['token']);
	          		exit;
					$sesi = 4;
					$_SESSION['form_berhasil'] 	= "insert_data_berhasil";
					$showPopUp 					= $_SESSION['form_berhasil'];

	          	} else {

	          		session_unset();
					$_SESSION['form_berhasil'] 	= "insert_data_berhasil_fonnte_err";
					$showPopUp 					= $_SESSION['form_berhasil'];

	          	}

	          	curl_close($curl);

			} else {
				// echo "Salah";exit;
				session_unset();
				$_SESSION['form_berhasil'] 	= "insert_data_gagal";
				$showPopUp 					= $_SESSION['form_berhasil'];
			}

	    }

	}

	$arrJenjangPilihanPPDB = [
		"KB",
		"1SD"
	];

	$arrAsalSekolahAwal = [
		"PAUD_AIIS",
		"LAINNYA"
	];

	$arrJenjangPiihanKelas = [
		"KB",
		"TKA",
		"TKB",
		"1SD",
		"2SD",
		"3SD",
		"4SD",
		"5SD",
		"6SD"
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

			.error {
			    color: red;
			    font-weight: bold;
			    font-style: italic;
			    margin-top: 7px;
			    display: none; /* awalnya disembunyikan */
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

				#mts,
				#divpdh,
				#rwyt_penyakit,
				.adik_kakak,
				.add8px,
				.add10px {
					margin-top: 0px;
				}

				.error {
				    color: red;
				    font-weight: bold;
				    font-style: italic;
				    margin-top: 7px;
				    font-size: 11px;
				    margin-left: 17px;
				    display: none; /* awalnya disembunyikan */
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

    	</div>
