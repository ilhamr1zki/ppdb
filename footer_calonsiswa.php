
							
</body>
</html>
<!-- Aditional Script -->
<script type="text/javascript" src="./assets/js/jquery-1.11.3.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap -->
<script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
<!-- Pace -->
<script type="text/javascript" src="./assets/plugins/pace/pace.js"></script>
<script type="text/javascript" src="theme/datetime/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="theme/datetime/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<!-- Datepicker -->
<script type="text/javascript" src="./assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="./assets/plugins/datepicker/css/bootstrap-datepicker.min.css">
<script type="text/javascript">

	let showAlert 		= `<?= $showPopUp; ?>`
	let tahfidz_quran 	= `<?= $pilihanTahfidz; ?>`

	let emptyAkte 		= `<?= $akteKosong; ?>`
	let emptyKK 		= `<?= $kartu_kk_empty; ?>`
	let emptyKTPayah  	= `<?= $ktpAyahKosong; ?>`
	let emptyKTPibu  	= `<?= $ktpIbuKosong; ?>`

	let akteInvalid 	= `<?= $fileAkteValid; ?>`
	let kkInvalid 		= `<?= $fileKkValid; ?>`
	let ktpAyahInvalid 	= `<?= $ktpAyahValid; ?>`
	let ktpIbuInvalid 	= `<?= $ktpIbuValid; ?>`
	let sertif1Invalid	= `<?= $sertifTahsinValid; ?>`
	let sertif2Invalid	= `<?= $sertifTahfidzValid; ?>`
	let infaqInvalid 	= `<?= $invalidInfaq; ?>`

	window.history.pushState(null, null, window.location.href);
    window.onpopstate = function() {
        window.history.go(1); // Ini akan memaksa browser untuk tetap di halaman yang sekarang
    };

	if (emptyAkte == 1) {

		Swal.fire({
		  title: "GAGAL",
		  text: "FILE AKTE KELAHIRAN HARAP DI ISI !",
		  icon: "warning"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);

	} else if (akteInvalid == 1) {

		Swal.fire({
		  icon: "error",
		  title: "GAGAL",
		  text: "FILE AKTE YANG ANDA UPLOAD BUKAN BERTIPE PDF !"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);

	} else if (emptyKK == 1) {

		Swal.fire({
		  title: "GAGAL",
		  text: "FILE KARTU KELUARGA HARAP DI ISI !",
		  icon: "warning"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);

	} else if (kkInvalid == 1) {

		Swal.fire({
		  icon: "error",
		  title: "GAGAL",
		  text: "FILE KARTU KELUARGA YANG ANDA UPLOAD BUKAN BERTIPE PDF !"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);

	} else if (emptyKTPayah == 1) {

		Swal.fire({
		  title: "GAGAL",
		  text: "FILE KTP AYAH HARAP DI ISI !",
		  icon: "warning"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);

	} else if (emptyKTPibu == 1) {

		Swal.fire({
		  title: "GAGAL",
		  text: "FILE KTP IBU HARAP DI ISI !",
		  icon: "warning"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);

	} else if (ktpAyahInvalid == 1) {

		Swal.fire({
		  icon: "error",
		  title: "GAGAL",
		  text: "FILE KTP AYAH YANG ANDA UPLOAD BUKAN BERTIPE PDF !"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);

	} else if (ktpIbuInvalid == 1) {

		Swal.fire({
		  icon: "error",
		  title: "GAGAL",
		  text: "FILE KTP IBU YANG ANDA UPLOAD BUKAN BERTIPE PDF !"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);

	} else if (sertif1Invalid == 1) {

		Swal.fire({
		  icon: "error",
		  title: "GAGAL",
		  text: "FILE SERTIFIKAT TAHSIN YANG ANDA UPLOAD BUKAN BERTIPE PDF !"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);		

	} else if (sertif2Invalid == 1) {

		Swal.fire({
		  icon: "error",
		  title: "GAGAL",
		  text: "FILE SERTIFIKAT TAHFIDZ YANG ANDA UPLOAD BUKAN BERTIPE PDF !"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);				

	} else if (infaqInvalid == 1) {

		Swal.fire({
		  icon: "error",
		  title: "GAGAL",
		  text: "NOMINAL INFAQ TIDAK DI ISI !"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);				

	} else if (infaqInvalid == 2) {

		Swal.fire({
		  icon: "error",
		  title: "GAGAL",
		  text: "NOMINAL INFAQ TERBILANG TIDAK DI ISI !"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);				

	} else if (infaqInvalid == 3) {

		Swal.fire({
		  icon: "error",
		  title: "GAGAL",
		  text: "NOMINAL INFAQ TIDAK DI ISI !"
		});

		setTimeout(() => {
			location.href = `<?= $base; ?>`
		}, 3000);				

	}

	if (showAlert == "jenjang_sekolah") {
		Swal.fire({
		  title: "GAGAL",
		  text: "HARAP PILIH KELAS TERLEBIH DAHULU !",
		  icon: "warning"
		});
	} else if (showAlert == "insert_data_berhasil") {

		Swal.fire({
		  title: "BERHASIL",
		  text: "PENDAFTARAN PPDB BERHASIL, SILAHKAN CHECK NOTIFIKASI WHATSAPP!",
		  icon: "success"
		});

	} else if (showAlert == 'insert_data_gagal') {

		Swal.fire({
		  title: "GAGAL",
		  text: "TIDAK DAPAT MENYIMPAN DATA !",
		  icon: "warning"
		});

		setTimeout(() => {
			location.href = `<?= $base_pendaftar_ppdb; ?>`
		}, 3000);

	} else if (showAlert == 'found_threat') {
		Swal.fire({
		  title: "GAGAL",
		  text: "TIDAK DAPAT MENYIMPAN DATA !",
		  icon: "error"
		});

		setTimeout(() => {
			location.href = `<?= $base_pendaftar_ppdb; ?>`
		}, 3000);
	} else {

		$('.form_date').datetimepicker({
	        weekStart: 1,
	        todayBtn:  1,
		    autoclose: 1,
		    todayHighlight: 1,
		    startView: 2,
		    minView: 2,
		    forceParse: 0
	    });

		$('.datepicker').datepicker({
		    format: "yyyy/mm/dd",
		    weekStart: 1,
		    todayBtn: "linked",
		    daysOfWeekHighlighted: "0,6",
		    orientation: "bottom right",
		    autoclose: true,
		    todayHighlight: true,
		    toggleActive: true,
		    language: "id"
		});

		$("#anak_ke").keypress(function (e) {
		    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
	  	});

	  	$("#nisn_calon_siswa").keypress(function (e) {
		    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
	  	});

		$("#daribrp_saudara").keypress(function (e) {
		    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
	  	});

	  	// $("#isijuzberapa").keypress(function (e) {
		  //   if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
	  	// });

	  	$("#nomorhpayah").keypress(function (e) {
		    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
	  	});

		let allowedExtension = [".pdf"];

	  	// Akte Kelahiran
	  	let fileInputAkte = document.getElementById("isian_surat_akte");

		// Upload Akte Kelahiran
		fileInputAkte.addEventListener("change", function() {
		  // Check that the file extension is supported.
		  // If not, clear the input.
		  // let hasInvalidFiles = false;
		  // for (let i = 0; i < this.files.length; i++) {
		  //   let file = this.files[i];
		    
		  //   if (!file.name.endsWith(allowedExtension)) {
		  //     hasInvalidFiles = true;
		  //   }
		  // }
		  
		  // if(hasInvalidFiles) {
		  //   fileInput.value = ""; 
		  //   alert("Unsupported file selected.");
		  // }

		  	let filePath          = this.value; 
	      	// let allowedExtensions = /(\.pdf|\.jpeg|\.png)$/i;
	      	let allowedExtensions = /(\.pdf)$/i;

	      	if (!allowedExtensions.exec(filePath)) {

	        	showErrAnotherFile("AKTE KELAHIRAN");
		        this.value = '';
		        return false;

		    } else {

	            const inputFile = this.files[0]
	            const limit     = 2500;
	            const size      = inputFile.size/1024;

	            if (size > limit) {
	              
	              	const err = new Error(`Ukuran File Terlalu Besar : ${(size/1000).toFixed(2)} MB`);
	              	this.value = '';
	              	showErrSizeFileTooBig(size,'AKTE KELAHIRAN');
	              	return false;

	            }

	        }

		});

		// Kartu Keluarga
	  	let fileInputKK = document.getElementById("isian_surat_kk");

		// Upload Kartu Keluarga
		fileInputKK.addEventListener("change", function() {
		  // Check that the file extension is supported.
		  // If not, clear the input.
		  // let hasInvalidFiles = false;
		  // for (let i = 0; i < this.files.length; i++) {
		  //   let file = this.files[i];
		    
		  //   if (!file.name.endsWith(allowedExtension)) {
		  //     hasInvalidFiles = true;
		  //   }
		  // }
		  
		  // if(hasInvalidFiles) {
		  //   fileInput.value = ""; 
		  //   alert("Unsupported file selected.");
		  // }

		  	let filePath          = this.value; 
	      	// let allowedExtensions = /(\.pdf|\.jpeg|\.png)$/i;
	      	let allowedExtensions = /(\.pdf)$/i;

	      	if (!allowedExtensions.exec(filePath)) {

	      		showErrAnotherFile("KARTU KELUARGA");
		        this.value = '';
		        return false;

		    } else {

	            const inputFile = this.files[0]
	            const limit     = 2500;
	            const size      = inputFile.size/1024;

	            if (size > limit) {
	              
	              	const err = new Error(`Ukuran File Terlalu Besar : ${(size/1000).toFixed(2)} MB`);
	              	this.value = '';
	              	showErrSizeFileTooBig(size, "KARTU KELUARGA");

	              	return false;

	            }

	        }

		});

		// KTP Ayah
	  	let fileInputKtpAyah = document.getElementById("isian_ktp_ayah");

		// Upload KTP AYAH
		fileInputKtpAyah.addEventListener("change", function() {

		  	let filePath          = this.value; 
	      	// let allowedExtensions = /(\.pdf|\.jpeg|\.png)$/i;
	      	let allowedExtensions = /(\.pdf)$/i;

	      	if (!allowedExtensions.exec(filePath)) {

	      		showErrAnotherFile("KTP AYAH");
		        this.value = '';
		        return false;

		    } else {

	            const inputFile = this.files[0]
	            const limit     = 2500;
	            const size      = inputFile.size/1024;

	            if (size > limit) {
	              
	              	const err = new Error(`Ukuran File Terlalu Besar : ${(size/1000).toFixed(2)} MB`);
	              	this.value = '';
	              	showErrSizeFileTooBig(size, "KTP AYAH");

	              	return false;

	            }

	        }

		});

		// KTP Ibu
	  	let fileInputKtpIbu = document.getElementById("isian_ktp_ibu");

		// Upload KTP AYAH
		fileInputKtpIbu.addEventListener("change", function() {

		  	let filePath          = this.value; 
	      	// let allowedExtensions = /(\.pdf|\.jpeg|\.png)$/i;
	      	let allowedExtensions = /(\.pdf)$/i;

	      	if (!allowedExtensions.exec(filePath)) {

	      		showErrAnotherFile("KTP IBU");
		        this.value = '';
		        return false;

		    } else {

	            const inputFile = this.files[0]
	            const limit     = 2500;
	            const size      = inputFile.size/1024;

	            if (size > limit) {
	              
	              	const err = new Error(`Ukuran File Terlalu Besar : ${(size/1000).toFixed(2)} MB`);
	              	this.value = '';
	              	showErrSizeFileTooBig(size, "KTP IBU");

	              	return false;

	            }

	        }

		});

		// Sertifikat Tahsin
	  	let fileInputSertifTahsin = document.getElementById("isian_sertif_tahsin");

		// Upload Sertifikat Tahsin
		fileInputSertifTahsin.addEventListener("change", function() {

		  	let filePath          = this.value; 
	      	// let allowedExtensions = /(\.pdf|\.jpeg|\.png)$/i;
	      	let allowedExtensions = /(\.pdf)$/i;

	      	if (!allowedExtensions.exec(filePath)) {

	      		showErrAnotherFile("SERTIFIKAT TAHSIN");
		        this.value = '';
		        return false;

		    } else {

	            const inputFile = this.files[0]
	            const limit     = 2500;
	            const size      = inputFile.size/1024;

	            if (size > limit) {
	              
	              	const err = new Error(`Ukuran File Terlalu Besar : ${(size/1000).toFixed(2)} MB`);
	              	this.value = '';
	              	showErrSizeFileTooBig(size, "SERTIFIKAT TAHSIN");

	              	return false;

	            }

	        }

		});

		// Sertifikat Tahfidz
	  	let fileInputSertifTahfidz = document.getElementById("isian_sertif_tahfidz");

		// Upload Sertifikat Tahfidz
		fileInputSertifTahfidz.addEventListener("change", function() {

		  	let filePath          = this.value; 
	      	// let allowedExtensions = /(\.pdf|\.jpeg|\.png)$/i;
	      	let allowedExtensions = /(\.pdf)$/i;

	      	if (!allowedExtensions.exec(filePath)) {

	      		showErrAnotherFile("SERTIFIKAT TAHFIDZ");
		        this.value = '';
		        return false;

		    } else {

	            const inputFile = this.files[0]
	            const limit     = 2500;
	            const size      = inputFile.size/1024;

	            if (size > limit) {
	              
	              	const err = new Error(`Ukuran File Terlalu Besar : ${(size/1000).toFixed(2)} MB`);
	              	this.value = '';
	              	showErrSizeFileTooBig(size, "SERTIFIKAT TAHFIDZ");

	              	return false;

	            }

	        }

		});

	}

  	function onlyNumberKey(evt) {

        // Only ASCII character in that range allowed
        let ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    function validasiTanggal() {
      // Ambil tanggal input dari elemen input
      var tanggalInput = document.getElementById('vldt').value;

      // Batas tanggal
      var tanggalMin = new Date('2019-02-01');  // Tanggal batas bawah
      var tanggalMax = new Date('2020-02-29');  // Tanggal batas atas

      // Konversi input tanggal menjadi objek Date
      var tanggal = new Date(tanggalInput);

      // Cek apakah input tanggal valid
      if (isNaN(tanggal)) {
        alert("Format tanggal tidak valid. Harap masukkan tanggal dalam format YYYY-MM-DD.");
        return;
      }

      // Cek apakah tanggal input dalam rentang yang diizinkan
      if (tanggal >= tanggalMin && tanggal <= tanggalMax) {
      	console.log("date is valid");
      } else {
        alert("Usia Anak anda melebihi batas usia maximal 7 tahun 5 bulan atau batas minimum 6 tahun 5 bulan pada saat Bulan Juli 2026");
        document.getElementById('vldt').focus();
        event.preventDefault();
      }
    }

    const showErrSizeFileTooBig = (size, nmfile) => {

    	Swal.fire({
		  icon: "error",
		  title: "FAILED !",
		  text: `UKURAN FILE ${nmfile} TERLALU BESAR !`
		});

    }

    const showErrAnotherFile = (jenisfile) => {

    	Swal.fire({
		  icon: "error",
		  title: "FAILED !",
		  text: `FORMAT FILE ${jenisfile} HARUS BER TIPE PDF !`
		});

    }

</script>
<!-- Validetta -->
<link rel="stylesheet" type="text/css" href="./assets/plugins/validetta/validetta.min.css">
<script type="text/javascript" src="./assets/plugins/validetta/validetta.min.js"></script>
<script type="text/javascript">

	// fungsi untuk validasi input dan checkbox
  	function validateForm() {
	    let angka = $("#nisn_calon_siswa").val();
	    let checkbox = $("#approverules").is(":checked");

	    if (angka.length < 10 && angka.length > 0) {
	      $("#error-message").show();
	    } else {
	      $("#error-message").hide();
	    }

	    // kondisi tombol aktif
	    if (checkbox && angka.length === 10 || checkbox && angka.length == 0) {
	      $("#proses_simpan").prop("disabled", false);
	    } else {
	      $("#proses_simpan").prop("disabled", true);
	    }
  	}

	$(document).ready(function() {

      	$("#proses_simpan").prop("disabled", true);
		$(".nmsklhasal").hide();
		$(".nisncalonsiswa").hide();
		$(".isianjuz").hide();
		$(".isiansurah").hide();
		$(".agamalainayah").hide();
		$(".agamalainibu").hide();
		$(".pekerjaanlainayah").hide();
		$(".pekerjaanlainibu").hide();
		$(".isianberapajuz").hide();
		$(".askinstansi").hide();
		$(".issd").hide();
		$(".sertif_tahsin").hide();
		$(".sertif_tahfidz").hide();
		$("#nisn_calon_siswa").focus();
		$(".tingkatkls_adik_kakak").hide();
		$(".nama_adik_kakak").hide();
		$(".sklh_lain").hide();
		$(".is_terapi").hide();
		$(".waktu_main_gadget").hide();

		$(".targetjenjangsekolah").on("change", function() {
			if(this.value == "KB") {
				// alert("KELAS KB")
				$(".issd").hide();
				$(".iskb").show();
				$(".nisncalonsiswa").hide();
				$("#nama_calon_siswa").focus();
				$(".sertif_tahsin").hide();
				$(".sertif_tahfidz").hide();
			} else if(this.value == "1SD") {
				// alert("KELAS SD")
				$(".iskb").hide();
				$(".issd").show();
				$(".nisncalonsiswa").show();
				$("#nisn_calon_siswa").focus();
				$(".sertif_tahsin").show();
				$(".sertif_tahfidz").show();
			} else {
				$(".nisncalonsiswa").hide();
			}
		});

		$(".target_asal_sekolah").on("change", function() {
			if(this.value == "LAINNYA") {
				// alert("KELAS KB")
				$(".sklh_lain").show();
				$("#sekolah_lain").focus();
				document.getElementById("sekolah_lain").setAttribute("required", "");

			} else {
				
				$(".sklh_lain").hide();
				document.getElementById("sekolah_lain").removeAttribute("required");

			}
		});

		$(".targetasalsekolah" ).on(
			"change", function() {
			if(this.value == "sdmi") {
				$(".nmsklhasal").show();
				$(".nisnawal").show();
				$("#asal_sekolah").focus();
			} else {
				$(".nmsklhasal").hide();
				$(".nisnawal").hide();
			}
		});

		$(".tingkatkelas_adik_kakak").on("change", function() {
			if (this.value == "ada") {
				$(".tingkatkls_adik_kakak").show();
				document.getElementById("pilih_tingkat").setAttribute("required", "");
			} else {
				$(".tingkatkls_adik_kakak").hide();
				$(".nama_adik_kakak").hide();
				$(".pilih_kelas_adik_kakak").val("");
				document.getElementById("pilih_tingkat").removeAttribute("required");
				document.getElementById("nama_adik_kakak").removeAttribute("required");
			}
		});

		$(".pilih_kelas_adik_kakak").on("change", function() {
			if (this.value != "") {
				$(".nama_adik_kakak").show();
				$("#nama_adik_kakak").focus();
				document.getElementById("nama_adik_kakak").setAttribute("required", "");
			} else {
				$(".nama_adik_kakak").hide();
				document.getElementById("nama_adik_kakak").removeAttribute("required");
			}
		});

		$(".apakah_terapi").on("change", function() {
			if(this.value == "PERNAH") {
				$(".is_terapi").show();
				$("#jenis_terapi").focus();
				document.getElementById("jenis_terapi").setAttribute("required", "");
				document.getElementById("alasan_terapi").setAttribute("required", "");
				document.getElementById("durasi_terapi").setAttribute("required", "");
				document.getElementById("waktu_mulai_akhir_terapi").setAttribute("required", "");
				document.getElementById("masih_atau_tidak_terapi").setAttribute("required", "");
				document.getElementById("keterlambatan_perkembangan").setAttribute("required", "");
			} else {
				$(".is_terapi").hide();
				document.getElementById("jenis_terapi").removeAttribute("required");
				document.getElementById("alasan_terapi").removeAttribute("required");
				document.getElementById("durasi_terapi").removeAttribute("required");
				document.getElementById("waktu_mulai_akhir_terapi").removeAttribute("required");
				document.getElementById("masih_atau_tidak_terapi").removeAttribute("required");
				document.getElementById("keterlambatan_perkembangan").removeAttribute("required");
			}
		});

		$(".terbiasa_gadget").on("change", function() {

			if (this.value == "IYA") {
				$(".waktu_main_gadget").show();
				$("#waktu_bermain_gadget").focus();
				document.getElementById("waktu_bermain_gadget").setAttribute("required", "");
			} else {
				$(".waktu_main_gadget").hide();
				document.getElementById("waktu_bermain_gadget").removeAttribute("required");
			}

		});

		$(".rencanapdh").on("change", function() {
			if (this.value == "ada") {
				$(".askinstansi").show();
				$("#alasan_pindah").focus();
				document.getElementById("alasan_pindah").setAttribute("required", "");
			} else {
				$(".askinstansi").hide();
				$("#alasan_pindah").val("");
				document.getElementById("alasan_pindah").removeAttribute("required");
			}
		});

		$(".target_tahfidz").on("change", function() {
			if(this.value == "sudahtahfidz") {
				$(".isianberapajuz").show();
				$(".isianjuz").show();
				$(".isiansurah").show();
				$("#isiberapajuz").focus();
				document.getElementById("isiberapajuz").setAttribute("required", "");
				document.getElementById("isijuzberapa").setAttribute("required", "");
				document.getElementById("isian_surat").setAttribute("required", ""); 
			} else if(this.value == "belumtahfidz") {

				$(".isianberapajuz").hide();
				$(".isianjuz").hide();
				$(".isiansurah").hide();
				$("#isijuzberapa").val("");
				$("#isiberapajuz").val("");
				$("#isian_surat").val("");
				document.getElementById("isijuzberapa").removeAttribute("required"); 
				document.getElementById("isian_surat").removeAttribute("required");  
				document.getElementById("isiberapajuz").removeAttribute("required"); 

			} else {

				$(".isianberapajuz").hide();
				$(".isianjuz").hide();
				$(".isiansurah").hide();
				$("#isijuzberapa").val("");
				$("#isiberapajuz").val("");
				$("#isian_surat").val("");
				document.getElementById("isijuzberapa").removeAttribute("required"); 
				document.getElementById("isian_surat").removeAttribute("required"); 
				document.getElementById("isiberapajuz").removeAttribute("required");

			}
		});

		$(".pilih_agama").on("change", function() {
			if (this.value == "LAINNYA") {
				$(".agamalainayah").show();
				$("#agamalainayah").focus();
				document.getElementById("agamalainayah").setAttribute("required", ""); 
			} else {
				document.getElementById("agamalainayah").removeAttribute("required"); 
				$(".agamalainayah").hide();
				$("#agamalainayah").val("");
			}
		});

		$(".pilih_agama_ibu").on("change", function() {
			if (this.value == "LAINNYA") {
				$(".agamalainibu").show();
				$("#agamalainibu").focus();
				document.getElementById("agamalainibu").setAttribute("required", "");
			} else {
				document.getElementById("agamalainibu").removeAttribute("required"); 
				$(".agamalainibu").hide();
				$("#agamalainibu").val("");
			}
		});

		$(".pilih_pekerjaan_ayah").on("change", function() {
			if (this.value == "LAINNYA") {
				$(".pekerjaanlainayah").show();
				$("#pekerjaanlainayah").focus();
				document.getElementById("pekerjaanlainayah").setAttribute("required", "");
			} else {
				$(".pekerjaanlainayah").hide();
				$("#pekerjaanlainayah").val("");
				document.getElementById("pekerjaanlainayah").removeAttribute("required");
			}
		});

		document.getElementById("nomorhpayah").addEventListener("input", function() {
		    let value = this.value;

		    // Jika user sudah memasukkan minimal 2 angka
		    if(value.length >= 2){
		        if(value.substring(0, 2) !== "08"){
	      			$("#error-message-hp1").show();
	      			$(".nomorhp1").val("");
		        } else {
					$("#error-message-hp1").hide();
		        }
		    } else {
				$("#error-message-hp1").hide();

		    }
		});

		$(".pilih_pekerjaan_ibu").on("change", function() {
			if (this.value == "LAINNYA") {
				$(".pekerjaanlainibu").show();
				$("#pekerjaanlainibu").focus();
				document.getElementById("pekerjaanlainibu").setAttribute("required", "");
			} else {
				$(".pekerjaanlainibu").hide();
				$("#pekerjaanlainibu").val("");
				document.getElementById("pekerjaanlainibu").removeAttribute("required");
			}
		});

		document.getElementById("nomorhpibu").addEventListener("input", function() {
		    let value = this.value;

		    // Jika user sudah memasukkan minimal 2 angka
		    if(value.length >= 2){
		        if(value.substring(0, 2) !== "08"){
	      			$("#error-message-hp2").show();
	      			$(".nomorhp2").val("");
		        } else {
					$("#error-message-hp2").hide();
		        }
		    } else {
				$("#error-message-hp2").hide();

		    }
		});

		$(".targetasalsekolaherr").on("change", function() {
			if(this.value == "sdmi") {
				$(".nmsklhasalerror").show();
				$("#asal_sekolah_err").focus();
			} else {
				$("#asal_sekolah_err").val("");
				$(".nmsklhasalerror").hide();
			}
		});

		if (tahfidz_quran == "sudahtahfidz") {
			$(".isianjuzerror").show();
			$(".isiansuraherror").show();
			$(".target_tahfidz_err").on("change", function() {
				if(this.value == "sudahtahfidz") {
					$(".isianjuzerror").show();
					$(".isiansuraherror").show();
					$("#errisijuzberapa").focus();
				} else {
					$(".isianjuzerror").hide();
					$(".isiansuraherror").hide();
				}
			});

		} else if (tahfidz_quran == "belumtahfidz") {
			$(".isianjuzerror").hide();
			$(".isiansuraherror").hide();
			$(".target_tahfidz_err").on("change", function() {
				if(this.value == "sudahtahfidz") {
					$(".isianjuzerror").show();
					$(".isiansuraherror").show();
					$("#errisijuzberapa").focus();
				} else {
					$(".isianjuzerror").hide();
					$(".isiansuraherror").hide();
					$("#errisijuzberapa").val("");
				}
			});
		}

		// $("#nisn_calon_siswa").on("keyup", function() {
		//     let val = $(this).val();

		//     if (val.length > 0 && val.length < 10) {
		//       // popup muncul kalau kurang dari 10 digit
		//       	$("#error-message").show();
		// 	    $(".check").click(function() {
		// 			if ($("input:checkbox").filter(":checked").length == 1 ) {
		// 				$("#proses_simpan").removeClass("disabled");
		// 			} else {
		// 				$("#proses_simpan").addClass("disabled");
		// 			}
		// 		});

		//     } else {
		//     	$("#error-message").hide();
		//     }
	  	// });

		// $(".check").click(function() {
		// 	if ($("input:checkbox").filter(":checked").length == 1 ) {
		// 		$("#proses_simpan").removeClass("disabled");
		// 	} else {
		// 		$("#proses_simpan").addClass("disabled");
		// 	}
		// });

		 // jalankan validasi setiap kali user mengetik atau klik checkbox
	  	$("#nisn_calon_siswa").on("keyup", validateForm);
	  	$("#approverules").on("change", validateForm);

		let nominal_infaq     = document.getElementById('nominal_infaq');

		nominal_infaq.addEventListener('keyup', function(e){
	        // tambahkan 'Rp.' pada saat form di ketik
	        // alert("ok")
	        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
	        nominal_infaq.value = formatRupiah(this.value, '');
	    });

		function formatRupiah(angka, prefix){
	        var number_string = angka.replace(/[^,\d]/g, '').toString(),
	        split             = number_string.split(','),
	        sisa              = split[0].length % 3,
	        nominal_infaq     = split[0].substr(0, sisa),
	        ribuan            = split[0].substr(sisa).match(/\d{3}/gi);

	        // tambahkan titik jika yang di input sudah menjadi angka ribuan
	        if(ribuan){
	            separator = sisa ? '.' : '';
	            nominal_infaq += separator + ribuan.join('.');
	        }

	        nominal_infaq = split[1] != undefined ? nominal_infaq + ',' + split[1] : nominal_infaq;
	        return prefix == undefined ? nominal_infaq : (nominal_infaq ? '' + nominal_infaq : '');
	    }

		$('.validetta').validetta({
			showErrorMessages : true,
			display : 'inline', // bubble or inline
			errorTemplateClass : 'validetta-inline',
		});

	});
</script>
<!-- Datatables -->
<link rel="stylesheet" type="text/css" href="./assets/plugins/datatables/media/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="./assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./assets/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable').DataTable( {
			"language": {
	            "url": "http://cdn.datatables.net/plug-ins/1.10.11/i18n/Indonesian.json"
	        }
			// "order": [[ 0, "desc" ]]
		} );
		$('#datatable2').DataTable( {
			// "order": [[ 0, "desc" ]]
		} );
	} );
</script>
<!-- Tooltip -->
<script type="text/javascript">
    $('.tooltip').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
</script>
