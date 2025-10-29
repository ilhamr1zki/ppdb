<?php  
	
	$timeOut        = $_SESSION['expire'];
    
	$timeRunningOut = time() + 5;

	$timeIsOut = 0;
	$sesi      = 0;

	$diMenu    = "not_approved";

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

	function format_tgl_indo_appr($date){  
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

	// echo "Waktu Habis : " . $timeOut . " Waktu Berjalan : " . $timeRunningOut . "<br>";

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

	  		$queryNotApprovedDaily         = mysqli_query($con, "
			    SELECT
			    daily_siswa_approved.from_nip as from_nip,
			    daily_siswa_approved.id as daily_id,
			    daily_siswa_approved.title_daily as judul,
			    daily_siswa_approved.isi_daily as isi_daily,
			    guru.nama as nama_guru,
			    admin.username as nama_user,
			    siswa.nama as nama_siswa,
			    daily_siswa_approved.status_approve as status,
			    daily_siswa_approved.tanggal_dibuat as created_date,
			    daily_siswa_approved.image as foto_upload,
			    daily_siswa_approved.tanggal_disetujui_atau_tidak as tanggal_disetujui_atau_tidak,
			    reason.is_reason as isi_alasan
			    FROM 
			    daily_siswa_approved 
			    LEFT JOIN guru
			    ON daily_siswa_approved.from_nip = guru.nip
			    LEFT JOIN admin
			    ON daily_siswa_approved.from_nip = admin.c_admin
			    LEFT JOIN siswa
			    ON daily_siswa_approved.nis_siswa = siswa.nis
			    LEFT JOIN reason
			    ON daily_siswa_approved.id = reason.daily_siswa_id
			    WHERE daily_siswa_approved.status_approve = 2
			    AND daily_siswa_approved.departemen = 'SD'
			    ORDER BY daily_siswa_approved.tanggal_disetujui_atau_tidak DESC
			  ");

	  	} else if ($foundDataPAUD == 1) {

	  		$queryNotApprovedDaily         = mysqli_query($con, "
			    SELECT
			    daily_siswa_approved.from_nip as from_nip,
			    daily_siswa_approved.id as daily_id,
			    daily_siswa_approved.title_daily as judul,
			    daily_siswa_approved.isi_daily as isi_daily,
			    guru.nama as nama_guru,
			    admin.username as nama_user,
			    siswa.nama as nama_siswa,
			    daily_siswa_approved.status_approve as status,
			    daily_siswa_approved.tanggal_dibuat as created_date,
			    daily_siswa_approved.image as foto_upload,
			    daily_siswa_approved.tanggal_disetujui_atau_tidak as tanggal_disetujui_atau_tidak,
			    reason.is_reason as isi_alasan
			    FROM 
			    daily_siswa_approved 
			    LEFT JOIN guru
			    ON daily_siswa_approved.from_nip = guru.nip
			    LEFT JOIN admin
			    ON daily_siswa_approved.from_nip = admin.c_admin
			    LEFT JOIN siswa
			    ON daily_siswa_approved.nis_siswa = siswa.nis
			    LEFT JOIN reason
			    ON daily_siswa_approved.id = reason.daily_siswa_id
			    WHERE daily_siswa_approved.status_approve = 2
			    AND daily_siswa_approved.departemen = 'PAUD'
			    ORDER BY daily_siswa_approved.tanggal_disetujui_atau_tidak DESC
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

    <table id="example" border="1" class="display nowrap" style="width:100%">
        <thead style="background-color: lightyellow;">
            <tr>
                <th style="text-align: center;" width="5%">NO</th>
	          	<th style="text-align: center;"> CREATED BY </th>
		        <th style="text-align: center;"> STUDENT </th>
		        <th style="text-align: center;"> TITLE </th>
		        <th style="text-align: center;"> STATUS </th>
	          	<th style="text-align: center;"> CREATED DATE </th>
	          	<th style="text-align: center;"> DATE NOT APPROVED </th>
            </tr>
        </thead>
        <tbody>
        	
        	<?php foreach ($queryNotApprovedDaily as $not_appr): ?>
			      	
		      	<tr id="tr_dashboard" style="background-color: red; color: yellow; font-weight: bold;" data-id="<?= $not_appr['daily_id']; ?>" onclick="showDataNotApproved(
		      		`<?= $not_appr['daily_id']; ?>`,
		      		`<?= format_tgl_indo_appr($not_appr['tanggal_disetujui_atau_tidak']); ?>`,
		      		`<?= $not_appr['nama_guru']; ?>`,
		      		`<?= format_tgl_indo_appr($not_appr['created_date']); ?>`,
		      		`<?= strtoupper($not_appr['nama_siswa']); ?>`,
		      		`<?= $not_appr['foto_upload']; ?>`,
		      		`<?= $not_appr['judul']; ?>`,
		      		`<?= $not_appr['isi_daily']; ?>`,
		      		`<?= $not_appr['isi_alasan']; ?>`
		      	)">
			        <td style="text-align: center;">  <?= $no++; ?> </td>
			        <td style="text-align: center;">  <?= $not_appr['nama_guru'] ?> </td>
			        <td style="text-align: center;">  <?= strtoupper($not_appr['nama_siswa']) ?> </td>
			        <td style="text-align: center;">  <?= $not_appr['judul'] ?> </td>
			        <td style="text-align: center;"> NOT APPROVE </td>
			        <td style="text-align: center;">  <?= formatDateEnglish($not_appr['created_date']); ?> </td>
			        <td style="text-align: center;">  <?= formatDateEnglish($not_appr['tanggal_disetujui_atau_tidak']); ?> </td>

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
	
	var minDate =""; 
	var maxDate = "";
 
		 // Custom filtering function which will search data in column four between two values
		DataTable.ext.search.push(function (settings, data, dataIndex) {
			var min = minDate.val();
		    var max = maxDate.val();
		    var date = new Date(data[6]);

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

</script>

<script type="text/javascript">

	$(document).ready(function() {

		$("#aList1").click();
		$("#isiList3").click();
		$("#stat_not_appr").css({
	        "background-color" : "#ccc",
	        "color" : "black"
	  	});

	  	$("#addIcon").css({
	        "top" : "3px"
	  	});

	  	$("#isiMenu").css({
	        "margin-left" : "5px"
	  	});

	  	let newIcon = document.getElementById("addIcon");
	  	newIcon.classList.remove("fa");
		newIcon.classList.add("glyphicon");
		newIcon.classList.add("glyphicon-thumbs-down");

		document.getElementById('isiMenu').innerHTML = `<span style="font-weight: bold;"> STATUS - </span>` + `<span style="font-weight: bold;"> NOT APPROVED </span>`
		

	})
	
	function showDataNotApproved(daily_id, dateNotApproved, sender, datePosted, nm, photo, title, main, reason='ksg') {

		$("#inpage-not-approved").modal('show');

		$("#inpage_date_not_approved").val(dateNotApproved);
		$("#inpage_pengirim_notappr").val(sender);
		$("#inpage_tanggal_upload_notappr").val(datePosted);
		$("#inpage_siswa_daily_notappr").val(nm);
		let imageInPage     	= document.querySelector("img[id='inpage_foto_upload_notappr']");
		imageInPage.setAttribute("src", `../image_uploads/${photo}`);
		$("#inpage_title_daily_notappr").val(title);
		$("#inpage_main_daily_notappr").html(main);

		if (reason != 'ksg') {
			if(reason == 'no_comment') {
                $("#inpage_div_notappr_reason").hide();
          	} else if (reason != 'no_comment') {
                $("#inpage_div_notappr_reason").show();
                $("#inpage_reason_notappr").text(reason); 
          	}
		}


	}


</script>