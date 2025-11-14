<?php  
	
	$timeOut        = $_SESSION['expire'];
    
    $timeRunningOut = time() + 5;

    $timeIsOut 		= 0;
    $validDataSiswa = 0;
    $validDataIbu 	= 0; 
    $totalValid    	= 0;

    $dataSiswaAcc   = mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa_diterima");
    $dataSiswaRej   = mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa_ditolak");
    $countAcc  		= mysqli_num_rows($dataSiswaAcc);
    $countRej  		= mysqli_num_rows($dataSiswaRej);
    $checkForm      = "";

    function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';

	    for ($i = 0; $i < $length; $i++) {
	      $randomString .= $characters[random_int(0, $charactersLength - 1)];
	    }

	    return $randomString;
  	}

    if (isset($_POST['upload_data'])) {

		// echo "SINI";exit;
		// session_start();
		require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
		require('spreadsheet-reader-master/SpreadsheetReader.php');

		// Validasi apakah type file ber type xlsx, xls
		$namaFile 			= $_FILES['isi_file']['name'];
		$ekstensiFileValid 	= ['xlsx', 'xls'];
		$ekstensiFile 		= explode('.', $namaFile);
		$ekstensiFile 		= strtolower(end($ekstensiFile) );
		$checkForm          = 0; 

		if ($ekstensiFile == '') {
			$checkForm = 1;
		}

		if ($checkForm == 1) {

			$_SESSION['form_success'] = "empty_form";

		} else {

			$status_ppdb = $_POST['stat_ppdb'];

			if ($status_ppdb == "terima") {

				if( !in_array($ekstensiFile, $ekstensiFileValid) ) {
					// echo "Type File Invalid. Yang Anda Masukan File Ber Type " . $ekstensiFile;
					$_SESSION['form_success'] = "type_fail";
					// return true;
				} else {

					//upload data excel kedalam folder uploads
					$target_dir = "uploads/ppdb_diterima/".basename($_FILES['isi_file']['name']);
					
					move_uploaded_file($_FILES['isi_file']['tmp_name'],$target_dir);

					$Reader = new SpreadsheetReader($target_dir);

					foreach ($Reader as $Key => $Row) {
						// import data excel mulai baris ke-2 (karena ada header pada baris 1)
						// echo "Nomer KEY : " . $Key . "<br>";
						if ($Key < 1) continue;
							
							// echo "Nama : " . $Row[4] . " ". $jadi;exit;

						// echo "<br> Isinya : " . mysqli_real_escape_string($con,htmlspecialchars($Row[1]));exit;
						$jenjangSekolah 	= mysqli_real_escape_string($con,htmlspecialchars($Row[0]));
						$calonNamaSiswa 	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[1])));
						$panggilanClnSiswa	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[2])));
						$nisnCalonSiswa 	= mysqli_real_escape_string($con, htmlspecialchars($Row[3]));
						$asalSklhClnSiswa 	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[4])));
						$jkClnSiswa 		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[5])));
						$tmptLhrClnSiswa 	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[6])));
						$tglLhrClnSiswa 	= htmlspecialchars($Row[7]);
						$anak_ke 			= mysqli_real_escape_string($con, htmlspecialchars($Row[8]));
						$dariBrpSdr 		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[9])));
						$kkAdikDiAiis 		= mysqli_real_escape_string($con, htmlspecialchars($Row[10]));
						$tngktKelaskkAdik 	= mysqli_real_escape_string($con, htmlspecialchars($Row[11]));
						$nama_kk_atau_adik 	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[12])));
						// Ada perubahan kolom dari kolom ini
						$alasanDiAiis 		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[13])));
						$pendapatOrtu 		= mysqli_real_escape_string($con, htmlspecialchars($Row[14]));
						$riwayat_penyakit 	= mysqli_real_escape_string($con, htmlspecialchars($Row[15]));
						$lmbtPerkembangan   = mysqli_real_escape_string($con, htmlspecialchars($Row[16]));
						$pernahTrapi 		= mysqli_real_escape_string($con, htmlspecialchars($Row[17]));
						$jenisTerapi 		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[18])));
						$alasanTrapi 		= mysqli_real_escape_string($con, htmlspecialchars($Row[19]));
						$durasiTerapi 		= mysqli_real_escape_string($con, htmlspecialchars($Row[20]));
						$wktAwAkhirTrapi    = mysqli_real_escape_string($con, htmlspecialchars($Row[21]));
						$masihTerapi        = mysqli_real_escape_string($con, htmlspecialchars($Row[22]));
						$kemampuanSosial 	= mysqli_real_escape_string($con, htmlspecialchars($Row[23]));
						$kemandirianSiswa 	= mysqli_real_escape_string($con, htmlspecialchars($Row[24]));
						$kelebihanSiswa 	= mysqli_real_escape_string($con, htmlspecialchars($Row[25]));
						$trbSolat 			= mysqli_real_escape_string($con, htmlspecialchars($Row[26]));
						$terbiasaGadget 	= mysqli_real_escape_string($con, htmlspecialchars($Row[27]));
						$brpLamaGadget      = mysqli_real_escape_string($con, htmlspecialchars($Row[28]));
						$bacaan_tahsin 		= mysqli_real_escape_string($con, htmlspecialchars($Row[29]));
						$jumlah_juz_dihafal = htmlspecialchars($Row[30]);
						$juz_dihafal 		= mysqli_real_escape_string($con, htmlspecialchars($Row[31]));
						$hafalan_surat  	= mysqli_real_escape_string($con, htmlspecialchars($Row[32]));
						$terlibatMengasuh 	= mysqli_real_escape_string($con, htmlspecialchars($Row[33]));
						$peranOrtua 		= mysqli_real_escape_string($con, htmlspecialchars($Row[34]));
						$nama_ayah 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[35])));
						$tempat_lahir_ayah 	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[36])));
						$tanggal_lahir_ayah = htmlspecialchars($Row[37]);
						$agama_ayah 		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[38])));
						$pendAy 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[39])));
						$pekerjaan_ayah     = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[40])));
						$domisiliAyah 		= mysqli_real_escape_string($con, htmlspecialchars($Row[41]));
						$hpAyah      		= htmlspecialchars($Row[42]);
						$tahsinAyah 		= mysqli_real_escape_string($con, htmlspecialchars($Row[43]));
						$tahfidzAyah 		= mysqli_real_escape_string($con, htmlspecialchars($Row[44]));
						$nama_ibu 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[45])));
						$tempat_lahir_ibu   = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[46])));
						$tanggal_lahir_ibu  = htmlspecialchars($Row[47]);
						$agama_ibu          = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[48])));
						$pendIbu 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[49])));
						$pekerjaan_ibu      = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[50])));
						$domisili_ibu 		= mysqli_real_escape_string($con, htmlspecialchars($Row[51]));
						$hpIbu 				= htmlspecialchars($Row[52]);
						$tahsinIbu 			= mysqli_real_escape_string($con, htmlspecialchars($Row[53]));
						$tahfidzIbu 		= mysqli_real_escape_string($con, htmlspecialchars($Row[54]));
						$pendapatanOrtu     = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[55])));
						$rencana_mutasi     = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[56])));
						$file_pdf_akte      = mysqli_real_escape_string($con, htmlspecialchars($Row[57]));
						$file_pdf_kk   		= mysqli_real_escape_string($con, htmlspecialchars($Row[58]));
						$ktp_ayah			= mysqli_real_escape_string($con, htmlspecialchars($Row[59]));
						$ktp_ibu 			= mysqli_real_escape_string($con, htmlspecialchars($Row[60]));
						$sertif_tahsin 		= mysqli_real_escape_string($con, htmlspecialchars($Row[61]));
						$sertif_tahfidz 	= mysqli_real_escape_string($con, htmlspecialchars($Row[62]));
						$nominalInfaq 		= mysqli_real_escape_string($con, htmlspecialchars($Row[63]));
						$nominalTerbilang 	= mysqli_real_escape_string($con, htmlspecialchars($Row[64]));
						$tanggalFormDiIsi 	= mysqli_real_escape_string($con, htmlspecialchars($Row[65]));

						$id 				= generateRandomString(25);

						if ($countAcc == 0) {

							$query = mysqli_query ($con, "
								INSERT INTO data_pendaftaran_siswa_diterima
								SET
								id 													= '$id',
								pendaftaran_kelas 									= '1SD',
								nama_calon_siswa  									= '$calonNamaSiswa',
								panggilan_calon_siswa								= '$panggilanClnSiswa',
								nisn 												= '$nisnCalonSiswa',
								asal_sekolah 										= '$asalSklhClnSiswa',
								jenis_kelamin          								= '$jkClnSiswa',
								tempat_lahir 										= '$tmptLhrClnSiswa',
								tanggal_lahir  										= '$tglLhrClnSiswa',
								anak_ke 											= '$anak_ke',
								dari_berapa_saudara 								= '$dariBrpSdr',
								kk_atau_adik_di_aiis 								= '$kkAdikDiAiis',
								tingkat_kelas_kk_atau_adik  						= '$tngktKelaskkAdik',
								nama_kk_atau_adik 									= '$nama_kk_atau_adik',
								riwayat_penyakit 									= '$riwayat_penyakit',
								bacaan_tahsin 										= '$bacaan_tahsin',
								jumlah_juz_dihafal 									= '$jumlah_juz_dihafal',
								juz_dihafal   										= '$juz_dihafal',
								hafalan_surat 										= '$hafalan_surat',
								pernah_menjalani_terapi 							= '$pernahTrapi',
								jenis_terapi 										= '$jenisTerapi',
								alasan_menjalani_terapi 							= '$alasanTrapi',
								durasi_terapi 										= '$durasiTerapi',
								waktu_mulai_dan_waktu_selesai_terapi				= '$wktAwAkhirTrapi',
								saat_ini_masih_menjalani_terapi 					= '$masihTerapi',
								keterlambatan_perkembangan 							= '$lmbtPerkembangan',
								terbiasa_solat_lima_waktu 							= '$trbSolat',
								peran_orangtua_membantu_anak_menghafal				= '$peranOrtua',
								anak_terbiasa_menonton_tv_atau_gadget 				= '$terbiasaGadget',
								berapa_lama_menonton_tv_atau_gadget_dalam_sehari	= '$brpLamaGadget',
								nama_ayah 											= '$nama_ayah',
								tempat_lahir_ayah 									= '$tempat_lahir_ayah',
								tanggal_lahir_ayah 									= '$tanggal_lahir_ayah',
								agama_ayah 											= '$agama_ayah',
								pendidikan_terakhir_ayah							= '$pendAy',
								pekerjaan_ayah 										= '$pekerjaan_ayah',
								domisili_ayah_saat_ini 								= '$domisiliAyah',
								nomor_hp_ayah 										= '$hpAyah',
								nama_ibu 											= '$nama_ibu',
								tempat_lahir_ibu 									= '$tempat_lahir_ibu',
								tanggal_lahir_ibu 									= '$tanggal_lahir_ibu',
								agama_ibu 											= '$agama_ibu',
								pendidikan_terakhir_ibu								= '$pendIbu',
								pekerjaan_ibu 										= '$pekerjaan_ibu',
								domisili_ibu_saat_ini 								= '$domisili_ibu',
								nomor_hp_ibu 										= '$hpIbu',
								pendapatan_orangtua 								= '$pendapatanOrtu',
								rencana_mutasi 										= '$rencana_mutasi',
								file_pdf_akte 										= '$file_pdf_akte',
								file_pdf_kk 										= '$file_pdf_kk',
								ktp_ayah 											= '$ktp_ayah',
								ktp_ibu 											= '$ktp_ibu',
								sertif_tahsin  										= '$sertif_tahsin',
								sertif_tahfidz  									= '$sertif_tahfidz',
								nominal_infaq										= '$nominalInfaq',
								nominal_terbilang 									= '$nominalTerbilang',
								tanggal_formulir_dibuat 							= '$tanggalFormDiIsi',
								alasan_diaiis 										= '$alasanDiAiis',
								pendapat_orangtua 									= '$pendapatOrtu',
								kemampuan_sosial 									= '$kemampuanSosial',
								kemandirian_anak 									= '$kemandirianSiswa',
								kelebihan_anak 										= '$kelebihanSiswa',
								terlibat_mengasuh 									= '$terlibatMengasuh',
								tahsin_ayah 										= '$tahsinAyah',
								tahfidz_ayah 										= '$tahfidzAyah',
								tahsin_ibu 											= '$tahsinIbu',
								tahfidz_ibu 										= '$tahfidzIbu'
							");

							if ($query) {

								$dataSiswaTelahAcc = mysqli_num_rows(mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa_diterima"));
								// echo "Import data berhasil";
								$total = $dataSiswaTelahAcc;

								$_SESSION['import_success'] = "berhasil";
								
							} else {

								$_SESSION['import_success'] = "gagal";

							}

						} else if ($countAcc != 0) {

							$queryFindDataDuplicate = mysqli_query($con, "
								SELECT nama_ibu FROM data_pendaftaran_siswa_diterima
								WHERE
								nama_calon_siswa = '$calonNamaSiswa'
								AND 
								nama_ibu LIKE '%$nama_ibu%'
							");

							$findDataDuplicate  = mysqli_num_rows($queryFindDataDuplicate);

							if ($findDataDuplicate == 1) {
								$_SESSION['import_success'] = "gagal";
							} else {

	    						$countAcc  		= mysqli_num_rows($dataSiswaAcc);

								$query = mysqli_query ($con, "
									INSERT INTO data_pendaftaran_siswa_diterima
									SET
									id 													= '$id',
									pendaftaran_kelas 									= '1SD',
									nama_calon_siswa  									= '$calonNamaSiswa',
									panggilan_calon_siswa								= '$panggilanClnSiswa',
									nisn 												= '$nisnCalonSiswa',
									asal_sekolah 										= '$asalSklhClnSiswa',
									jenis_kelamin          								= '$jkClnSiswa',
									tempat_lahir 										= '$tmptLhrClnSiswa',
									tanggal_lahir  										= '$tglLhrClnSiswa',
									anak_ke 											= '$anak_ke',
									dari_berapa_saudara 								= '$dariBrpSdr',
									kk_atau_adik_di_aiis 								= '$kkAdikDiAiis',
									tingkat_kelas_kk_atau_adik  						= '$tngktKelaskkAdik',
									nama_kk_atau_adik 									= '$nama_kk_atau_adik',
									riwayat_penyakit 									= '$riwayat_penyakit',
									bacaan_tahsin 										= '$bacaan_tahsin',
									jumlah_juz_dihafal 									= '$jumlah_juz_dihafal',
									juz_dihafal   										= '$juz_dihafal',
									hafalan_surat 										= '$hafalan_surat',
									pernah_menjalani_terapi 							= '$pernahTrapi',
									jenis_terapi 										= '$jenisTerapi',
									alasan_menjalani_terapi 							= '$alasanTrapi',
									durasi_terapi 										= '$durasiTerapi',
									waktu_mulai_dan_waktu_selesai_terapi				= '$wktAwAkhirTrapi',
									saat_ini_masih_menjalani_terapi 					= '$masihTerapi',
									keterlambatan_perkembangan 							= '$lmbtPerkembangan',
									terbiasa_solat_lima_waktu 							= '$trbSolat',
									peran_orangtua_membantu_anak_menghafal				= '$peranOrtua',
									anak_terbiasa_menonton_tv_atau_gadget 				= '$terbiasaGadget',
									berapa_lama_menonton_tv_atau_gadget_dalam_sehari	= '$brpLamaGadget',
									nama_ayah 											= '$nama_ayah',
									tempat_lahir_ayah 									= '$tempat_lahir_ayah',
									tanggal_lahir_ayah 									= '$tanggal_lahir_ayah',
									agama_ayah 											= '$agama_ayah',
									pendidikan_terakhir_ayah							= '$pendAy',
									pekerjaan_ayah 										= '$pekerjaan_ayah',
									domisili_ayah_saat_ini 								= '$domisiliAyah',
									nomor_hp_ayah 										= '$hpAyah',
									nama_ibu 											= '$nama_ibu',
									tempat_lahir_ibu 									= '$tempat_lahir_ibu',
									tanggal_lahir_ibu 									= '$tanggal_lahir_ibu',
									agama_ibu 											= '$agama_ibu',
									pendidikan_terakhir_ibu								= '$pendIbu',
									pekerjaan_ibu 										= '$pekerjaan_ibu',
									domisili_ibu_saat_ini 								= '$domisili_ibu',
									nomor_hp_ibu 										= '$hpIbu',
									pendapatan_orangtua 								= '$pendapatanOrtu',
									rencana_mutasi 										= '$rencana_mutasi',
									file_pdf_akte 										= '$file_pdf_akte',
									file_pdf_kk 										= '$file_pdf_kk',
									ktp_ayah 											= '$ktp_ayah',
									ktp_ibu 											= '$ktp_ibu',
									sertif_tahsin  										= '$sertif_tahsin',
									sertif_tahfidz  									= '$sertif_tahfidz',
									nominal_infaq										= '$nominalInfaq',
									nominal_terbilang 									= '$nominalTerbilang',
									tanggal_formulir_dibuat 							= '$tanggalFormDiIsi',
									alasan_diaiis 										= '$alasanDiAiis',
									pendapat_orangtua 									= '$pendapatOrtu',
									kemampuan_sosial 									= '$kemampuanSosial',
									kemandirian_anak 									= '$kemandirianSiswa',
									kelebihan_anak 										= '$kelebihanSiswa',
									terlibat_mengasuh 									= '$terlibatMengasuh',
									tahsin_ayah 										= '$tahsinAyah',
									tahfidz_ayah 										= '$tahfidzAyah',
									tahsin_ibu 											= '$tahsinIbu',
									tahfidz_ibu 										= '$tahfidzIbu'
								");

								if ($query) {

									$dataSiswaTelahAccInputBaru = mysqli_num_rows(mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa_diterima"));
									$total = $dataSiswaTelahAccInputBaru - $countAcc;

									$_SESSION['import_success'] = "berhasil";

								} else {

									$_SESSION['import_success'] = "gagal";

								}


							}

						}

					}

				}

			} else if ($status_ppdb == "tolak") {

				if( !in_array($ekstensiFile, $ekstensiFileValid) ) {
					// echo "Type File Invalid. Yang Anda Masukan File Ber Type " . $ekstensiFile;
					$_SESSION['form_success'] = "type_fail";
					// return true;
				} else {

					//upload data excel kedalam folder uploads
					$target_dir = "uploads/ppdb_ditolak/".basename($_FILES['isi_file']['name']);
					
					move_uploaded_file($_FILES['isi_file']['tmp_name'],$target_dir);

					$Reader = new SpreadsheetReader($target_dir);

					foreach ($Reader as $Key => $Row) {
						// import data excel mulai baris ke-2 (karena ada header pada baris 1)
						// echo "Nomer KEY : " . $Key . "<br>";
						if ($Key < 1) continue;
							
							// echo "Nama : " . $Row[4] . " ". $jadi;exit;

						// echo "<br> Isinya : " . mysqli_real_escape_string($con,htmlspecialchars($Row[1]));exit;
						$jenjangSekolah 	= mysqli_real_escape_string($con,htmlspecialchars($Row[0]));
						$calonNamaSiswa 	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[1])));
						$panggilanClnSiswa	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[2])));
						$nisnCalonSiswa 	= mysqli_real_escape_string($con, htmlspecialchars($Row[3]));
						$asalSklhClnSiswa 	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[4])));
						$jkClnSiswa 		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[5])));
						$tmptLhrClnSiswa 	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[6])));
						$tglLhrClnSiswa 	= htmlspecialchars($Row[7]);
						$anak_ke 			= mysqli_real_escape_string($con, htmlspecialchars($Row[8]));
						$dariBrpSdr 		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[9])));
						$kkAdikDiAiis 		= mysqli_real_escape_string($con, htmlspecialchars($Row[10]));
						$tngktKelaskkAdik 	= mysqli_real_escape_string($con, htmlspecialchars($Row[11]));
						$nama_kk_atau_adik 	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[12])));

						$alasanDiAiis 		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[13])));
						$pendapatOrtu 		= mysqli_real_escape_string($con, htmlspecialchars($Row[14]));
						$riwayat_penyakit 	= mysqli_real_escape_string($con, htmlspecialchars($Row[15]));
						$lmbtPerkembangan   = mysqli_real_escape_string($con, htmlspecialchars($Row[16]));
						$pernahTrapi 		= mysqli_real_escape_string($con, htmlspecialchars($Row[17]));
						$jenisTerapi 		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[18])));
						$alasanTrapi 		= mysqli_real_escape_string($con, htmlspecialchars($Row[19]));
						$durasiTerapi 		= mysqli_real_escape_string($con, htmlspecialchars($Row[20]));
						$wktAwAkhirTrapi    = mysqli_real_escape_string($con, htmlspecialchars($Row[21]));
						$masihTerapi        = mysqli_real_escape_string($con, htmlspecialchars($Row[22]));
						$kemampuanSosial 	= mysqli_real_escape_string($con, htmlspecialchars($Row[23]));
						$kemandirianSiswa 	= mysqli_real_escape_string($con, htmlspecialchars($Row[24]));
						$kelebihanSiswa 	= mysqli_real_escape_string($con, htmlspecialchars($Row[25]));
						$trbSolat 			= mysqli_real_escape_string($con, htmlspecialchars($Row[26]));
						$terbiasaGadget 	= mysqli_real_escape_string($con, htmlspecialchars($Row[27]));
						$brpLamaGadget      = mysqli_real_escape_string($con, htmlspecialchars($Row[28]));
						$bacaan_tahsin 		= mysqli_real_escape_string($con, htmlspecialchars($Row[29]));
						$jumlah_juz_dihafal = htmlspecialchars($Row[30]);
						$juz_dihafal 		= mysqli_real_escape_string($con, htmlspecialchars($Row[31]));
						$hafalan_surat  	= mysqli_real_escape_string($con, htmlspecialchars($Row[32]));
						$terlibatMengasuh 	= mysqli_real_escape_string($con, htmlspecialchars($Row[33]));
						$peranOrtua 		= mysqli_real_escape_string($con, htmlspecialchars($Row[34]));
						$nama_ayah 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[35])));
						$tempat_lahir_ayah 	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[36])));
						$tanggal_lahir_ayah = htmlspecialchars($Row[37]);
						$agama_ayah 		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[38])));
						$pendAy 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[39])));
						$pekerjaan_ayah     = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[40])));
						$domisiliAyah 		= mysqli_real_escape_string($con, htmlspecialchars($Row[41]));
						$hpAyah      		= htmlspecialchars($Row[42]);
						$tahsinAyah 		= mysqli_real_escape_string($con, htmlspecialchars($Row[43]));
						$tahfidzAyah 		= mysqli_real_escape_string($con, htmlspecialchars($Row[44]));
						$nama_ibu 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[45])));
						$tempat_lahir_ibu   = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[46])));
						$tanggal_lahir_ibu  = htmlspecialchars($Row[47]);
						$agama_ibu          = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[48])));
						$pendIbu 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[49])));
						$pekerjaan_ibu      = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[50])));
						$domisili_ibu 		= mysqli_real_escape_string($con, htmlspecialchars($Row[51]));
						$hpIbu 				= htmlspecialchars($Row[52]);
						$tahsinIbu 			= mysqli_real_escape_string($con, htmlspecialchars($Row[53]));
						$tahfidzIbu 		= mysqli_real_escape_string($con, htmlspecialchars($Row[54]));
						$pendapatanOrtu     = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[55])));
						$rencana_mutasi     = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[56])));
						$file_pdf_akte      = mysqli_real_escape_string($con, htmlspecialchars($Row[57]));
						$file_pdf_kk   		= mysqli_real_escape_string($con, htmlspecialchars($Row[58]));
						$ktp_ayah			= mysqli_real_escape_string($con, htmlspecialchars($Row[59]));
						$ktp_ibu 			= mysqli_real_escape_string($con, htmlspecialchars($Row[60]));
						$sertif_tahsin 		= mysqli_real_escape_string($con, htmlspecialchars($Row[61]));
						$sertif_tahfidz 	= mysqli_real_escape_string($con, htmlspecialchars($Row[62]));
						$nominalInfaq 		= mysqli_real_escape_string($con, htmlspecialchars($Row[63]));
						$nominalTerbilang 	= mysqli_real_escape_string($con, htmlspecialchars($Row[64]));
						$tanggalFormDiIsi 	= mysqli_real_escape_string($con, htmlspecialchars($Row[65]));

						$id 				= generateRandomString(25);

						if ($countRej == 0) {

							$query = mysqli_query ($con, "
								INSERT INTO data_pendaftaran_siswa_ditolak
								SET
								id 													= '$id',
								pendaftaran_kelas 									= '1SD',
								nama_calon_siswa  									= '$calonNamaSiswa',
								panggilan_calon_siswa								= '$panggilanClnSiswa',
								nisn 												= '$nisnCalonSiswa',
								asal_sekolah 										= '$asalSklhClnSiswa',
								jenis_kelamin          								= '$jkClnSiswa',
								tempat_lahir 										= '$tmptLhrClnSiswa',
								tanggal_lahir  										= '$tglLhrClnSiswa',
								anak_ke 											= '$anak_ke',
								dari_berapa_saudara 								= '$dariBrpSdr',
								kk_atau_adik_di_aiis 								= '$kkAdikDiAiis',
								tingkat_kelas_kk_atau_adik  						= '$tngktKelaskkAdik',
								nama_kk_atau_adik 									= '$nama_kk_atau_adik',
								riwayat_penyakit 									= '$riwayat_penyakit',
								bacaan_tahsin 										= '$bacaan_tahsin',
								jumlah_juz_dihafal 									= '$jumlah_juz_dihafal',
								juz_dihafal   										= '$juz_dihafal',
								hafalan_surat 										= '$hafalan_surat',
								pernah_menjalani_terapi 							= '$pernahTrapi',
								jenis_terapi 										= '$jenisTerapi',
								alasan_menjalani_terapi 							= '$alasanTrapi',
								durasi_terapi 										= '$durasiTerapi',
								waktu_mulai_dan_waktu_selesai_terapi				= '$wktAwAkhirTrapi',
								saat_ini_masih_menjalani_terapi 					= '$masihTerapi',
								keterlambatan_perkembangan 							= '$lmbtPerkembangan',
								terbiasa_solat_lima_waktu 							= '$trbSolat',
								peran_orangtua_membantu_anak_menghafal				= '$peranOrtua',
								anak_terbiasa_menonton_tv_atau_gadget 				= '$terbiasaGadget',
								berapa_lama_menonton_tv_atau_gadget_dalam_sehari	= '$brpLamaGadget',
								nama_ayah 											= '$nama_ayah',
								tempat_lahir_ayah 									= '$tempat_lahir_ayah',
								tanggal_lahir_ayah 									= '$tanggal_lahir_ayah',
								agama_ayah 											= '$agama_ayah',
								pendidikan_terakhir_ayah							= '$pendAy',
								pekerjaan_ayah 										= '$pekerjaan_ayah',
								domisili_ayah_saat_ini 								= '$domisiliAyah',
								nomor_hp_ayah 										= '$hpAyah',
								nama_ibu 											= '$nama_ibu',
								tempat_lahir_ibu 									= '$tempat_lahir_ibu',
								tanggal_lahir_ibu 									= '$tanggal_lahir_ibu',
								agama_ibu 											= '$agama_ibu',
								pendidikan_terakhir_ibu								= '$pendIbu',
								pekerjaan_ibu 										= '$pekerjaan_ibu',
								domisili_ibu_saat_ini 								= '$domisili_ibu',
								nomor_hp_ibu 										= '$hpIbu',
								pendapatan_orangtua 								= '$pendapatanOrtu',
								rencana_mutasi 										= '$rencana_mutasi',
								file_pdf_akte 										= '$file_pdf_akte',
								file_pdf_kk 										= '$file_pdf_kk',
								ktp_ayah 											= '$ktp_ayah',
								ktp_ibu 											= '$ktp_ibu',
								sertif_tahsin  										= '$sertif_tahsin',
								sertif_tahfidz  									= '$sertif_tahfidz',
								nominal_infaq										= '$nominalInfaq',
								nominal_terbilang 									= '$nominalTerbilang',
								tanggal_formulir_dibuat 							= '$tanggalFormDiIsi',
								alasan_diaiis 										= '$alasanDiAiis',
								pendapat_orangtua 									= '$pendapatOrtu',
								kemampuan_sosial 									= '$kemampuanSosial',
								kemandirian_anak 									= '$kemandirianSiswa',
								kelebihan_anak 										= '$kelebihanSiswa',
								terlibat_mengasuh 									= '$terlibatMengasuh',
								tahsin_ayah 										= '$tahsinAyah',
								tahfidz_ayah 										= '$tahfidzAyah',
								tahsin_ibu 											= '$tahsinIbu',
								tahfidz_ibu 										= '$tahfidzIbu'
							");

							if ($query) {

								$dataSiswaReject = mysqli_num_rows(mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa_ditolak"));
								// echo "Import data berhasil";
								$total = $dataSiswaReject;

								$_SESSION['import_success'] = "berhasil_import_tolak";
								
							} else {
								mysqli_error($con);
								echo "Gagal";
							}

						} else if ($countRej != 0) {

							$queryFindDataDuplicate = mysqli_query($con, "
								SELECT nama_ibu FROM data_pendaftaran_siswa_ditolak
								WHERE
								nama_calon_siswa = '$calonNamaSiswa'
								AND 
								nama_ibu LIKE '%$nama_ibu%'
							");

							$findDataDuplicate  = mysqli_num_rows($queryFindDataDuplicate);

							if ($findDataDuplicate == 1) {
								$_SESSION['import_success'] = "gagal";
							} else {

	    						$countRej  		= mysqli_num_rows($dataSiswaRej);

								$query = mysqli_query ($con, "
									INSERT INTO data_pendaftaran_siswa_ditolak
									SET
									id 													= '$id',
									pendaftaran_kelas 									= '1SD',
									nama_calon_siswa  									= '$calonNamaSiswa',
									panggilan_calon_siswa								= '$panggilanClnSiswa',
									nisn 												= '$nisnCalonSiswa',
									asal_sekolah 										= '$asalSklhClnSiswa',
									jenis_kelamin          								= '$jkClnSiswa',
									tempat_lahir 										= '$tmptLhrClnSiswa',
									tanggal_lahir  										= '$tglLhrClnSiswa',
									anak_ke 											= '$anak_ke',
									dari_berapa_saudara 								= '$dariBrpSdr',
									kk_atau_adik_di_aiis 								= '$kkAdikDiAiis',
									tingkat_kelas_kk_atau_adik  						= '$tngktKelaskkAdik',
									nama_kk_atau_adik 									= '$nama_kk_atau_adik',
									riwayat_penyakit 									= '$riwayat_penyakit',
									bacaan_tahsin 										= '$bacaan_tahsin',
									jumlah_juz_dihafal 									= '$jumlah_juz_dihafal',
									juz_dihafal   										= '$juz_dihafal',
									hafalan_surat 										= '$hafalan_surat',
									pernah_menjalani_terapi 							= '$pernahTrapi',
									jenis_terapi 										= '$jenisTerapi',
									alasan_menjalani_terapi 							= '$alasanTrapi',
									durasi_terapi 										= '$durasiTerapi',
									waktu_mulai_dan_waktu_selesai_terapi				= '$wktAwAkhirTrapi',
									saat_ini_masih_menjalani_terapi 					= '$masihTerapi',
									keterlambatan_perkembangan 							= '$lmbtPerkembangan',
									terbiasa_solat_lima_waktu 							= '$trbSolat',
									peran_orangtua_membantu_anak_menghafal				= '$peranOrtua',
									anak_terbiasa_menonton_tv_atau_gadget 				= '$terbiasaGadget',
									berapa_lama_menonton_tv_atau_gadget_dalam_sehari	= '$brpLamaGadget',
									nama_ayah 											= '$nama_ayah',
									tempat_lahir_ayah 									= '$tempat_lahir_ayah',
									tanggal_lahir_ayah 									= '$tanggal_lahir_ayah',
									agama_ayah 											= '$agama_ayah',
									pendidikan_terakhir_ayah							= '$pendAy',
									pekerjaan_ayah 										= '$pekerjaan_ayah',
									domisili_ayah_saat_ini 								= '$domisiliAyah',
									nomor_hp_ayah 										= '$hpAyah',
									nama_ibu 											= '$nama_ibu',
									tempat_lahir_ibu 									= '$tempat_lahir_ibu',
									tanggal_lahir_ibu 									= '$tanggal_lahir_ibu',
									agama_ibu 											= '$agama_ibu',
									pendidikan_terakhir_ibu								= '$pendIbu',
									pekerjaan_ibu 										= '$pekerjaan_ibu',
									domisili_ibu_saat_ini 								= '$domisili_ibu',
									nomor_hp_ibu 										= '$hpIbu',
									pendapatan_orangtua 								= '$pendapatanOrtu',
									rencana_mutasi 										= '$rencana_mutasi',
									file_pdf_akte 										= '$file_pdf_akte',
									file_pdf_kk 										= '$file_pdf_kk',
									ktp_ayah 											= '$ktp_ayah',
									ktp_ibu 											= '$ktp_ibu',
									sertif_tahsin  										= '$sertif_tahsin',
									sertif_tahfidz  									= '$sertif_tahfidz',
									nominal_infaq										= '$nominalInfaq',
									nominal_terbilang 									= '$nominalTerbilang',
									tanggal_formulir_dibuat 							= '$tanggalFormDiIsi',
									alasan_diaiis 										= '$alasanDiAiis',
									pendapat_orangtua 									= '$pendapatOrtu',
									kemampuan_sosial 									= '$kemampuanSosial',
									kemandirian_anak 									= '$kemandirianSiswa',
									kelebihan_anak 										= '$kelebihanSiswa',
									terlibat_mengasuh 									= '$terlibatMengasuh',
									tahsin_ayah 										= '$tahsinAyah',
									tahfidz_ayah 										= '$tahfidzAyah',
									tahsin_ibu 											= '$tahsinIbu',
									tahfidz_ibu 										= '$tahfidzIbu'
								");

								$dataSiswaRejectInputBaru = mysqli_num_rows(mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa_ditolak"));
								$total = $dataSiswaRejectInputBaru - $countRej;

								$_SESSION['import_success'] = "berhasil_import_tolak";

							}

						}

					}

				}

			} else {

				$_SESSION['import_success'] = "gagal";

			}

		}
	}

?>

<div class="row">
    
    <div class="col-xs-12 col-md-12 col-lg-12">

    	<?php if ($checkForm == 2): ?>

    		<div class="alert alert-danger alert-dismissable"> <span style="color: yellow;"> DATA ATAS NAMA <?= $clnSiswa; ?> SUDAH ADA </span>
             	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             	<?php $checkForm = 0; ?>
          	</div>
    		
    	<?php endif ?>

        <?php if(isset($_SESSION['form_success']) && $_SESSION['form_success'] == 'type_fail'){?>
          <div style="display: none;" class="alert alert-danger alert-dismissable"> Silahkan Masukan file bertipe xls, atau xlsx
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <?php unset($_SESSION['form_success']); ?>
          </div>
        <?php } ?>

        <?php if(isset($_SESSION['import_success']) && $_SESSION['import_success'] == 'berhasil'){?>
          <div style="display: none;" class="alert alert-warning alert-dismissable"> <?= $total . " Calon Siswa Yang DiTerima Berhasil di Import !"; ?>
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <?php unset($_SESSION['import_success']); ?>
          </div>
        <?php } ?>

        <?php if(isset($_SESSION['import_success']) && $_SESSION['import_success'] == 'berhasil_import_tolak'){?>
          <div style="display: none;" class="alert alert-warning alert-dismissable"> <?= $total . " Calon Siswa Yang DiTolak Berhasil di Import !"; ?>
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <?php unset($_SESSION['import_success']); ?>
          </div>
        <?php } ?>

        <?php if(isset($_SESSION['import_success']) && $_SESSION['import_success'] == 'gagal'){?>
          <div style="display: none;" class="alert alert-danger alert-dismissable"> <?php echo " Data Gagal di Import !"; ?>
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <?php unset($_SESSION['import_success']); ?>
          </div>
        <?php } ?>

        <?php if(isset($_SESSION['form_success']) && $_SESSION['form_success'] == 'empty_form'){?>
          <div style="display: none;" class="alert alert-danger alert-dismissable"> Tidak Ada File Yang Di Upload
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <?php unset($_SESSION['form_success']); ?>
          </div>
        <?php } ?>

        <?php if(isset($_SESSION['form_success']) && $_SESSION['form_success'] == 'size_too_big'){?>
          <div style="display: none;" class="alert alert-danger alert-dismissable"> Ukuran File Terlalu Besar
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <?php unset($_SESSION['form_success']); ?>
          </div>
        <?php } ?>

    </div>

</div>

<div class="box box-info">

    <form action="<?= $basead; ?>importdatappdb" enctype="multipart/form-data" method="post">
        <div class="box-body">

            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>IMPORT STATUS PPDB</label>
                        <select class="form-control target" id="statusPPDB" name="stat_ppdb" required onchange="toggleImportFile()">
							<option value="empty"> -- PILIH -- </option>
							<option value="terima">TERIMA</option>
    						<option value="tolak">TOLAK</option>
						</select>
                    </div>
                </div>
                <div class="col-sm-4" id="importFileSection" style="display: none;">
                    <div class="form-group">
                        <label>Import PPDB <span id="status_ppdb">  </span> (xlsx, xls) </label>
                        <input type="file" id="uploadfilestatus" name="isi_file" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required class="form-control" />
                        
                    </div>
                </div>
            </div> 
            
        <button type="submit" name="upload_data" class="btn btn-success btn-sm" id="import_btn"> <i class="glyphicon glyphicon-download"></i> IMPORT </button>
        </div>
    </form>

</div>

<script type="text/javascript">
	
	let newIcon = document.getElementById("addIcon");
    newIcon.classList.remove("fa");
    newIcon.classList.add("glyphicon");
    newIcon.classList.add("glyphicon-download");

    // mencegah user ketika refresh halaman dan mengirim data yang sama pada halaman yang sama
  	if (window.history.replaceState) {
	    window.history.replaceState(null, null, window.location.href);
  	}

	document.getElementById('isiMenu').innerHTML = `IMPORT DATA PPDB`	

	function toggleImportFile() {
    	var status = document.getElementById("statusPPDB").value;
    	var fileSection = document.getElementById("importFileSection");
    
	    if (status === "terima" || status === "tolak") {
	      fileSection.style.display = "block"; // Show file import section
	      if (status == "terima") {
	      	document.querySelector("#status_ppdb").innerText = "Di Terima"
	      	document.querySelector("#import_btn").style.display = "block"
	      } else if (status == "tolak") {
	      	document.querySelector("#status_ppdb").innerText = "Di Tolak"
	      	document.querySelector("#import_btn").style.display = "block"
	      }
	    } else {
	      	fileSection.style.display = "none"; // Hide file import section
      		document.querySelector("#import_btn").style.display = "none"

	    }
  	}

  	document.querySelectorAll("#uploadfilestatus").forEach(function(input) {
	    input.addEventListener("change", function() {
	      const file = this.files[0];
	      
	      if (file) {
	        const validType = file.type === "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || file.type === "application/vnd.ms-excel";
	        const validExt = file.name.toLowerCase().endsWith(".xlsx") || file.name.toLowerCase().endsWith(".xls");
	        const maxSize = 5 * 1024 * 1024; // 5 MB (dalam byte)

	        // Validasi format file
	        if (!validType || !validExt) {
	          alert("File harus berformat excel (.xlsx atau xls)");
	          this.value = ""; // reset input
	          return;
	        }

	        // Validasi ukuran file
	        if (file.size > maxSize) {
	          alert("File melebihi kapasitas maksimal 5MB");
	          this.value = ""; // reset input
	          return;
	        }

	        console.log("File valid:", file.name, "-", (file.size / 1024 / 1024).toFixed(2), "MB");
	      }
	    });
  	});

	$(document).ready( function () {
		$("#import_btn").hide();
        $("#export_data").click();
        $("#import").css({
            "background-color" : "#ccc",
            "color" : "black"
        });
    });

</script>