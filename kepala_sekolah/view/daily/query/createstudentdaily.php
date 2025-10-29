<?php  

	$timeOut        = $_SESSION['expire'];
    
  	$timeRunningOut = time() + 5;

	$timeIsOut 		= 0;
	$sesi      		= 0;
	$nama      		= "";
	$jumlahData 	= 0;

	$no 			= 1;
	$dataEmpty      = 0;

	$countDataActivity = "";

	$diMenu     	= "createstudentdaily";

	// echo "Waktu Habis : " . $timeOut . " Waktu Berjalan : " . $timeRunningOut;

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

  		if (isset($_POST['send_data_student'])) {
  			// echo "SINI";exit;
  			$nip 		= $_POST['nip'];
  			$nama 		= $_POST['nama_guru'];

  			$sesi      	= 0;

  			$getDataStudentByTeacher = mysqli_query($con, "
  				SELECT
	            daily_siswa_approved.from_nip AS fromnip,
	            daily_siswa_approved.nis_siswa AS nis_siswa,
	            guru.nama AS nama_guru,
	            guru.nip AS nip_guru,
	            siswa.nama AS nama_siswa,
	            daily_siswa_approved.departemen AS divisi,
	            daily_siswa_approved.title_daily AS title_daily,
	            daily_siswa_approved.isi_daily AS isi_daily,
            	daily_siswa_approved.image AS foto_upload,
	            daily_siswa_approved.tanggal_disetujui_atau_tidak AS tanggal_disetujui_atau_tidak,
	            daily_siswa_approved.status_approve AS status_approve,
	            ruang_pesan.room_key AS room_key
	            FROM daily_siswa_approved
	            LEFT JOIN siswa
	            ON daily_siswa_approved.nis_siswa = siswa.nis
	            LEFT JOIN guru
	            ON daily_siswa_approved.from_nip = guru.nip
	            LEFT JOIN ruang_pesan
	            ON ruang_pesan.daily_id = daily_siswa_approved.id
	            WHERE 
				daily_siswa_approved.from_nip = '$nip'
				AND daily_siswa_approved.status_approve != 0
				ORDER BY daily_siswa_approved.tanggal_disetujui_atau_tidak DESC
  			");

  			$countDataActivity = mysqli_num_rows($getDataStudentByTeacher);
  			// echo "<br>" . $countDataActivity;exit;

  		} else {
  			
  			$dataActivityFromTeacher = [];
  			$sesi      = 1;

  		}

  		$jumlahData = 5;

  	}

  	$upperName = strtoupper($nama);

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
			        <th style="text-align: center;"> STUDENT </th>
			        <th style="text-align: center;"> TITLE </th>
			        <th style="text-align: center;"> STATUS </th>
		          	<th style="text-align: center;"> DATE POSTED </th>
		          	<th style="text-align: center;"> ACTION </th>
	            </tr>
	        </thead>
	        <tbody>

	        	<?php if ($countDataActivity == 0): ?>
        			
        			<?php $dataEmpty = 0; ?>

        		<?php else: ?>
	        		<?php 
	        			$dataEmpty = 1; 
	        		?>
	        		<?php foreach ($getDataStudentByTeacher as $data): ?>
				      	
				      	<?php if ($data['status_approve'] == 1): ?>
				      		
				      		<tr style="background-color: limegreen; color: white; font-weight: bold;">
						        <td style="text-align: center;"> <?= $no++; ?> </td>
						        <td style="text-align: center;"> <?= strtoupper($data['nama_siswa']) ?> </td>
						        <td style="text-align: center;"> <?= $data['title_daily'] ?> </td>
						        <td style="text-align: center;"> APPROVED <i style="color: gold;" class="glyphicon glyphicon-ok"></i> </td>
						        <td style="text-align: center;"> <?= formatDateEnglish($data['tanggal_disetujui_atau_tidak']); ?> </td>
						        <td style="text-align: center;">
							        <form action="lookactivity" method="post">
							        	<input type="hidden" name="frompage" value="createstudentdaily">
							        	<input type="hidden" name="roomkey" value="<?= $data['room_key']; ?>">
							        	<input type="hidden" name="nis" value="<?= strtoupper($data['nis_siswa']); ?>">
							        	<input type="hidden" name="nama" value="<?= strtoupper($data['nama_siswa']); ?>">
							        	<input type="hidden" name="guru" value="<?= strtoupper($data['nama_guru']); ?>">
							        	<input type="hidden" name="foto" value="<?= strtoupper($data['foto_upload']); ?>">
							        	<input type="hidden" name="tglpost" value="<?= format_tgl_indo($data['tanggal_disetujui_atau_tidak']); ?>">
							        	<input type="hidden" name="nipguru_lookdaily" value="<?= $data['nip_guru']; ?>">
							        	<input type="hidden" name="tglori" value="<?= $data['tanggal_disetujui_atau_tidak']; ?>">
							        	<input type="hidden" name="judul" value="<?= $data['title_daily']; ?>">
							        	<input type="hidden" name="isi" value="<?= $data['isi_daily']; ?>">
							        	<button class="btn btn-sm btn-primary" style="text-align: center;" type="submit" name="krm"> <i class="glyphicon glyphicon-eye-open"></i> LOOK DAILY </button>
							        </form>
							    </td>
					      	</tr>

				      	<?php elseif($data['status_approve'] == 2): ?>

				      		<tr style="background-color: red; color: white; font-weight: bold;">
						        <td style="text-align: center;"> <?= $no++; ?> </td>
						        <td style="text-align: center;"> <?= strtoupper($data['nama_siswa']) ?> </td>
						        <td style="text-align: center;"> <?= $data['title_daily'] ?> </td>
						        <td style="text-align: center;"> NOT APPROVE </td>
						        <td style="text-align: center;"> <?= formatDateEnglish($data['tanggal_disetujui_atau_tidak']); ?> </td>
						        <td style="text-align: center;">
							    </td>
					      	</tr>

				      	<?php endif ?>

			      	<?php endforeach ?>

	        	<?php endif ?>
	            
	        </tbody>
	    </table>

	    <div class="row" style="float: right; margin-top: 10px; margin-right: 5px;">
					
			<div class="col-sm-3">
        		<button class="btn btn-sm btn-primary" id="backto_querydailystd"> <span class="glyphicon glyphicon-log-out" id="cancel"></span> Kembali </button>	
				<br>
			</div>

		</div>

	  </div>
	</div>

<!-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script> -->
<script src="view/daily/query/dataTables1.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script> -->
<script src="view/daily/query/moment.min.js"></script>
<!-- <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script> -->
<script src="view/daily/query/dateTime.min.js"></script>

<script type="text/javascript">
	
	let minDate, maxDate;
 
		 // Custom filtering function which will search data in column four between two values
		DataTable.ext.search.push(function (settings, data, dataIndex) {
			let min = minDate.val();
		    let max = maxDate.val();
		    let date = new Date(data[4]);

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
		  let table = new DataTable('#example');
		   
		  // Refilter the table
		  document.querySelectorAll('#min, #max').forEach((el) => {
		      el.addEventListener('change', () => table.draw());
		  });

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

	let dataMt = `<?= $dataEmpty; ?>`

	if(dataMt == 0) {
		Swal.fire(`Tidak Ada Data Daily Siswa <?= $nama; ?>`);
	}
	
	$(document).ready( function () {

    	let sesiForm = `<?= $sesi; ?>`

    	if (sesiForm == 1) {
    		const noData = setTimeout(showPopUpNoData, 1000);
    	}

	    $("#aList1").click();

	    setTimeout(clickSubMenu, 500);

	    function clickSubMenu() {
	      $("#isiList2").click();
	      $("#query_data_guru").css({
	          "background-color" : "#ccc",
	          "color" : "black"
	      });
	    }

	    $("#backto_querydailystd").click(function(){
	    	location.href = `<?= $basekepsek; ?>querydailyteacher`
	    });

	    let titleLists1   = document.getElementById('titleList1').innerHTML

		let newIcon = document.getElementById("addIcon");
		newIcon.classList.remove("fa");
		newIcon.classList.add("glyphicon");
		newIcon.classList.add("glyphicon-zoom-in");

		let getTitleList1 = document.getElementById('isiList2').innerHTML;
		$("#isiMenu").css({
			"margin-left" : "5px"
		});

		$("#spanIsiNama").css({
			"font-weight" : "bold"
		});

		document.getElementById('isiMenu').innerHTML =  `<span style="font-weight: bold;"> QUERY </span>`+ ' - <span style="font-weight: bold;"> TEACHER </span> - ' + `<span style="font-weight: bold;"> <?= $upperName; ?> </span>` 

	    function showPopUpNoData() {
	      Swal.fire({
	        title: 'TIDAK ADA DATA MURID YANG DIPILIH!',
	        icon: "warning"
	      });

	      setTimeout(redirectToPageDailyStudent, 1200);
	      
	    }

	    function redirectToPageDailyStudent() {
	    	location.href = `<?= $basekepsek; ?>querydailyteacher`;
	    }

	    function showPopUp() {
	      Swal.fire({
	        title: 'TIME IS OUT',
	        icon: "warning"
	      });

	      setTimeout(clearSession, 1200);
	      
	    }

	    function clearSession() {
	      $.ajax({
	        url : `../../../admin.php`,
	        type : 'POST',
	        data : {
	          clearSess : "out"
	        },
	        success:function(data) {
	          let checkDataOut = JSON.parse(data).clear
	          if(checkDataOut == true) {
	            document.location.href = `<?= $base; ?>login`
	          }
	        }

	      })
	    }

  	});

</script>