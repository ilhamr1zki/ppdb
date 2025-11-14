<?php  

	require('../php/config.php');

	$sesi 							= 0;
	$no 							= 1;
	$arrData 						= [];
	$arrDataCalonSiswa				= [];
	$arrDataCalonNamaSiswa			= [];
	$arrDataCalonNamaPanggilanSiswa	= [];
	$arrDataJkCalonSiswa			= [];
	$arrDataTtlCalonSiswa 			= [];
	$arrDataAgamaCalonSiswa   		= [];
	$arrDataAnakKeCalonSiswa 		= [];
	$arrDataDariBrpSdrCalonSiswa 	= [];
	$arrDataRwytCalonSiswa 			= [];
	$arrDataThsnCalonSiswa 			= [];
	$arrDataThfCalonSiswa  			= [];
	$arrDataAslCalonSiswa   		= [];

	$arrDataNamaAyahCalonSiswa 		= []; 
	$arrDataTtlAyahCalonSiswa 		= [];
	$arrDataAgamaAyahCalonSiswa 	= [];
	$arrDataPendAyahCalonSiswa 		= [];
	$arrDataPekAyahCalonSiswa 		= [];
	$arrDataAlamatAyahCalonSiswa 	= [];
	$arrDataNoHpAyahCalonSiswa 		= [];

	$arrDataNamaIbuCalonSiswa 		= [];
	$arrDataTtlIbuCalonSiswa 		= [];
	$arrDataAgamaIbuCalonSiswa 		= [];
	$arrDataPendIbuCalonSiswa 		= [];
	$arrDataPekIbuCalonSiswa 		= [];
	$arrDataAlamatIbuCalonSiswa 	= [];
	$arrDataNoHpIbuCalonSiswa 		= [];

	$arrDataPendapatanOrtuCalonSiswa = [];

	$arrDataOrtuCalonSiswa	= [];		

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

	if (isset($_POST['print_calon_siswa'])) {

		$sesi 				= 1;
		// echo $_POST['kelas_calon_siswa'];exit;
		$kelas 				= str_replace(["SD"], " SD", htmlspecialchars($_POST['kelas_calon_siswa']));
		$namaLengkap 		= htmlspecialchars($_POST['nama_calon_siswa']);
		$nisn  				= htmlspecialchars($_POST['nisn_calon_siswa']);
		$namaPanggilan 		= htmlspecialchars($_POST['panggilan_calon_siswa']);
		$jenisKelamin   	= htmlspecialchars($_POST['jk_calon_siswa']);
		$tempatLahir    	= htmlspecialchars($_POST['tempat_lahir_siswa']);
		$tanggal_lahir 		= htmlspecialchars($_POST['tanggal_lahir_siswa']);
		$anak_ke 			= htmlspecialchars($_POST['anak_ke']);
		$dariSaudara 		= htmlspecialchars($_POST['dariberapa_saudara']);
		$sdrAiis 			= htmlspecialchars($_POST['sdr_aiis']);
		$tktSdr	 			= htmlspecialchars($_POST['tkt_sdr']);
		// echo $tktSdr;exit;
		$nmSdr 				= htmlspecialchars($_POST['nm_sdr']);

		$riwayatPenyakit 	= htmlspecialchars($_POST['riwayat_penyakit']);
		$asalSekolah 		= htmlspecialchars($_POST['asal_sekolah']);
		$bacaanTahsin 		= htmlspecialchars($_POST['bacaan_tahsin']);
		$brpJuz 			= htmlspecialchars($_POST['jumlah_juz_dihafal']);
		$juzDihafal 		= htmlspecialchars($_POST['hafalan_juz']);
		$suratTerakhir 		= htmlspecialchars($_POST['hafalan_surat']);
		$hafalanJuz 		= "";

		$dapat_berjalan_pada_usia 	= htmlspecialchars($_POST['dapat_berjalan_pada_usia']);
		$dapatBerbicara 			= htmlspecialchars($_POST['dapat_berbicara_pada_usia']);
		$pernahTerapi 				= htmlspecialchars($_POST['pernah_terapi']);
		$jenisTerapi 				= htmlspecialchars($_POST['jenis_terapi']);
		$alasanTerapi 				= htmlspecialchars($_POST['alasan_terapi']);
		$durasiTerapi 				= htmlspecialchars($_POST['durasi_terapi']);
		$waktuMulaiTerapi 			= htmlspecialchars($_POST['waktu_mulai_terapi']);
		$saatIniMshTerapi 			= htmlspecialchars($_POST['msh_terapi']);
		$telatPerkembangan 			= htmlspecialchars($_POST['telat_perkembangan']);
		$terbiasaSolat 				= htmlspecialchars($_POST['terbiasa_solat']);
		$tahsinOrtu 				= htmlspecialchars($_POST['tahsin_ortu']);
		$tahfidzOrtu 				= htmlspecialchars($_POST['tahfidz_ortu']);
		$peranOrtu 					= htmlspecialchars($_POST['peran_ortu']);
		$terbiasaGadget 			= htmlspecialchars($_POST['terbiasa_gadget']);
		$durasiGadget 				= htmlspecialchars($_POST['durasi_gadget']);

		$namaAyah 			= htmlspecialchars($_POST['nama_ayah']);
		$tempatLahirAyah 	= htmlspecialchars($_POST['tempat_lahir_ayah']);
		$tanggalLahirAyah 	= htmlspecialchars($_POST['tanggal_lahir_ayah']);
		$agamaAyah 			= htmlspecialchars($_POST['agama_ayah']);
		$pendAyah 			= htmlspecialchars($_POST['pend_ayah']);
		$pekerjaanAyah 		= htmlspecialchars($_POST['pekerjaan_ayah']);
		$alamatAyah 		= htmlspecialchars($_POST['alamat_ayah']);
		$noHpAyah 			= htmlspecialchars($_POST['nomer_hp_ayah']);
		$namaIbu 			= htmlspecialchars($_POST['nama_ibu']);
		$tempatLahirIbu 	= htmlspecialchars($_POST['tempat_lahir_ibu']);
		$tanggalLahirIbu 	= htmlspecialchars($_POST['tanggal_lahir_ibu']);
		$penghasilanOrtu 	= htmlspecialchars($_POST['penghasilan_ortu']);
		$agamaIbu 			= htmlspecialchars($_POST['agama_ibu']);
		$pendIbu 			= htmlspecialchars($_POST['pend_ibu']);
		$pekerjaanIbu  		= htmlspecialchars($_POST['pekerjaan_ibu']);
		$alamatIbu 			= htmlspecialchars($_POST['alamat_ibu']);
		$noHpIbu 			= htmlspecialchars($_POST['nomer_hp_ibu']);
		$infaq 				= htmlspecialchars($_POST['infaq']);
		$terbilang 			= htmlspecialchars($_POST['terbilang']);
		$mutasi 			= htmlspecialchars($_POST['mutasi']);

		// Baru
		$alasanAiis 		= htmlspecialchars($_POST['alasan_diaiis']);
		$pendapatOrtu 		= htmlspecialchars($_POST['pendapat_orangtua']);
		$kemampuanSosial 	= htmlspecialchars($_POST['kemampuan_sosial']);
		$kemandirianSiswa 	= htmlspecialchars($_POST['kemandirian_anak']);
		$kelebihanSiswa 	= htmlspecialchars($_POST['kelebihan_anak']);
		$terlibatMengasuh 	= htmlspecialchars($_POST['terlibat_mengasuh']);
		$tahsinAyah			= htmlspecialchars($_POST['tahsin_ayah']);
		$tahfidzAyah		= htmlspecialchars($_POST['tahfidz_ayah']);
		$tahsinIbu			= htmlspecialchars($_POST['tahsin_ibu']);
		$tahfidzIbu			= htmlspecialchars($_POST['tahfidz_ibu']);

		// echo htmlspecialchars($_POST['nama_calon_siswa']);

		$arrDataCalonNamaSiswa[] 			= $namaLengkap;
		$arrDataCalonNamaPanggilanSiswa[] 	= $namaPanggilan;
		$arrDataJkCalonSiswa[] 				= $jenisKelamin;
		$arrDataTtlCalonSiswa[]		 		= $tempatLahir . ", " . format_tgl_indo($tanggal_lahir);
		$arrDataAgamaCalonSiswa[] 			= "ISLAM";
		$arrDataAnakKeCalonSiswa[]		 	= $anak_ke;
		$arrDataDariBrpSdrCalonSiswa[] 		= $dariSaudara;
		$arrDataRwytCalonSiswa[] 			= $riwayatPenyakit;
		$arrDataThsnCalonSiswa[] 			= $bacaanTahsin;
		$arrDataThfCalonSiswa[] 			= $hafalanJuz;
		// $arrDataAslCalonSiswa[]		 		= $asalSekolah;

		$arrDataNamaAyahCalonSiswa[] 		= $namaAyah;
		$arrDataTtlAyahCalonSiswa[] 		= $tempatLahirAyah . ", " . format_tgl_indo($tanggalLahirAyah);
		$arrDataAgamaAyahCalonSiswa[] 		= $agamaAyah;
		$arrDataPendAyahCalonSiswa[] 		= $pendAyah;
		$arrDataPekAyahCalonSiswa[] 		= $pekerjaanAyah;
		$arrDataAlamatAyahCalonSiswa[] 		= $alamatAyah;
		$arrDataNoHpAyahCalonSiswa[] 		= $noHpAyah;

		$arrDataNamaIbuCalonSiswa[] 		= $namaIbu;
		$arrDataTtlIbuCalonSiswa[] 			= $tempatLahirIbu . ", " . format_tgl_indo($tanggalLahirIbu);
		$arrDataAgamaIbuCalonSiswa[] 		= $agamaIbu;
		$arrDataPendIbuCalonSiswa[] 		= $pendIbu;
		$arrDataPekIbuCalonSiswa[] 			= $pekerjaanIbu;
		$arrDataAlamatIbuCalonSiswa[] 		= $alamatIbu;
		$arrDataNoHpIbuCalonSiswa[] 		= $noHpIbu;
		$arrDataPendapatanOrtuCalonSiswa[] 	= $penghasilanOrtu;

		$dataCalonSiswa = [
			'data' => [
				'namacalonsiswa' 		=> $arrDataCalonNamaSiswa,
				'panggilancalonsiswa' 	=> $arrDataCalonNamaPanggilanSiswa,
				'jk' 					=> $arrDataJkCalonSiswa,
				'ttl' 					=> $arrDataTtlCalonSiswa,
				'agama' 				=> $arrDataAgamaCalonSiswa,
				'anak_ke' 				=> $arrDataAnakKeCalonSiswa,
				'dr_brp' 				=> $arrDataDariBrpSdrCalonSiswa,
				'rwyt' 					=> $arrDataRwytCalonSiswa,
				'thsn' 					=> $arrDataThsnCalonSiswa,
				'thf' 					=> $arrDataThfCalonSiswa,
				'asl' 					=> $arrDataAslCalonSiswa
			],
		];

		$dataOrtuSiswa = [
			'data' => [
				'namaayah' 				=> $arrDataNamaAyahCalonSiswa,
				'ttl_ayah' 				=> $arrDataTtlAyahCalonSiswa,
				'agama_ayah' 			=> $arrDataAgamaAyahCalonSiswa,
				'pend_ayah'				=> $arrDataPendAyahCalonSiswa,
				'peker_ayah' 			=> $arrDataPekAyahCalonSiswa,
				'al_ayah' 				=> $arrDataAlamatAyahCalonSiswa,
				'nohp_ayah' 			=> $arrDataNoHpAyahCalonSiswa,
				'namaibu' 				=> $arrDataNamaIbuCalonSiswa,
				'ttl_ibu' 				=> $arrDataTtlIbuCalonSiswa,
				'agama_ibu' 			=> $arrDataAgamaIbuCalonSiswa,
				'pend_ibu'				=> $arrDataPendIbuCalonSiswa,
				'peker_ibu' 			=> $arrDataPekIbuCalonSiswa,
				'al_ibu' 				=> $arrDataAlamatIbuCalonSiswa,
				'nohp_ibu' 				=> $arrDataNoHpIbuCalonSiswa,
				'pendapatan_ortu' 		=> $arrDataPendapatanOrtuCalonSiswa
			]
		];

		// var_dump($arrDataCalonSiswa);exit;

	} else {

		$sesi = 0;

	}

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style type="text/css">
	
	.utk-flex {
		display: flex;
		/*gap: 150px;*/
	}

	h5 {
		margin-bottom: -5px;
	}

	#rp {
		margin-top: -30px;
	}

	table {
		text-align: center;
		margin-top: 50px;
		font-size: 15px;
		padding: 5px;
	}

	table td {
		background-color: #ddd;
	}


</style>

<?php if ($sesi == 0): ?>

	<br><br><br>
	<center> <h1> TIDAK ADA DATA </h1> </center>

<?php else: ?>
	
		<div class="container document">
	    	<div class="row">
		    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		    		<div class="panel panel-default">
						<form class="form form-horizontal validetta" method="post" action="">
							<!-- <div class="panel-heading"><h4 id="tahunajar" class="text-center">Tahun Ajaran Aktif : <strong><?php echo $ta_aktif; ?></strong></h4></div> -->
							<div class="panel-body" style="margin-top: 30px;">
								<!-- <input type="hidden" value="simpan_calon_siswa" name="aksi" id="aksi"> -->

								<legend> <i class="glyphicon glyphicon-user"></i> &nbsp; DATA CALON SISWA </legend>

								<br>
								<div class="form-group">
									<label class="col-md-8 control-label"> PENDAFTARAN UNTUK KELAS : </label>
									<div class="col-md-2">
										<input type="text" class="form-control" readonly name="jenjang_sekolah_reviewx" value="<?= str_replace(["SD"], "SD" ,$kelas); ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_nama_calon_siswa" for="nama_calon_siswa">
										ASAL SEKOLAH :
									</label>
									<div class="col-md-5">
										<?php if ($asalSekolah == 'PAUD AIIS'): ?>
											<input readonly type="text" class="form-control" value="PAUD AIIS" name="nama_calon_siswa_review" id="nama_calon_siswa">
										<?php else: ?>
											<input readonly type="text" class="form-control" value="<?= $asalSekolah; ?>" name="nama_calon_siswa_review" id="nama_calon_siswa">
										<?php endif ?>
									</div>
								</div>

								<div class="form-group nisnawal">
									<label class="col-md-3 control-label" id="label_nisn" for="nisn_calon_siswa">
										NISN :
									</label>
									<?php if ($nisn == "0" || $nisn == "0000"): ?>

										<div class="col-md-2">
											<input readonly type="text" class="form-control" value="" name="nisn_review" id="nisn_calon_siswa">
										</div>

									<?php else: ?>

										<div class="col-md-2">
											<input readonly type="text" class="form-control" value="<?= $nisn; ?>" name="nisn_review" id="nisn_calon_siswa">
										</div>
										
									<?php endif ?>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" id="label_nama_calon_siswa" for="nama_calon_siswa">
										NAMA LENGKAP :
									</label>
									<div class="col-md-5">
										<input readonly type="text" class="form-control" value="<?= $namaLengkap; ?>" name="nama_calon_siswa_review" id="nama_calon_siswa">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_namapanggilan_calon_siswa" for="nama_panggilan_siswa">
										NAMA PANGGILAN :
									</label>
									<div class="col-md-5">
										<input readonly type="text" class="form-control" value="<?= $namaPanggilan; ?>" name="namapanggilan_calon_siswa_review" id="nama_panggilan_siswa">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label"> JENIS KELAMIN : </label>
									<div class="col-md-2">
										<input type="text" class="form-control" name="jenis_kelamin_review" readonly value="<?= $jenisKelamin; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" id="label_tempat_lahir_calon_siswa" for="tempat_lahir_calon_siswa">
										TEMPAT LAHIR :
									</label>
									<div class="col-md-3">
										<input readonly type="text" required class="form-control" value="<?= $tempatLahir; ?>" name="tempat_lahir_calon_siswa_review" id="tempat_lahir_calon_siswa">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label" id="label_tanggal_lahir_calon_siswa" for="tanggal_lahir_calon_siswa">
										TANGGAL LAHIR :
									</label>
									<div class="col-md-3">
			                          <div class="controls input-append date form_date" data-date="2012-01-01" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
			                              <input readonly class="form-control" value="<?= format_tgl_indo($tanggal_lahir); ?>" id="tanggal_lahir_calon_siswa" type="text" name="tanglahir_anak_review" value="" required="">
			                              <span class="add-on"><i class="icon-th"></i></span>
			                          </div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_anak_ke" for="anak_ke">
										ANAK KE :
									</label>
									<div class="col-md-2">
										<input readonly type="text" value="<?= $anak_ke; ?>" pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 1" name="anak_ke_review" id="anak_ke">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_daribrp_sdr" for="daribrp_saudara">
										DARI BERAPA SAUDARA :
									</label>
									<div class="col-md-2">
										<input type="text" value="<?= $dariSaudara; ?>" readonly pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 2" name="daribrp_saudara_review" id="daribrp_saudara">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-7 control-label" id="label_daribrp_sdr" for="daribrp_saudara">
										APAKAH ADA ADIK/KAKAK KANDUNG YANG SUDAH BERSEKOLAH DI AIIS :
									</label>
									<div class="col-md-2">
										<input type="text" value="<?= $sdrAiis; ?>" readonly pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 2" name="daribrp_saudara_review" id="daribrp_saudara">
									</div>
								</div>

								<?php if ($sdrAiis != "TIDAK"): ?>

									<div class="form-group">
										<label class="col-md-8 control-label" id="label_riwayat_penyakit" for="rwyt_penyakit">
											TINGKAT KELAS ADIK/KAKAK TERSEBUT :
										</label>
										<div class="col-md-5">
											<input type="text" readonly value="<?= $tktSdr; ?>" class="form-control" placeholder="Ex : Penyakit Anemia (kosongkan jika tidak ada)" name="rwyt_penyakit_review" id="rwyt_penyakit">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-8 control-label" id="label_riwayat_penyakit" for="rwyt_penyakit">
											NAMA ADIK/KAKAK TERSEBUT :
										</label>
										<div class="col-md-5">
											<input type="text" readonly value="<?= $nmSdr; ?>" class="form-control" name="rwyt_penyakit_review" id="rwyt_penyakit">
										</div>
									</div>

								<?php endif ?>

								<div class="form-group">
									<label class="col-md-7 control-label" id="label_daribrp_sdr" for="daribrp_saudara">
										APA ALASAN ANDA MEMILIH SEKOLAH AIIS ?
									</label>
									<div class="col-md-8">
										<input type="text" value="<?= $alasanAiis; ?>" readonly pattern="[0-9]*" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-7 control-label" id="label_daribrp_sdr" for="daribrp_saudara">
										APA YANG AKAN BAPAK DAN IBU LAKUKAN BILA ADA KEBIJAKAN SEKOLAH YANG TIDAK SESUAI DENGAN PEMIKIRAN BAPAK DAN IBU ?
									</label>
									<div class="col-md-8">
										<input type="text" value="<?= $pendapatOrtu; ?>" readonly pattern="[0-9]*" class="form-control">
									</div>
								</div>

								<legend> <i class="glyphicon glyphicon-user"></i> &nbsp; RIWAYAT PERKEMBANGAN ANAK </legend>

								<br>
								<!-- <div class="form-group">
									<label class="col-md-5 control-label" for="nama_ayah_wali">
										ANANDA DAPAT BERJALAN PADA USIA :
									</label>
									<div class="col-md-3">
										<input type="text" readonly value="<?= $dapat_berjalan_pada_usia; ?>" class="form-control" name="nama_ayah_wali_review" id="nama_ayah_wali">
									</div>
								</div> -->

								<!-- <div class="form-group">
									<label class="col-md-8 control-label" for="temlahir_ayah">
										ANANDA DAPAT BERBICARA BERMAKNA MIN. 2 KATA PADA USIA : 
									</label>
									<div class="col-md-3">
										<input type="text" readonly class="form-control" value="<?= $dapatBerbicara; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div> -->

								<div class="form-group">
									<label class="col-md-8 control-label" id="label_riwayat_penyakit" for="rwyt_penyakit">
										APAKAH ANANDA MEMILIKI RIWAYAT MASALAH KESEHATAN ? (DARI PROSES HAMIL HINGGA SAAT INI)
									</label>
									<div class="col-md-8">
										<input type="text" readonly value="<?= $riwayatPenyakit; ?>" class="form-control" placeholder="Ex : Penyakit Anemia (kosongkan jika tidak ada)" name="rwyt_penyakit_review" id="rwyt_penyakit">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-8 control-label" id="label_riwayat_penyakit" for="rwyt_penyakit">
										APAKAH ANANDA MEMILIKI RIWAYAT KETERLAMBATAN TUMBUH KEMBANG ? (FASE MERANGKAK/BERDIRI/BERJALAN/BICARA)
									</label>
									<div class="col-md-8">
										<input type="text" readonly value="<?= $telatPerkembangan; ?>" class="form-control" placeholder="Ex : Penyakit Anemia (kosongkan jika tidak ada)" name="rwyt_penyakit_review" id="rwyt_penyakit">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-8 control-label" for="temlahir_ayah">
										APAKAH ANANDA PERNAH MENJALANI TERAPI : 
									</label>
									<div class="col-md-3">
										<input type="text" readonly class="form-control" value="<?= $pernahTerapi; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div>

								<?php if ($pernahTerapi == "PERNAH"): ?>

									<div class="form-group">
										<label class="col-md-8 control-label" for="temlahir_ayah">
											JENIS TERAPI APA : 
										</label>
										<div class="col-md-3">
											<input type="text" readonly class="form-control" value="<?= $jenisTerapi; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-8 control-label" for="temlahir_ayah">
											ALASAN MENJALANI TERAPI TERSEBUT : 
										</label>
										<div class="col-md-8">
											<input type="text" readonly class="form-control" value="<?= $alasanTerapi; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-8 control-label" for="temlahir_ayah">
											DURASI TERAPI TERSEBUT : 
										</label>
										<div class="col-md-3">
											<input type="text" readonly class="form-control" value="<?= $durasiTerapi; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-8 control-label" for="temlahir_ayah">
											WAKTU MULAI DAN WAKTU SELESAI TERAPI : 
										</label>
										<div class="col-md-5">
											<input type="text" readonly class="form-control" value="<?= $waktuMulaiTerapi; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-8 control-label" for="temlahir_ayah">
											APAKAH SAAT INI MASIH MENJALANI TERAPI : 
										</label>
										<div class="col-md-3">
											<input type="text" readonly class="form-control" value="<?= $saatIniMshTerapi; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
										</div>
									</div>
									
								<?php endif ?>

								<div class="form-group">
									<label class="col-md-8 control-label" for="temlahir_ayah">
										BAGAIMANA KEMAMPUAN SOSIAL ANANDA DALAM MEMASUKI LINGKUNGAN BARU ? 
									</label>
									<div class="col-md-8">
										<input type="text" readonly class="form-control" value="<?= $kemampuanSosial; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-8 control-label" for="temlahir_ayah">
										BAGAIMANA KEMANDIRIAN ANANDA DALAM KEGIATAN SEHARI-HARI DI RUMAH ? 
									</label>
									<div class="col-md-8">
										<input type="text" readonly class="form-control" value="<?= $kemandirianSiswa; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-8 control-label" for="temlahir_ayah">
										APA SAJA KELEBIHAN DIRI YANG ANANDA MILIKI ? (BISA SIFAT POSITIF, KEBIASAAN POSITIF ATAU SKILL AKAN SUATU HARI) 
									</label>
									<div class="col-md-8">
										<input type="text" readonly class="form-control" value="<?= $kelebihanSiswa; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-9 control-label" for="temlahir_ayah">
										APAKAH ANANDA SUDAH TERBIASA SHOLAT 5 WAKTU : 
									</label>
									<div class="col-md-3">
										<input type="text" readonly class="form-control" value="<?= $terbiasaSolat; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-8 control-label" for="temlahir_ayah">
										APAKAH ANAK TERBIASA MENONTON TV ATAU MENGGUNAKAN GADGET : 
									</label>
									<div class="col-md-3">
										<input type="text" readonly class="form-control" value="<?= $terbiasaGadget; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div>

								<?php if ($terbiasaGadget == 'IYA'): ?>
									
									<div class="form-group">
										<label class="col-md-8 control-label" for="temlahir_ayah">
											BERAPA JAM DALAM SEHARI MENONTON TV ATAUPUN MENGGUNAKAN GADGET : 
										</label>
										<div class="col-md-8">
											<textarea class="form-control" style="height: 125px;" disabled>
												<?= $durasiGadget; ?>
											</textarea>
											<!-- <input type="text" readonly class="form-control" value="<?= $durasiGadget; ?>" name="temlahir_ayah_review" id="temlahir_ayah"> -->
										</div>
									</div>

								<?php endif ?>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_bacaan_tahsin" for="bacaan_tahsin">
										TAHSIN / BACA AL-QUR'AN :
									</label>
									<div class="col-md-2">
										<input readonly type="text" class="form-control" value="<?= $bacaanTahsin; ?>" name="tahsin_rev" id="nisn_calon_siswa">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_bacaan_tahsin" for="bacaan_tahsin">
										BANYAK JUZ DI HAFAL :
									</label>
									<div class="col-md-2">
										<input readonly type="text" class="form-control" value="<?= $brpJuz; ?>" name="tahsin_rev" id="nisn_calon_siswa">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_bacaan_tahsin" for="bacaan_tahsin">
										JUZ YANG DI HAFAL :
									</label>
									<div class="col-md-5">
										<input readonly type="text" class="form-control" value="<?= $juzDihafal; ?>" name="tahsin_rev" id="nisn_calon_siswa">
									</div>
								</div>

								<br><br><br><br>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_bacaan_tahsin" for="bacaan_tahsin">
										HAFALAN SURAT TERAKHIR :
									</label>
									<div class="col-md-7">
										<textarea class="form-control" disabled style="resize:vertical; height:125px;"> <?= $suratTerakhir; ?> </textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-5 control-label" for="temlahir_ayah">
										SIAPA SAJA YANG TERLIBAT DALAM MENGASUH ANANDA ? (DARI SEJAK LAHIR SAMPAI DENGAN SAAT INI) 
									</label>
									<div class="col-md-3">
										<input type="text" readonly class="form-control" value="<?= $terlibatMengasuh; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-8 control-label" for="temlahir_ayah">
										PERAN AYAH BUNDA DALAM MEMBANTU PERKEMBANGAN HAFALAN AL-QUR'AN ANANDA : 
									</label>
									<div class="col-md-8">
										<textarea class="form-control" style="height: 125px;" disabled> <?= $peranOrtu; ?> </textarea>
									</div>
								</div>
								
								<br><br><br>

								<legend> <i class="glyphicon glyphicon-user"></i> &nbsp; DATA ORANG TUA </legend>

								<br>
								<div class="form-group">
									<label class="col-md-3 control-label" for="nama_ayah_wali">
										NAMA AYAH / WALI :
									</label>
									<div class="col-md-8">
										<input type="text" readonly value="<?= $namaAyah; ?>" class="form-control" name="nama_ayah_wali_review" id="nama_ayah_wali">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="temlahir_ayah">
										TEMPAT LAHIR : 
									</label>
									<div class="col-md-3">
										<input type="text" readonly class="form-control" value="<?= $tempatLahirAyah; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div>

								<br><br><br>

								<div class="form-group">

									<label class="col-md-2 control-label" id="label_tanggal_lahir_ayah" for="tanggal_lahir_ayah">
										TANGGAL LAHIR :
									</label>
									<div class="col-md-3">
			                          <div class="controls input-append date form_date" data-date="1985-01-01" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
			                              <input class="form-control" id="tanggal_lahir_ayah" type="text" name="tanglahir_ayah_review" value="<?= format_tgl_indo($tanggalLahirAyah); ?>" readonly>
			                              <span class="add-on"><i class="icon-th"></i></span>
			                          </div>
									</div>

								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_agama" for="agama_ayah">
										AGAMA :
									</label>
									<?php if ($agamaAyah == "ISLAM"): ?>
										<div class="col-md-2">
											<input type="text" readonly value="<?= $agamaAyah; ?>" class="form-control" name="agama_ayah_review">
										</div>
									<?php elseif($agamaAyah == "LAINNYA"): ?>

										<div class="col-md-2">
											<input type="text" readonly value="<?= $agamaAyah; ?>" class="form-control" name="agama_ayah_review">
										</div>
										<div class="agamalainayah_review">

											<div class="col-md-3">
												<input type="text" readonly class="form-control" value="<?= $isiAgamaLainAyah; ?>" name="agamalainayah_review" id="agamalainayah">
											</div>
											
										</div>

									<?php endif ?>
									
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_pend_ayah" for="pend_ayah">
										PENDIDIKAN TERAKHIR : 
									</label>
									<div class="col-md-2">
										<input type="text" class="form-control" readonly value="<?= $pendAyah; ?>" name="pend_ayah_review">
									</div>
								</div>

								<?php if ($pekerjaanAyah != "LAINNYA"): ?>
								
									<div class="form-group">
										<label class="col-md-3 control-label" for="pekerjaan_ayah">
											PEKERJAAN :
										</label>
										<div class="col-md-3">
											<?php if ($pekerjaanAyah == "pegawai_pns"): ?>
												<input type="text" readonly class="form-control" value="<?= str_replace(["pegawai_pns"], "PEGAWAI PNS", $pekerjaanAyah); ?>" name="pekerjaan_ayah_review">
											<?php elseif($pekerjaanAyah == "pegawai_bumn"): ?>
												<input type="text" readonly class="form-control" value="<?= str_replace(["pegawai_bumn"], "PEGAWAI BUMN / BUMD", $pekerjaanAyah); ?>" name="pekerjaan_ayah_review">
											<?php elseif($pekerjaanAyah == "karyawan_swasta"): ?>
												<input type="text" readonly class="form-control" value="<?= str_replace(["karyawan_swasta"], "KARYAWAN SWASTA", $pekerjaanAyah); ?>" name="pekerjaan_ayah_review">
											<?php else: ?>
												<input type="text" readonly class="form-control" value="<?= $pekerjaanAyah; ?>" name="pekerjaan_ayah_review">
											<?php endif ?>
										</div>
									</div>

								<?php elseif($pekerjaanAyah == "LAINNYA"): ?>
								
									<div class="form-group">
										<label class="col-md-3 control-label" for="pekerjaan_ayah">
											PEKERJAAN :
										</label>
										<div class="col-md-3">
											<input type="text" class="form-control" readonly value="<?= $pekerjaanAyah; ?>" name="pekerjaan_ayah_review">
										</div>
										<div class="pekerjaanlainayah_review">

											<div class="col-md-3">
												<input type="text" readonly class="form-control" value="<?= $pekerjaanLainAyah; ?>" name="pekerjaanlainayah_review" id="pekerjaanlainayah_review">
											</div>
											
										</div>
									</div>

								<?php endif ?>

								<div class="form-group">
									<label class="col-md-3 control-label" for="alamat_ayah">
										DOMISILI SAAT INI :
									</label>
									<div class="col-md-8">
										<textarea readonly class="form-control" name="alamat_ayah_review" id="alamat_ayah" style="resize:vertical; max-height:150px;"> <?= $alamatAyah; ?> </textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="nomorhpayah">
										NOMOR HANDPHONE :
									</label>
									<div class="col-md-3">
										<input readonly type="text" pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" name="nomorhpayah_review" id="nomorhpayah" value="<?= $noHpAyah; ?>" >
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="temlahir_ayah">
										TAHSIN / BACA AL-QUR'AN AYAH : 
									</label>
									<div class="col-md-3">
										<input type="text" readonly class="form-control" value="<?= $tahsinAyah; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="temlahir_ayah">
										TAHFIDZ / HAFALAN AL-QUR'AN AYAH : 
									</label>
									<div class="col-md-3">
										<input type="text" readonly class="form-control" value="<?= $tahfidzAyah; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div>

								<hr>

								<div class="form-group">
									<label class="col-md-3 control-label" for="nama_ibu">
										NAMA IBU :
									</label>
									<div class="col-md-8">
										<input type="text" readonly value="<?= $namaIbu; ?>" class="form-control" name="nama_ibu_review" id="nama_ibu">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="temlahir_ibu">
										TEMPAT LAHIR : 
									</label>
									<div class="col-md-3">
										<input type="text" readonly value="<?= $tempatLahirIbu; ?>" class="form-control" name="temlahir_ibu_review" id="temlahir_ibu">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="nama_ibu">
										TANGGAL LAHIR :
									</label>
									<div class="col-md-8">
										<input type="text" readonly value="<?= format_tgl_indo($tanggalLahirIbu); ?>" class="form-control" name="nama_ibu_review" id="nama_ibu">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_agama_ibu" for="agama_ibu">
										AGAMA :
									</label>
									<?php if ($agamaIbu == "ISLAM"): ?>
										<div class="col-md-2">
											<input type="text" readonly value="<?= $agamaIbu; ?>" class="form-control" name="agama_ibu_review">
										</div>
									<?php elseif($agamaIbu == "LAINNYA"): ?>

										<div class="col-md-2">
											<input type="text" readonly value="<?= $agamaIbu; ?>" class="form-control" name="agama_ibu_review">
										</div>
										<div class="agamalainiibu_review">

											<div class="col-md-3">
												<input type="text" readonly class="form-control" value="<?= $isiAgamaLainIbu; ?>" name="agamalainibu_review" id="agamalainibu">
											</div>
											
										</div>

									<?php endif ?>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_pend_ibu" for="pend_ibu">
										PENDIDIKAN TERAKHIR : 
									</label>
									<div class="col-md-2">
										<input type="text" class="form-control" readonly value="<?= $pendIbu; ?>" name="pend_ibu_review">
									</div>
								</div>

								<?php if ($pekerjaanIbu != "LAINNYA"): ?>

									<div class="form-group">
										<label class="col-md-3 control-label" for="pekerjaan_ayah">
											PEKERJAAN :
										</label>
										<div class="col-md-3">
											<?php if ($pekerjaanIbu == "pegawai_pns"): ?>
												<input type="text" readonly class="form-control" value="<?= str_replace(["pegawai_pns"], "PEGAWAI PNS", $pekerjaanIbu); ?>" name="pekerjaan_ibu_review">
											<?php elseif($pekerjaanIbu == "pegawai_bumn"): ?>
												<input type="text" readonly class="form-control" value="<?= str_replace(["pegawai_bumn"], "PEGAWAI BUMN / BUMD", $pekerjaanIbu); ?>" name="pekerjaan_ibu_review">
											<?php elseif($pekerjaanIbu == "karyawan_swasta"): ?>
												<input type="text" readonly class="form-control" value="<?= str_replace(["karyawan_swasta"], "KARYAWAN SWASTA", $pekerjaanIbu); ?>" name="pekerjaan_ibu_review">
											<?php else: ?>
												<input type="text" readonly class="form-control" value="<?= $pekerjaanIbu; ?>" name="pekerjaan_ibu_review">
											<?php endif ?>
										</div>
									</div>

								<?php elseif($pekerjaanIbu == "LAINNYA"): ?>
								
									<div class="form-group">
										<label class="col-md-3 control-label" for="pekerjaan_ayah">
											PEKERJAAN :
										</label>
										<div class="col-md-3">
											<input type="text" class="form-control" readonly value="<?= $pekerjaanIbu; ?>" name="pekerjaan_ibu_review">
										</div>
										<div class="pekerjaanlainibu_review">

											<div class="col-md-3">
												<input type="text" readonly class="form-control" value="<?= $pekerjaanLainIbu; ?>" name="pekerjaanlainibu_review" id="pekerjaanlainayah_review">
											</div>
											
										</div>
									</div>

								<?php endif ?>

								<div class="form-group">
									<label class="col-md-3 control-label" for="alamat_ibu">
										DOMISILI SAAT INI :
									</label>
									<div class="col-md-8">
										<textarea readonly class="form-control" name="alamat_ibu_review" id="alamat_ibu" style="resize:vertical; max-height:150px;"> <?= $alamatIbu; ?> </textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="nomorhpibu">
										NOMOR HANDPHONE :
									</label>
									<div class="col-md-3">
										<input readonly type="text" pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" name="nomorhpibu_review" id="nomorhpibu" value="<?= $noHpIbu; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="temlahir_ayah">
										TAHSIN / BACA AL-QUR'AN IBU : 
									</label>
									<div class="col-md-3">
										<input type="text" readonly class="form-control" value="<?= $tahsinIbu; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="temlahir_ayah">
										TAHFIDZ / HAFALAN AL-QUR'AN IBU : 
									</label>
									<div class="col-md-3">
										<input type="text" readonly class="form-control" value="<?= $tahfidzIbu; ?>" name="temlahir_ayah_review" id="temlahir_ayah">
									</div>
								</div>

								<div class="form-group">
									
									<label class="col-md-12 control-label"> PENGHASILAN ORANG TUA / WALI CALON MURID PER BULAN : </label>
									<br>
									<div class="col-md-3">
										<input type="text" readonly class="form-control" value="<?= $penghasilanOrtu; ?>" name="pendapatan_ortu_review">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-12 control-label" for="nomorhpibu">
										APAKAH ADA RENCANA UNTUK MUTASI/PINDAH KE LUAR KOTA (dalam 1-3 tahun kedepan) :
									</label>
									<div class="col-md-3" id="mts">
										<input type="text" class="form-control" disabled value="ADA" name="">
									</div>
								</div>

								<?php if ($mutasi != "TIDAK ADA RENCANA UNTUK MUTASI"): ?>
									
									<div class="form-group">
										<label class="col-md-12 control-label" for="nomorhpibu">
											APAKAH INI KEWAJIBAN DARI INSTANSI/PERUSAHAAN :
										</label>
										<div class="col-md-10" id="mts">
											<textarea class="form-control" style="height: 125px;" disabled>
												<?= $mutasi; ?>
											</textarea>
										</div>
									</div>

								<?php else: ?>

									<div class="form-group">
										<label class="col-md-12 control-label" for="nomorhpibu">
											APAKAH INI KEWAJIBAN DARI INSTANSI/PERUSAHAAN :
										</label>
										<div class="col-md-10" id="mts">
											<input type="text" class="form-control" disabled value="<?= $mutasi; ?>" name="">
										</div>
									</div>
									
								<?php endif ?>

								<div class="form-group" id="infaq">
									<label class="col-md-12" style="text-align: justify; text-justify: inter-word;">  
										<?= strtoupper("Bersedia berinfaq untuk membantu proses pembangunan dan perawatan Gedung serta Fasilitas Sekolah sesuai kadar kesanggupan");?> :
									</label>
								</div>

								<div class="form-group" id="rp">
									<label class="col-md-3 control-label">
										Rp :
									</label>
									<div class="col-md-3" id="iptrp">
										<input type="text" required disabled value="<?= $infaq; ?>" class="form-control" name="nominal_infaq" id="nominal_infaq">
									</div>
								</div>

								<div class="form-group" id="terbilang">
									<label class="col-md-3 control-label">
										Terbilang :
									</label>
									<div class="col-md-8">
										<input type="text" required disabled class="form-control" name="nominal_terbilang" value="<?= $terbilang; ?>">
									</div>
								</div>

								<hr>

								<label id="labelpernyataan"> PERNYATAAN ORANG TUA / WALI CALON MURID </label>

								<div class="utk_pernyataan">
									<p id="pernyataan">  
									Bahwa segala Peraturan dan Ketentuan pada Penerimaan Peserta Didik Baru (PPDB) Akhyar International, termasuk Pernyataan sebagai berikut :

									<ol>
									  <li>Orang Tua / Wali Calon Murid bagi yang dinyatakan lolos TAHAP 1 (ONLINE), akan diinformasikan melakukan PENDAFTARAN TAHAP 2 (OFFLINE) dan akan dihubungi oleh Tim Administrasi untuk siap menyelesaikan Biaya Registrasi (Formulir Pendaftaran).</li>
									  <li>Orang Tua/Wali Calon Murid wajib menyelesaikan Biaya Masuk (Uang Pangkal) sebesar minimal 50%, 15 hari setelah murid dinyatakan diterima, dilanjutkan sisa nya pada waktu yang telah ditentukan. Jika tidak maka murid dianggap mengundurkan diri.</li>
									  <li>Orang Tua Calon murid Siap Menerima keputusan dari Panitia penerimaan murid baru tanpa syarat apapun.</li>
									  <li> Orang Tua / Wali Calon Murid menyetujui tanpa syarat bahwa dalam kondisi siswa yang dinyatakan diterima kemudian mengundurkan diri, maka seluruh biaya yang telah dibayarkan dinilai sebagai infaq untuk sekolah yang tidak dapat dikembalikan atau dipindahkan ke calon murid lain, atau diundur ke tahun berikutnya dalam kondisi atau alasan apapun. </li>
									  <li> Orang Tua / Wali Calon Murid, bersedia berinfaq dan berkomitmen untuk membantu proses pembangunan dan perawatan Gedung serta Fasilitas Sekolah sesuai kesanggupan. </li>
									</ol>

									</p>

									<p id="pernyataan">
										Setelah membaca dan meneliti dengan seksama, dengan ini saya menyatakan mengikuti Peraturan - Ketentuan Panitia PPDB dan pernyataan tersebut diatas dengan sebenarnya dan sejujurnya, ikhlas tanpa tekanan dan paksaan dari pihak manapun, untuk dapat digunakan sebagaimana mestinya.
									</p>

								</p>

								</div>

								<br>

							</div>

						</form>
					</div>

		    	</div>
	    	</div>
		</div>

<?php endif ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
	
	let is_session = `<?= $sesi; ?>`;

	$(document).ready(function(){
		if (is_session != 0) {

			setTimeout(() => {
				window.print();
			}, 1500);

		} else if (is_session == 0) {

			setTimeout(() => {
				location.href = `<?= $basead; ?>`
			}, 1000);

		}
	});

</script>