<?php  

	if (isset($_POST['nama_file_akte'])) {

		$fileName = basename($_POST['nama_file_akte']);
		$filePath = "../upload/" . $fileName;

		if(!empty($fileName) && file_exists($filePath)) {

			// Define Headers
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Disposition: attachment; filename=$fileName");
			header("Content-Type: application/zip");
			header("Content-Transfer-Emcoding: binary");

			readfile($filePath);
			exit;

		} else {

			echo "File Does not exist";

		}

	}

?>