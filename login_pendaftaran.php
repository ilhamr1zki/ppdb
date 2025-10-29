<?php 

	include("./header.php");

?>	

	<style type="text/css">
			
		#pagelogin {
			margin-left: 28%;
			margin-top: 50px;
		}

		@media (max-width: 992px) {

			#pagelogin {
				width: 310px;
				margin-left: 11%;
				margin-top: 30px;
			}

			#tahunajar {
				font-size: 17px;
			}

			legend {

				font-size: 25px;

			}

			#iconkalender {
				font-size: 30px;
			}

			#label_nama_calon_siswa,
			#label_asal_sekolah,
			#label_tempat_lahir_calon_siswa,
			#label_tanggal_lahir_calon_siswa,
			#label_namapanggilan_calon_siswa {
				font-size: 15px;
			}

			#nama_calon_siswa,
			#asal_sekolah,
			#tempat_lahir_calon_siswa,
			#tanggal_lahir_calon_siswa,
			#namapanggilan_calon_siswa {
				height: 35px;
				font-size: 15px;
			}

		}

		@media(max-width: 376px) {
			#pagelogin {
				margin-left: 13%;
				width: 270px;
			}
		}

	</style>

	<div class="container document">
    	<div class="row">
	    	<div id="pagelogin" class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
	    		<div class="panel panel-default">
					<form class="form form-horizontal validetta" method="post" action="">
						<!-- <div class="panel-heading"><h4 id="tahunajar" class="text-center">Tahun Ajaran Aktif : <strong><?php echo $ta_aktif; ?></strong></h4></div> -->
						<div class="panel-body">
							<input type="hidden" value="simpan_calon_siswa" name="aksi" id="aksi">

							<legend> <i class="glyphicon glyphicon-log-in"></i> &nbsp; <strong> LOGIN </strong> </legend>
							
							<div class="form-group">
								<label class="col-md-4 control-label" id="label_nama_calon_siswa" for="password_lg">
									PASSWORD :
								</label>
								<div class="col-md-8">
									<input type="password" required class="form-control" name="password_lg" id="password_lg">
								</div>
							</div>

						</div>
						<div class="panel-footer text-center">
							<button type="submit" name="lgpw" id="lgpw" class="btn btn-primary"> <i class="glyphicon glyphicon-log-in"> </i> LOGIN </button>
						</div>
					</form>
				</div>
	    	</div>
    	</div>
	</div>

<?php  
	
	include("./footer.php");

?>