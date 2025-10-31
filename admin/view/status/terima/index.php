<?php  

    $dataSiswaAcc   = mysqli_query($con, "SELECT * FROM data_pendaftaran_siswa_diterima");
    $countAcc  		= mysqli_num_rows($dataSiswaAcc);
    $no      		= 1;

    $timeIsOut 		= 0;
    

?>

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
        			<td> <button> EDIT </button> </td>
        		</tr>

        	<?php endforeach ?>

        </tbody>

      </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript"></script>

<script type="text/javascript">
	
	let newIcon = document.getElementById("addIcon");
    newIcon.classList.remove("fa");
    newIcon.classList.add("glyphicon");
    newIcon.classList.add("glyphicon-ok-sign");

	document.getElementById('isiMenu').innerHTML = `STATUS CALON SISWA DITERIMA`

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

    });

</script>