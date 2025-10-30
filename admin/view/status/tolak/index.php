<?php  
	
	$timeOut        = $_SESSION['expire'];
    
    $timeRunningOut = time() + 5;

    $timeIsOut 		= 0;
    $validDataSiswa = 0;
    $validDataIbu 	= 0; 
    $totalValid    	= 0;

    $dataSiswaAcc   = mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa_diterima");
    $countAcc  		= mysqli_num_rows($dataSiswaAcc);
    $checkForm      = "";

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

			if( !in_array($ekstensiFile, $ekstensiFileValid) ) {
				// echo "Type File Invalid. Yang Anda Masukan File Ber Type " . $ekstensiFile;
				$_SESSION['form_success'] = "type_fail";
				// return true;
			} else {

				//upload data excel kedalam folder uploads
				$target_dir = "uploads/".basename($_FILES['isi_file']['name']);
				
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
					$riwayat_penyakit 	= mysqli_real_escape_string($con, htmlspecialchars($Row[13]));
					$bacaan_tahsin 		= mysqli_real_escape_string($con, htmlspecialchars($Row[14]));
					$jumlah_juz_dihafal = htmlspecialchars($Row[15]);
					$juz_dihafal 		= mysqli_real_escape_string($con, htmlspecialchars($Row[16]));
					$hafalan_surat  	= mysqli_real_escape_string($con, htmlspecialchars($Row[17]));
					$berjalanPdUsia 	= mysqli_real_escape_string($con, htmlspecialchars($Row[18]));
					$bicaraPdUsia 		= mysqli_real_escape_string($con, htmlspecialchars($Row[19]));
					$pernahTrapi 		= mysqli_real_escape_string($con, htmlspecialchars($Row[20]));
					$jenisTerapi 		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[21])));
					$alasanTrapi 		= mysqli_real_escape_string($con, htmlspecialchars($Row[22]));
					$durasiTerapi 		= mysqli_real_escape_string($con, htmlspecialchars($Row[23]));
					$wktAwAkhirTrapi    = mysqli_real_escape_string($con, htmlspecialchars($Row[24]));
					$masihTerapi        = mysqli_real_escape_string($con, htmlspecialchars($Row[25]));
					$lmbtPerkembangan   = mysqli_real_escape_string($con, htmlspecialchars($Row[26]));
					$trbSolat 			= mysqli_real_escape_string($con, htmlspecialchars($Row[27]));
					$tahsinOrtua        = mysqli_real_escape_string($con, htmlspecialchars($Row[28]));
					$tahfidzOrtua 		= mysqli_real_escape_string($con, htmlspecialchars($Row[29]));
					$peranOrtua 		= mysqli_real_escape_string($con, htmlspecialchars($Row[30]));
					$terbiasaGadget 	= mysqli_real_escape_string($con, htmlspecialchars($Row[31]));
					$brpLamaGadget      = mysqli_real_escape_string($con, htmlspecialchars($Row[32]));
					$nama_ayah 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[33])));
					$tempat_lahir_ayah 	= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[34])));
					$tanggal_lahir_ayah = htmlspecialchars($Row[35]);
					$agama_ayah 		= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[36])));
					$pendAy 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[37])));
					$pekerjaan_ayah     = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[38])));
					$domisiliAyah 		= mysqli_real_escape_string($con, htmlspecialchars($Row[39]));
					$hpAyah      		= htmlspecialchars($Row[40]);
					$nama_ibu 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[41])));
					$tempat_lahir_ibu   = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[42])));
					$tanggal_lahir_ibu  = htmlspecialchars($Row[43]);
					$agama_ibu          = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[44])));
					$pendIbu 			= mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[45])));
					$pekerjaan_ibu      = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[46])));
					$domisili_ibu 		= mysqli_real_escape_string($con, htmlspecialchars($Row[47]));
					$hpIbu 				= htmlspecialchars($Row[48]);
					$pendapatanOrtu     = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[49])));
					$rencana_mutasi     = mysqli_real_escape_string($con, strtoupper(htmlspecialchars($Row[50])));
					$file_pdf_akte      = mysqli_real_escape_string($con, htmlspecialchars($Row[51]));
					$file_pdf_kk   		= mysqli_real_escape_string($con, htmlspecialchars($Row[52]));
					$ktp_ayah			= mysqli_real_escape_string($con, htmlspecialchars($Row[53]));
					$ktp_ibu 			= mysqli_real_escape_string($con, htmlspecialchars($Row[54]));
					$sertif_tahsin 		= mysqli_real_escape_string($con, htmlspecialchars($Row[55]));
					$sertif_tahfidz 	= mysqli_real_escape_string($con, htmlspecialchars($Row[56]));
					$nominalInfaq 		= mysqli_real_escape_string($con, htmlspecialchars($Row[57]));
					$nominalTerbilang 	= mysqli_real_escape_string($con, htmlspecialchars($Row[58]));

					// echo "Di Sini " . $Row[1] . ' ' . $Row[41];exit;

					if ($countAcc != 0) {

						$queryFindDataNamaSiswa = mysqli_query($con, ' 
							SELECT nama_calon_siswa FROM status_data_pendaftaran_siswa
							WHERE nama_calon_siswa = "'. $Row[1] .'"
						');

						$countNama = mysqli_num_rows($queryFindDataNamaSiswa);

						$queryFindDataNamaIbu = mysqli_query($con, ' 
							SELECT nama_ibu FROM status_data_pendaftaran_siswa
							WHERE nama_ibu = "'. $Row[41] .'"
						');

						$countIbu = mysqli_num_rows($queryFindDataNamaIbu);

						if ($countNama == 1) 	{
							$validDataSiswa = 1;
						}

						if ($countIbu == 1) {
							$validDataIbu = 1;
						}

						$checkNamaCalonSiswa = mysqli_query($con, '
							SELECT 
							nama_calon_siswa, nomor_hp_ibu 
							FROM data_pendaftaran_siswa_diterima 
							WHERE
							data_pendaftaran_siswa_diterima.nama_calon_siswa = "'. $Row[1] .'" ');

						$countDataCalonSiswa = mysqli_num_rows($checkNamaCalonSiswa);

						if ($countDataCalonSiswa == 0) {

							$query = mysqli_query ($con, "
								INSERT INTO data_pendaftaran_siswa_diterima
								SET
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
								dapat_berjalan_pada_usia 							= '$berjalanPdUsia',
								dapat_berbicara_bermakna_pada_usia					= '$bicaraPdUsia',
								pernah_menjalani_terapi 							= '$pernahTrapi',
								jenis_terapi 										= '$jenisTerapi',
								alasan_menjalani_terapi 							= '$alasanTrapi',
								durasi_terapi 										= '$durasiTerapi',
								waktu_mulai_dan_waktu_selesai_terapi				= '$wktAwAkhirTrapi',
								saat_ini_masih_menjalani_terapi 					= '$masihTerapi',
								keterlambatan_perkembangan 							= '$lmbtPerkembangan',
								terbiasa_solat_lima_waktu 							= '$trbSolat',
								orangtua_sudah_lancar_dalam_tahsin					= '$tahsinOrtua',
								hafalan_tahfidz_orangtua							= '$tahfidzOrtua',
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
								nominal_terbilang 									= '$nominalTerbilang'
							");

							if ($query) {

								$dataSiswaTelahAcc = mysqli_num_rows(mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa_diterima"));
								// echo "Import data berhasil";
								$total = $dataSiswaTelahAcc - $countAcc;
								$_SESSION['import_success'] = "berhasil";
								$success_sess = 1;
								
								$totalValid = $validDataSiswa + $validDataIbu;

								if ($totalValid == 2) {

									$queryUpdateDatas = mysqli_query($con, '
										UPDATE status_data_pendaftaran_siswa
										SET status = 1
										WHERE nama_calon_siswa = "' . $Row[1] .'"
										AND nama_ibu = "'. $Row[41] .'"
									'); 

									$_SESSION['import_success'] = "berhasil";
								} else {
									echo $Row[1] . ' ' . $Row[41];exit;
								}

							} else {
								mysqli_error($con);
								echo "Gagal";
							}

						}

					} else if ($countAcc == 0) {

						$queryFindDataNamaSiswa = mysqli_query($con, ' 
							SELECT nama_calon_siswa FROM status_data_pendaftaran_siswa
							WHERE nama_calon_siswa = "'. $Row[1] .'"
						');

						$countNama = mysqli_num_rows($queryFindDataNamaSiswa);

						$queryFindDataNamaIbu = mysqli_query($con, ' 
							SELECT nama_ibu FROM status_data_pendaftaran_siswa
							WHERE nama_ibu = "'. $Row[41] .'"
						');

						$countIbu = mysqli_num_rows($queryFindDataNamaIbu);

						if ($countNama == 1) 	{
							$validDataSiswa = 1;
						}

						if ($countIbu == 1) {
							$validDataIbu = 1;
						}

						$query = mysqli_query ($con, "
							INSERT INTO data_pendaftaran_siswa_diterima
							SET
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
							dapat_berjalan_pada_usia 							= '$berjalanPdUsia',
							dapat_berbicara_bermakna_pada_usia					= '$bicaraPdUsia',
							pernah_menjalani_terapi 							= '$pernahTrapi',
							jenis_terapi 										= '$jenisTerapi',
							alasan_menjalani_terapi 							= '$alasanTrapi',
							durasi_terapi 										= '$durasiTerapi',
							waktu_mulai_dan_waktu_selesai_terapi				= '$wktAwAkhirTrapi',
							saat_ini_masih_menjalani_terapi 					= '$masihTerapi',
							keterlambatan_perkembangan 							= '$lmbtPerkembangan',
							terbiasa_solat_lima_waktu 							= '$trbSolat',
							orangtua_sudah_lancar_dalam_tahsin					= '$tahsinOrtua',
							hafalan_tahfidz_orangtua							= '$tahfidzOrtua',
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
							nominal_terbilang 									= '$nominalTerbilang'
						");

						if ($query) {

							$dataSiswaTelahAcc = mysqli_num_rows(mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa_diterima"));
							// echo "Import data berhasil";
							$total = $dataSiswaTelahAcc;
							
							$success_sess = 1;

							$totalValid = $validDataSiswa + $validDataIbu;

							if ($totalValid == 2) {

								$queryUpdateDatas = mysqli_query($con, '
									UPDATE status_data_pendaftaran_siswa
									SET status = 1
									WHERE nama_calon_siswa = "' . $Row[1] .'"
									AND nama_ibu = "'. $Row[41] .'"
								'); 

								$_SESSION['import_success'] = "berhasil";
							} else {
								echo $Row[1] . ' ' . $Row[41];exit;
							}
							
						} else {
							mysqli_error($con);
							echo "Gagal";
						}

					}

				}

			}

		}
	}

?>

<div class="box box-info">

    <center> 
      <h4 id="judul_daily">
        <strong> <u> DATA CALON SISWA YANG TELAH DITOLAK </u> </strong> 
      </h4> 
    </center>

    <!-- <div class="form-group"> -->
      
    <!-- </div> -->

    <div class="box-body table-responsive">

      <table id="hightlight_list_siswa" style="text-align: center; width: 200%;" class="table table-bordered table-hover">

        <thead>
          <tr style="background-color: lightyellow; font-weight: bold;">
            <th style="text-align: center; border: 1px solid black;" width="5%">NO</th>
            <th style="text-align: center; border: 1px solid black;"> NAMA CALON SISWA </th>
            <th style="text-align: center; border: 1px solid black;"> JENIS KELAMIN </th>
            <th style="text-align: center; border: 1px solid black; width: 220px;"> TEMPAT TANGGAL LAHIR </th>
            <th style="text-align: center; border: 1px solid black;"> BACAAN TAHSIN </th>
            <th style="text-align: center; border: 1px solid black; width: 242px;"> BANYAK JUZ YANG DI HAFAL </th>
            <th style="text-align: center; border: 1px solid black; width: 250px;"> JUZ & SURAT YANG DI HAFAL </th>
            <th style="text-align: center; border: 1px solid black;"> AKTE KELAHIRAN </th>
            <th style="text-align: center; border: 1px solid black;"> KARTU KELUARGA </th>
            <th style="text-align: center; border: 1px solid black;"> KTP AYAH </th>
            <th style="text-align: center; border: 1px solid black;"> KTP IBU </th>
            <th style="text-align: center; border: 1px solid black;"> ACTION </th>
            <!-- <th style="text-align: center;"> DAILY </th> -->
            <!-- Terdapat Administrasi Pembiayaan Yang Perlu Di Selesaikan -->
          </tr>
        </thead>

        <tbody>
          
        </tbody>

      </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript"></script>

<script type="text/javascript">
	
	let newIcon = document.getElementById("addIcon");
    newIcon.classList.remove("fa");
    newIcon.classList.add("glyphicon");
    newIcon.classList.add("glyphicon-ok-sign");

	document.getElementById('isiMenu').innerHTML = `STATUS CALON SISWA DITOLAK`

	$(document).ready( function () {
        $("#list_status").click();
        $("#status_tolak").css({
            "background-color" : "#ccc",
            "color" : "black"
        });

        $("#isiMenu").css({
	        "margin-left" : "5px",
	        "font-weight" : "bold",
	        "text-transform": "uppercase"
	    });

    });

</script>