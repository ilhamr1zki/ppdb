<?php  

	$arrJenjangPilihan = [
		"paud",
		"sd"
	];

	$arrKelasPilihanSD = [
		"1SD",
		"2SD",
		"3SD",
		"4SD",
		"5SD"
	];

	$arrJenisKelamin = [
		"LAKI-LAKI",
		"PEREMPUAN"
	];

	$arrHafalanTerakhir = [
		"BELUM",
		"SUDAH"
	];

	$arrIsiAgama = [
		"ISLAM",
		"LAINNYA"
	];

	$arrIsiPddAyah = [
		"SD/MI",
		"SMP/MTS",
		"SMA/SMK/MA",
		"D1",
		"D2",
		"D3",
		"S1",
		"S2",
		"S3"
	];

	$arrJobFather = [
		"GURU",
		"DOSEN",
		"pegawai_pns",
		"pegawai_bumn",
		"karyawan_swasta",
		"POLRI",
		"TNI",
		"WIRASWASTA",
		"WIRAUSAHA",
		"LAINNYA"
	];

	$arrJobMother = [
		"GURU",
		"DOSEN",
		"pegawai_pns",
		"pegawai_bumn",
		"karyawan_swasta",
		"POLRI",
		"TNI",
		"WIRASWASTA",
		"WIRAUSAHA",
		"IRT",
		"LAINNYA"
	];

	if (isset($_POST['kirim'])) {
		
		$jenjangPendidikan = htmlspecialchars($_POST['jenjang_sekolah']);
		$kelas             = "";

		if ($jenjangPendidikan == "paud") {
			$jenjangPendidikan = "KB/TK/PAUD";
			$kelas = htmlspecialchars($_POST['selectpaud']);
		
		} else if ($jenjangPendidikan == "sd") {

			$jenjangPendidikan = "SD";
			$kelas = str_replace(["SD"], " SD", htmlspecialchars($_POST['selectsd']));

		}

		$asalSekolah	= htmlspecialchars($_POST['asalsekolah']);

		if ($asalSekolah == "tkra") {
			$asalSekolah = "TK/RA";
		} elseif ($asalSekolah == "sdmi") {
			$asalSekolah = "SD/MI";
		} elseif ($asalSekolah == "lain") {
			$asalSekolah = "LAINNYA";
		}

		$ketSekolah  	= htmlspecialchars($_POST['keterangan']);

		echo "Jenjang Pendidikan : " . $jenjangPendidikan . "<br> Kelas : " . $kelas . "<br> Asal Sekolah : " . $asalSekolah . "<br> Keterangan Asal Sekolah : " . $ketSekolah;
	
	}

?>

<style type="text/css">
	
	p {
	  text-indent: 50px;
	  text-align: justify;
	}

</style>

<center>
	<h1> FORM PENDAFTARAN AKHYAR INTERNATIONAL ISLAMIC SCHOOL TAHUN AJARAN 2024-2025 </h1>
	<hr>
</center>

<h3> DATA ANAK CALON PESERTA DIDIK </h3>

<form action="" method="post">
	
	<label> PENDAFTARAN UNTUK KELAS : </label>
	<select class="target" name="jenjang_sekolah">
		<option value="kosong"> -- PILIH -- </option>
		<?php foreach ($arrJenjangPilihan as $data): ?>
			
			<?php if ($data == "paud"): ?>

				<option value="<?= $data; ?>"> PAUD </option>

			<?php elseif($data == "sd"): ?>

				<option value="<?= $data; ?>"> SD </option>
				
			<?php endif ?>

		<?php endforeach ?>
	</select>
	<select id="utk_kb" name="selectpaud">
		<option value="KB"> KB </option>
		<option value="TKA"> TKA </option>
		<option value="TKB"> TKB </option>
	</select>
	<select id="utk_sd" name="selectsd">
		<?php foreach ($arrKelasPilihanSD as $data): ?>
			<option value="<?= $data; ?>"> <?= str_replace(["SD"], " SD", $data); ?> </option>
		<?php endforeach ?>
	</select>

	<br>
	<br>

	<label> NAMA LENGKAP : </label>
	<input type="text" required name="nama_lengkap">

	<br><br>

	<label> NAMA PANGGILAN : </label>
	<input type="text" required name="nama_panggilan">

	<br><br>

	<label> JENIS KELAMIN : </label>
		<select>
			<?php foreach ($arrJenisKelamin as $data): ?>
					<option value="<?= $data; ?>"> <?= $data; ?> </option>
			<?php endforeach ?>
		</select>

	<br>
	<br>

	<label> TEMPAT LAHIR : </label>
	<input type="text" required name="tempat_lahir">
	<span>   </span>
	<label> TANGGAL LAHIR : </label>
	<input type="date" required name="tang_lahir">

	<br><br>

	<label> ANAK KE : </label>
	<input type="text" required name="anak_ke">

	<label> DARI : </label>
	<input type="text" required name="dari">

	<br><br>

	<label> RIWAYAT PENYAKIT ANAK, APAKAH ADA ALERGI ? </label>
	<input type="text" required name="riwayat_penyakit">

	<br><br>

	<label> ASAL SEKOLAH SEBELUMNYA : </label>
	<select required class="asalsklh" name="asalsekolah">
		<option value="kosong"> -- PILIH -- </option>
		<option value="tkra"> TK/RA </option>
		<option value="sdmi"> SD/MI </option>
		<option value="lain"> LAINNYA </option>
	</select>
	<input type="text" required id="keterangan" name="keterangan" placeholder="Contoh SD AIIS, TK AIIS">

	<br>
	<br>

	<label> HAFALAN SURAH AL-QUR'AN TERAKHIR : </label>
	<!-- <input type="text" name="hafalan_terakhir"> -->
	<select required id="hafalan_terakhir" name="hafalan_terakhir">
		<?php foreach ($arrHafalanTerakhir as $data): ?>
			<option value="<?= $data; ?>"> <?= $data; ?> </option>
		<?php endforeach ?>
	</select>

	<br><br>
	
	<div class="isi_ket_hafalan_terakhir">
		
		<label> JUZ : </label>
		<input type="text" required name="isi_juz" id="isi_juz" placeholder="isi juz dengan angka">

		<label> SURAT : </label>
		<input type="text" required name="isi_surat" id="isi_surat">
	
		<br><br>

	</div>

	<hr>

	<h3> DATA ORANG TUA/WALI CALON PESERTA DIDIK </h3>

	<label> NAMA AYAH/WALI : </label>
	<input type="text" required name="nama_ayah">

	<br><br>

	<label> TEMPAT LAHIR AYAH/WALI : </label>
	<input type="text" required name="temlahir_ayah">

	<label> TANGGAL LAHIR AYAH/WALI : </label>
	<input type="date" required name="tanglahir_ayah">

	<br><br>

	<label> AGAMA AYAH/WALI : </label>
	<select name="agama_ayah">
		<?php foreach ($arrIsiAgama as $data): ?>
			<option value="<?= $data; ?>"> <?= $data; ?> </option>
		<?php endforeach ?>
	</select>

	<br><br>

	<label> PENDIDIKAN TERAKHIR AYAH/WALI : </label>
	<select id="pdd_ayah" name="pdd_ayah">
		<option value="kosongpendayah"> -- PILIH -- </option>
		<?php foreach ($arrIsiPddAyah as $data): ?>
			<option value="<?= $data; ?>"> <?= $data; ?> </option>
		<?php endforeach ?>
	</select>

	<br><br>

	<label> PEKERJAAN AYAH/WALI : </label>
	<select id="fatherjob" name="fatherjob">
		<option value="emptyfatherjob"> -- PILIH -- </option>
		<?php foreach ($arrJobFather as $data): ?>
			<?php if ($data == "pegawai_pns"): ?>
				<option value="<?= $data; ?>"> PEGAWAI PNS </option>
			<?php elseif($data == "pegawai_bumn"): ?>
				<option value="<?= $data; ?>"> PEGAWAI BUMN </option>
			<?php elseif($data == "karyawan_swasta"): ?>
				<option value="<?= $data; ?>"> KARYAWAN SWASTA </option>
			<?php else: ?>
				<option value="<?= $data; ?>"> <?= $data; ?> </option>
			<?php endif ?>
		<?php endforeach ?>
	</select>

	<br><br>

	<label> ALAMAT RUMAH AYAH/WALI : </label>
	<input type="text" name="alamat_ayah" id="alamat_ayah">

	<br><br>

	<label> NOMOR HANDPHONE/WA AYAH/WALI YANG DAPAT DIHUBUNGI : </label>
	<input type="text" id="nomhp_ayah" placeholder="Ex : 08xxxx" name="nomhp_ayah">
	<br><br>

	<br><br>

	<label> NAMA IBU : </label>
	<input type="text" required name="nama_ibu">

	<br><br>

	<label> TEMPAT LAHIR IBU : </label>
	<input type="text" required name="temlahir_ibu">

	<label> TANGGAL LAHIR IBU : </label>
	<input type="date" required name="tanglahir_ibu">

	<br><br>

	<label> AGAMA IBU : </label>
	<select name="agama_ibu">
		<?php foreach ($arrIsiAgama as $data): ?>
			<option value="<?= $data; ?>"> <?= $data; ?> </option>
		<?php endforeach ?>
	</select>

	<br><br>

	<label> PEKERJAAN IBU : </label>
	<select id="motherjob" name="motherjob">
		<option value="emptymotherjob"> -- PILIH -- </option>
		<?php foreach ($arrJobMother as $data): ?>
			<?php if ($data == "pegawai_pns"): ?>
				<option value="<?= $data; ?>"> PEGAWAI PNS </option>
			<?php elseif($data == "pegawai_bumn"): ?>
				<option value="<?= $data; ?>"> PEGAWAI BUMN </option>
			<?php elseif($data == "karyawan_swasta"): ?>
				<option value="<?= $data; ?>"> KARYAWAN SWASTA </option>
			<?php else: ?>
				<option value="<?= $data; ?>"> <?= $data; ?> </option>
			<?php endif ?>
		<?php endforeach ?>
	</select>

	<br><br>

	<label> NOMOR HANDPHONE/WA IBU YANG DAPAT DIHUBUNGI : </label>
	<input type="text" id="nomhp_ibu" placeholder="Ex : 08xxxx" name="nomhp_ibu">
	<br><br>

	<br><br>

	<label> PENGHASILAN ORANG TUA/WALI CALON MURID PER BULAN : </label>
	<br>
	<input type="radio" name="opt1">
	<label> 1 - 5 JUTA RUPIAH </label>
	<br>
	<input type="radio" name="opt1">
	<label> 6 - 10 JUTA RUPIAH </label>
	<br>
	<input type="radio" name="opt1">
	<label> 11 - 15 JUTA RUPIAH </label>
	<br>
	<input type="radio" name="opt1">
	<label> DI ATAS 15 JUTA RUPIAH </label>

	<br><br>

	<label> PERNYATAAN ORANG TUA/WALI CALON MURID </label>
	<p>  
		Setelah membaca dan meneliti dengan seksama semua ketentuan dan pesyaratan penerimaan murid baru Akhyar International Islamic School, dengan ini menyatakan bahwa Saya bersedia mengikuti syarat dan ketentuan penerimaan yang berlaku, serta menyatakan sanggup untuk melaksanakan hal-hal sebagai berikut :

		<ol>
		  <li>Orang Tua/Wali Calon Murid wajib menyelesaikan Biaya Registrasi sebelum mengisi formulir (Biaya Pendaftaran).</li>
		  <li>Orang Tua/Wali Calon Murid wajib menyelesaikan Biaya Masuk (Uang Pangkal) sebesar minimal 50%, 15 hari setelah murid dinyatakan diterima, dilanjutkan sisa nya pada waktu yang telah ditentukan. Jika tidak maka murid dianggap mengundurkan diri.</li>
		  <li>Orang Tua Calon murid Siap Menerima keputusan dari Panitia penerimaan murid baru tanpa syarat apapun.</li>
		  <li> Orang Tua/Wali Calon Murid menyetujui tanpa syarat bahwa semua biaya yang telah di bayarkan tidak dapat dikembalikan atau dipindahkan ke calon murid lain, atau diundur ke tahun berikutnya dalam kondisi atau alasan apapun. </li>
		</ol>

	</p>

	<br>
	<button type="submit" name="kirim"> SEND </button>

</form>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){
		$(".target").val("kosong");
		$("#utk_kb").hide();
		$("#utk_sd").hide();
		$("#keterangan").hide();
		$("#hafalan_terakhir").val("BELUM");
		$("#pdd_ayah").val("kosongpendayah");
		$("#fatherjob").val("emptyfatherjob");
		$("#motherjob").val("emptymotherjob");

		$(".isi_ket_hafalan_terakhir").hide();

		$(".target" ).on(
			"change", function() {
			if(this.value == "sd") {
				$("#utk_sd").show();
				$("#utk_kb").hide();
			} else if (this.value == "paud") {
				$("#utk_kb").show();
				$("#utk_sd").hide();
			} else {
				$("#utk_kb").hide();
				$("#utk_sd").hide();
			}
		});

		$(".asalsklh" ).on(
			"change", function() {
			if(this.value == "tkra") {
				$("#keterangan").show();
			} else if (this.value == "sdmi") {
				$("#keterangan").show();
			} else if (this.value == "lain") {
				$("#keterangan").show();
			} else {
				$("#keterangan").hide();
			}
		});

		$("#hafalan_terakhir").on("change", function() {
			if (this.value == "SUDAH") {
				$(".isi_ket_hafalan_terakhir").show();
				$("#isi_juz").focus();
				$("#isi_juz").val("");
			} else {
				$(".isi_ket_hafalan_terakhir").hide();
			}
		});

		$('#isi_juz').keypress(function (e) {
		    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
	  	});

	  	$("#nomhp_ayah").keypress(function (e) {
		    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
	  	});

	  	$("#nomhp_ibu").keypress(function (e) {
		    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
	  	});

	});

</script>