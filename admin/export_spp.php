<?php  
    
    require '../php/config.php';
    require '../php/function.php';

    function rupiah($angka){
    
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
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
        // $jamIndo = date_format($tanggal_indo, "H:i:s");
        // echo $jamIndo;
        $result = $tanggal ." ". $bulan ." ". $tahun;       
        return($result);  
    }

    function rupiahFormat($angkax){
    
        $hasil_rupiahx = "Rp " . number_format($angkax,0,'.',',');
        return $hasil_rupiahx;
     
    }

    $ambildata_perhalaman = mysqli_query($con, 'SELECT * FROM data_pendaftaran_siswa_diterima');


?>

<!DOCTYPE html>
<html>
<head>
    <title>EXPORT EXCEL</title>
</head>
<body>
    
    <style type="text/css">
        body{
            font-family: sans-serif;
        }
        table{
            margin: 20px auto;
            border-collapse: collapse;
        }
        table th,
        table td{
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }
        a{
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data_murid_sd.xls");
    ?>

    <div style="overflow-x: auto; margin: 10px;">
                            
        <table id="example_semua" class="table table-bordered" border="1">
            <thead>
              <tr>
                 <th style="text-align: center;"> tahun_join </th>
                 <th style="text-align: center;"> NIS </th>
                 <th style="text-align: center;"> KELAS </th>
                 <th style="text-align: center;"> Nama </th>
                 <th style="text-align: center;"> Panggilan </th>
                 <th style="text-align: center;"> KLP </th>
                 <th style="text-align: center;"> jk </th>
                 <th style="text-align: center;"> tempat_lahir </th>
                 <th style="text-align: center;"> tanggal_lahir </th>
                 <th style="text-align: center;"> berat_badan </th>
                 <th style="text-align: center;"> tinggi_badan </th>
                 <th style="text-align: center;"> ukuran_baju  </th>
                 <th style="text-align: center;"> Alamat </th>
                 <th style="text-align: center;"> telp_rumah </th>
                 <th style="text-align: center;"> HP </th>
                 <th style="text-align: center;"> alamat_email </th>
                 <th style="text-align: center;"> nama_ayah </th>
                 <th style="text-align: center;"> Pendidikan </th>
                 <th style="text-align: center;"> Pekerjaan </th>
                 <th style="text-align: center;"> tempat_tanggal_lahir </th>
                 <th style="text-align: center;"> nama_ibu </th>
                 <th style="text-align: center;"> Pendidikan1 </th>
                 <th style="text-align: center;"> Pekerjaan1 </th>
                 <th style="text-align: center;"> tempat_tanggal_lahir1 </th>
              </tr>
            </thead>
            <tbody>

                <?php foreach ($ambildata_perhalaman as $data) : ?>
                    <tr>
                        <td style="text-align: center;"> 2024 </td>
                        <td style="text-align: center;"> <?= $data['nisn']; ?> </td>
                        <td style="text-align: center;"> <?= str_replace(["SD"], " SD", htmlspecialchars($data['pendaftaran_kelas'])); ?> </td>
                        <td style="text-align: center;"> <?= strtoupper(htmlspecialchars($data['nama_calon_siswa'])); ?> </td>
                        <td style="text-align: center;"> <?= strtoupper(htmlspecialchars($data['panggilan_calon_siswa'])); ?> </td>
                        <td style="text-align: center;"> - </td>
                        <?php if ($data['jenis_kelamin'] == "LAKI-LAKI"): ?>
                            <td style="text-align: center;"> L </td>
                        <?php elseif($data['jenis_kelamin'] == "PEREMPUAN"): ?>
                            <td style="text-align: center;"> P </td>
                        <?php endif ?>
                        <td style="text-align: center;"> <?= htmlspecialchars($data['tempat_lahir']); ?> </td>
                        <td style="text-align: center;"> <?= htmlspecialchars($data['tanggal_lahir']); ?> </td>
                        <td style="text-align: center;"> - </td>
                        <td style="text-align: center;"> - </td>
                        <td style="text-align: center;"> - </td>
                        <td style="text-align: center;"> <?= htmlspecialchars($data['domisili_ayah_saat_ini']); ?> </td>
                        <td style="text-align: center;"> - </td>
                        <td style="text-align: center;"> <?= htmlspecialchars($data['nomor_hp_ayah']); ?> </td>
                        <td style="text-align: center;"> - </td>
                        <td style="text-align: center;"> <?= strtoupper(htmlspecialchars($data['nama_ayah'])); ?> </td>
                        <td style="text-align: center;"> <?= htmlspecialchars($data['pendidikan_terakhir_ayah']); ?> </td>
                        <td style="text-align: center;"> <?= htmlspecialchars($data['pekerjaan_ayah']); ?> </td>
                        <td style="text-align: center;"> <?= htmlspecialchars($data['tempat_lahir_ayah']) . ", " . htmlspecialchars(format_tgl_indo($data['tanggal_lahir_ayah'])); ?> </td>
                        <td style="text-align: center;"> <?= strtoupper(htmlspecialchars($data['nama_ibu'])); ?> </td>
                        <td style="text-align: center;"> <?= htmlspecialchars($data['pendidikan_terakhir_ibu']); ?> </td>
                        <td style="text-align: center;"> <?= htmlspecialchars($data['pekerjaan_ibu']); ?> </td>
                        <td style="text-align: center;"> <?= htmlspecialchars($data['tempat_lahir_ibu']) . ", " . htmlspecialchars(format_tgl_indo($data['tanggal_lahir_ibu'])); ?> </td>

                    </tr>
                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</body>
</html>