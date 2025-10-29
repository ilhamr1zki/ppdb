<?php  
	
	$timeOut        = $_SESSION['expire'];
    
  	$timeRunningOut = time() + 5;

  	$diMenu = "waiting";

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

	if ($timeRunningOut == $timeOut || $timeRunningOut > $timeOut) {

		$_SESSION['form_success'] = "session_time_out";

	    $timeIsOut = 1;
	    error_reporting(1);

	} else {

		$getDataBagian  = $_SESSION['c_kepsek'];

		$is_SD      = "/SD/i";
	  	$is_PAUD    = "/PAUD/i";
	  	$sd         = false;
	  	$paud       = false;

	  	$foundDataSD    = preg_match($is_SD, $getDataBagian);
	  	$foundDataPAUD  = preg_match($is_PAUD, $getDataBagian);

	  	if ($foundDataSD == 1) {

	  		// echo $_POST['judul'];exit;
			$queryWaitingApprovedDaily = mysqli_query($con, "
			    SELECT
			    daily_siswa_approved.from_nip as from_nip,
			    daily_siswa_approved.id as daily_id,
			    daily_siswa_approved.image as foto_upload,
			    daily_siswa_approved.isi_daily as isi_daily,
			    guru.nama as nama_guru,
			    admin.username as nama_user,
			    siswa.nama as nama_siswa,
			    daily_siswa_approved.status_approve as status,
			    daily_siswa_approved.title_daily as judul,
			    daily_siswa_approved.tanggal_dibuat as created_date,
			    daily_siswa_approved.tanggal_disetujui_atau_tidak as tanggal_disetujui_atau_tidak
			    FROM 
			    daily_siswa_approved 
			    LEFT JOIN guru
			    ON daily_siswa_approved.from_nip = guru.nip
			    LEFT JOIN admin
			    ON daily_siswa_approved.from_nip = admin.c_admin
			    LEFT JOIN siswa
			    ON daily_siswa_approved.nis_siswa = siswa.nis
			    WHERE daily_siswa_approved.status_approve = 0
			    AND daily_siswa_approved.departemen = 'SD'
	  			ORDER BY daily_siswa_approved.tanggal_dibuat DESC
	  		");

	  	} else if ($foundDataPAUD == 1) {

	  		// echo $_POST['judul'];exit;
			$queryWaitingApprovedDaily = mysqli_query($con, "
			    SELECT
			    daily_siswa_approved.from_nip as from_nip,
			    daily_siswa_approved.id as daily_id,
			    daily_siswa_approved.image as foto_upload,
			    daily_siswa_approved.isi_daily as isi_daily,
			    guru.nama as nama_guru,
			    admin.username as nama_user,
			    siswa.nama as nama_siswa,
			    daily_siswa_approved.status_approve as status,
			    daily_siswa_approved.title_daily as judul,
			    daily_siswa_approved.tanggal_dibuat as created_date,
			    daily_siswa_approved.tanggal_disetujui_atau_tidak as tanggal_disetujui_atau_tidak
			    FROM 
			    daily_siswa_approved 
			    LEFT JOIN guru
			    ON daily_siswa_approved.from_nip = guru.nip
			    LEFT JOIN admin
			    ON daily_siswa_approved.from_nip = admin.c_admin
			    LEFT JOIN siswa
			    ON daily_siswa_approved.nis_siswa = siswa.nis
			    WHERE daily_siswa_approved.status_approve = 0
			    AND daily_siswa_approved.departemen = 'PAUD'
	  			ORDER BY daily_siswa_approved.tanggal_dibuat DESC
	  		");

	  	}

  		$no = 1;

	}

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">

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
		                <th style="text-align: center; border: 1px solid black;" width="5%">NO</th>
			          	<th style="text-align: center; border: 1px solid black;"> CREATED BY </th>
			          	<th style="text-align: center; border: 1px solid black;"> STUDENT </th>
			          	<th style="text-align: center; border: 1px solid black;"> DAILY TITLE </th>
			          	<th style="text-align: center; border: 1px solid black;"> CREATED DATE </th>
			          	<th style="text-align: center; border: 1px solid black;"> STATUS </th>
		            </tr>
		        </thead>
		        <tbody>
		        	
		        	<?php foreach ($queryWaitingApprovedDaily as $waiting_appr): ?>
					      	
				      	<tr id="inpage_wtappr" style="background-color: aqua;" onclick="showDataWaitAppr(
				      		`<?= $waiting_appr['daily_id']; ?>`,
				      		`<?= $waiting_appr['status']; ?>`,
				      		`<?= $waiting_appr['nama_guru']; ?>`,
				      		`<?= $waiting_appr['created_date']; ?>`,
				      		`<?= $waiting_appr['tanggal_disetujui_atau_tidak']; ?>`,
				      		`<?= $waiting_appr['foto_upload']; ?>`,
				      		`<?= strtoupper($waiting_appr['nama_siswa']); ?>`,
				      		`<?= $waiting_appr['judul']; ?>`,
				      		`<?= $waiting_appr['isi_daily']; ?>`
				      	)">
					        <td style="text-align: center;"> <?= $no++; ?> </td>
					        <td style="text-align: center;"> <?= $waiting_appr['nama_guru'] ?> </td>
					        <td style="text-align: center;"> <?= strtoupper($waiting_appr['nama_siswa']); ?> </td>
					        <td style="text-align: center;"> <?= $waiting_appr['judul'] ?> </td>
					        <td style="text-align: center;"> <?= formatDateEnglish($waiting_appr['created_date']); ?> </td>
				        	<td style="text-align: center;"> Waiting <i class="glyphicon glyphicon-hourglass"></i> </td>

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

<script type="text/javascript">

	function showDataWaitAppr(dailyID, stat, from, datePosted, dateAppr, imgUpload, siswa, title, main) {

		$("#inpage-wt-appr").modal('show');
		let dataHgDailyId   = dailyID;
      	let dataHgSender    = from;
      	let dataHgSiswa 	= siswa;
      	let dataHgTglUpload = datePosted;
      	let dataHgImage     = imgUpload;
      	let dataHgJudul     = title;
      	let dataHgDaily     = main;

      	let hgImage     = document.querySelector("img[id='inpage_foto_upload_wt_appr']");

      	$("#inpage_save_notappr_wt_appr").hide();
      	$(".inpage_reason").hide();
      	$("#inpage_not_approve_wt_appr").show();
      	$("#inpage_approve_wt_appr").show();
      	$("#inpage_cancel_not_approve_wt_appr").hide();
      	$("#inpage_pengirim_wt_appr").val(dataHgSender);
      	$("#inpage_tanggal_upload_wt_appr").val(dataHgTglUpload);
      	$("#inpage_title_daily_wt_appr").val(dataHgJudul);
      	$("#inpage_siswa_daily_wt_appr").val(dataHgSiswa);
      	$("#inpage_id_daily_waiiting_wt_appr").val(dataHgDailyId);
      	hgImage.setAttribute("src", `../image_uploads/${dataHgImage}`);
      	$("#inpage_main_daily_wt_appr").html(dataHgDaily);

  	}

	let newIcon = document.getElementById("addIcon");
  	newIcon.classList.remove("fa");
  	newIcon.classList.add("glyphicon");
  	newIcon.classList.add("glyphicon-hourglass");

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

	$("#approve_in_page").click(function() {

      	$.ajax({
	        url  : `<?= $basekepsek; ?>data`,
	        type : "POST",
	        data : {
	          daily_id  : $("#id_daily_waiiting_in_page").val()
	        },
	        success:function(data) {

	          console.log(JSON.parse(data).status_approve);

	          Swal.fire({
	            title : "Approve",
	            icon  : "success",
	            timer : 1000
	          });

	          $("#not_approve_in_page").hide();
	          $("#approve_in_page").hide();
	          $("#close_not_yet_appr_in_page").click();

	        }

      	})

    })

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

	document.getElementById('isiMenu').innerHTML = `<span style="font-weight: bold;"> STATUS - </span>` + `<span style="font-weight: bold;"> WAITING APPROVAL </span>`

</script>