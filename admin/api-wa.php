<?php  
	require '../php/config.php'; 

	$token  	= htmlspecialchars($_POST['_token']);
	$mother 	= $_POST['phone1'];
	$father 	= $_POST['phone2'];
	$student 	= $_POST['std'];
	$file_name 	= $_POST['filename'];
	$status 	= $_POST['stats'];

	$apiUrl 	= "https://api.fonnte.com/send";

	$allNumberPhone = [];
	$results = [];

	// Cek Keamanan
	if(!empty($token)) {

		if ($status == 'accept') {

			// Gabungkan array jadi string pakai implode
			$resultStudent 	= implode(',', $student);
		    $resultMother 	= implode(',', $mother);
		    $resultFather 	= implode(',', $father);
		    $resultFileName = implode(',', $file_name);

		    $toArrStudent 	= explode(',', $resultStudent);
		    $toArrMother 	= explode(',', $resultMother);
		    $toArrFather 	= explode(',', $resultFather);
		    $toArrFileName 	= explode(',', $resultFileName);

		    $students 		= array_map('trim', explode(',', $resultStudent));
			$mothers  		= array_map('trim', explode(',', $resultMother));
			$fathers  		= array_map('trim', explode(',', $resultFather));
			$filename 		= array_map('trim', explode(',', $resultFileName));
			$url  			= $basead. "uploads/ppdb_diterima/pdf_send_to_otm/";

			$combined = [];

		    // $allNumberPhone[] = array_merge($toArrMother, $toArrFather);

			for ($i = 0; $i < count($students); $i++) {

			    $combined[] = [
			        $students[$i],
			        $mothers[$i],
			        $fathers[$i],
			        $filename[$i]
			    ];

			}

			// for ($i = 0; $i < count($combined); $i++) {
			//     for ($j = 0; $j < count($combined[$i]); $j++) {
			//         echo $combined[$i][$j] . ' ';
			//     }
			//     echo "<br>";
			// }

			foreach ($combined as $index => $row) {
				$pesan 	= "BISMILLAH" . "\n". "\n" . "SELAMAT !". "\n" ."Ananda a/n " . "*{$row[0]}*" . "\n" . "\n" . "*LOLOS SELEKSI* TAHAP 1" . "\n" . "\n" . "Mohon menunggu informasi selanjutnya di Seleksi TAHAP 2. " . "\n" . "\n" . "_*AKHYAR INTERNATIONAL ISLAMIC SCHOOL*_";
			    $target = $row[1] . "," . $row[2]; // misalnya nomor ada di kolom ke-3
			    $pdf 	= $url . $row[3];

			    $curl = curl_init();
			    curl_setopt_array($curl, [
			        CURLOPT_URL => $apiUrl,
			        CURLOPT_RETURNTRANSFER => true,
			        CURLOPT_POST => true,
			        CURLOPT_POSTFIELDS => [
			            'target' 	=> $target,
			            'message' 	=> $pesan,
			            'url' 		=> $pdf,
			            'filename'  => strtoupper($row[0]),
			            'delay' 	=> '5'
			        ],
			        CURLOPT_HTTPHEADER => [
			            "Authorization:v5daG91JX3QJnsDeSYnc"
			        ],
			    ]);

			    $response = curl_exec($curl);

			    $decodedResponse = json_decode($response, true);

			    // --- Ambil status dari hasil response ---
			    $apiStatus = isset($decodedResponse['status']) ? $decodedResponse['status'] : null;

			    $error = curl_error($curl);
			    curl_close($curl);

			    $results[] = [
			        'nama' => $row[0],
			        'target' => $target,
			        'status' => $apiStatus === false ? 'failed' : 'success',
			        'response' => $decodedResponse
			    ];
			}

			header('Content-Type: application/json');
			echo json_encode($results);

		} else if ($status == 'reject') {

			// Gabungkan array jadi string pakai implode
			$resultStudent 	= implode(',', $student);
		    $resultMother 	= implode(',', $mother);
		    $resultFather 	= implode(',', $father);
		    $resultFileName = implode(',', $file_name);

		    $toArrStudent 	= explode(',', $resultStudent);
		    $toArrMother 	= explode(',', $resultMother);
		    $toArrFather 	= explode(',', $resultFather);
		    $toArrFileName 	= explode(',', $resultFileName);

		    $students 		= array_map('trim', explode(',', $resultStudent));
			$mothers  		= array_map('trim', explode(',', $resultMother));
			$fathers  		= array_map('trim', explode(',', $resultFather));
			$filename 		= array_map('trim', explode(',', $resultFileName));
			$url  			= $basead. "uploads/ppdb_ditolak/pdf_send_to_otm/";

			$combined = [];

			for ($i = 0; $i < count($students); $i++) {

			    $combined[] = [
			        $students[$i],
			        $mothers[$i],
			        $fathers[$i],
			        $filename[$i]
			    ];

			}

			foreach ($combined as $index => $row) {
			    $pesan 	= "BISMILLAH" . "\n". "\n" ."Mohon Maaf !". "\n" ."Ananda a/n " ."*{$row[0]}*" . "\n" . "\n" . "*BELUM LOLOS* SELEKSI TAHAP 1" . "\n" . "\n" . "Semoga Ananda senantiasa dapat menempuh pembelajaran yang terbaik dimanapun berada. " . "\n" . "Aamiin" . "\n" . "\n" . "_*AKHYAR INTERNATIONAL ISLAMIC SCHOOL*_";
			    $target = $row[1] . "," . $row[2]; // misalnya nomor ada di kolom ke-3
			    $pdf 	= $url . $row[3];

			    $curl = curl_init();
			    curl_setopt_array($curl, [
			        CURLOPT_URL => $apiUrl,
			        CURLOPT_RETURNTRANSFER => true,
			        CURLOPT_POST => true,
			        CURLOPT_POSTFIELDS => [
			            'target' 	=> $target,
			            'message' 	=> $pesan,
			            'url' 		=> $pdf,
			            'filename'  => strtoupper($row[0]),
			            'delay' 	=> '5'
			        ],
			        CURLOPT_HTTPHEADER => [
			            "Authorization:v5daG91JX3QJnsDeSYnc"
			        ],
			    ]);

			    $response = curl_exec($curl);

			    $decodedResponse = json_decode($response, true);

			    // --- Ambil status dari hasil response ---
			    $apiStatus = isset($decodedResponse['status']) ? $decodedResponse['status'] : null;

			    $error = curl_error($curl);
			    curl_close($curl);

			    $results[] = [
			        'nama' => $row[0],
			        'target' => $target,
			        'status' => $apiStatus === false ? 'failed' : 'success',
			        'response' => $decodedResponse
			    ];
			}

			header('Content-Type: application/json');
			echo json_encode($results);

		} else {

			echo "Status Pendaftaran Failed";

		}

	} else {
	    echo "Tidak ada data yang dikirim";
	}

?>