<?php  

  require '../php/config.php'; 

  $acc_reject = "";

  // Cek apakah akses lewat POST
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      // Jika tidak lewat POST, arahkan ke form
      header("Location: $basead");
      exit;
  }

  if ($_POST['is_data'] == 'acc') {

    $acc_reject = "accept";

    $token = htmlspecialchars($_POST['token']);

    $dataSiswa    = mysqli_query($con, "
      SELECT 
      data_pendaftaran_siswa_diterima.id, 
      data_pendaftaran_siswa_diterima.nama_calon_siswa, 
      data_pendaftaran_siswa_diterima.jenis_kelamin,
      data_pendaftaran_siswa_diterima.tempat_lahir,
      data_pendaftaran_siswa_diterima.tanggal_lahir,
      data_pendaftaran_siswa_diterima.nomor_hp_ayah,
      data_pendaftaran_siswa_diterima.nomor_hp_ibu,
      upload_file.nama_file  
      FROM data_pendaftaran_siswa_diterima
      LEFT JOIN upload_file
      ON data_pendaftaran_siswa_diterima.id = upload_file.id_siswa_diterima_ditolak
      WHERE upload_file.nama_file != ''
      ORDER BY data_pendaftaran_siswa_diterima.tanggal_formulir_dibuat ASC
  ");

  } else if ($_POST['is_data'] == 'rej') {

    $acc_reject = "reject";

    $token = htmlspecialchars($_POST['token']);

    $dataSiswa    = mysqli_query($con, "
      SELECT 
      data_pendaftaran_siswa_ditolak.id, 
      data_pendaftaran_siswa_ditolak.nama_calon_siswa, 
      data_pendaftaran_siswa_ditolak.jenis_kelamin,
      data_pendaftaran_siswa_ditolak.tempat_lahir,
      data_pendaftaran_siswa_ditolak.tanggal_lahir,
      data_pendaftaran_siswa_ditolak.nomor_hp_ayah,
      data_pendaftaran_siswa_ditolak.nomor_hp_ibu,
      upload_file.nama_file  
      FROM data_pendaftaran_siswa_ditolak
      LEFT JOIN upload_file
      ON data_pendaftaran_siswa_ditolak.id = upload_file.id_siswa_diterima_ditolak
      WHERE upload_file.nama_file != ''
      ORDER BY data_pendaftaran_siswa_ditolak.tanggal_formulir_dibuat ASC
    ");    

  }

  $no = 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="<?= $token; ?>">
  <title>AIIS - PPDB</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="<?php echo $base; ?>imgstatis/favicon.jpg">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .modal-content { border-radius: 1rem; }
    .pagination { justify-content: center; }
    @media (max-width: 576px) {
      .form-check-input { transform: scale(1.3); }
      .modal-dialog { margin: 0.5rem; }
      table { font-size: 0.9rem; }
    }
  </style>
</head>

<body>
<div class="container mt-5 text-center">
  <h3 class="mb-4">PILIH SISWA UNTUK MENGIRIM PESAN WHATSAPP</h3>
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">Pilih Siswa</button>
  <div id="selectedStudents" class="mt-4 fw-semibold text-success"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Pilih Siswa</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" id="selectAll">
          <label class="form-check-label fw-semibold" for="selectAll">Pilih Semua Siswa</label>
        </div>

        <div class="table-responsive">
          <table id="myTable" class="display">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Siswa</th>
            <th>Jenis Kelamin</th>
            <th>Pilih</th>
        </tr>
    </thead>
    <tbody>

      <?php foreach ($dataSiswa as $data_send): ?>
        
        <tr>
          <td> <?= $no++; ?> </td>
          <td> <?= $data_send['nama_calon_siswa']; ?> </td>
          <td> <?= $data_send['jenis_kelamin']; ?> </td>
          <td>  
            <?php if (substr($data_send['nomor_hp_ayah'], 0, 1) == 8 || substr($data_send['nomor_hp_ibu'], 0, 1) == 8): ?>
              
              <input type="checkbox" class="ischeckbox" data-siswa="<?= $data_send['nama_calon_siswa']; ?>" data-phone1="0<?= (htmlspecialchars($data_send['nomor_hp_ibu'])); ?>" data-phone2="0<?= htmlspecialchars($data_send['nomor_hp_ayah']); ?>" data-filepdf="<?= $data_send['nama_file']; ?>">

            <?php else: ?>

              <input type="checkbox" class="ischeckbox" data-siswa="<?= $data_send['nama_calon_siswa']; ?>" data-phone1="<?= (htmlspecialchars($data_send['nomor_hp_ibu'])); ?>" data-phone2="<?= htmlspecialchars($data_send['nomor_hp_ayah']); ?>" data-filepdf="<?= $data_send['nama_file']; ?>">
              
            <?php endif ?>
          </td>
        </tr>

      <?php endforeach ?>

    </tbody>
</table>
        </div>

        <nav>
          <ul class="pagination" id="pagination"></ul>
        </nav>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button id="saveSelection" class="btn btn-success"> 📄 Kirim Pesan </button>
      </div>
    </div>
  </div>
</div>

<script>

window.history.pushState(null, null, window.location.href);
window.onpopstate = function() {
    window.history.go(1); // Ini akan memaksa browser untuk tetap di halaman yang sekarang
};

$(document).ready( function () {
    $('#myTable').DataTable();

    // Ketika checkbox "Select All" diklik
    $('#selectAll').on('change', function() {
        $('.ischeckbox').prop('checked', $(this).prop('checked'));
    });

    // Jika salah satu checkbox siswa diubah
    $('.ischeckbox').on('change', function() {
        if ($('.ischeckbox:checked').length === $('.ischeckbox').length) {
            $('#selectAll').prop('checked', true);
        } else {
            $('#selectAll').prop('checked', false);
        }
    });

    $('#saveSelection').on('click', function(e) {
      e.preventDefault();

      // Ambil semua ID siswa yang dipilih
      let phoneNumber1 = [];
      let phoneNumber2 = [];
      let data_siswa   = [];
      let filePDF      = [];

      $('.ischeckbox:checked').each(function() {
          phoneNumber1.push($(this).data('phone1'));
          phoneNumber2.push($(this).data('phone2'));
          data_siswa.push($(this).data('siswa'));
          filePDF.push($(this).data('filepdf'));
      });

      // Jika tidak ada yang dipilih
      if(phoneNumber1.length === 0){
          alert('Tidak ada siswa yang dipilih!');
          return;
      }

      // Kirim via AJAX
      $.ajax({
          url: 'api-wa', // ganti ke route kamu
          type: 'POST',
          data: {
              _token    : $('meta[name="csrf-token"]').attr('content'),
              phone1    : phoneNumber1,
              phone2    : phoneNumber2,
              std       : data_siswa,
              filename  : filePDF,
              stats     : `<?= $acc_reject; ?>`
          },
          success: function(response) {
              // respon dari server
              console.log(response[0]);
              Swal.fire({
                title: "Pesan Berhasil Dikirim!",
                icon: "success",
                draggable: true
              });
              // Tutup modal jika perlu
              $('#selectStudentsModal').modal('hide');
          },
          error: function(xhr) {
              console.log(xhr.responseText);
              alert("Terjadi kesalahan dalam menyimpan data");
          }
      });
    });


} );
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
