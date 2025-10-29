<?php  
	
	$timeOut        = $_SESSION['expire'];
    
  	$timeRunningOut = time() + 5;

	$timeIsOut = 0;
	$sesi      = 0;

	// echo "Waktu Habis : " . $timeOut . " Waktu Berjalan : " . $timeRunningOut . "<br>";

	function formatDateEnglish($date){  
	  $tanggal_indo = date_create($date);
	  date_timezone_set($tanggal_indo,timezone_open("Asia/Jakarta"));
	  $array_bulan = array(1=>'January','February','March', 'April', 'May', 'June','July','August','September','October', 'November','Desember');
	  $date = strtotime($date);
	  $tanggal = date ('d', $date);
	  $bulan = $array_bulan[date('n',$date)];
	  $tahun = date('Y',$date); 
	  $H     = date_format($tanggal_indo, "H");
	  $i     = date_format($tanggal_indo, "i");
	  $s     = date_format($tanggal_indo, "s");

	  $jamIndo = $H.":".$i.":".$s;
	  $result = $tanggal ." ". $bulan ." ". $tahun . " " . $jamIndo;       
	  return($result);  
	}

	if ($timeRunningOut == $timeOut || $timeRunningOut > $timeOut) {

		$_SESSION['form_success'] = "session_time_out";

	    $timeIsOut = 1;
	    error_reporting(1);

	} else {

		date_default_timezone_set("Asia/Jakarta");

		// echo $_POST['judul'];exit;
		$queryWaitingApprovedDaily = mysqli_query($con, "
		    SELECT
		    daily_siswa_approved.id as daily_id,
		    daily_siswa_approved.from_nip as from_nip,
		    guru.nama as nama_guru,
		    admin.username as nama_user,
		    siswa.nama as nama_siswa,
		    daily_siswa_approved.status_approve as status,
		    daily_siswa_approved.image as foto,
		    daily_siswa_approved.title_daily as judul,
		    daily_siswa_approved.isi_daily as isi_daily,
		    daily_siswa_approved.tanggal_dibuat as tanggal_dibuat,
		    daily_siswa_approved.tanggal_disetujui_atau_tidak as tanggal_disetujui_atau_tidak,
		    daily_siswa_approved.stamp as created_date
		    FROM 
		    daily_siswa_approved 
		    LEFT JOIN guru
		    ON daily_siswa_approved.from_nip = guru.nip
		    LEFT JOIN admin
		    ON daily_siswa_approved.from_nip = admin.c_admin
		    LEFT JOIN siswa
		    ON daily_siswa_approved.nis_siswa = siswa.nis
		    WHERE daily_siswa_approved.status_approve = 0
		    AND daily_siswa_approved.from_nip = '$_SESSION[nip_guru]'
  			ORDER BY daily_siswa_approved.tanggal_dibuat DESC
  		");

  		$no = 1;

	}

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">

	<div class="modal fade" id="modal-lookdaily">
	  	<div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header" style="border-bottom-color: white;">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		          <center>
		            <h4 class="modal-title"> <strong> DAILY SISWA </strong> </h4>
		          </center>
		      </div>
		      <div class="modal-body" style="margin-bottom: 10px;">

		          <div class="box-body" style="padding-left: 60px; padding-right: 60px;">

		            <form role="form" id="forms">

		              <div class="row">

		                <div class="col-sm-6">
		                  <div class="form-group">
		                    <label> Status : <strong style="color: green;"> Waiting Approval </strong> <i class="fa fa-fw fa-hourglass-half" style="color: green;"></i> </label>
		                  </div>
		                </div>

		                <div class="col-sm-6">
		                  <div class="form-group">
		                    <label> Date Posted </label>
		                    <input type="text" readonly id="tanggal_upload_daily" name="tanggal_upload" class="form-control">
		                  </div>
		                </div>

		              </div>

		              <div class="form-group gambar_banner">
		                <label for="banner"> Uploaded Photo </label>
		                <!-- <input type="text" id="banner" name=""> -->
		                <img class="img-responsive pad" id="foto_upload_wait" alt="Photo">
		              </div>

		              <div class="form-group">
		                <label for="title_daily">Title Daily</label>
		                <input type="text" id="judul_daily" name="title_daily" readonly class="form-control">
		              </div>

		              <div class="form-group">
		                <label for="main_daily">Daily</label>
		                <div class="isiDaily" id="isi_daily" style="height: 150px;border: 1px solid #eee;padding: 10px; background-color: #eee;" class="form-control">
		                  
		                </div>
		                <!-- <textarea style="height: 150px;" class="form-control" id="main_daily" rows="3" placeholder="Announcement ..."></textarea> -->
		              </div>

		            </form>

		          </div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" id="close_approve_wt_inpage" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		    <!-- /.modal-content -->
	  	</div>
	  <!-- /.modal-dialog -->
	</div>

	<div class="box box-info">
	  	<div class="box-body table-responsive">
	  			
  			<table border="0" cellspacing="5" cellpadding="5" id="tableFilter">
		      	<tbody id="filterDate">
			        <tr>
			            <td> Filter Date From <span id="dotFrom"> : </span> </td>
			            <td><input type="text" id="min" name="min"></td>
			        </tr>
			        <tr>
			            <td> Filter Date To <span id="dotTo"> : </span> </td>
			            <td><input type="text" id="max" name="max"></td>
			        </tr>
		      	</tbody>

		    </table>

		    <table id="example" class="display nowrap" style="width:100%">
		        <thead>
		            <tr style="background-color: lightyellow;">
		                <th style="text-align: center;" width="5%">NO</th>
			          	<th style="text-align: center;"> SISWA </th>
			          	<th style="text-align: center;"> JUDUL </th>
			          	<th style="text-align: center;"> STATUS </th>
			          	<th style="text-align: center;"> TANGGAL DIBUAT </th>
		            </tr>
		        </thead>
		        <tbody>
		        	
		        	<?php foreach ($queryWaitingApprovedDaily as $waiting_appr): ?>
					      	
				      	<tr id="tr_dashboard" style="background-color: aqua;" onclick="showDataWaitAppr(
					      	`<?= $waiting_appr['daily_id']; ?>`, 
					      	`<?= strtoupper($waiting_appr['nama_guru']); ?>`, 
					      	`<?= $waiting_appr['tanggal_dibuat']; ?>`, 
					      	`<?= strtoupper($waiting_appr['nama_siswa']); ?>`,
					      	`<?= $waiting_appr['foto']; ?>`,
					      	`<?= $waiting_appr['judul']; ?>`,
					      	`<?= $waiting_appr['isi_daily']; ?>`
				      	)">
					        <td style="text-align: center;"> <?= $no++; ?> </td>
					        <td style="text-align: center;"> <?= strtoupper($waiting_appr['nama_siswa']); ?> </td>
					        <td style="text-align: center;"> <?= $waiting_appr['judul'] ?> </td>
				        	<td style="text-align: center;"> Waiting <i class="glyphicon glyphicon-hourglass"></i> </td>
					        <td style="text-align: center;"> <?= formatDateEnglish($waiting_appr['created_date']); ?> </td>

				      	</tr>

			      	<?php endforeach ?>
		            
		        </tbody>
		    </table>

	  	</div>
	</div>

<!-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script> -->
<script src="view/daily/query/dataTables1.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script> -->
<script src="view/daily/query/moment.min.js"></script>
<!-- <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script> -->
<script src="view/daily/query/dateTime.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">

	let newIcon = document.getElementById("addIcon");
  	newIcon.classList.remove("fa");
  	newIcon.classList.add("glyphicon");
  	newIcon.classList.add("glyphicon-hourglass");

  	Swal.fire({
	  icon: "warning",
	  title: "Perhatian !",
	  text: "Daily Yang Sudah Di Buat Tidak Bisa Di Ubah Ataupun Di Hapus ! "
	});

  	let getTitleList1 = document.getElementById('isiList2').innerHTML;

  	var minDate =""; 
	var maxDate = "";
 
		 // Custom filtering function which will search data in column four between two values
		DataTable.ext.search.push(function (settings, data, dataIndex) {
			var min = minDate.val();
		    var max = maxDate.val();
		    var date = new Date(data[4]);

		    if (
		        (min === null && max === null) ||
		        (min === null && date <= max) ||
		        (min <= date && max === null) ||
		        (min <= date && date <= max)
		    ) {
		        return true;
		    }
		    return false;
		});
		   
		  // Create date inputs
		  minDate = new DateTime('#min', {
		      format: 'MMMM Do YYYY'
		  });
		  maxDate = new DateTime('#max', {
		      format: 'MMMM Do YYYY'
		  });
		   
		  // DataTables initialisation
		  var table = new DataTable('#example');
		   
		  // Refilter the table
		  document.querySelectorAll('#min, #max').forEach((el) => {
		      el.addEventListener('change', () => table.draw());
		  });

	$(document).ready(function() {

		$("#aList1").click();
	    $("#isiList3").click();
	    $("#stat_wait").css({
	        "background-color" : "#ccc",
	        "color" : "black"
	    });

	    $("#isiMenu").css({
	      "margin-left" : "5px"
	    });

	})

	function lkDaily(tgl, jdl, ft, isi) {

    	$("#modal-lookdaily").modal('show');

    	$("#tanggal_upload_daily").val(tgl);

    	let image = document.querySelector("img[id='foto_upload_wait']");
    	image.setAttribute("src", `<?= $base; ?>image_uploads/${ft}`);

    	$("#judul_daily").val(jdl);
    	$("#isi_daily").html(isi);

    }

  //   function showDataWaitAppr(dailyID, stat, from, datePosted, dateAppr, imgUpload, siswa, title, main) {

		// $("#inpage-wt-appr").modal('show');
		// let dataHgDailyId   = dailyID;
  //     	let dataHgSender    = from;
  //     	let dataHgSiswa 	= siswa;
  //     	let dataHgTglUpload = datePosted;
  //     	let dataHgImage     = imgUpload;
  //     	let dataHgJudul     = title;
  //     	let dataHgDaily     = main;

  //     	let hgImage     = document.querySelector("img[id='inpage_foto_upload_wt_appr']");

  //     	$("#inpage_save_notappr_wt_appr").hide();
  //     	$(".inpage_reason").hide();
  //     	$("#inpage_not_approve_wt_appr").show();
  //     	$("#inpage_approve_wt_appr").show();
  //     	$("#inpage_cancel_not_approve_wt_appr").hide();
  //     	$("#inpage_pengirim_wt_appr").val(dataHgSender);
  //     	$("#inpage_tanggal_upload_wt_appr").val(dataHgTglUpload);
  //     	$("#inpage_title_daily_wt_appr").val(dataHgJudul);
  //     	$("#inpage_siswa_daily_wt_appr").val(dataHgSiswa);
  //     	$("#inpage_id_daily_waiiting_wt_appr").val(dataHgDailyId);
  //     	hgImage.setAttribute("src", `../image_uploads/${dataHgImage}`);
  //     	$("#inpage_main_daily_wt_appr").html(dataHgDaily);

  // 	}

  	function showDataWaitAppr(dailyID, from, dateposted, nm, photo, title, main) {

	 	$("#inpage-wt-appr").modal('show');

      	let dataInPageDailyId 	= dailyID;
      	let dataInPageFrom    	= from;
      	let dataInPageTglUpload = dateposted;
      	let dataInPageSiswa   	= nm;
      	let dataInPageImage     = photo;
      	let hgImage     		= document.querySelector("img[id='inpage_foto_upload_wt_appr']");
      	hgImage.setAttribute("src", `../image_uploads/${dataInPageImage}`);
      	let dataInPageTitle 	= title;
      	let dataInPageMain      = main;

      	$("#inpage_id_daily_waiiting_wt_appr").val(dataInPageDailyId);
      	$("#inpage_pengirim_wt_appr").val(dataInPageFrom);
      	$("#inpage_tanggal_upload_wt_appr").val(dataInPageTglUpload);
      	$("#inpage_siswa_daily_wt_appr").val(dataInPageSiswa);
      	$("#inpage_title_daily_wt_appr").val(dataInPageTitle);
      	$("#inpage_main_daily_wt_appr").html(dataInPageMain);

  	}


	document.getElementById('isiMenu').innerHTML = `<span style="font-weight: bold;"> STATUS - </span>` + `<span style="font-weight: bold;"> WAITING APPROVAL </span>`

</script>