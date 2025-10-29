<?php  

	$timeOut        = $_SESSION['expire'];
    
  	$timeRunningOut = time() + 5;

	$timeIsOut = 0;
	$sesi      = 0;
	$nama      = "";
	$nis       = 0;
	$guru      = "";
	$key_room  = "";
	$users     = "";
	$sesiKomen = 1;

	$tglSkrngAwal 	= "";
	$tglSkrngAkhir 	= "";

	$nipKepsek = $_SESSION['nip_kepsek'];

	$nipGuru   = "";
	$fromPage  = "";
	$diMenu    = "lookactivity";

	$countDataChat  = 0;

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

  	$empty = "";

	// echo "Waktu Habis : " . $timeOut . " Waktu Berjalan : " . $timeRunningOut;

	if ($timeRunningOut == $timeOut || $timeRunningOut > $timeOut) {

		$_SESSION['form_success'] = "session_time_out";

	    $timeIsOut = 1;
	    error_reporting(1);

  	} else {

  		if (isset($_POST['krm'])) {

	  		$roomKey    = $_POST['roomkey'];
	  		$nama 		= htmlspecialchars($_POST['nama']);
	  		$nis 		= htmlspecialchars($_POST['nis']);
	  		$guru 		= htmlspecialchars($_POST['guru']);
	  		$foto 		= htmlspecialchars($_POST['foto']);
	  		$tglPosting = $_POST['tglpost'];
	  		$tglOri     = $_POST['tglori'];
	  		$judul      = htmlspecialchars($_POST['judul']);
	  		$isi        = $_POST['isi'];
	  		$nipGuru    = $_POST['nipguru_lookdaily'];
	  		$users      = $nipKepsek;

	  		date_default_timezone_set("Asia/Jakarta");
			  
		  	$tglSkrngAwal         = date("Y-m-d") . " 00:00:00";
		  	$tglSkrngAkhir        = date("Y-m-d") . " 23:59:59";

	  		$sesi 		= 1;

	  		if ($tglOri < $tglSkrngAwal) {
		  		$sesiKomen = 0;
		  	} else {
		  		$sesiKomen = 1;
		  	}

		  	$getDataKomenOther = mysqli_query($con, "
		      	SELECT 
		      	tbl_komentar.room_id as r_id,
		      	tbl_komentar.code_user as fromnip,
		      	guru.nama as nama_guru,
		      	kepala_sekolah.nama as nama_kepsek,
		      	siswa.nama as nama_siswa,
		      	tbl_komentar.stamp as tanggal_kirim,
		      	tbl_komentar.isi_komentar as pesan
		      	FROM 
		      	tbl_komentar 
		      	LEFT JOIN ruang_pesan
		      	ON tbl_komentar.room_id = ruang_pesan.room_key
		      	LEFT JOIN guru
		      	ON tbl_komentar.code_user = guru.nip
		      	LEFT JOIN kepala_sekolah
		      	ON tbl_komentar.code_user = kepala_sekolah.nip
		      	LEFT JOIN akses_otm
		      	ON tbl_komentar.code_user = akses_otm.nis_siswa
		      	LEFT JOIN siswa
		      	ON akses_otm.nis_siswa = siswa.nis
		      	WHERE 
		      	ruang_pesan.room_key LIKE '%$roomKey%'
		      	ORDER BY tbl_komentar.id
		    ");

		    $countDataChat = mysqli_num_rows($getDataKomenOther);

		  	$fromPage   = $_POST['frompage'];

	  		$key_room   = $roomKey;
	  		
	  	} else if (isset($_POST['redirectLookDaily'])) {

	  		$roomKey    = $_POST['roomkey_lookdaily'];
	  		$nama 		= htmlspecialchars($_POST['nama_siswa_lookdaily']);
	  		$nis        = htmlspecialchars($_POST['nis_lookdaily']);
	  		$guru 		= htmlspecialchars($_POST['guru_lookdaily']);
	  		$foto 		= $_POST['foto_upload_lookdaily'];
	  		$tglPosting = $_POST['tgl_posting_lookdaily'];
	  		$tglOri     = $_POST['tglori_posting_lookdaily'];
	  		$judul      = htmlspecialchars($_POST['jdl_posting_lookdaily']);
	  		$isi 		= $_POST['isi_posting_lookdaily'];
	  		$nipGuru    = $_POST['nipguru_lookdaily'];
	  		$users      = $nipKepsek;

	  		$sesi 		= 1;

	  		date_default_timezone_set("Asia/Jakarta");
			  
		  	$tglSkrngAwal         = date("Y-m-d") . " 00:00:00";
		  	$tglSkrngAkhir        = date("Y-m-d") . " 23:59:59";

		  	if ($tglOri < $tglSkrngAwal) {
		  		$sesiKomen = 0;
		  	} else {
		  		$sesiKomen = 1;
		  	}

		  	$fromPage   = $_POST['frompage_lookdaily'];
		  	$key_room   = $roomKey;

		  	$getDataKomenOther = mysqli_query($con, "
		      SELECT 
		      tbl_komentar.room_id as r_id,
		      tbl_komentar.code_user as fromnip,
		      guru.nama as nama_guru,
		      kepala_sekolah.nama as nama_kepsek,
		      siswa.nama as nama_siswa,
		      tbl_komentar.stamp as tanggal_kirim,
		      tbl_komentar.isi_komentar as pesan
		      FROM 
		      tbl_komentar 
		      LEFT JOIN ruang_pesan
		      ON tbl_komentar.room_id = ruang_pesan.room_key
		      LEFT JOIN guru
		      ON tbl_komentar.code_user = guru.nip
		      LEFT JOIN kepala_sekolah
		      ON tbl_komentar.code_user = kepala_sekolah.nip
		      LEFT JOIN akses_otm
		      ON tbl_komentar.code_user = akses_otm.nis_siswa
		      LEFT JOIN siswa
		      ON akses_otm.nis_siswa = siswa.nis
		      WHERE 
		      ruang_pesan.room_key LIKE '%$roomKey%'
		      ORDER BY tbl_komentar.id
		    ");

		  	$countDataChat = mysqli_num_rows($getDataKomenOther);

	  	} elseif (isset($_POST['send_mssg'])) {

	  		$roomKey    = $_POST['roomkey'];
	  		$nama 		= htmlspecialchars($_POST['nama']);
	  		$nis 		= htmlspecialchars($_POST['nis']);
	  		$guru 		= htmlspecialchars($_POST['guru']);
	  		$foto 		= htmlspecialchars($_POST['foto']);
	  		$tglPosting = $_POST['tglpost'];
	  		$tglOri     = $_POST['tglori'];
	  		$judul      = htmlspecialchars($_POST['judul']);
	  		$isi   		= $_POST['isi'];
	  		$users      = $nipKepsek;
	  		$nipGuru    = $_POST['nipguru_lookdaily'];

	  		$fromPage   = $_POST['frompage'];

	  		$isKomen    = mysqli_real_escape_string($con, htmlspecialchars($_POST['message']));

	  		if ($isKomen == null) {

	  			$empty = "empty_comment";

	  			date_default_timezone_set("Asia/Jakarta");
			  	$arrTgl               = [];
				
			  	$countDataChat = 0;

			  	$tglSkrngAwal         = date("Y-m-d") . " 00:00:00";
			  	$tglSkrngAkhir        = date("Y-m-d") . " 23:59:59";

		  		$sesi 		= 1;

		  		$getDataKomenOther = mysqli_query($con, "
			      SELECT 
			      tbl_komentar.room_id as r_id,
			      tbl_komentar.code_user as fromnip,
			      guru.nama as nama_guru,
			      kepala_sekolah.nama as nama_kepsek,
			      siswa.nama as nama_siswa,
			      tbl_komentar.stamp as tanggal_kirim,
			      tbl_komentar.isi_komentar as pesan
			      FROM 
			      tbl_komentar 
			      LEFT JOIN ruang_pesan
			      ON tbl_komentar.room_id = ruang_pesan.room_key
			      LEFT JOIN guru
			      ON tbl_komentar.code_user = guru.nip
			      LEFT JOIN kepala_sekolah
			      ON tbl_komentar.code_user = kepala_sekolah.nip
			      LEFT JOIN akses_otm
			      ON tbl_komentar.code_user = akses_otm.nis_siswa
			      LEFT JOIN siswa
			      ON akses_otm.nis_siswa = siswa.nis
			      WHERE 
			      ruang_pesan.room_key LIKE '%$roomKey%'
			      ORDER BY tbl_komentar.id
			    ");

			    $countDataChat = mysqli_num_rows($getDataKomenOther);

		  		if ($tglOri < $tglSkrngAwal) {
			  		$sesiKomen = 0;
			  	} else {
			  		$sesiKomen = 1;
			  	}

	  		} else {

	  			date_default_timezone_set("Asia/Jakarta");
			  	$arrTgl               = [];
				
			  	$countDataChat = 0;

			  	$tglSkrngAwal         = date("Y-m-d") . " 00:00:00";
			  	$tglSkrngAkhir        = date("Y-m-d") . " 23:59:59";

		  		$sesi 		= 1;
		  		$sqlInsertChat  = mysqli_query($con, "
					INSERT INTO tbl_komentar 
					SET 
					code_user 		= '$users', 
					isi_komentar  	= '$isKomen', 
					room_id   		= '$roomKey'
				");

				if ($sqlInsertChat === TRUE) {	    // echo "Message saved successfully!";
				    
					$getDataKomenOther = mysqli_query($con, "
				      SELECT 
				      tbl_komentar.room_id as r_id,
				      tbl_komentar.code_user as fromnip,
				      guru.nama as nama_guru,
				      kepala_sekolah.nama as nama_kepsek,
				      siswa.nama as nama_siswa,
				      tbl_komentar.stamp as tanggal_kirim,
				      tbl_komentar.isi_komentar as pesan
				      FROM 
				      tbl_komentar 
				      LEFT JOIN ruang_pesan
				      ON tbl_komentar.room_id = ruang_pesan.room_key
				      LEFT JOIN guru
				      ON tbl_komentar.code_user = guru.nip
				      LEFT JOIN kepala_sekolah
				      ON tbl_komentar.code_user = kepala_sekolah.nip
				      LEFT JOIN akses_otm
				      ON tbl_komentar.code_user = akses_otm.nis_siswa
				      LEFT JOIN siswa
				      ON akses_otm.nis_siswa = siswa.nis
				      WHERE 
				      ruang_pesan.room_key LIKE '%$roomKey%'
				      ORDER BY tbl_komentar.id
				    ");

				    $countDataChat = mysqli_num_rows($getDataKomenOther);

				}

		  		if ($tglOri < $tglSkrngAwal) {
			  		$sesiKomen = 0;
			  	} else {
			  		$sesiKomen = 1;
			  	}

	  		}

	  	} else {
	  		$sesi = 0;
	  		$_SESSION['data'] = 'nodata';
	  	}

  	}

?>

	<style type="text/css">
		
		#nama_sswa {
			font-size: 10px;
		}

		@media only screen and (max-width: 768px) {

			#nama_sswa {
				font-size: 8px;
			}

			#time_send {
				font-size: 8px;
			}

		}

	</style>

	<?php if ($sesi == 1): ?>
		
		<div class="row">
			<div class="col-md-7">
			    <!-- Box Comment -->
			    <div class="box box-widget">
			      <div class="box-header with-border">
			        <div class="user-block">
			          <img class="img-circle" src="<?= $base; ?>theme/dist/img/logo2.png" alt="User Image">
			          <span class="username" id="namaguru"> <?= strtoupper($guru); ?> </span>
			          <span class="description" id="tglpublish"> Published Date - <?= $tglPosting; ?> </span>
			        </div>
			        <!-- /.user-block -->
			      </div>
			      <!-- /.box-header -->
			      <div class="box-body" id="isian_daily">
			        <h4 style="color: black;"> TITLE : <?= $judul; ?>  </h4>
			        <img class="img-responsive pad" src="<?= $base; ?>image_uploads/<?= $foto; ?>" alt="Photo" style="width: auto; height: 300px;">
			        <?= $isi; ?>
			        
			        <!-- <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
			        <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
			        <span class="pull-right text-muted">127 likes - 3 comments</span> -->
			      </div>

			    </div>

			    <div class="tombol-hide" style="display: none;">
			    	<form action="lookactivity" method="post">
			    		<input type="hidden" name="frompage" value="<?= $fromPage; ?>">
			    		<input type="hidden" name="roomkey" value="<?= $roomKey; ?>">
			        	<input type="hidden" name="nis" value="<?= $nis; ?>">
			        	<input type="hidden" name="nama" value="<?= strtoupper($nama); ?>">
			        	<input type="hidden" name="guru" value="<?= strtoupper($guru); ?>">
			        	<input type="hidden" name="foto" value="<?= $foto; ?>">
			        	<input type="hidden" name="tglpost" value="<?= $tglPosting; ?>">
			        	<input type="hidden" name="tglori" value="<?= $tglOri; ?>">
			        	<input type="hidden" name="judul" value="<?= $judul; ?>">
			    		<input type="hidden" name="isi" value="<?= $isi; ?>">
			    		<input type="hidden" name="nipguru_lookdaily" value="<?= $nipGuru; ?>">
			    		<button type="hidden" name="krm" id="try"> send hide </button>
			    	</form>
			    </div>

			    <!-- /.box -->
			</div>
		  <!-- /.col -->
		  	<div class="col-md-5">
		    <!-- DIRECT CHAT SUCCESS -->
			    <div class="box box-primary direct-chat direct-chat-primary">
			      <div class="box-header with-border" style="background-color: gainsboro;">
			        <h3 class="box-title" style="color: black;"> Comments </h3>
			      </div>
			      <!-- /.box-header -->
			      <div class="box-body">
			        <!-- Conversations are loaded here -->
			        <div class="direct-chat-messages" id="comments-box" style="height: 400px !important;">

			        	<!-- Jika Isi Chat Masih Kosong -->
			        	<?php if ($countDataChat == 0): ?>

			        		<?php if ($tglOri < $tglSkrngAwal): ?>

								<div class="center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 10px;">
								  <h4 style="font-weight: bold;"> TIDAK ADA KOMENTAR ! </h4>
								</div>

							<?php elseif($tglOri >= $tglSkrngAwal && $tglOri <= $tglSkrngAkhir) : ?>

								<div class="center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 10px;">
								  <h4 style="font-weight: bold;"> BELUM ADA KOMENTAR ! </h4>
								</div>

			        		<?php endif ?>

			        	<?php else: ?>

			        		<?php foreach ($getDataKomenOther as $data): ?>

			        			<?php if ($data['fromnip'] == $nipKepsek): ?>

							    	<div class="direct-chat-msg right">
							         	<div class="direct-chat-info clearfix">
								            <span id="namakepsek" class="direct-chat-name pull-right"> <?= $data['nama_kepsek']; ?> </span>
								            <span id="tglsendkepsek" class="direct-chat-timestamp pull-left"> <?= format_tgl_indo($data['tanggal_kirim']); ?> </span>
							          	</div>
							          	<img class="direct-chat-img" src="<?= $base; ?>imgstatis/icon_chat.png" alt="Message User Image">
							          	<div class="direct-chat-text"> <?= htmlspecialchars($data['pesan']); ?> </div>
							        </div>

							    <?php elseif($data['fromnip'] == $nipGuru): ?>
				        			
							    	<div class="direct-chat-msg">
							         	<div class="direct-chat-info clearfix">
								            <span id="namaguruchat" class="direct-chat-name pull-left"> <?= strtoupper($data['nama_guru']); ?> </span>
								            <span id="tglsendguru" class="direct-chat-timestamp pull-right"> <?= format_tgl_indo($data['tanggal_kirim']); ?> </span>
							          	</div>
							          	<img class="direct-chat-img" src="<?= $base; ?>imgstatis/icon_chat.png" alt="Message User Image">
							          	<div class="direct-chat-text"> <?= htmlspecialchars($data['pesan']); ?> </div>
							        </div>

							    <?php elseif($data['fromnip'] == $nis): ?>

							    	<div class="direct-chat-msg">
							         	<div class="direct-chat-info clearfix">
								            <span id="nama_sswa" class="direct-chat-name pull-left">  WALI MURID : <?= strtoupper($data['nama_siswa']); ?> </span>
								            <span id="time_send" class="direct-chat-timestamp pull-right"> <?= format_tgl_indo($data['tanggal_kirim']); ?> </span>
							          	</div>
							          	<img class="direct-chat-img" src="<?= $base; ?>imgstatis/icon_chat.png" alt="Message User Image">
							          	<div class="direct-chat-text"> <?= htmlspecialchars($data['pesan']); ?> </div>
							        </div>

				        		<?php endif ?>
				        		
				        	<?php endforeach ?>
			        		
			        	<?php endif ?>

			        </div>
			        <!-- /.direct-chat-pane -->
			      </div>
			      <!-- /.box-body -->
			      <div class="box-footer">
			      	<span class="input-group-btn">
	                  <button id="refresh_btn" style="margin-bottom: 10px; font-weight: bold;" class="btn btn-light btn-flat"> <i class="glyphicon glyphicon-refresh"></i> Refresh to Update Data </button>
	                </span>

			        <form action="lookactivity" method="post">
			          	<div class="input-group" id="tombolComment">
			            	<input type="text" id="message-input" name="message" placeholder="Type Message ..." class="form-control">
			            	<input type="hidden" name="frompage" value="<?= $fromPage; ?>">
			            	<input type="hidden" name="roomkey" value="<?= $roomKey; ?>">
				        	<input type="hidden" name="nis" value="<?= $nis; ?>">
				        	<input type="hidden" name="nama" value="<?= strtoupper($nama); ?>">
				        	<input type="hidden" name="guru" value="<?= strtoupper($guru); ?>">
				        	<input type="hidden" name="foto" value="<?= $foto; ?>">
				        	<input type="hidden" name="tglpost" value="<?= $tglPosting; ?>">
				        	<input type="hidden" name="tglori" value="<?= $tglOri; ?>">
				        	<input type="hidden" name="judul" value="<?= $judul; ?>">
				        	<input type="hidden" name="isi" value="<?= $isi; ?>">
				        	<input type="hidden" name="nipguru_lookdaily" value="<?= $nipGuru; ?>">
			                <span class="input-group-btn">
			                  <button type="submit" name="send_mssg" id="send-btn" class="btn btn-success btn-flat">Send</button>
			                </span>
			          	</div>
			        </form>
			      </div>
			      <!-- /.box-footer-->
			    </div>
			    <!--/.direct-chat -->
		  	</div>
		  <!-- /.col -->
		</div>

		<div class="wrapx" style="display: flex; justify-content: flex-end;">

			<div class="row">
				
				<div class="col-md-3">
					<?php if ($fromPage == "status_approved"): ?>
						
						<form action="<?= $fromPage; ?>" method="post">
							<input type="hidden" name="nama" value="<?= $nama; ?>">
							<input type="hidden" name="nis" value="<?= $nis; ?>">
			        		<button class="btn btn-sm btn-primary" type="submit" name="send_data_student"> <span class="glyphicon glyphicon-log-out" id="cancel"></span> Kembali </button>
			        	</form>
						<br>
						
					<?php elseif($fromPage == "teachercreatedaily"): ?>

						<form action="<?= $fromPage; ?>" method="post">
							<input type="hidden" name="nama" value="<?= $nama; ?>">
							<input type="hidden" name="nis" value="<?= $nis; ?>">
			        		<button class="btn btn-sm btn-primary" type="submit" name="send_data_student"> <span class="glyphicon glyphicon-log-out" id="cancel"></span> Kembali </button>
			        	</form>
						<br>

					<?php elseif($fromPage == "createstudentdaily"): ?>

						<form action="<?= $fromPage; ?>" method="post">
							<input type="hidden" name="nama_guru" value="<?= $guru; ?>">
							<input type="hidden" name="nip" value="<?= $nipGuru; ?>">
			        		<button class="btn btn-sm btn-primary" type="submit" name="send_data_student"> <span class="glyphicon glyphicon-log-out" id="cancel"></span> Kembali </button>
			        	</form>
						<br>

					<?php elseif($fromPage == "homepage"): ?>

						<form action="<?= $basegu; ?>" method="post">
							<input type="hidden" name="nama" value="<?= $nama; ?>">
							<input type="hidden" name="nis" value="<?= $nis; ?>">
			        		<button class="btn btn-sm btn-primary" type="submit" name="send_data_student"> <span class="glyphicon glyphicon-log-out" id="cancel"></span> Kembali </button>
			        	</form>
						<br>

					<?php else: ?>

						<form action="teachercreatedaily" method="post">
							<input type="hidden" name="nama" value="<?= $nama; ?>">
							<input type="hidden" name="nis" value="<?= $nis; ?>">
			        		<button class="btn btn-sm btn-primary" type="submit" name="send_data_student"> <span class="glyphicon glyphicon-log-out" id="cancel"></span> Kembali </button>
			        	</form>
						<br>

					<?php endif ?>
					<br>
				</div>

			</div>

		</div>

	<?php elseif($sesi == 0): ?>

		<div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12">

		        <?php if(isset($_SESSION['data']) && $_SESSION['data'] == 'nodata'){?>
		          <div style="display: none;" class="alert alert-danger alert-dismissable"> Tidak Ada Data Yang Di Kirim! 
		             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		             <?php 
		             	$nis = 0;
		             	unset($_SESSION['data']);
		             ?>
		          </div>
		        <?php } ?>

		    </div>
		</div>

	<?php endif ?>

<script type="text/javascript">

	let rooms 		= `<?= $key_room; ?>`
	let nip_guru   	= `<?= $nipGuru; ?>`
	let komenSes 	= `<?= $sesiKomen; ?>`
	let nis_siswa   = `<?= $nis; ?>`
	let emptyKomen  = `<?= $empty; ?>`

	// if(localStorage.getItem("showpopup") == "tidak") {

	// 	// alert("ok")

	// } else if(localStorage.getItem("showpopup") != "muncul") {
	// 	localStorage.setItem("showpopup", "muncul");
	// }

	function firstLoad(rmId) {
	    $.ajax({
	        url     : `<?= $basekepsek; ?>data_komen`,
	        method  : 'POST',
	        data    : {
	            room_id 	: rmId,
	            nip_guru   	: `<?= $nipGuru; ?>`,
	            nip_kepsek  : `<?= $users; ?>`,
	            nis_siswa   : nis_siswa
	        },
	        success:function(data) {
	          	$('#comments-box').scrollTop($('#comments-box')[0].scrollHeight);
        		let jumlahKomen        = JSON.parse(data).jumlah_komen;
        		let tglPosting        = JSON.parse(data).tgl_posting;

	            if(jumlahKomen == 0) {
	            	// Tanggal Posting Kemarin
	            	if(tglPosting < `<?= $tglSkrngAwal; ?>`) {

		            	$('#comments-box').html(`
		            		<div class="center">
							  <h4 id="komenkosong" style="font-weight: bold;"> TIDAK ADA KOMENTAR ! </h4>
							</div>`
						);

		            // Tanggal Posting Hari Ini
		            } else if (tglPosting >= `<?= $tglSkrngAwal; ?>` && tglPosting <= `<?= $tglSkrngAkhir; ?>`) {

		            	$('#comments-box').html(`
		            		<div class="center">
							  <h4 id="komenkosong" style="font-weight: bold;"> BELUM ADA KOMENTAR ! </h4>
							</div>`
						);
						$("#message-input").focus();

		            }

	            } else {
		            
		            setTimeout(function() {
		                $('#comments-box').html(JSON.parse(data).isi_chat);
		                // $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
		            }, 100);
		            $("#message-input").focus();

	            }

	        }
	    })
	}
	
	$(document).ready( function () {

		// if (localStorage.getItem("showpopup") == "muncul") {
		// 	Swal.fire({
		// 	  title: "Perhatian !",
		// 	  text: "Setiap 10 Detik Halaman ini akan Refresh Screen !",
		// 	  icon: "warning"
		// 	});
		// 	localStorage.setItem("showpopup", "tidak");
		// 	// alert(se) 
		// }

		if(emptyKomen == 'empty_comment') {

			Swal.fire({
			  title: "Perhatian !",
			  text: "Tidak Bisa Mengirim Komentar Yang Kosong !",
			  icon: "warning"
			});

			let element = document.querySelector(".swal2-confirm");
			element.addEventListener("click", function() {
			  	document.getElementById("message-input").focus();
			});

		}

	    if (`<?= $nis; ?>` == 0) {
			setTimeout(() => {
				location.href = `<?= $basegu; ?>querydailystudent`
			}, 1000);
		} else {

			$('#comments-box').scrollTop($('#comments-box')[0].scrollHeight);

			if (komenSes != 0) {
				
				$("#refresh_btn").click(function(){
					$("#try").click();
				});

			}

			$("#message-input").focus();

	  		let session = `<?= $sesi; ?>` 
			
			if (session == 0) {
				setTimeout(linkRedirect, 1200);
			}

		    $("#aList1").click();

		    setTimeout(clickSubMenu, 500);

		    if (komenSes == 0) {
		    
		    	Swal.fire("Sesi Comment telah berakhir");
		      	$("#tombolComment").hide();
		      	$("#refresh_btn").hide();
		    	// setTimeout(function() {
			    //   firstLoad(`<?= $key_room; ?>`)
			    // }, 1000); 

		    } else {

		    	// setTimeout(function() {
			    //   firstLoad(`<?= $key_room; ?>`)
			    // }, 1000);

		    }

		}

	    function clickSubMenu() {
	      	$("#isiList2").click();
	      	$("#query_data_siswa").css({
	          	"background-color" : "#ccc",
	          	"color" : "black"
	      	});
	    }

	    // $('#send-btn').click(function(e){
	    //     e.preventDefault();        
	    //     var message = $('#message-input').val();
	    //     if (message !== "") {
	    //       	// alert(`<?= $users; ?>`)
	    //         appendMessage(message, rooms, `<?= $users; ?>`);

	            
	    //         $('#message-input').val(''); // Clear input field after sending
	    //         $('#message-input').focus();
	    //         $('#message-input').click();
	    //     } else {
	    //       alert('Tidak Boleh Kosong')
	    //     }
	    //     // $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
	    //     // $("#chat-box").animate({ scrollTop: $('#chat-box').prop("scrollHeight")}, 1000);
	    // });

	    let titleLists1   = ' - ACTIVITY ' + document.getElementById('titleList1').innerHTML
	    let elementWrap   = document.getElementById('boxTitle')

		let newIcon = document.getElementById("addIcon");
		newIcon.classList.remove("fa");
		newIcon.classList.add("glyphicon");
		newIcon.classList.add("glyphicon-zoom-in");

		let getTitleList1 = document.getElementById('isiList2').innerHTML;
		$("#isiMenu").css({
			"margin-left" : "5px"
		});

		let createElementSpanNama = document.createElement('span')
		createElementSpanNama.id  = 'spanIsiNama'
		createElementSpanNama.textContent += `<?= $nama; ?>`

		elementWrap.appendChild(createElementSpanNama)

		$("#spanIsiNama").css({
			"font-weight" : "bold"
		});

		document.getElementById('isiMenu').innerHTML = `<span style="font-weight: bold;"> QUERY </span>` + `<span style="font-weight: bold;"> ${titleLists1} </span> ` + ' -'

		function linkRedirect() {
			location.href = `<?= $basekepsek; ?>querydailystudent`
	    }

  	});

  	function appendMessage(message, rm, usr) {
	    $.ajax({
	        url     : `<?= $basekepsek; ?>save_message`,
	        method  : 'POST',
	        data    : {
	            message 	: message,
	            room    	: rm,
	            user    	: usr
	        },
	        success:function(res) {
	          console.log(JSON.parse(res).room)
	            $.ajax({
	                url     : `<?= $basekepsek; ?>data`,
	                method  : 'POST',
	                data    : {
	                    room_id 	: JSON.parse(res).room,
	                    usr_kepsek  : `<?= $users; ?>`,
	                    usr_guru    : nip_guru,
	                    usr_otm 	: nis_siswa
	                },
	                success:function(respon) {
	                    firstLoad(`<?= $key_room; ?>`)
	                }
	            });
	        }
	    });
	}

</script>