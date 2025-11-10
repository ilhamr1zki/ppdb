<?php  

  $dataSiswaAcc    = mysqli_query($con, "
    SELECT 
    data_pendaftaran_siswa_diterima.id, 
    data_pendaftaran_siswa_diterima.nama_calon_siswa, 
    data_pendaftaran_siswa_diterima.jenis_kelamin,
    data_pendaftaran_siswa_diterima.tempat_lahir,
    data_pendaftaran_siswa_diterima.tanggal_lahir,
    upload_file.nama_file  
    FROM data_pendaftaran_siswa_diterima
    LEFT JOIN upload_file
    ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
    ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
  ");

  $no      		  = 1;

  $timeIsOut 		= 0;
  $arr_res      =[];

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
      $nama_siswa   = mysqli_real_escape_string($con, htmlspecialchars($_POST['siswa_diterima']));
      // Set the maximum file size (5 MB = 5 * 1024 * 1024 bytes)
      $maxSize = 5 * 1024 * 1024;

      // Get file extension and MIME type
      $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
      $fileMimeType = mime_content_type($file['tmp_name']);

      // Validate file type (only PDF allowed)
      if ($fileExtension !== 'pdf' || $fileMimeType !== 'application/pdf') {

        $_SESSION['upload_file_err'] = "invalid_type_file";

        $dataSiswaAcc    = mysqli_query($con, "
          SELECT 
          data_pendaftaran_siswa_diterima.id, 
          data_pendaftaran_siswa_diterima.nama_calon_siswa, 
          data_pendaftaran_siswa_diterima.jenis_kelamin,
          data_pendaftaran_siswa_diterima.tempat_lahir,
          data_pendaftaran_siswa_diterima.tanggal_lahir,
          upload_file.nama_file  
          FROM data_pendaftaran_siswa_diterima
          LEFT JOIN upload_file
          ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
          ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
        ");

      }

      // Validate file size (must be less than or equal to 5 MB)
      if ($file['size'] > $maxSize) {

        $_SESSION['upload_file_err'] = "file_oversize_limit";

        $dataSiswaAcc    = mysqli_query($con, "
          SELECT 
          data_pendaftaran_siswa_diterima.id, 
          data_pendaftaran_siswa_diterima.nama_calon_siswa, 
          data_pendaftaran_siswa_diterima.jenis_kelamin,
          data_pendaftaran_siswa_diterima.tempat_lahir,
          data_pendaftaran_siswa_diterima.tanggal_lahir,
          upload_file.nama_file  
          FROM data_pendaftaran_siswa_diterima
          LEFT JOIN upload_file
          ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
          ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
        ");

      }

      // Define the upload directory
      $uploadDir = 'uploads/ppdb_diterima/pdf_send_to_otm/';
      // Make sure the upload directory exists
      if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
      }

      // Define the path to store the uploaded file
      $filePath = $uploadDir . basename(generateRandomString() . "-". $file['name']);
      $nameFile = mysqli_real_escape_string($con, htmlspecialchars(str_replace(['uploads/ppdb_diterima/pdf_send_to_otm/'], '', $filePath)));

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
            id_siswa_diterima_ditolak = '$id_diterima',
            nama_siswa        = '$nama_siswa',
            nama_file         = '$nameFile',
            status            = 1
          ");

          if ($insertFileUpload) {

            $_SESSION['import_success'] = "berhasil";

            $dataSiswaAcc    = mysqli_query($con, "
              SELECT 
              data_pendaftaran_siswa_diterima.id, 
              data_pendaftaran_siswa_diterima.nama_calon_siswa, 
              data_pendaftaran_siswa_diterima.jenis_kelamin,
              data_pendaftaran_siswa_diterima.tempat_lahir,
              data_pendaftaran_siswa_diterima.tanggal_lahir,
              upload_file.nama_file  
              FROM data_pendaftaran_siswa_diterima
              LEFT JOIN upload_file
              ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
              ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
            ");

          } else {

            $_SESSION['import_fail'] = "gagal";

            $dataSiswaAcc    = mysqli_query($con, "
              SELECT 
              data_pendaftaran_siswa_diterima.id, 
              data_pendaftaran_siswa_diterima.nama_calon_siswa, 
              data_pendaftaran_siswa_diterima.jenis_kelamin,
              data_pendaftaran_siswa_diterima.tempat_lahir,
              data_pendaftaran_siswa_diterima.tanggal_lahir,
              upload_file.nama_file  
              FROM data_pendaftaran_siswa_diterima
              LEFT JOIN upload_file
              ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
              ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
            ");

          }

        } else {

          // check jika siswa sudah pernah upload file PDF
          $getNameFile = mysqli_fetch_assoc($queryCheckFile);

          $file = "uploads/ppdb_diterima/pdf_send_to_otm/" . $getNameFile['nama_file'];

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

                $_SESSION['import_success'] = "berhasil";

                $dataSiswaAcc    = mysqli_query($con, "
                  SELECT 
                  data_pendaftaran_siswa_diterima.id, 
                  data_pendaftaran_siswa_diterima.nama_calon_siswa, 
                  data_pendaftaran_siswa_diterima.jenis_kelamin,
                  data_pendaftaran_siswa_diterima.tempat_lahir,
                  data_pendaftaran_siswa_diterima.tanggal_lahir,
                  upload_file.nama_file  
                  FROM data_pendaftaran_siswa_diterima
                  LEFT JOIN upload_file
                  ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
                  ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
                ");

              }

            }

          } else {

            $_SESSION['import_fail'] = "gagal";

            $dataSiswaAcc    = mysqli_query($con, "
              SELECT 
              data_pendaftaran_siswa_diterima.id, 
              data_pendaftaran_siswa_diterima.nama_calon_siswa, 
              data_pendaftaran_siswa_diterima.jenis_kelamin,
              data_pendaftaran_siswa_diterima.tempat_lahir,
              data_pendaftaran_siswa_diterima.tanggal_lahir,
              upload_file.nama_file  
              FROM data_pendaftaran_siswa_diterima
              LEFT JOIN upload_file
              ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
              ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
            ");

          }

        }

      } else {
          echo "Error uploading the file. Please try again.";
      }
    } else {

      $_SESSION['upload_file_err'] = "upload_error";

      $dataSiswaAcc    = mysqli_query($con, "
        SELECT 
        data_pendaftaran_siswa_diterima.id, 
        data_pendaftaran_siswa_diterima.nama_calon_siswa, 
        data_pendaftaran_siswa_diterima.jenis_kelamin,
        data_pendaftaran_siswa_diterima.tempat_lahir,
        data_pendaftaran_siswa_diterima.tanggal_lahir,
        upload_file.nama_file  
        FROM data_pendaftaran_siswa_diterima
        LEFT JOIN upload_file
        ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
        ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
      ");

    }
  }

  if (isset($_POST['delete_data'])) {

    $arr_res['id']          = $_POST['id_siswa'];
    $arr_res['nama_siswa']  = $_POST['siswa_dihapus'];

    // Check ID terdaftar atau tidak
    $queryFindData = mysqli_query($con, "
      SELECT id, nama_calon_siswa FROM data_pendaftaran_siswa_diterima
      WHERE id = '$arr_res[id]'
    ");

    $countData = mysqli_num_rows($queryFindData);

    if ($countData == 1) {

      // check jika siswa sudah pernah upload file PDF
      $queryCheckFilePdf = mysqli_query($con, "
        SELECT nama_siswa, nama_file FROM upload_file
        WHERE id_siswa_diterima_ditolak = '$arr_res[id]' ;
      ");

      $countDataFile = mysqli_num_rows($queryCheckFilePdf);

      if ($countDataFile == 1) {
        $getNameFile = mysqli_fetch_assoc($queryCheckFilePdf); 

        $file = "uploads/ppdb_diterima/pdf_send_to_otm/" . $getNameFile['nama_file'];
        // echo $file;exit;

        if (file_exists($file)) {

          if (unlink($file)) {

            $queryDelete = mysqli_query($con, "
              DELETE FROM data_pendaftaran_siswa_diterima
              WHERE id = '$arr_res[id]'
            ");

            if ($queryDelete) {

              $queryDeleteFile = mysqli_query($con, "
                DELETE FROM upload_file
                WHERE id_siswa_diterima_ditolak = '$arr_res[id]'
              ");

              if ($queryDeleteFile) {

                $dataSiswaAcc    = mysqli_query($con, "
                  SELECT 
                  data_pendaftaran_siswa_diterima.id, 
                  data_pendaftaran_siswa_diterima.nama_calon_siswa, 
                  data_pendaftaran_siswa_diterima.jenis_kelamin,
                  data_pendaftaran_siswa_diterima.tempat_lahir,
                  data_pendaftaran_siswa_diterima.tanggal_lahir,
                  upload_file.nama_file  
                  FROM data_pendaftaran_siswa_diterima
                  LEFT JOIN upload_file
                  ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
                  ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
                ");

                $_SESSION['delete_student'] = "berhasil";

              }

            }
          
          }

        } else {

          $queryDelete = mysqli_query($con, "
            DELETE FROM data_pendaftaran_siswa_diterima
            WHERE id = '$arr_res[id]'
          ");

          if ($queryDelete) {

            $queryDeleteFile = mysqli_query($con, "
              DELETE FROM upload_file
              WHERE id_siswa_diterima_ditolak = '$arr_res[id]'
            ");

            if ($queryDeleteFile) {

              $dataSiswaAcc    = mysqli_query($con, "
                SELECT 
                data_pendaftaran_siswa_diterima.id, 
                data_pendaftaran_siswa_diterima.nama_calon_siswa, 
                data_pendaftaran_siswa_diterima.jenis_kelamin,
                data_pendaftaran_siswa_diterima.tempat_lahir,
                data_pendaftaran_siswa_diterima.tanggal_lahir,
                upload_file.nama_file  
                FROM data_pendaftaran_siswa_diterima
                LEFT JOIN upload_file
                ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
                ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
              ");

              $_SESSION['delete_student'] = "berhasil";

            }

          }

        }

      } else if ($countDataFile == 0) {

        $queryDelete = mysqli_query($con, "
          DELETE FROM data_pendaftaran_siswa_diterima
          WHERE id = '$arr_res[id]'
        ");

        if ($queryDelete) {

          $dataSiswaAcc    = mysqli_query($con, "
            SELECT 
            data_pendaftaran_siswa_diterima.id, 
            data_pendaftaran_siswa_diterima.nama_calon_siswa, 
            data_pendaftaran_siswa_diterima.jenis_kelamin,
            data_pendaftaran_siswa_diterima.tempat_lahir,
            data_pendaftaran_siswa_diterima.tanggal_lahir,
            upload_file.nama_file  
            FROM data_pendaftaran_siswa_diterima
            LEFT JOIN upload_file
            ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
            ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
          ");

          $_SESSION['delete_student'] = "berhasil";

        }

      }
      
    } else if ($countData == 0) {

      $dataSiswaAcc    = mysqli_query($con, "
        SELECT 
        data_pendaftaran_siswa_diterima.id, 
        data_pendaftaran_siswa_diterima.nama_calon_siswa, 
        data_pendaftaran_siswa_diterima.jenis_kelamin,
        data_pendaftaran_siswa_diterima.tempat_lahir,
        data_pendaftaran_siswa_diterima.tanggal_lahir,
        upload_file.nama_file  
        FROM data_pendaftaran_siswa_diterima
        LEFT JOIN upload_file
        ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
        ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
      ");

      $_SESSION['delete_student'] = "gagal";

    }

  }

?>

<div class="row">
    
  <div class="col-xs-12 col-md-12 col-lg-12">

    <?php if(isset($_SESSION['import_success']) && $_SESSION['import_success'] == 'berhasil'){?>
      <div style="display: none;" class="alert alert-warning alert-dismissable"> <?= "File PDF Berhasil Di Upload"; ?>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php unset($_SESSION['import_success']); ?>
      </div>
    <?php } ?>

    <?php if(isset($_SESSION['delete_student']) && $_SESSION['delete_student'] == 'berhasil'){?>
      <div style="display: none;" class="alert alert-warning alert-dismissable"> <?= "Data Calon Siswa PPDB $arr_res[nama_siswa] Berhasil Dihapus"; ?>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php unset($_SESSION['delete_student']); ?>
      </div>
    <?php } ?>

    <?php if(isset($_SESSION['import_fail']) && $_SESSION['import_fail'] == 'gagal'){?>
      <div style="display: none;" class="alert alert-danger alert-dismissable"> <?= "File PDF Gagal Di Upload !"; ?>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php unset($_SESSION['import_fail']); ?>
      </div>
    <?php } ?>

    <?php if(isset($_SESSION['delete_student']) && $_SESSION['delete_student'] == 'gagal'){?>
      <div style="display: none;" class="alert alert-danger alert-dismissable"> <?= "Data Calon Siswa PPDB $arr_res[nama_siswa] Gagal Dihapus !"; ?>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php unset($_SESSION['delete_student']); ?>
      </div>
    <?php } ?>

    <?php if(isset($_SESSION['upload_file_err']) && $_SESSION['upload_file_err'] == 'upload_error'){?>
      <div style="display: none;" class="alert alert-danger alert-dismissable"> <?= "Tidak Ada File Yang Di Upload !"; ?>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php unset($_SESSION['upload_file_err']); ?>
      </div>
    <?php } ?>

    <?php if(isset($_SESSION['upload_file_err']) && $_SESSION['upload_file_err'] == 'invalid_type_file'){?>
      <div style="display: none;" class="alert alert-danger alert-dismissable"> <?= "File yang di input tidak valid !"; ?>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php unset($_SESSION['upload_file_err']); ?>
      </div>
    <?php } ?>

    <?php if(isset($_SESSION['upload_file_err']) && $_SESSION['upload_file_err'] == 'file_oversize_limit'){?>
      <div style="display: none;" class="alert alert-danger alert-dismissable"> <?= "Ukuran file yang di upload terlalu besar !"; ?>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php unset($_SESSION['upload_file_err']); ?>
      </div>
    <?php } ?>

  </div>

</div>

<div class="box box-info">

    <center> 
      <h4 id="judul_daily">
        <strong> <u> DATA CALON SISWA YANG TELAH DITERIMA </u> </strong> 
      </h4> 
    </center>

    <!-- <div class="form-group"> -->
      
    <!-- </div> -->

    <div class="box-body table-responsive">

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
          
        	<?php foreach ($dataSiswaAcc as $data): ?>
        			
        		<tr>
        			<td> <?= $no++; ?> </td>
        			<td> <?= $data['nama_calon_siswa']; ?> </td>
        			<td> <?= $data['jenis_kelamin']; ?> </td>
              <td> <?= $data['tempat_lahir']; ?>, <?= str_replace(["00:00:00"], "", tglIndo($data['tanggal_lahir'])) ; ?> </td>
        			<td> <a href="<?= $basead . 'uploads/ppdb_diterima/pdf_send_to_otm/' . $data['nama_file']; ?>" target="blank"> <?= $data['nama_file']; ?> </a> </td>
        			<td> 
                <button class="btn btn-light" data-toggle="modal" data-target="#exampleModalCenter<?= $data['id']; ?>"> <i class="glyphicon glyphicon-upload"></i> UPLOAD PDF </button>
                |
                <button class="btn btn-danger" data-toggle="modal" data-target="#modalHapus<?= $data['id']; ?>"> <i class="glyphicon glyphicon-trash"></i> HAPUS </button> 
              </td>
        		</tr>

            <div class="modal fade" id="exampleModalCenter<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog" role="document">
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

            <div class="modal fade" id="modalHapus<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalCenterTitle"> <i class="glyphicon glyphicon-trash"></i> KONFIRMASI HAPUS DATA </h4>
                  </div>
                  <div class="modal-body">

                    <!-- <h4 style="margin-top: -10px; margin-bottom: 25px;"> <b> <?= $data['nama_calon_siswa']; ?> </b> </h4> -->

                    <form method="post">
                      <input type="hidden" name="id_siswa" value="<?= $data['id']; ?>">
                      <input type="hidden" name="siswa_dihapus" value="<?= $data['nama_calon_siswa']; ?>">
                      <div class="form-group">
                        <h4> Anda yakin ingin menghapus data calon siswa PPDB <b> <?= $data['nama_calon_siswa']; ?> </b> ? </h4>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="delete_data" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"></i> Hapus </button>
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

  // mencegah user ketika refresh halaman dan mengirim data yang sama pada halaman yang sama
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
	
	let newIcon = document.getElementById("addIcon");
    newIcon.classList.remove("fa");
    newIcon.classList.add("glyphicon");
    newIcon.classList.add("glyphicon-ok-sign");

	document.getElementById('isiMenu').innerHTML = `STATUS CALON SISWA DITERIMA`

  document.querySelectorAll("#uploadfile").forEach(function(input) {
    input.addEventListener("change", function() {
      const file = this.files[0];
      
      if (file) {
        const validType = file.type === "application/pdf";
        const validExt = file.name.toLowerCase().endsWith(".pdf");
        const maxSize = 5 * 1024 * 1024; // 5 MB (dalam byte)

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
    $("#status_terima").css({
      "background-color" : "#ccc",
      "color" : "black"
    });

    $("#isiMenu").css({
      "margin-left" : "5px",
      "font-weight" : "bold",
      "text-transform": "uppercase"
    });

    document.querySelectorAll('#hps_btn').forEach(button => {
      button.addEventListener('click', function() {
        // Ambil data-id tombol yang diklik
        let id = this.getAttribute('data-id');
              
        // Konfirmasi dengan SweetAlert
        Swal.fire({
          title: `Apakah Anda yakin ingin menghapus dengan id ${id} ? `,
          text: "Data ini akan dihapus permanen!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal',
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url   : `facebook.com`,      // The URL to which you are sending the request
              type  : 'POST',              // Request type: POST
              data  : {  
                delete_data : true,
                id_siswa    : id
              },
              success: function(response) {
                console.log('Success:', response);
                Swal.fire(
                  'Dihapus!',
                  'Data berhasil dihapus.',
                  'success'
                );
                // Logika penghapusan data bisa ditambahkan di sini
                console.log('Data dengan ID ' + id + ' telah dihapus.');
              },
              error: function(xhr, status, error) {
                console.error('Error:', error);
              }
            });

          } 
        });

      });
    });

  });

</script>