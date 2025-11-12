<?php  
	
		$timeOut        = $_SESSION['expire'];
    
    $timeRunningOut = time() + 5;

    $timeIsOut 		= 0;
    $validDataSiswa = 0;
    $validDataIbu 	= 0; 
    $totalValid    	= 0;

    $dataSiswaReject   	= mysqli_query($con, "
    	SELECT 
	    data_pendaftaran_siswa_ditolak.id, 
	    data_pendaftaran_siswa_ditolak.nama_calon_siswa, 
	    data_pendaftaran_siswa_ditolak.jenis_kelamin,
	    data_pendaftaran_siswa_ditolak.tempat_lahir,
	    data_pendaftaran_siswa_ditolak.tanggal_lahir,
	    upload_file.nama_file  
	    FROM data_pendaftaran_siswa_ditolak
	    LEFT JOIN upload_file
	    ON data_pendaftaran_siswa_ditolak.id = upload_file.id_siswa_diterima_ditolak
	    ORDER BY data_pendaftaran_siswa_ditolak.tanggal_formulir_dibuat ASC
    ");

  	$no      		    = 1;

  	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';

	    for ($i = 0; $i < $length; $i++) {
	      $randomString .= $characters[random_int(0, $charactersLength - 1)];
	    }

	    return $randomString;
  	}

    if (isset($_POST['upload_file'])) {
	    // Check if a file was uploaded
	    if (isset($_FILES['up_file']) && $_FILES['up_file']['error'] == 0) {
	      $file         = $_FILES['up_file'];
	      $id_diterima  = $_POST['id_siswa_terima'];
	      // echo $id_diterima;exit;
	      $nama_siswa   = mysqli_real_escape_string($con, htmlspecialchars($_POST['siswa_diterima']));
	      // Set the maximum file size (5 MB = 5 * 1024 * 1024 bytes)
	      $maxSize = 6 * 1024 * 1024;

	      // Get file extension and MIME type
	      $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
	      $fileMimeType = mime_content_type($file['tmp_name']);

	      // Validate file type (only PDF allowed)
	      if ($fileExtension !== 'pdf' || $fileMimeType !== 'application/pdf') {
	          echo "Invalid file type. Only PDF files are allowed.";
	          exit; // Stop further processing
	      }

	      // Validate file size (must be less than or equal to 5 MB)
	      if ($file['size'] > $maxSize) {
	          echo "File size exceeds the 5 MB limit. Please upload a smaller file.";
	          exit; // Stop further processing
	      }

	      // Define the upload directory
	      $uploadDir = 'uploads/ppdb_ditolak/pdf_send_to_otm/';
	      // Make sure the upload directory exists
	      if (!is_dir($uploadDir)) {
	          mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
	      }

	      // Define the path to store the uploaded file
	      $filePath = $uploadDir . basename(generateRandomString() . "-". $file['name']);
	      $nameFile = mysqli_real_escape_string($con, htmlspecialchars(str_replace(['uploads/ppdb_ditolak/pdf_send_to_otm/'], '', $filePath)));

	      // Attempt to move the uploaded file to the desired directory
	      if (move_uploaded_file($file['tmp_name'], $filePath)) {
	        
	        // Check Jika file PDF belum pernah di upload
	        $queryCheckFile = mysqli_query($con, "
	          SELECT id_siswa_diterima_ditolak, nama_siswa, nama_file 
	          FROM upload_file
	          WHERE id_siswa_diterima_ditolak = '$id_diterima'
	        ");

	        $countCheckFile = mysqli_num_rows($queryCheckFile);

	        if ($countCheckFile == 0) {

	          $insertFileUpload = mysqli_query($con, "
	            INSERT INTO upload_file 
	            SET 
	            id_siswa_diterima_ditolak 	= '$id_diterima',
	            nama_siswa        			= '$nama_siswa',
	            nama_file         			= '$nameFile',
	            status            			= 2
	          ");

	          if ($insertFileUpload) {

	            $_SESSION['import_success'] = "status_tolak";

	            $dataSiswaReject    = mysqli_query($con, "
	              	SELECT 
				    data_pendaftaran_siswa_ditolak.id, 
				    data_pendaftaran_siswa_ditolak.nama_calon_siswa, 
				    data_pendaftaran_siswa_ditolak.jenis_kelamin,
				    data_pendaftaran_siswa_ditolak.tempat_lahir,
				    data_pendaftaran_siswa_ditolak.tanggal_lahir,
				    upload_file.nama_file  
				    FROM data_pendaftaran_siswa_ditolak
				    LEFT JOIN upload_file
				    ON data_pendaftaran_siswa_ditolak.id = upload_file.id_siswa_diterima_ditolak
				    ORDER BY data_pendaftaran_siswa_ditolak.tanggal_formulir_dibuat ASC
	            ");

	          } else {

	            $_SESSION['import_fail'] = "gagal";

	            $dataSiswaReject    = mysqli_query($con, "
	              	SELECT 
				    data_pendaftaran_siswa_ditolak.id, 
				    data_pendaftaran_siswa_ditolak.nama_calon_siswa, 
				    data_pendaftaran_siswa_ditolak.jenis_kelamin,
				    data_pendaftaran_siswa_ditolak.tempat_lahir,
				    data_pendaftaran_siswa_ditolak.tanggal_lahir,
				    upload_file.nama_file  
				    FROM data_pendaftaran_siswa_ditolak
				    LEFT JOIN upload_file
				    ON data_pendaftaran_siswa_ditolak.id = upload_file.id_siswa_diterima_ditolak
				    ORDER BY data_pendaftaran_siswa_ditolak.tanggal_formulir_dibuat ASC
	            ");

	          }

	        } else {

        	// check jika siswa sudah pernah upload file PDF
          	$getNameFile = mysqli_fetch_assoc($queryCheckFile);

          	$file = "uploads/ppdb_ditolak/pdf_send_to_otm/" . $getNameFile['nama_file'];

          	if (file_exists($file)) {

            	if (unlink($file)) {

            		// Check jika file PDF sudah pernah di upload atau sudah ada
			          $updateFileUpload = mysqli_query($con, "
			            UPDATE upload_file 
			            SET 
			            nama_file         = '$nameFile'
			            WHERE id_siswa_diterima_ditolak = '$id_diterima'
			          ");

			          if ($updateFileUpload) {

			            $_SESSION['import_success'] = "status_tolak";

			            $dataSiswaReject    = mysqli_query($con, "
		              	SELECT 
								    data_pendaftaran_siswa_ditolak.id, 
								    data_pendaftaran_siswa_ditolak.nama_calon_siswa, 
								    data_pendaftaran_siswa_ditolak.jenis_kelamin,
								    data_pendaftaran_siswa_ditolak.tempat_lahir,
								    data_pendaftaran_siswa_ditolak.tanggal_lahir,
								    upload_file.nama_file  
								    FROM data_pendaftaran_siswa_ditolak
								    LEFT JOIN upload_file
								    ON data_pendaftaran_siswa_ditolak.id = upload_file.id_siswa_diterima_ditolak
								    ORDER BY data_pendaftaran_siswa_ditolak.tanggal_formulir_dibuat ASC
			            ");

			          } else {

			            $_SESSION['import_fail'] = "gagal";

			            $dataSiswaReject    = mysqli_query($con, "
		              	SELECT 
								    data_pendaftaran_siswa_ditolak.id, 
								    data_pendaftaran_siswa_ditolak.nama_calon_siswa, 
								    data_pendaftaran_siswa_ditolak.jenis_kelamin,
								    data_pendaftaran_siswa_ditolak.tempat_lahir,
								    data_pendaftaran_siswa_ditolak.tanggal_lahir,
								    upload_file.nama_file  
								    FROM data_pendaftaran_siswa_ditolak
								    LEFT JOIN upload_file
								    ON data_pendaftaran_siswa_ditolak.id = upload_file.id_siswa_diterima_ditolak
								    ORDER BY data_pendaftaran_siswa_ditolak.tanggal_formulir_dibuat ASC
			            ");

			          }

            	}

            } else {

            	$_SESSION['import_fail'] = "gagal";

	            $dataSiswaReject    = mysqli_query($con, "
              	SELECT 
						    data_pendaftaran_siswa_ditolak.id, 
						    data_pendaftaran_siswa_ditolak.nama_calon_siswa, 
						    data_pendaftaran_siswa_ditolak.jenis_kelamin,
						    data_pendaftaran_siswa_ditolak.tempat_lahir,
						    data_pendaftaran_siswa_ditolak.tanggal_lahir,
						    upload_file.nama_file  
						    FROM data_pendaftaran_siswa_ditolak
						    LEFT JOIN upload_file
						    ON data_pendaftaran_siswa_ditolak.id = upload_file.id_siswa_diterima_ditolak
						    ORDER BY data_pendaftaran_siswa_ditolak.tanggal_formulir_dibuat ASC
	            ");

            }

	        }

	      } else {
	          echo "Error uploading the file. Please try again.";
	      }
	    } else {
	        echo "No file uploaded or there was an upload error.";
	    }
  	}

?>


<div class="row">
    
  <div class="col-xs-12 col-md-12 col-lg-12">

    <?php if(isset($_SESSION['import_success']) && $_SESSION['import_success'] == 'status_tolak'){?>
      <div style="display: none;" class="alert alert-warning alert-dismissable"> <?= "File PDF Berhasil Di Upload"; ?>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php unset($_SESSION['import_success']); ?>
      </div>
    <?php } ?>

    <?php if(isset($_SESSION['import_fail']) && $_SESSION['import_fail'] == 'gagal'){?>
      <div style="display: none;" class="alert alert-danger alert-dismissable"> <?= "File PDF Gagal Di Upload !"; ?>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php unset($_SESSION['import_fail']); ?>
      </div>
    <?php } ?>

  </div>

</div>

<div class="box box-info">

    <center> 
      <h4 id="judul_daily">
        <strong> <u> DATA CALON SISWA YANG TELAH DITOLAK </u> </strong> 
      </h4> 
    </center>

    <!-- <div class="form-group"> -->
      
    <!-- </div> -->

    <div class="box-body table-responsive">

    	<form method="post" action="send">
        <input type="hidden" name="is_data" value="rej">
        <input type="hidden" name="token" value="<?= generateRandomString(25); ?>">
        <button class="btn btn-sm btn-success" type="submit"> <i class="glyphicon glyphicon-envelope"></i> KIRIM PESAN </button>
      </form>
      <br>
      <br>

      <table id="list_siswa_acc" style="text-align: center;" class="table table-bordered table-hover">

        <thead>
          <tr style="background-color: lightyellow; font-weight: bold;">
            <th style="text-align: center; border: 1px solid black;" width="5%">NO</th>
            <th style="text-align: center; border: 1px solid black; width: 10px;"> NAMA CALON SISWA </th>
            <th style="text-align: center; border: 1px solid black; width: 10px;"> JENIS KELAMIN </th>
            <th style="text-align: center; border: 1px solid black; width: 10px;"> TEMPAT TANGGAL LAHIR </th>
            <th style="text-align: center; border: 1px solid black; width: 10px;"> FILE PDF </th>
            <th style="text-align: center; border: 1px solid black; width: 10px;"> ACTION </th>
            <!-- <th style="text-align: center;"> DAILY </th> -->
            <!-- Terdapat Administrasi Pembiayaan Yang Perlu Di Selesaikan -->
          </tr>
        </thead>

        <tbody>
          
        	<?php foreach ($dataSiswaReject as $data): ?>
        			
        		<tr>
        			<td> <?= $no++; ?> </td>
        			<td> <?= $data['nama_calon_siswa']; ?> </td>
        			<td> <?= $data['jenis_kelamin']; ?> </td>
              		<td> <?= $data['tempat_lahir']; ?>, <?= str_replace(["00:00:00"], "", tglIndo($data['tanggal_lahir'])) ; ?> </td>
        			<td> <a href="<?= $basead . 'uploads/ppdb_ditolak/pdf_send_to_otm/' . $data['nama_file']; ?>" target="blank"> <?= $data['nama_file']; ?> </a> </td>
        			<td> <button class="btn btn-light" data-toggle="modal" data-target="#exampleModalCenter<?= $data['id']; ?>"> <i class="glyphicon glyphicon-upload"></i> UPLOAD PDF </button> </td>
        		</tr>

	            <div class="modal fade" id="exampleModalCenter<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	              <div class="modal-dialog modal-dialog-centered" role="document">
	                <div class="modal-content">
	                  <div class="modal-header">
	                    <h4 class="modal-title" id="exampleModalCenterTitle"> <i class="glyphicon glyphicon-file"></i> UPLOAD PDF </h4>
	                  </div>
	                  <div class="modal-body">

	                    <h4 style="margin-top: -10px; margin-bottom: 25px;"> <b> <?= $data['nama_calon_siswa']; ?> </b> </h4>

	                    <form enctype="multipart/form-data" method="post">
	                      <input type="hidden" name="id_siswa_terima" value="<?= $data['id']; ?>">
	                      <input type="hidden" name="siswa_diterima" value="<?= $data['nama_calon_siswa']; ?>">
	                      <div class="form-group">
	                        <label for="recipient-name" class="col-form-label"> UPLOAD FILE (PDF) (MAX 5 MB) </label>
	                        <input type="file" class="form-control" name="up_file" id="uploadfile" accept=".pdf" multiple required>
	                      </div>
	                  </div>
	                  <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                    <button type="submit" name="upload_file" class="btn btn-success"> <i class="glyphicon glyphicon-upload"></i> Upload </button>
	                    </form>
	                  </div>
	                </div>
	              </div>
	            </div>

        	<?php endforeach ?>

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
    newIcon.classList.add("glyphicon-remove-sign");

	document.getElementById('isiMenu').innerHTML = `STATUS CALON SISWA DITOLAK`

	document.querySelectorAll("#uploadfile").forEach(function(input) {
	    input.addEventListener("change", function() {
	      const file = this.files[0];
	      
	      if (file) {
	        const validType = file.type === "application/pdf";
	        const validExt = file.name.toLowerCase().endsWith(".pdf");
	        const maxSize = 6 * 1024 * 1024; // 5 MB (dalam byte)

	        // Validasi format file
	        if (!validType || !validExt) {
	          alert("File harus berformat PDF (.pdf)");
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