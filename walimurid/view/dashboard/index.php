<?php 

	$timeOut        = $_SESSION['expire'];
    
  	$timeRunningOut = time() + 5;

  	$timeIsOut 		= 0;

  	$tampungDataNis = [];
  	$tampungDataPw 	= [];
  	$no 			= 1;

  	$nis            = $_SESSION['c_otm'];

  	$kelas_siswa    = $_SESSION['bag_siswa'];

  	$siswa_sd      	= "/SD/i";

    $foundDataSD    = preg_match($siswa_sd, $kelas_siswa);

    $nipkepsek      = "";

    if ($foundDataSD == 1) {
    	$nipkepsek = "2019032";
    } else {
      	$nipkepsek = "2019034";
    }

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
	    $jamIndo = date_format($tanggal_indo, "H:i:s");
	    // echo $jamIndo;
	    $result = $tanggal ." ". $bulan ." ". $tahun . " " . $jamIndo;       
	    return($result);  
	}

  	// echo "Waktu Habis : " . $timeOut . " Waktu Berjalan : " . $timeRunningOut;

  	if ($timeRunningOut == $timeOut || $timeRunningOut > $timeOut) {

	    $_SESSION['form_success'] = "session_time_out";

	    $timeIsOut = 1;
	    error_reporting(1);
	      // exit;

	 } else {

	 	date_default_timezone_set("Asia/Jakarta");
	  	$arrTgl               = [];
		  
	  	$tglSkrngAwal         = date("Y-m-d") . " 00:00:00";
	  	$tglSkrngAkhir        = date("Y-m-d") . " 23:59:59";

	 	$queryGetDataActSiswa = mysqli_query($con, "
	 		SELECT 
	 		guru.nip as nip_guru,
	 		guru.nama as nama_guru,
	 		siswa.nis as nis_siswa,
	 		siswa.nama as nama_siswa,
	 		ruang_pesan.room_key as room_key,
	 		daily_siswa_approved.title_daily as judul_daily,
	 		daily_siswa_approved.isi_daily as isi_daily,
	 		daily_siswa_approved.tanggal_disetujui_atau_tidak as tanggal_disetujui_atau_tidak,
	 		daily_siswa_approved.image as foto_upload
	 		FROM daily_siswa_approved
	 		LEFT JOIN guru
	 		ON daily_siswa_approved.from_nip = guru.nip
	 		LEFT JOIN siswa
	 		ON daily_siswa_approved.nis_siswa = siswa.nis
	 		LEFT JOIN ruang_pesan
	 		ON daily_siswa_approved.id = ruang_pesan.daily_id
	 		WHERE daily_siswa_approved.nis_siswa = '$nis'
	 		AND daily_siswa_approved.stamp >= '$tglSkrngAwal' AND daily_siswa_approved.stamp <= '$tglSkrngAkhir'
	 		AND daily_siswa_approved.status_approve = 1
	 		ORDER BY daily_siswa_approved.tanggal_dibuat DESC
	 	");

	 // 	foreach ($queryGetDataActSiswa as $data) {
		//  	$tampungDataNis[] = $data['nis_siswa'];
		//  	$tampungDataPw[]  = $data['password'];
		// }

	 // 	$queryGetGuru = mysqli_query($con, "SELECT nama FROM guru ");

	 }

?>

<div class="box box-info">

	<div class="box-header with-border">
      <h3 class="box-title" id="boxTitle"> <i class="glyphicon glyphicon-th-large"></i> <span style="margin-left: 10px; font-weight: bold;"> DASHBOARD </span> </h3>
    </div>

    <center> 
    	<h4 id="judul_daily">
    		Today's <strong> <?= $_SESSION['username_otm']; ?> </strong> Activity From Teacher
    	</h4> 
    </center>

  	<div class="box-body table-responsive">

	    <table id="list_siswa" class="table table-bordered table-hover">
	      <thead>
	        <tr style="background-color: lightyellow;">
	          <th style="text-align: center;" width="5%">NO</th>
	          <th style="text-align: center;"> FROM TEACHER </th>
	          <th style="text-align: center;"> ACTIVITY TITLE </th>
	          <th style="text-align: center;"> DATE POSTED </th>
	        </tr>
	      </thead>

	      <tbody>

	      	<?php foreach ($queryGetDataActSiswa as $act_siswa): ?>
	      		
	      		<tr id="tr_dashboard" style="text-align: center; background-color: aliceblue;" onclick="showDataOTM(
	      			`<?= $act_siswa['room_key']; ?>`,
	      			`<?= $act_siswa['tanggal_disetujui_atau_tidak']; ?>`,
	      			`<?= format_tgl_indo($act_siswa['tanggal_disetujui_atau_tidak']); ?>`,
	      			`<?= $act_siswa['nip_guru']; ?>`,
	      			`<?= strtoupper($act_siswa['nama_guru']); ?>`,
	      			`<?= strtoupper($act_siswa['nama_siswa']); ?>`,
	      			`<?= $act_siswa['nis_siswa']; ?>`,
	      			`<?= $act_siswa['foto_upload']; ?>`,
	      			`<?= $act_siswa['judul_daily']; ?>`,
	      			`<?= $act_siswa['isi_daily']; ?>`,
	      			`<?= $nipkepsek; ?>`
	      		)">
		        	<td> <?= $no++; ?> </td>
		        	<td> <?= strtoupper($act_siswa['nama_guru']); ?> </td>
		        	<td> <?= $act_siswa['judul_daily']; ?> </td>
		        	<td> <?= format_tgl_indo($act_siswa['tanggal_disetujui_atau_tidak']); ?> </td>
		        </tr>

	      	<?php endforeach ?>
		        
	      </tbody>

	    </table>
  	</div>

</div>

<script type="text/javascript">
	
	function showDataOTM(roomKey, dateOri, datePosted, nipguru, guru, siswa, nis, photo, title, desc, kepsek) {

		$("#modal-hg-appr").modal('show');

		$("#hg_tanggal_upload_appr").val(datePosted);
		$("#hg_pengirim_appr").val(guru);
		$("#hg_siswa_daily_appr").val(siswa)
		$("#thg_itle_daily_appr").val(title);
		$("#hg_main_daily_appr").html(desc)

		let image     = document.querySelector("img[id='hg_foto_upload_appr']");
		image.setAttribute("src", `../image_uploads/${photo}`);

		$("#hg_nama_guru_lookdaily").val(guru);
		$("#hg_nis_siswa_lookdaily").val(nis);
		$("#hg_nama_siswa_lookdaily").val(siswa);
		$("#hg_foto_upload_lookdaily").val(photo);
		$("#hg_tgl_posting").val(datePosted);
		$("#hg_jdl_posting_lookdaily").val(title);
		$("#hg_isi_posting_lookdaily").val(desc);
		$("#hg_title_daily_appr").val(title);
		$("#hg_roomkey_lookdaily").val(roomKey);
		$("#hg_tglori_posting_lookdaily").val(dateOri);
		$("#hg_nip_guru_lookdaily").val(nipguru);
		$("#hg_nip_kepsek_lookdaily").val(kepsek)

	}

	$(document).ready(function(){

		$("#dashboard").css({
	      "background-color" : "#ccc",
	      "color" : "black"
	  	});

	})

</script>