<?php  

	require './php/config.php';

	$jumlahData3Sd = mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa WHERE pendaftaran_kelas = '3SD' ");
	echo "Jumlah Pendaftar kelas 3 SD : " . mysqli_num_rows($jumlahData3Sd) . " Orang <br>";

	$jumlahData4Sd = mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa WHERE pendaftaran_kelas = '4SD' ");
	echo "Jumlah Pendaftar kelas 4 SD : " . mysqli_num_rows($jumlahData4Sd) . " Orang <br>";

	$jumlahData5Sd = mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa WHERE pendaftaran_kelas = '5SD' ");
	echo "Jumlah Pendaftar kelas 5 SD : " . mysqli_num_rows($jumlahData5Sd) . " Orang <br>";

?>