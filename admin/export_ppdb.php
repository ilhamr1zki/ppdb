<?php  
    
    require '../php/config.php';
    require '../php/function.php';

    function rupiah($angka){
    
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }

    function rupiahFormat($angkax){
    
        $hasil_rupiahx = "Rp " . number_format($angkax,0,'.',',');
        return $hasil_rupiahx;
     
    }

    $ambildata_perhalaman = mysqli_query($con, 'SELECT * FROM data_pendaftaran_siswa');

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
        header("Content-Disposition: attachment; filename=data_ppdb_sd.xls");
    ?>

    <div style="overflow-x: auto; margin: 10px;">
                            
        <table id="example_semua" class="table table-bordered" border="1">
            <thead>
              <tr style="background-color: darkgrey;">
                 <th style="text-align: center;"> pendaftaran_kelas </th>
                 <th style="text-align: center;"> nama_calon_siswa </th>
                 <th style="text-align: center;"> panggilan_calon_siswa </th>
                 <th style="text-align: center;"> nisn </th>
                 <th style="text-align: center;"> asal_sekolah </th>
                 <th style="text-align: center;"> jenis_kelamin </th>
                 <th style="text-align: center;"> tempat_lahir </th>
                 <th style="text-align: center;"> tanggal_lahir </th>
                 <th style="text-align: center;"> anak_ke </th>
                 <th style="text-align: center;"> dari_berapa_saudara </th>
                 <th style="text-align: center;"> kk_atau_adik_di_aiis </th>
                 <th style="text-align: center;"> tingkat_kelas_kk_atau_adik </th>
                 <th style="text-align: center;"> nama_kk_atau_adik </th>
                 <th style="text-align: center;"> alasan_memilih_sekolah_diaiis </th>
                 <th style="text-align: center;"> pendapat_orangtua_mengenai_kebijakan_sekolah </th>
                 <th style="text-align: center;"> riwayat_penyakit_proses_hamil_hingga_saat_ini </th>
                 <th style="text-align: center;"> riwayat_penyakit_keterlambatan_tumbuh_kembang </th>
                 <th style="text-align: center;"> pernah_menjalani_terapi </th>
                 <th style="text-align: center;"> jenis_terapi </th>
                 <th style="text-align: center;"> alasan_menjalani_terapi </th>
                 <th style="text-align: center;"> durasi_terapi </th>
                 <th style="text-align: center;"> waktu_mulai_dan_waktu_selesai_terapi </th>
                 <th style="text-align: center;"> saat_ini_masih_menjalani_terapi </th>
                 <th style="text-align: center;"> kemampuan_sosial_anak_terhadap_lingkungan_baru </th>
                 <th style="text-align: center;"> kemandirian_ananda </th>
                 <th style="text-align: center;"> kelebihan_ananda </th>
                 <th style="text-align: center;"> terbiasa_solat_lima_waktu </th>
                 <th style="text-align: center;"> anak_terbiasa_menonton_tv_atau_gadget </th>
                 <th style="text-align: center;"> berapa_lama_menonton_tv_atau_gadget_dalam_sehari </th>
                 <th style="text-align: center;"> bacaan_tahsin </th>
                 <th style="text-align: center;"> jumlah_juz_dihafal </th>
                 <th style="text-align: center;"> juz_dihafal </th>
                 <th style="text-align: center;"> hafalan_surat </th>
                 <!-- <th style="text-align: center;"> dapat_berjalan_pada_usia </th> -->
                 <!-- <th style="text-align: center;"> dapat_berbicara_bermakna_pada_usia </th> -->
                 <th style="text-align: center;"> yang_terlibat_dalam_mengasuh_ananda </th>
                 <th style="text-align: center;"> peran_orangtua_membantu_anak_menghafal </th>
                 <th style="text-align: center;"> nama_ayah </th>
                 <th style="text-align: center;"> tempat_lahir_ayah </th>
                 <th style="text-align: center;"> tanggal_lahir_ayah </th>
                 <th style="text-align: center;"> agama_ayah </th>
                 <th style="text-align: center;"> pendidikan_terakhir_ayah </th>
                 <th style="text-align: center;"> pekerjaan_ayah </th>
                 <th style="text-align: center;"> domisili_ayah_saat_ini </th>
                 <th style="text-align: center;"> nomor_hp_ayah </th>
                 <th style="text-align: center;"> tahsin_ayah </th>
                 <th style="text-align: center;"> tahfidz_ayah </th>
                 <th style="text-align: center;"> nama_ibu </th>
                 <th style="text-align: center;"> tempat_lahir_ibu </th>
                 <th style="text-align: center;"> tanggal_lahir_ibu </th>
                 <th style="text-align: center;"> agama_ibu </th>
                 <th style="text-align: center;"> pendidikan_terakhir_ibu </th>
                 <th style="text-align: center;"> pekerjaan_ibu </th>
                 <th style="text-align: center;"> domisili_ibu_saat_ini </th>
                 <th style="text-align: center;"> nomor_hp_ibu </th>
                 <th style="text-align: center;"> tahsin_ibu </th>
                 <th style="text-align: center;"> tahfidz_ibu </th>
                 <th style="text-align: center;"> pendapatan_orangtua </th>
                 <th style="text-align: center;"> rencana_mutasi </th>
                 <th style="text-align: center;"> file_pdf_akte </th>
                 <th style="text-align: center;"> file_pdf_kk </th>
                 <th style="text-align: center;"> ktp_ayah </th>
                 <th style="text-align: center;"> ktp_ibu </th>
                 <th style="text-align: center;"> sertif_tahsin </th>
                 <th style="text-align: center;"> sertif_tahfidz </th>
                 <th style="text-align: center;"> nominal_infaq </th>
                 <th style="text-align: center;"> nominal_terbilang </th>
                 <th style="text-align: center;"> tanggal_formulir_dibuat </th>
              </tr>
            </thead>
            <tbody>

                <?php foreach ($ambildata_perhalaman as $data) : ?>
                    
                    <tr>
                        <td style="text-align: center;"> <?= $data['pendaftaran_kelas']; ?> </td>
                        <td style="text-align: center;"> <?= $data['nama_calon_siswa']; ?> </td>
                        <td style="text-align: center;"> <?= $data['panggilan_calon_siswa']; ?> </td>
                        <td style="text-align: center;"> <?= $data['nisn']; ?> </td>
                        <td style="text-align: center;"> <?= $data['asal_sekolah']; ?> </td>
                        <td style="text-align: center;"> <?= $data['jenis_kelamin']; ?> </td>
                        <td style="text-align: center;"> <?= $data['tempat_lahir']; ?> </td>
                        <td style="text-align: center;"> <?= $data['tanggal_lahir']; ?> </td>
                        <td style="text-align: center;"> <?= $data['anak_ke']; ?> </td>
                        <td style="text-align: center;"> <?= $data['dari_berapa_saudara']; ?> </td>
                        <td style="text-align: center;"> <?= $data['kk_atau_adik_di_aiis']; ?> </td>
                        <td style="text-align: center;"> <?= $data['tingkat_kelas_kk_atau_adik']; ?> </td>
                        <td style="text-align: center;"> <?= $data['nama_kk_atau_adik']; ?> </td>
                        <td style="text-align: center;"> <?= $data['alasan_diaiis']; ?> </td>
                        <td style="text-align: center;"> <?= $data['pendapat_orangtua']; ?> </td>
                        <td style="text-align: center;"> <?= $data['riwayat_penyakit']; ?> </td>
                        <td style="text-align: center;"> <?= $data['keterlambatan_perkembangan']; ?> </td>
                        <td style="text-align: center;"> <?= $data['pernah_menjalani_terapi']; ?> </td>
                        <td style="text-align: center;"> <?= $data['jenis_terapi']; ?> </td>
                        <td style="text-align: center;"> <?= $data['alasan_menjalani_terapi']; ?> </td>
                        <td style="text-align: center;"> <?= $data['durasi_terapi']; ?> </td>
                        <td style="text-align: center;"> <?= $data['waktu_mulai_dan_waktu_selesai_terapi']; ?> </td>
                        <td style="text-align: center;"> <?= $data['saat_ini_masih_menjalani_terapi']; ?> </td>
                        <td style="text-align: center;"> <?= $data['kemampuan_sosial']; ?> </td>
                        <td style="text-align: center;"> <?= $data['kemandirian_anak']; ?> </td>
                        <td style="text-align: center;"> <?= $data['kelebihan_anak']; ?> </td>
                        <td style="text-align: center;"> <?= $data['terbiasa_solat_lima_waktu']; ?> </td>
                        <td style="text-align: center;"> <?= $data['anak_terbiasa_menonton_tv_atau_gadget']; ?> </td>
                        <td style="text-align: center;"> <?= $data['berapa_lama_menonton_tv_atau_gadget_dalam_sehari']; ?> </td>
                        <td style="text-align: center;"> <?= $data['bacaan_tahsin']; ?> </td>
                        <td style="text-align: center;"> <?= $data['jumlah_juz_dihafal']; ?> </td>
                        <td style="text-align: center;"> <?= $data['juz_dihafal']; ?> </td>
                        <td style="text-align: center;"> <?= $data['hafalan_surat']; ?> </td>
                        <!-- <td style="text-align: center;"> <?= $data['dapat_berjalan_pada_usia']; ?> </td> -->
                        <!-- <td style="text-align: center;"> <?= $data['dapat_berbicara_bermakna_pada_usia']; ?> </td> -->
                        <td style="text-align: center;"> <?= $data['terlibat_mengasuh']; ?> </td>
                        <td style="text-align: center;"> <?= $data['peran_orangtua_membantu_anak_menghafal']; ?> </td>
                        <td style="text-align: center;"> <?= $data['nama_ayah']; ?> </td>
                        <td style="text-align: center;"> <?= $data['tempat_lahir_ayah']; ?> </td>
                        <td style="text-align: center;"> <?= $data['tanggal_lahir_ayah']; ?> </td>
                        <td style="text-align: center;"> <?= $data['agama_ayah']; ?> </td>
                        <td style="text-align: center;"> <?= $data['pendidikan_terakhir_ayah']; ?> </td>
                        <td style="text-align: center;"> <?= $data['pekerjaan_ayah']; ?> </td>
                        <td style="text-align: center;"> <?= $data['domisili_ayah_saat_ini']; ?> </td>
                        <td style="text-align: center;"> <?= $data['nomor_hp_ayah']; ?> </td>
                        <td style="text-align: center;"> <?= $data['tahsin_ayah']; ?> </td>
                        <td style="text-align: center;"> <?= $data['tahfidz_ayah']; ?> </td>
                        <td style="text-align: center;"> <?= $data['nama_ibu']; ?> </td>
                        <td style="text-align: center;"> <?= $data['tempat_lahir_ibu']; ?> </td>
                        <td style="text-align: center;"> <?= $data['tanggal_lahir_ibu']; ?> </td>
                        <td style="text-align: center;"> <?= $data['agama_ibu']; ?> </td>
                        <td style="text-align: center;"> <?= $data['pendidikan_terakhir_ibu']; ?> </td>
                        <td style="text-align: center;"> <?= $data['pekerjaan_ibu']; ?> </td>
                        <td style="text-align: center;"> <?= $data['domisili_ibu_saat_ini']; ?> </td>
                        <td style="text-align: center;"> <?= $data['nomor_hp_ibu']; ?> </td>
                        <td style="text-align: center;"> <?= $data['tahsin_ibu']; ?> </td>
                        <td style="text-align: center;"> <?= $data['tahfidz_ibu']; ?> </td>
                        <td style="text-align: center;"> <?= $data['pendapatan_orangtua']; ?> </td>
                        <td style="text-align: center;"> <?= $data['rencana_mutasi']; ?> </td>
                        <td style="text-align: center;"> <a href="<?= $base . 'upload/akte_kelahiran/' . $data['file_pdf_akte']; ?>"> <?= $base . 'upload/akte_kelahiran/' . $data['file_pdf_akte']; ?> </a> </td>
                        <td style="text-align: center;"> <a href="<?= $base . 'upload/kartu_keluarga/' . $data['file_pdf_kk']; ?>"> <?= $base . 'upload/kartu_keluarga/' . $data['file_pdf_kk']; ?> </a> </td>
                        <td style="text-align: center;"> <a href="<?= $base . 'upload/ktp_ayah/' . $data['ktp_ayah']; ?>"> <?= $base . 'upload/ktp_ayah/' . $data['ktp_ayah']; ?> </a> </td>
                        <td style="text-align: center;"> <a href="<?= $base . 'upload/ktp_ibu/' . $data['ktp_ibu']; ?>"> <?= $base . 'upload/ktp_ibu/' . $data['ktp_ibu']; ?> </a> </td>

                        <?php if ($data['sertif_tahsin'] != NULL): ?>
                            
                            <td style="text-align: center;"> <a href="<?= $base . 'upload/sertif_tahsin/' . $data['sertif_tahsin']; ?>"> <?= $base . 'upload/sertif_tahsin/' . $data['sertif_tahsin']; ?> </a> </td>

                        <?php else: ?>
                            
                            <td style="text-align: center;"> <strong> - </strong> </td>

                        <?php endif; ?>


                        <?php if($data['sertif_tahfidz'] != NULL): ?>

                            <td style="text-align: center;"> <a href="<?= $base . 'upload/sertif_tahfidz/' . $data['sertif_tahfidz']; ?>"> <?= $base . 'upload/sertif_tahfidz/' . $data['sertif_tahfidz']; ?> </a> </td>

                        <?php else: ?>

                            <td style="text-align: center;"> <strong> - </strong> </td>

                        <?php endif ?>

                        <td style="text-align: center;"> <?= $data['nominal_infaq']; ?> </td>
                        <td style="text-align: center;"> <?= $data['nominal_terbilang']; ?> </td>

                        <td style="text-align: center;"> <?= $data['tanggal_formulir_dibuat']; ?> </td>
                        
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</body>
</html>