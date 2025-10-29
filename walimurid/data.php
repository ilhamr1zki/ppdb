<?php  
	
	require '../php/config.php'; 
  	require '../php/function.php';

  	// Cek status login user jika tidak ada session
  	if (!$user->isLoggedInOTM()) { 
		header("location:../"); //Redirect ke halaman login  
  	}

  	function getDateTimeDiff($tanggal) {
    
	    date_default_timezone_set("Asia/Jakarta");
	    $now_timestamp = strtotime(date('Y-m-d H:i:s'));
	    $diff_timestamp = $now_timestamp - strtotime($tanggal);

	    if ($diff_timestamp < 60) {
	      return 'Beberapa detik yang lalu';
	    } else if ( $diff_timestamp >= 60 && $diff_timestamp < 3600 ) {
	      return round($diff_timestamp/60) . ' Menit yang lalu';
	    } else if ( $diff_timestamp >= 3600 && $diff_timestamp < 86400 ) {
	      return round($diff_timestamp/3600) . ' Jam yang lalu';
	    } else if ( $diff_timestamp >= 86400 && $diff_timestamp < (86400*30) ) {
	      return round($diff_timestamp/(86400)). ' Hari yang lalu';
	    } else if ( $diff_timestamp >= (86400*30) && $diff_timestamp < (86400*365) ) {
	      return round($diff_timestamp/(86400*30)) . ' Bulan yang lalu';
	    } else {
	      return round($diff_timestamp/(86400*365)) . ' Tahun yang lalu';
	    }

  	}

  	function tgl_indo($date){  
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
	    $result = $tanggal ." ". $bulan ." ". $tahun;       
	    return($result);  
  	}

  	function rupiahFormat($angkax){
    
        $hasil_rupiahx = "Rp " . number_format($angkax,0,'.','.');
        return $hasil_rupiahx;
     
    }

  	$arr                  = [];
  	$status_approve       = "";
  	$forIsiNotifSdhAppr   = "";
  	$isiStatusDaily       = "";
  	$isiPesan             = '';
  
  	if (isset($_POST['room_id'])) {
        
	    $room_id = $_POST['room_id'];
	    $users   = $_POST['users'];

	    $getDataChatOther = mysqli_query($conn, "
	      SELECT 
	      tbl_komentar.room_id as r_id,
	      tbl_komentar.code_user as nip_guru,
	      guru.nama as nama_guru,
	      tbl_komentar.stamp as tanggal_kirim,
	      tbl_komentar.isi_komentar as pesan
	      FROM 
	      tbl_komentar 
	      LEFT JOIN ruang_pesan
	      ON tbl_komentar.room_id = ruang_pesan.room_key
	      LEFT JOIN guru
	      ON tbl_komentar.code_user = guru.nip
	      WHERE 
	      ruang_pesan.room_key LIKE '%$room_id%'
	      ORDER BY tbl_komentar.id
	    ");

	    $getDataFrom_MySelf = mysqli_query($conn, "
	      SELECT 
	      room_key as r_key,
	      tbl_komentar.room_id as room_id,
	      tbl_komentar.isi_komentar as pesan,
	      tbl_komentar.code_user as from_pesan,
	      tbl_komentar.stamp as tanggal_kirim,
	      guru.nama as nama_guru
	      FROM 
	      ruang_pesan
	      LEFT JOIN tbl_komentar
	      ON tbl_komentar.room_id = ruang_pesan.room_key
	      LEFT JOIN guru
	      ON tbl_komentar.code_user = guru.nip
	      WHERE 
	      ruang_pesan.room_key LIKE '%$room_id%'
	      ORDER BY tbl_komentar.id
	    ");

	    $getDataAll   = mysqli_fetch_array($getDataChatOther);
	    $getDataSelf  = mysqli_fetch_array($getDataFrom_MySelf);

	    $count        = mysqli_num_rows($getDataChatOther);
	    $fromAll      = [];
	    $fromMe       = [];
	    $pesanSemua   = [];
	    $pesanSaya    = [];

	    foreach ($getDataChatOther as $all_data) {

	      $fromAll[] = $all_data['nama_guru'];

	      if ($all_data['nip_guru'] == $users) {
	        
	        $pesanSemua[] = '
	        <div class="direct-chat-msg right">
	          <div class="direct-chat-info clearfix">
	            <span class="direct-chat-name pull-right">'. $all_data['nama_guru'] .'</span>
	            <span class="direct-chat-timestamp pull-left">'. format_tgl_indo($all_data['tanggal_kirim']) . '</span>
	          </div>
	          <img class="direct-chat-img" src="'. $base . 'theme/dist/img/icon_chat.png'. '" alt="Message User Image">
	          <div class="direct-chat-text">'. htmlspecialchars($all_data['pesan']) .'</div>
	          </div>
	        </div>';



	      } else {
	        $pesanSemua[] = '
	          <div class="direct-chat-msg">
	            <div class="direct-chat-info clearfix">
	              <span class="direct-chat-name pull-left">'. $all_data['nama_guru'] .'</span>
	              <span class="direct-chat-timestamp pull-right">'. format_tgl_indo($all_data['tanggal_kirim']) .'</span>
	            </div>
	            <img class="direct-chat-img" src="'. $base . 'theme/dist/img/icon_chat.png'. '" alt="Message User Image">
	            <div class="direct-chat-text">'. htmlspecialchars($all_data['pesan']) .'</div>
	          </div>';
	      }

	    }

	    foreach ($getDataFrom_MySelf as $myself) {
	      $fromMe[]  = $myself['nama_guru'];
	      $pesanSaya[] = '
	        <div class="direct-chat-msg right">
	          <div class="direct-chat-info clearfix">
	            <span class="direct-chat-name pull-right">'. $myself['nama_guru'] .'</span>
	            <span class="direct-chat-timestamp pull-left">'. format_tgl_indo($myself['tanggal_kirim']) . '</span>
	          </div>
	          <img class="direct-chat-img" src="'. $base . 'theme/dist/img/icon_chat.png'. '" alt="Message User Image">
	          <div class="direct-chat-text">'. htmlspecialchars($myself['pesan']) .'</div>
	          </div>
	        </div>'
	      ;
	    }

	    for ($i=0; $i < count($pesanSemua); $i++) { 
	      $arrOther[] = $pesanSemua[$i];
	    }

	    for ($i=0; $i < count($pesanSaya); $i++) { 
	      $arrMe[] = $pesanSaya[$i];
	    }    

  	}

  	$execQueryAppr        = '';

  	$dataFound            = '';
  	$nis                  = $_SESSION['c_otm'];

  	date_default_timezone_set("Asia/Jakarta");
  	$tglSkrngAwal         = date("Y-m-d") . " 00:00:00";
  	$tglSkrngAkhir        = date("Y-m-d") . " 23:59:59";

  	$arrTgl['tgl_awal']   = $tglSkrngAwal;
  	$arrTgl['tgl_akhir']  = $tglSkrngAkhir;

  	// Array Penampung Data Sudah di Approve
  	  $tampungDataTglUploadOri      = [];
  	  $tampungDataRoomKey           = [];
	  $tampungDataID_sdhAppr        = [];
	  $tampungDataNIP_sdhAppr       = [];
	  $tampungDataGuru_sdhAppr      = [];
	  $tampungDataPengirim_sdhAppr  = [];
	  $tampungDataUsername_sdhAppr  = [];
	  $tampungDataTglDisetujui      = [];
	  $tampungDataTglUpload_sdhAppr = [];
	  $tampungDataJamUpload_sdhAppr = [];
	  $tampungDataJamDisetujui      = [];
	  $tampungDataImage_sdhAppr     = [];
	  $tampungDataNis_siswa_sdhAppr = [];
	  $tampungDataJudul_sdhAppr     = [];
	  $tampungDataIsi_sdhAppr       = [];
	  $elementNotifAppr             = '';
  	// Akhir Array Penampung Data Sudah di Approve


	############################################################################################################
	// Data Sudah di Approve

    	$queryApproved         = mysqli_query($con, "
	      SELECT
	      daily_siswa_approved.id as daily_id,
	      daily_siswa_approved.from_nip as from_nip,
	      daily_siswa_approved.image as foto,
	      daily_siswa_approved.isi_daily as isi_daily,
	      daily_siswa_approved.nis_siswa as nis_siswa,
	      guru.nama as nama_guru,
	      guru.username as username_guru,
	      admin.username as nama_user,
	      siswa.nama as nama_siswa,
	      daily_siswa_approved.status_approve as status,
	      daily_siswa_approved.title_daily as judul,
	      daily_siswa_approved.tanggal_dibuat as tgl_dibuat,
	      daily_siswa_approved.tanggal_disetujui_atau_tidak as tgl_disetujui,
	      ruang_pesan.room_key as room_key
	      FROM 
	      daily_siswa_approved 
	      LEFT JOIN guru
	      ON daily_siswa_approved.from_nip = guru.nip
	      LEFT JOIN admin
	      ON daily_siswa_approved.from_nip = admin.c_admin
	      LEFT JOIN siswa
	      ON daily_siswa_approved.nis_siswa = siswa.nis
	      LEFT JOIN ruang_pesan
	      ON daily_siswa_approved.id = ruang_pesan.daily_id
	      WHERE daily_siswa_approved.status_approve = 1
	      AND daily_siswa_approved.nis_siswa = '$nis'
	      AND daily_siswa_approved.tanggal_disetujui_atau_tidak >= '$arrTgl[tgl_awal]' AND daily_siswa_approved.tanggal_disetujui_atau_tidak <= '$arrTgl[tgl_akhir]'
	      ORDER BY daily_siswa_approved.tanggal_disetujui_atau_tidak DESC
    	");

    	$queryApprovedAll      = mysqli_query($con, "
	      SELECT
	      daily_siswa_approved.id as daily_id,
	      daily_siswa_approved.from_nip as from_nip,
	      daily_siswa_approved.image as foto,
	      daily_siswa_approved.isi_daily as isi_daily,
	      daily_siswa_approved.nis_siswa as nis_siswa,
	      guru.nama as nama_guru,
	      admin.username as nama_user,
	      siswa.nama as nama_siswa,
	      daily_siswa_approved.status_approve as status,
	      daily_siswa_approved.title_daily as judul,
	      daily_siswa_approved.tanggal_dibuat as tgl_dibuat,
	      daily_siswa_approved.tanggal_disetujui_atau_tidak as tgl_disetujui
	      FROM 
	      daily_siswa_approved 
	      LEFT JOIN guru
	      ON daily_siswa_approved.from_nip = guru.nip
	      LEFT JOIN admin
	      ON daily_siswa_approved.from_nip = admin.c_admin
	      LEFT JOIN siswa
	      ON daily_siswa_approved.nis_siswa = siswa.nis
	      WHERE daily_siswa_approved.status_approve = 1
	      AND daily_siswa_approved.nis_siswa = '$nis'
	      ORDER BY daily_siswa_approved.tanggal_disetujui_atau_tidak DESC
    	");

    	foreach ($queryApproved as $data_appr) {

    	  $tampungDataTglUploadOri[]      = $data_appr['tgl_disetujui'];
    	  $tampungDataRoomKey[] 		  = $data_appr['room_key'];
	      $tampungDataID_sdhAppr[]        = $data_appr['daily_id'];
	      $tampungDataNIP_sdhAppr[]       = $data_appr['from_nip'];
	      $tampungDataNis_siswa_sdhAppr[] = $data_appr['nis_siswa'];
	      $tampungDataUsername_sdhAppr[]  = strtoupper($data_appr['username_guru']);
	      $tampungDataSiswa_sdhAppr[]     = strtoupper($data_appr['nama_siswa']);
	      $tampungDataPengirim_sdhAppr[]  = $data_appr['nama_guru'];
	      $tampungDataTglDiUpload[]       = substr($data_appr['tgl_dibuat'], 0, 11);
	      $tampungDataTglDisetujui[]      = substr($data_appr['tgl_disetujui'], 0, 11);
	      $tampungDataJamDiUpload[]       = substr($data_appr['tgl_dibuat'], 11, 19);
	      $tampungDataJamDisetujui[]      = substr($data_appr['tgl_disetujui'], 11, 19);
	      $tampungDataImage_sdhAppr[]     = $data_appr['foto'];
	      $tampungDataJudul_sdhAppr[]     = $data_appr['judul'];
	      $tampungDataIsi_sdhAppr[]       = $data_appr['isi_daily'];

    	}

      	$countDataApproved    = mysqli_num_rows($queryApproved);
	    $countDataApprovedAll = mysqli_num_rows($queryApprovedAll);

	    if($countDataApproved > 5) {

	      for ($i = 0; $i < 5; $i++) {

	        $explode                = explode(" ", $tampungDataPengirim_sdhAppr[$i]);
	        $isiPesanNamaSiswa      = "";
	        $isiPesan               = "";
	        
	        $semuaNamaSiswa = strlen($tampungDataSiswa_sdhAppr[$i]) > 13 ? $isiPesanNamaSiswa .= substr($tampungDataSiswa_sdhAppr[$i], 0, 13) . " ..." : $tampungDataSiswa_sdhAppr[$i];
	        $semuaPesan = strlen($tampungDataJudul_sdhAppr[$i]) > 15 ? $isiPesan .= substr($tampungDataJudul_sdhAppr[$i], 0, 15) . " ..." : $tampungDataJudul_sdhAppr[$i];

	        $forIsiNotifSdhAppr .= '
	          	<li class="apprlist" data-nip_guru="'. $tampungDataNIP_sdhAppr[$i] .'" data-tgl_ori="'. $tampungDataTglUploadOri[$i] .'" data-room_key="'. $tampungDataRoomKey[$i] .'" data-username_guru = "'. $tampungDataUsername_sdhAppr[$i] .'" data-nis_siswa_was_appr="'. $tampungDataNis_siswa_sdhAppr[$i] .'" data-nama_guru_lengkap="'. $tampungDataPengirim_sdhAppr[$i] .'" data-pengirim="'. $explode[0] .'" data-siswa_was_appr="'. $tampungDataSiswa_sdhAppr[$i] .'" data-tgl_upload = "'. tgl_indo($tampungDataTglDisetujui[$i]) . " " . $tampungDataJamDisetujui[$i] . '" data-tgl_approved ="'. tgl_indo($tampungDataTglDisetujui[$i]) . " " . $tampungDataJamDisetujui[$i] .'" data-img="'. $tampungDataImage_sdhAppr[$i] .'" data-judul="'. $tampungDataJudul_sdhAppr[$i] .'" data-isian="'. $tampungDataIsi_sdhAppr[$i] .'" data-toggle="modal">
	            	<a href="#">
		              	<h4 style="font-size: 12px;">
		                	<small style="font-size: 12px;float: right;margin-top: -13px;"> <i class="fa fa-clock-o" style="margin-right: 5px;"></i>'. getDateTimeDiff($tampungDataTglDisetujui[$i]." ".$tampungDataJamDisetujui[$i]) . '</small>
		              	</h4>
			            <div class="pull-left" style="margin-left: 10px; margin-top: 15px;">
			                <img src="../imgstatis/logo2.png" style="width: 35px;">
			            </div>
		              	<h4 style="font-size: 12px; margin-top: 24px;">
	                  		<p style="font-size: 13px;margin-left: 60px;"> <strong> FROM </strong> <span style="margin-left: 15px;"> : </span> <strong id="from_daily" style="margin-left: 7px;">'. $tampungDataUsername_sdhAppr[$i] . '</strong> </p>
	                  	</h4>
		              	<h4 style="font-size: 12px;">
		                	<p style="font-size: 13px;margin-left: 59px;"> 
			                  	<strong> JUDUL </strong> <span style="margin-left: 4px;"> : </span> 
			                  	<strong id="title_daily" style="margin-left: 7px;"> 
			                    '. $semuaPesan .'
			                  	</strong> 
		                	</p>
		              	</h4>
		            </a>
	          	
	          	</li>
	        ';

	      }

	    } else if ($countDataApproved < 6) {

	      for ($i = 0; $i < $countDataApproved; $i++) {

	        $explode                = explode(" ", $tampungDataPengirim_sdhAppr[$i]);

	        $isiNamaSiswa      		= "";
	        $isiNamaGuru      		= "";
	        $isiPesan               = "";
	        
	        $semuaNamaSiswa = strlen($tampungDataSiswa_sdhAppr[$i]) > 13 ? $isiNamaSiswa .= substr($tampungDataSiswa_sdhAppr[$i], 0, 13) . " ..." : $tampungDataSiswa_sdhAppr[$i];
	        $semuaNamaGuru  = strlen($tampungDataPengirim_sdhAppr[$i]) > 17 ? $isiNamaGuru .= substr($tampungDataPengirim_sdhAppr[$i], 0, 17) . " ..." : $tampungDataPengirim_sdhAppr[$i];
	        $semuaPesan = strlen($tampungDataJudul_sdhAppr[$i]) > 17 ? $isiPesan .= substr($tampungDataJudul_sdhAppr[$i], 0, 17) . " ..." : $tampungDataJudul_sdhAppr[$i];

	        $forIsiNotifSdhAppr .= '
	          	<li class="apprlist" data-nip_guru="'. $tampungDataNIP_sdhAppr[$i] .'" data-tgl_ori="'. $tampungDataTglUploadOri[$i] .'" data-room_key="'. $tampungDataRoomKey[$i] .'" data-username_guru = "'. $tampungDataUsername_sdhAppr[$i] .'" data-nis_siswa_was_appr="'. $tampungDataNis_siswa_sdhAppr[$i] .'" data-nama_guru_lengkap="'. $tampungDataPengirim_sdhAppr[$i] .'" data-pengirim="'. $explode[0] .'" data-siswa_was_appr="'. $tampungDataSiswa_sdhAppr[$i] .'" data-tgl_upload = "'. tgl_indo($tampungDataTglDisetujui[$i]) . " " . $tampungDataJamDisetujui[$i] . '" data-tgl_approved ="'. tgl_indo($tampungDataTglDisetujui[$i]) . " " . $tampungDataJamDisetujui[$i] .'" data-img="'. $tampungDataImage_sdhAppr[$i] .'" data-judul="'. $tampungDataJudul_sdhAppr[$i] .'" data-isian="'. $tampungDataIsi_sdhAppr[$i] .'" data-toggle="modal">
	            	<a href="#">
		              	<h4 style="font-size: 12px;">
		                	<small style="font-size: 12px;float: right;margin-top: -13px;"> <i class="fa fa-clock-o" style="margin-right: 5px;"></i>'. getDateTimeDiff($tampungDataTglDisetujui[$i]." ".$tampungDataJamDisetujui[$i]) . '</small>
		              	</h4>
			            <div class="pull-left" style="margin-left: 10px; margin-top: 15px;">
			                <img src="../imgstatis/logo2.png" style="width: 35px;">
			            </div>
		              	<h4 style="font-size: 12px; margin-top: 24px;">
	                  		<p style="font-size: 13px;margin-left: 60px;"> <strong> FROM </strong> <span style="margin-left: 15px;"> : </span> <strong id="from_daily" style="margin-left: 7px;">'. $semuaNamaGuru . '</strong> </p>
	                  	</h4>
		              	<h4 style="font-size: 12px;">
		                	<p style="font-size: 13px;margin-left: 59px;"> 
			                  	<strong> JUDUL </strong> <span style="margin-left: 10px;"> : </span> 
			                  	<strong id="title_daily" style="margin-left: 7px;"> 
			                    '. $semuaPesan .'
			                  	</strong> 
		                	</p>
		              	</h4>
		            </a>
	          	
	          	</li>
	        ';

	      }

	    }

    // Akhir Data Sudah di Approve
    ############################################################################################################

	##############################
  	// Data All Info 

	  	$forIsiNotifInfo 	= '';
	  	$dataArrNIS 		= [];
	  	$dataArrNama 		= [];
	  	$dataArrJenisBayar	= [];
	  	$dataArrKetBayar    = [];
	  	$dataArrNominalByr  = [];
	  	$dataArrTglDibuat   = [];
	  	$dataArrJamDibuat   = [];

		$jumlahDataInfo     = 0;

	  	$dataAllInfo = mysqli_query($con, "
		  	SELECT 
		  	info_pengumuman_pembayaran.jenis_info_pembayaran as jenis_bayar,
		  	info_pengumuman_pembayaran.keterangan as ket_bayar,
		  	info_pengumuman_pembayaran.tanggal_dibuat as tgl_dibuat,
		  	info_pengumuman_pembayaran.nis as nis_siswa,
		  	info_pengumuman_pembayaran.nominal as nominal,
		  	siswa.nama as nama_siswa
		  	FROM info_pengumuman_pembayaran
		  	LEFT JOIN siswa
		  	ON info_pengumuman_pembayaran.nis = siswa.nis
		  	WHERE 
		  	info_pengumuman_pembayaran.nis = '$nis' 
			AND 
		  	info_pengumuman_pembayaran.status_pembayaran = 0 
		  	OR
		  	info_pengumuman_pembayaran.status_pembayaran IS NULL
		  	ORDER BY info_pengumuman_pembayaran.tanggal_dibuat DESC
	  	");

  		foreach($dataAllInfo as $data) {

		  	$dataArrNIS[]         	= $data['nis_siswa'];
		  	$dataArrNama[] 			= strtoupper($data['nama_siswa']);
		  	$dataArrJenisBayar[] 	= $data['jenis_bayar'];
		  	$dataArrKetBayar[]    	= $data['ket_bayar'];
		  	$dataArrNominalByr[]  	= $data['nominal'];
		  	$dataArrTglDibuat[]   	= substr($data['tgl_dibuat'], 0, 11);
		  	$dataArrJamDibuat[]   	= substr($data['tgl_dibuat'], 11, 19);
  		}

  		$jumlahDataInfo = count($dataArrNama);

  		if ($jumlahDataInfo > 5) {
  			for ($i = 0; $i < 5; $i++) {

  				// $explode                = explode(" ", $tampungDataPengirim_sdhAppr[$i]);
      			$isiPesanNamaSiswa      = "";
      			$isiPesan               = "";
        
      			$semuaNamaSiswa 		= strlen($dataArrNama[$i]) > 17 ? $isiPesanNamaSiswa .= substr($dataArrNama[$i], 0, 17) . " ..." : $dataArrNama[$i];
      			$semuaPesan 			= strlen($dataArrJenisBayar[$i]) > 13 ? $isiPesan .= substr($dataArrJenisBayar[$i], 0, 13) . " ..." : $dataArrJenisBayar[$i];

      			$forIsiNotifInfo .= '
        			<li class="infolist" data-nominal="'. $dataArrNominalByr[$i] .'" data-nama_siswa="'. $dataArrNama[$i] .'" data-nis_siswa="'. $dataArrNIS[$i] .'" data-tgl_upload = "'. tgl_indo($dataArrTglDibuat[$i]) . " " . $dataArrJamDibuat[$i] . '" data-jenis_byr="'. $dataArrJenisBayar[$i] .'" data-ket_byr="'. $dataArrKetBayar[$i] .'" data-toggle="modal">
	            		<a href="#">
		              		<h4 style="font-size: 12px;">
		                		<small style="font-size: 12px;float: right;margin-top: -13px;"> <i class="fa fa-clock-o" style="margin-right: 5px;"></i>'. getDateTimeDiff($dataArrTglDibuat[$i]." ".$dataArrJamDibuat[$i]) . '</small>
		              		</h4>
		              		<div class="pull-left" style="margin-left: -1px; margin-top: 13px;">
		                		<img src="../imgstatis/logo2.png" style="width: 35px;">
		              		</div>
		              		<h4 style="font-size: 12px; margin-top: 20px;">
		                		<p style="font-size: 15px;margin-left: 45px;"> 
		                  			<strong> SISWA </strong> <span style="margin-left: 6px;"> : </span> 
		                  			<strong id="title_daily" style="margin-left: 7px;"> 
		                    		'. $semuaNamaSiswa .'
		                  			</strong> 
		                		</p>
		              		</h4>
			              	<h4 style="font-size: 12px;">
				                <p style="font-size: 15px;margin-left: 45px;"> 
				                  <strong> INFO </strong> <span style="margin-left: 15.5px;"> : </span> 
				                  <strong id="title_daily" style="margin-left: 7px; font-size: 13px;"> 
				                    '. ' Pembayaran ' . $semuaPesan .'
				                  </strong> 
				                </p>
			              	</h4>
	            		</a>
          			</li>
      			';

  			}

		} elseif ($jumlahDataInfo <= 5) {

		  	for ($i = 0; $i < $jumlahDataInfo; $i++) {

		  		// $explode                = explode(" ", $tampungDataPengirim_sdhAppr[$i]);
		      	$isiPesanNamaSiswa      = "";
		      	$isiPesan               = "";
		        
		      	$semuaNamaSiswa = strlen($dataArrNama[$i]) > 17 ? $isiPesanNamaSiswa .= substr($dataArrNama[$i], 0, 17) . " ..." : $dataArrNama[$i];
		      	$semuaPesan 		= strlen($dataArrJenisBayar[$i]) > 13 ? $isiPesan .= substr($dataArrJenisBayar[$i], 0, 13) . " ..." : $dataArrJenisBayar[$i];

		      	$forIsiNotifInfo .= '
		        	<li class="infolist" data-nominal="'. rupiahFormat($dataArrNominalByr[$i]) .'" data-nama_siswa="'. $dataArrNama[$i] .'" data-nis_siswa="'. $dataArrNIS[$i] .'" data-tgl_upload = "'. tgl_indo($dataArrTglDibuat[$i]) . " " . $dataArrJamDibuat[$i] . '" data-jenis_byr="'. $dataArrJenisBayar[$i] .'" data-ket_byr="'. $dataArrKetBayar[$i] .'" data-toggle="modal">
			            <a href="#">
			              <h4 style="font-size: 12px;">
			                <small style="font-size: 12px;float: right;margin-top: -13px;"> <i class="fa fa-clock-o" style="margin-right: 5px;"></i>'. getDateTimeDiff($dataArrTglDibuat[$i]." ".$dataArrJamDibuat[$i]) . '</small>
			              </h4>
			              <div class="pull-left" style="margin-left: -1px; margin-top: 13px;">
			                <img src="../imgstatis/logo2.png" style="width: 35px;">
			              </div>
			              <h4 style="font-size: 12px; margin-top: 20px;">
			                <p style="font-size: 15px;margin-left: 45px;"> 
			                  <strong> SISWA </strong> <span style="margin-left: 6px;"> : </span> 
			                  <strong id="title_daily" style="margin-left: 3px;"> 
			                    '. $semuaNamaSiswa .'
			                  </strong> 
			                </p>
			              </h4>
			              <h4 style="font-size: 12px;">
			                <p style="font-size: 15px;margin-left: 45px;"> 
			                  <strong> INFO </strong> <span style="margin-left: 15.5px;"> : </span> 
			                  <strong id="title_daily" style="margin-left: 3px; font-size: 13px;"> 
			                    '. ' Pembayaran ' . $semuaPesan .'
			                  </strong> 
			                </p>
			              </h4>
			            </a>
		          	</li>
		      ';

		  	}

		}

  // Akhir Data All Info
	##############################

    $arr['notif_appr']              = $countDataApproved;
  	$arr['notif_appr_all']          = $countDataApprovedAll;

  	// Isi notif sudah di approve
	$arr['isi_notif_approved']      = $forIsiNotifSdhAppr;
	$arr['elementNotifAppr']        = $elementNotifAppr;
  	// Akhir isi notif sudah di approve

	// Notif Info
  	$arr['notif_info']      		= $jumlahDataInfo;
  	$arr['isi_notif_info']  		= $forIsiNotifInfo;
  	// Akhir Notif Info

  	echo json_encode($arr);

?>