<?php 

  $timeOut        = $_SESSION['expire'];
  // echo $_SESSION['nip_guru'] . "<br>";
    
  $timeRunningOut = time() + 5;

  $timeIsOut = 0;

  $tampungDataNis = [];
  $tampungDataPw  = [];

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
    // $jamIndo = date_format($tanggal_indo, "H:i:s");
    // echo $jamIndo;
    $result = $tanggal ." ". $bulan ." ". $tahun;       
    return($result);  
  }

  function rupiahFormat($angkax){
    
    $hasil_rupiahx = "Rp " . number_format($angkax,0,'.','.');
    return $hasil_rupiahx;
   
  }

  $no = 1; 

  $resFilter = "";
    // echo "Waktu Habis : " . $timeOut . " Waktu Berjalan : " . $timeRunningOut;

  if ($timeRunningOut == $timeOut || $timeRunningOut > $timeOut) {

    $_SESSION['form_success'] = "session_time_out";

    $timeIsOut = 1;
    error_reporting(1);

  } else {

    date_default_timezone_set("Asia/Jakarta");
    $arrTgl               = [];
      
    $tglSkrngAwal         = date("Y-m-d") . " 00:00:00";
    $tglSkrngAkhir        = date("Y-m-d") . " 23:59:59";

    $queryGetAllInfo = mysqli_query($con, "
      SELECT
      data_pendaftaran_siswa.pendaftaran_kelas as kelas,
      data_pendaftaran_siswa.nama_calon_siswa as calon_siswa,
      data_pendaftaran_siswa.panggilan_calon_siswa as panggilan_siswa,
      data_pendaftaran_siswa.jenis_kelamin as jenis_kelamin,
      data_pendaftaran_siswa.tempat_lahir as tempat_lahir,
      data_pendaftaran_siswa.tanggal_lahir as tanggal_lahir,
      data_pendaftaran_siswa.nisn as nisn_calon_siswa,
      data_pendaftaran_siswa.bacaan_tahsin as tahsin,
      data_pendaftaran_siswa.asal_sekolah as asal_sekolah,
      data_pendaftaran_siswa.jumlah_juz_dihafal as jumlah_juz_dihafal,
      data_pendaftaran_siswa.juz_dihafal as juz_dihafal,
      data_pendaftaran_siswa.hafalan_surat as hafalan_surat,
      data_pendaftaran_siswa.anak_ke as anak_ke,
      data_pendaftaran_siswa.dari_berapa_saudara as dari_berapa_saudara,
      data_pendaftaran_siswa.kk_atau_adik_di_aiis as kk_atau_adik_di_aiis,
      data_pendaftaran_siswa.tingkat_kelas_kk_atau_adik as tingkat_kelas_kk_atau_adik,
      data_pendaftaran_siswa.nama_kk_atau_adik as nama_kk_atau_adik,
      data_pendaftaran_siswa.riwayat_penyakit as riwayat_penyakit,
      data_pendaftaran_siswa.dapat_berjalan_pada_usia as dapat_berjalan_pada_usia,
      data_pendaftaran_siswa.dapat_berbicara_bermakna_pada_usia as dapat_berbicara_pada_usia,
      data_pendaftaran_siswa.pernah_menjalani_terapi as pernah_menjalani_terapi,
      data_pendaftaran_siswa.jenis_terapi as jenis_terapi,
      data_pendaftaran_siswa.alasan_menjalani_terapi as alasan_menjalani_terapi,
      data_pendaftaran_siswa.durasi_terapi as durasi_terapi,
      data_pendaftaran_siswa.waktu_mulai_dan_waktu_selesai_terapi as waktu_mulai_dan_waktu_selesai_terapi,
      data_pendaftaran_siswa.saat_ini_masih_menjalani_terapi as saat_ini_masih_menjalani_terapi,
      data_pendaftaran_siswa.keterlambatan_perkembangan as keterlambatan_perkembangan,
      data_pendaftaran_siswa.terbiasa_solat_lima_waktu as terbiasa_solat_lima_waktu,
      data_pendaftaran_siswa.orangtua_sudah_lancar_dalam_tahsin as orangtua_sudah_lancar_dalam_tahsin,
      data_pendaftaran_siswa.hafalan_tahfidz_orangtua as hafalan_tahfidz_orangtua,
      data_pendaftaran_siswa.peran_orangtua_membantu_anak_menghafal as peran_orangtua_membantu_anak_menghafal,
      data_pendaftaran_siswa.anak_terbiasa_menonton_tv_atau_gadget as anak_terbiasa_menonton_tv_atau_gadget,
      data_pendaftaran_siswa.berapa_lama_menonton_tv_atau_gadget_dalam_sehari as berapa_lama_menonton_tv_atau_gadget_dalam_sehari,
      data_pendaftaran_siswa.nama_ayah as nama_ayah,
      data_pendaftaran_siswa.tempat_lahir_ayah as tempat_lahir_ayah,
      data_pendaftaran_siswa.tanggal_lahir_ayah as tanggal_lahir_ayah,
      data_pendaftaran_siswa.agama_ayah as agama_ayah,
      data_pendaftaran_siswa.pendidikan_terakhir_ayah as pendidikan_terakhir_ayah,
      data_pendaftaran_siswa.pekerjaan_ayah as pekerjaan_ayah,
      data_pendaftaran_siswa.domisili_ayah_saat_ini as alamat_rumah_ayah,
      data_pendaftaran_siswa.nomor_hp_ayah as nomor_hp_ayah,
      data_pendaftaran_siswa.nama_ibu as nama_ibu,
      data_pendaftaran_siswa.tempat_lahir_ibu as tempat_lahir_ibu,
      data_pendaftaran_siswa.tanggal_lahir_ibu as tanggal_lahir_ibu,
      data_pendaftaran_siswa.agama_ibu as agama_ibu,
      data_pendaftaran_siswa.pendidikan_terakhir_ibu as pendidikan_terakhir_ibu,
      data_pendaftaran_siswa.pekerjaan_ibu as pekerjaan_ibu,
      data_pendaftaran_siswa.domisili_ibu_saat_ini as alamat_rumah_ibu,
      data_pendaftaran_siswa.nomor_hp_ibu as nomor_hp_ibu,
      data_pendaftaran_siswa.pendapatan_orangtua as pendapatan_orangtua,
      data_pendaftaran_siswa.file_pdf_akte as akte,
      data_pendaftaran_siswa.file_pdf_kk as kk,
      data_pendaftaran_siswa.ktp_ayah as ktp_ayah,
      data_pendaftaran_siswa.ktp_ibu as ktp_ibu,
      data_pendaftaran_siswa.rencana_mutasi as mutasi,
      data_pendaftaran_siswa.sertif_tahsin as sertif_tahsin,
      data_pendaftaran_siswa.sertif_tahfidz as sertif_tahfidz,
      data_pendaftaran_siswa.nominal_infaq as infaq,
      data_pendaftaran_siswa.nominal_terbilang as terbilang
      FROM data_pendaftaran_siswa
      ORDER BY data_pendaftaran_siswa.tanggal_formulir_dibuat DESC 
    ");

    if (isset($_POST['cari_data'])) {

      $resFilter = htmlspecialchars($_POST['fl_data']);

      if ($resFilter == "sudah") {

        $queryGetAllInfo = mysqli_query($con, "
          SELECT
          data_pendaftaran_siswa.pendaftaran_kelas as kelas,
          data_pendaftaran_siswa.nama_calon_siswa as calon_siswa,
          data_pendaftaran_siswa.panggilan_calon_siswa as panggilan_siswa,
          data_pendaftaran_siswa.jenis_kelamin as jenis_kelamin,
          data_pendaftaran_siswa.tempat_lahir as tempat_lahir,
          data_pendaftaran_siswa.tanggal_lahir as tanggal_lahir,
          data_pendaftaran_siswa.asal_sekolah as asal_sekolah,
          data_pendaftaran_siswa.nisn as nisn_calon_siswa,
          data_pendaftaran_siswa.bacaan_tahsin as tahsin,
          data_pendaftaran_siswa.hafalan_juz as isi_hafalan_juz,
          data_pendaftaran_siswa.anak_ke as anak_ke,
          data_pendaftaran_siswa.dari_berapa_saudara as dari_berapa_saudara,
          data_pendaftaran_siswa.riwayat_penyakit as riwayat_penyakit,
          data_pendaftaran_siswa.asal_sekolah as asal_sekolah,
          data_pendaftaran_siswa.bacaan_tahsin as bacaan_tahsin,
          data_pendaftaran_siswa.hafalan_juz as hafalan_juz,
          data_pendaftaran_siswa.nama_ayah as nama_ayah,
          data_pendaftaran_siswa.tempat_lahir_ayah as tempat_lahir_ayah,
          data_pendaftaran_siswa.tanggal_lahir_ayah as tanggal_lahir_ayah,
          data_pendaftaran_siswa.agama_ayah as agama_ayah,
          data_pendaftaran_siswa.pendidikan_terakhir_ayah as pendidikan_terakhir_ayah,
          data_pendaftaran_siswa.pekerjaan_ayah as pekerjaan_ayah,
          data_pendaftaran_siswa.alamat_rumah_ayah as alamat_rumah_ayah,
          data_pendaftaran_siswa.nomor_hp_ayah as nomor_hp_ayah,
          data_pendaftaran_siswa.nama_ibu as nama_ibu,
          data_pendaftaran_siswa.tempat_lahir_ibu as tempat_lahir_ibu,
          data_pendaftaran_siswa.tanggal_lahir_ibu as tanggal_lahir_ibu,
          data_pendaftaran_siswa.agama_ibu as agama_ibu,
          data_pendaftaran_siswa.pendidikan_terakhir_ibu as pendidikan_terakhir_ibu,
          data_pendaftaran_siswa.pekerjaan_ibu as pekerjaan_ibu,
          data_pendaftaran_siswa.alamat_rumah_ibu as alamat_rumah_ibu,
          data_pendaftaran_siswa.nomor_hp_ibu as nomor_hp_ibu,
          data_pendaftaran_siswa.pendapatan_orangtua as pendapatan_orangtua
          FROM data_pendaftaran_siswa
          WHERE data_pendaftaran_siswa.status = 1
          ORDER BY data_pendaftaran_siswa.pendaftaran_kelas ASC 
        ");

      } else {

        $queryGetAllInfo = mysqli_query($con, "
          SELECT
          data_pendaftaran_siswa.pendaftaran_kelas as kelas,
          data_pendaftaran_siswa.nama_calon_siswa as calon_siswa,
          data_pendaftaran_siswa.panggilan_calon_siswa as panggilan_siswa,
          data_pendaftaran_siswa.jenis_kelamin as jenis_kelamin,
          data_pendaftaran_siswa.tempat_lahir as tempat_lahir,
          data_pendaftaran_siswa.tanggal_lahir as tanggal_lahir,
          data_pendaftaran_siswa.asal_sekolah as asal_sekolah,
          data_pendaftaran_siswa.nisn as nisn_calon_siswa,
          data_pendaftaran_siswa.bacaan_tahsin as tahsin,
          data_pendaftaran_siswa.hafalan_juz as isi_hafalan_juz,
          data_pendaftaran_siswa.anak_ke as anak_ke,
          data_pendaftaran_siswa.dari_berapa_saudara as dari_berapa_saudara,
          data_pendaftaran_siswa.riwayat_penyakit as riwayat_penyakit,
          data_pendaftaran_siswa.asal_sekolah as asal_sekolah,
          data_pendaftaran_siswa.bacaan_tahsin as bacaan_tahsin,
          data_pendaftaran_siswa.hafalan_juz as hafalan_juz,
          data_pendaftaran_siswa.nama_ayah as nama_ayah,
          data_pendaftaran_siswa.tempat_lahir_ayah as tempat_lahir_ayah,
          data_pendaftaran_siswa.tanggal_lahir_ayah as tanggal_lahir_ayah,
          data_pendaftaran_siswa.agama_ayah as agama_ayah,
          data_pendaftaran_siswa.pendidikan_terakhir_ayah as pendidikan_terakhir_ayah,
          data_pendaftaran_siswa.pekerjaan_ayah as pekerjaan_ayah,
          data_pendaftaran_siswa.alamat_rumah_ayah as alamat_rumah_ayah,
          data_pendaftaran_siswa.nomor_hp_ayah as nomor_hp_ayah,
          data_pendaftaran_siswa.nama_ibu as nama_ibu,
          data_pendaftaran_siswa.tempat_lahir_ibu as tempat_lahir_ibu,
          data_pendaftaran_siswa.tanggal_lahir_ibu as tanggal_lahir_ibu,
          data_pendaftaran_siswa.agama_ibu as agama_ibu,
          data_pendaftaran_siswa.pendidikan_terakhir_ibu as pendidikan_terakhir_ibu,
          data_pendaftaran_siswa.pekerjaan_ibu as pekerjaan_ibu,
          data_pendaftaran_siswa.alamat_rumah_ibu as alamat_rumah_ibu,
          data_pendaftaran_siswa.nomor_hp_ibu as nomor_hp_ibu,
          data_pendaftaran_siswa.pendapatan_orangtua as pendapatan_orangtua
          FROM data_pendaftaran_siswa
          ORDER BY data_pendaftaran_siswa.pendaftaran_kelas ASC 
        ");

      }

    }

  }

?>

<div class="box box-info">

  <div class="box-header with-border">
      <h3 class="box-title" id="boxTitle"> <i class="glyphicon glyphicon-th-large"></i> <span style="margin-left: 10px; font-weight: bold;"> DASHBOARD </span> </h3>
    </div>

    <center> 
      <h4 id="judul_daily">
        <strong> <u> DATA CALON SISWA PENDAFTAR PPDB </u> </strong> 
      </h4> 
    </center>

    <!-- <div class="form-group"> -->
      
    <!-- </div> -->

    <div class="box-body table-responsive">

      <table id="hightlight_list_siswa" style="text-align: center; width: 200%;" class="table table-bordered table-hover">

        <thead>
          <tr style="background-color: lightyellow; font-weight: bold;">
            <th style="text-align: center; border: 1px solid black;" width="5%">NO</th>
            <th style="text-align: center; border: 1px solid black;"> KELAS </th>
            <th style="text-align: center; border: 1px solid black;"> NAMA CALON SISWA </th>
            <th style="text-align: center; border: 1px solid black;"> JENIS KELAMIN </th>
            <th style="text-align: center; border: 1px solid black; width: 220px;"> TEMPAT TANGGAL LAHIR </th>
            <th style="text-align: center; border: 1px solid black;"> BACAAN TAHSIN </th>
            <th style="text-align: center; border: 1px solid black; width: 242px;"> BANYAK JUZ YANG DI HAFAL </th>
            <th style="text-align: center; border: 1px solid black; width: 250px;"> JUZ & SURAT YANG DI HAFAL </th>
            <th style="text-align: center; border: 1px solid black;"> AKTE KELAHIRAN </th>
            <th style="text-align: center; border: 1px solid black;"> KARTU KELUARGA </th>
            <th style="text-align: center; border: 1px solid black;"> KTP AYAH </th>
            <th style="text-align: center; border: 1px solid black;"> KTP IBU </th>
            <th style="text-align: center; border: 1px solid black;"> ACTION </th>
            <!-- <th style="text-align: center;"> DAILY </th> -->
            <!-- Terdapat Administrasi Pembiayaan Yang Perlu Di Selesaikan -->
          </tr>
        </thead>

        <tbody>

          <?php foreach ($queryGetAllInfo as $data): ?>
            
            <tr>
                <td> <?= $no++; ?> </td>
                <td> <?= str_replace(["SD"], " SD", strtoupper($data['kelas'])); ?> </td>
                <td> <?= $data['calon_siswa']; ?> </td>
                <td> <?= $data['jenis_kelamin']; ?> </td>
                <td> <?= $data['tempat_lahir']; ?>, <?= format_tgl_indo($data['tanggal_lahir']); ?> </td>
                <td> <?= $data['tahsin']; ?> </td>
                <td> <?= $data['jumlah_juz_dihafal']; ?> </td>
                <?php if ($data['juz_dihafal'] == 'BELUM ADA'): ?>
                  <td> BELUM ADA JUZ YANG DI HAFAL </td>
                <?php else: ?>
                  <td> <?= $data['juz_dihafal']; ?> - <?= $data['hafalan_surat']; ?> </td>
                <?php endif ?>
                <td>
                  <form action="<?= $base . 'upload/akte_kelahiran/'. $data['akte']; ?>" method="post" target="_blank">
                    <button type="submit" name="print_calon_siswa" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-download-alt"></i> AKTE </button>
                  </form>
                </td>
                <td>
                  <form action="<?= $base . 'upload/kartu_keluarga/'. $data['kk']; ?>" method="post" target="_blank">
                    <button type="submit" name="print_calon_siswa" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-download-alt"></i> KK </button>
                  </form>
                </td>
                <td>
                  <form action="<?= $base . 'upload/ktp_ayah/'. $data['ktp_ayah']; ?>" method="post" target="_blank">
                    <button type="submit" name="print_calon_siswa" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-download-alt"></i> KTP AYAH </button>
                  </form>
                </td>
                <td>
                  <form action="<?= $base . 'upload/ktp_ibu/'. $data['ktp_ibu']; ?>" method="post" target="_blank">
                    <button type="submit" name="print_calon_siswa" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-download-alt"></i> KTP IBU </button>
                  </form>
                </td>
                <td>
                  <form action="infocalonsiswa" method="post">
                    <input type="hidden" name="kelas_calon_siswa" value="<?= $data['kelas']; ?>">
                    <input type="hidden" name="nama_calon_siswa" value="<?= $data['calon_siswa']; ?>">
                    <input type="hidden" name="nisn_calon_siswa" value="<?= $data['nisn_calon_siswa']; ?>">
                    <input type="hidden" name="panggilan_calon_siswa" value="<?= $data['panggilan_siswa']; ?>">
                    <input type="hidden" name="jk_calon_siswa" value="<?= $data['jenis_kelamin']; ?>">
                    <input type="hidden" name="tempat_lahir_siswa" value="<?= $data['tempat_lahir']; ?>">
                    <input type="hidden" name="tanggal_lahir_siswa" value="<?= $data['tanggal_lahir']; ?>">
                    <input type="hidden" name="anak_ke" value="<?= $data['anak_ke']; ?>">
                    <input type="hidden" name="dariberapa_saudara" value="<?= $data['dari_berapa_saudara']; ?>">
                    <input type="hidden" name="riwayat_penyakit" value="<?= $data['riwayat_penyakit']; ?>">
                    <input type="hidden" name="asal_sekolah" value="<?= $data['asal_sekolah']; ?>">
                    <input type="hidden" name="bacaan_tahsin" value="<?= $data['tahsin']; ?>">
                    <input type="hidden" name="hafalan_juz" value="<?= $data['juz_dihafal']; ?>">
                    <input type="hidden" name="jumlah_juz_dihafal" value="<?= $data['jumlah_juz_dihafal']; ?>">
                    <input type="hidden" name="hafalan_surat" value="<?= $data['hafalan_surat']; ?>">
                    <input type="hidden" name="nama_ayah" value="<?= $data['nama_ayah']; ?>">
                    <input type="hidden" name="tempat_lahir_ayah" value="<?= $data['tempat_lahir_ayah']; ?>">
                    <input type="hidden" name="tanggal_lahir_ayah" value="<?= $data['tanggal_lahir_ayah']; ?>">
                    <input type="hidden" name="agama_ayah" value="<?= $data['agama_ayah']; ?>">
                    <input type="hidden" name="pend_ayah" value="<?= $data['pendidikan_terakhir_ayah']; ?>">
                    <input type="hidden" name="pekerjaan_ayah" value="<?= $data['pekerjaan_ayah']; ?>">
                    <input type="hidden" name="alamat_ayah" value="<?= $data['alamat_rumah_ayah']; ?>">
                    <input type="hidden" name="nomer_hp_ayah" value="<?= $data['nomor_hp_ayah']; ?>">
                    <input type="hidden" name="nama_ibu" value="<?= $data['nama_ibu']; ?>">
                    <input type="hidden" name="tempat_lahir_ibu" value="<?= $data['tempat_lahir_ibu']; ?>">
                    <input type="hidden" name="tanggal_lahir_ibu" value="<?= $data['tanggal_lahir_ibu']; ?>">
                    <input type="hidden" name="agama_ibu" value="<?= $data['agama_ibu']; ?>">
                    <input type="hidden" name="pend_ibu" value="<?= $data['pendidikan_terakhir_ibu']; ?>">
                    <input type="hidden" name="pekerjaan_ibu" value="<?= $data['pekerjaan_ibu']; ?>">
                    <input type="hidden" name="alamat_ibu" value="<?= $data['alamat_rumah_ibu']; ?>">
                    <input type="hidden" name="nomer_hp_ibu" value="<?= $data['nomor_hp_ibu']; ?>">
                    <input type="hidden" name="penghasilan_ortu" value="<?= $data['pendapatan_orangtua']; ?>">

                    <input type="hidden" name="sdr_aiis" value="<?= $data['kk_atau_adik_di_aiis']; ?>">
                    <input type="hidden" name="tkt_sdr" value="<?= ($data['kk_atau_adik_di_aiis'] == 'TIDAK' ) ? ("TIDAK ADA") : ($data['tingkat_kelas_kk_atau_adik']); ?>">
                    <input type="hidden" name="nm_sdr" value="<?= ($data['kk_atau_adik_di_aiis'] == 'TIDAK' ) ? ("TIDAK ADA") : ($data['nama_kk_atau_adik']); ?>">
                    <input type="hidden" name="dapat_berjalan_pada_usia" value="<?= $data['dapat_berjalan_pada_usia']; ?>">
                    <input type="hidden" name="dapat_berbicara_pada_usia" value="<?= $data['dapat_berbicara_pada_usia']; ?>">
                    <input type="hidden" name="pernah_terapi" value="<?= $data['pernah_menjalani_terapi']; ?>">
                    <input type="hidden" name="jenis_terapi" value="<?= ($data['pernah_menjalani_terapi'] == 'PERNAH' ) ? ($data['jenis_terapi']) : ("TIDAK ADA"); ?>">
                    <input type="hidden" name="alasan_terapi" value="<?= $data['alasan_menjalani_terapi']; ?>">
                    <input type="hidden" name="durasi_terapi" value="<?= $data['durasi_terapi']; ?>">
                    <input type="hidden" name="waktu_mulai_terapi" value="<?= $data['waktu_mulai_dan_waktu_selesai_terapi']; ?>">
                    <input type="hidden" name="msh_terapi" value="<?= $data['saat_ini_masih_menjalani_terapi']; ?>">
                    <input type="hidden" name="telat_perkembangan" value="<?= $data['keterlambatan_perkembangan']; ?>">
                    <input type="hidden" name="terbiasa_solat" value="<?= $data['terbiasa_solat_lima_waktu']; ?>">
                    <input type="hidden" name="tahsin_ortu" value="<?= $data['orangtua_sudah_lancar_dalam_tahsin']; ?>">
                    <input type="hidden" name="tahfidz_ortu" value="<?= $data['hafalan_tahfidz_orangtua']; ?>">
                    <input type="hidden" name="peran_ortu" value="<?= $data['peran_orangtua_membantu_anak_menghafal']; ?>">
                    <input type="hidden" name="terbiasa_gadget" value="<?= $data['anak_terbiasa_menonton_tv_atau_gadget']; ?>">
                    <input type="hidden" name="durasi_gadget" value="<?= $data['berapa_lama_menonton_tv_atau_gadget_dalam_sehari']; ?>">
                    <input type="hidden" name="mutasi" value="<?= $data['mutasi']; ?>">

                    <input type="hidden" name="infaq" value="<?= $data['infaq']; ?>">
                    <input type="hidden" name="terbilang" value="<?= $data['terbilang']; ?>">

                    <button type="submit" name="print_calon_siswa" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-print"></i> PRINT </button>
                  </form>
                </td>
              </tr>

          <?php endforeach ?>
          
        </tbody>

      </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

  function updateStatus(id, nis, nama) {
    
    Swal.fire({
      title: `Anda Yakin Ingin Update Pembayaran ${nama} ?`,
      showCancelButton: true,
      confirmButtonText: "UPDATE",
      denyButtonText: `Don't save`
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $.ajax({
          url     : `<?= $basead; ?>data`,
          method  : 'POST',
          data    : {
            tesdata : nis,
            idbayar : id
          },
          success:function(data) {
            
            let dataRes = JSON.parse(data).update_pembayaran;

            if (dataRes == 'berhasil') {
              Swal.fire("Pembayaran Berhasil DiUpdate !", "", "success");
              setTimeout(() => {
                location.href = `<?= $basead; ?>`
              }, 1000);
            } else {
              Swal.fire("Pembayaran Gagal DiUpdate !", "", "warning");
            }
            console.log(JSON.parse(data).update_pembayaran);
          }
        });
      } else if (result.isDenied) {
        Swal.fire("Changes are not saved", "", "info");
      }
    });

    let newIcon = document.querySelector(".swal2-confirm");
    newIcon.classList.add("btn-sm");
    newIcon.classList.add("btn-success");

    let newIconCancel = document.querySelector(".swal2-cancel");
    newIconCancel.classList.add("btn-sm");

  }

  function printerPage() {
    window.print()
  }
    
  $(document).ready(function(){

    $("#dashboard").css({
      "background-color" : "#ccc",
      "color" : "black"
    });

  })

</script>