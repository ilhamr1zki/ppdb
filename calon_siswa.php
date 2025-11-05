<?php 

	include("./header_calonsiswa.php");

?>	

	<style type="text/css">
			
		#pagelogin {
			margin-left: 28%;
		}

		.utk_pernyataan {
			padding: 20px;
		}

		#pernyataan {
			text-indent: 22px;
	  		text-align: justify;
		}

		.outsidereview {
			display: flex;
			justify-content: center;
			gap: 20px;
		}

		.div_rencana_mutasi_review {
			margin-top: 10px;
		}

		legend {
			border-bottom: 1px solid blue;
		}

		@media (max-width: 992px) {

			#div_pernyataan {
				margin-top: 20px;
			}

			.tingkat_kelas_rev {
				margin-top: 10px;
			}

			.div_rencana_mutasi_review {
				margin-top: 0px;
			}

			.label_tanggal_lahir_calon_siswa_rev,
			.label_tanggal_lahir_ayah_rev,
			.label_tanggal_ibu_rev,
			.label_nama_adik_kakak_rev,
			.label_tgl_lahir_calon_siswa,
			#label_sklh_lain,
			#label_tingkatkls_adik_kakak,
			#label_tanggal_lahir_ayah,
			#label_tgl_lahir_ibu {
				margin-top: 10px;
			}

			#label_pernyataan {
				font-size: 10px;
			}

			#pagelogin {
				width: 310px;
				margin-left: 11%;
			}

			#pernyataan {
				text-indent: 20px;
		  		text-align: justify;
			}

			#labelpernyataan {
				font-size: 13px;
				letter-spacing: 1px;
			}

			#tahunajar {
				font-size: 17px;
			}

			legend {

				font-size: 25px;

			}

			.outsidereview {
				display: grid;
				justify-content: normal !important;
				gap: 20px;
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

	<?php if ($sesi == 1): ?>

		<div class="container document">
	    	<div class="row">
		    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		    		<div class="panel panel-default">
						<form class="form form-horizontal validetta" method="post" action="">
							<!-- <div class="panel-heading"><h4 id="tahunajar" class="text-center">Tahun Ajaran Aktif : <strong><?php echo $ta_aktif; ?></strong></h4></div> -->
							<div class="panel-body">
								<input type="hidden" value="simpan_calon_siswa" name="aksi" id="aksi">

								<legend> <i class="glyphicon glyphicon-user"></i> &nbsp; DATA CALON SISWA </legend>
								<div class="form-group">
									<label class="col-md-3 control-label"> PENDAFTARAN UNTUK KELAS : </label>
									<div class="col-md-2">
										<select class="form-control targetjenjangsekolah" name="jenjang_sekolah">
											<option value="kosongjenjangkelas"> -- PILIH -- </option>
											<?php foreach ($arrJenjangPilihanSd as $data): ?>
												
												<!-- <?php if ($data == "paud"): ?>

													<option value="<?= $data; ?>"> PAUD </option>

												<?php elseif($data == "sd"): ?>

													<option value="<?= $data; ?>"> SD </option>
													
												<?php endif ?> -->

												<option value="<?= $data; ?>"> <?= str_replace(["SD"], " SD", $data); ?> </option>

											<?php endforeach ?>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" id="label_nama_calon_siswa" for="nama_calon_siswa">
										NAMA LENGKAP :
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control" value="<?= $calonNamaSiswa; ?>" name="nama_calon_siswa" id="nama_calon_siswa">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_namapanggilan_calon_siswa" for="nama_panggilan_siswa">
										NAMA PANGGILAN :
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control" value="<?= $namaPanggilan; ?>" name="namapanggilan_calon_siswa" id="nama_panggilan_siswa">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label"> JENIS KELAMIN : </label>
									<div class="col-md-2">
										<select class="form-control target" name="jenis_kelamin">
											<option value="kosongjeniskelamin"> -- PILIH -- </option>
											<?php foreach ($arrJenisKelamin as $data): ?>

                                           		<option value="<?= $data; ?>" <?=($data == $jenisKelamin )?'selected="selected"':''?> > <?= $data; ?> </option>

                                        	<?php endforeach; ?>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" id="label_tempat_lahir_calon_siswa" for="tempat_lahir_calon_siswa">
										TEMPAT LAHIR<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-3">
										<input type="text" required class="form-control" value="<?= $tempatLahir; ?>" name="tempat_lahir_calon_siswa" id="tempat_lahir_calon_siswa">
									</div>
									<label class="col-md-2 control-label" id="label_tanggal_lahir_calon_siswa" for="tanggal_lahir_calon_siswa">
										TANGGAL LAHIR<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-3">
			                          <div class="controls input-append date form_date" data-date="2012-01-01" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
			                              <input class="form-control" value="<?= $tanggalLahirSiswa; ?>" id="tanggal_lahir_calon_siswa" type="text" name="tanglahir_anak" value="" required="">
			                              <span class="add-on"><i class="icon-th"></i></span>
			                          </div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_anak_ke" for="anak_ke">
										ANAK KE<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-2">
										<input required type="text" value="<?= $anak_ke; ?>" pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 1" name="anak_ke" id="anak_ke">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_daribrp_sdr" for="daribrp_saudara">
										DARI BERAPA SAUDARA<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-2">
										<input type="text" value="<?= $dari_berapa_sdr; ?>" required pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 2" name="daribrp_saudara" id="daribrp_saudara">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_riwayat_penyakit" for="rwyt_penyakit">
										RIWAYAT PENYAKIT ANAK, APAKAH ADA ALERGI ? :
									</label>
									<div class="col-md-5">
										<input type="text" value="<?= $riwayatPenyakit; ?>" class="form-control" placeholder="Ex : Penyakit Anemia (kosongkan jika tidak ada)" name="rwyt_penyakit" id="rwyt_penyakit">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_asal_sekolah" for="asal_sekolah">
										ASAL SEKOLAH SEBELUMNYA<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-2">
										<select class="form-control targetasalsekolaherr" name="asal_pilihan_sekolah">
											<option value="kosong_asalsekolah"> -- PILIH -- </option>
											<?php foreach ($arrAsalSekolah as $data): ?>

												<?php if ($data == "sdmi"): ?>
													<option value="<?= $data; ?>" <?=($data == $asalPilihanSekolah )?'selected="selected"':''?> > SD/MI </option>
												<?php endif ?>

											<?php endforeach ?>
										</select>
									</div>
									<div class="nmsklhasalerror">

										<label class="col-md-3 control-label" id="label_asal_sekolah" for="asal_sekolah">
											NAMA SEKOLAH<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3">
											<input required type="text" value="<?= $asalSekolah; ?>" class="form-control" name="asal_sekolahx" id="asal_sekolah_err">
										</div>
										
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_bacaan_tahsin" for="bacaan_tahsin">
										TAHSIN / BACA AL-QUR'AN<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-2">
										<select class="form-control pilihantahsinerr" required name="bacaan_tahsin">
											<option value="kosong_tahsin"> -- PILIH -- </option>
											<?php foreach ($arrIsiTahsin as $data): ?>

												<?php if ($data == "SANGAT_BAIK"): ?>
													<?php if ($data == $tahsinQuran): ?>
														<option value="<?= $data; ?>" <?=($data == $tahsinQuran )?'selected="selected"':''?> > SANGAT BAIK </option>
													<?php else: ?>
														<option value="<?= $data; ?>"> SANGAT BAIK </option>
													<?php endif ?>
												<?php else: ?>
													<?php if ($data == $tahsinQuran): ?>
														<option value="<?= $data; ?>" <?=($data == $tahsinQuran )?'selected="selected"':''?> > <?= $data; ?> </option>
													<?php else: ?>
														<option value="<?= $data; ?>"> <?= $data; ?> </option>
													<?php endif ?>
												<?php endif ?>

											<?php endforeach ?>
										</select>
									</div>
								</div>

								<?php if ($pilihanTahfidz == "belumtahfidz"): ?>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_tahfidz" for="pilihan_tahfidz">
											TAHFIDZ/HAFALAN AL-QUR'AN<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<select required class="form-control target_tahfidz_err" name="pilihan_tahfidz">
												<option value="kosong_tahfidz"> -- PILIH -- </option>
												<option value="belumtahfidz" selected> BELUM </option>
												<option value="sudahtahfidz"> SUDAH </option>
											</select>
										</div>
									</div>

									<div class="form-group isianjuzerror">
										<label class="col-md-3 control-label" id="label_tahfidz" for="errisijuzberapa">
											JUZ BERAPA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input type="text" pattern="[0-9]*" required inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 30" name="isi_juz" id="errisijuzberapa">
										</div>
									</div>

									<div class="form-group isiansuraherror">
										<label class="col-md-3 control-label" id="label_tahfidz" for="err_isian_surat">
											SURAT<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-5">
											<input type="text" required class="form-control" placeholder="Ex : Surat An-Naba" name="isi_surat" id="err_isian_surat">
										</div>
									</div>

								<?php elseif($pilihanTahfidz == "sudahtahfidz"): ?>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_tahfidz" for="pilihan_tahfidz">
											TAHFIDZ/HAFALAN AL-QUR'AN<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<select required class="form-control target_tahfidz_err" name="pilihan_tahfidz">
												<option value="kosong_tahfidz"> -- PILIH -- </option>
												<option value="belumtahfidz"> BELUM </option>
												<option value="sudahtahfidz" selected> SUDAH </option>
											</select>
										</div>
									</div>

									<div class="form-group isianjuzerror">
										<label class="col-md-3 control-label" id="label_tahfidz" for="errisijuzberapa">
											JUZ BERAPA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input type="text" value="<?= $isiJuzSkr; ?>" pattern="[0-9]*" required inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 30" name="isi_juz" id="errisijuzberapa">
										</div>
									</div>

									<div class="form-group isiansuraherror">
										<label class="col-md-3 control-label" id="label_tahfidz" for="err_isian_surat">
											SURAT<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-5">
											<input type="text" value="<?= $isiSuratSkr; ?>" required class="form-control" placeholder="Ex : Surat An-Naba" name="isi_surat" id="err_isian_surat">
										</div>
									</div>
								
								<?php endif ?>

								<br>

								<legend> <i class="glyphicon glyphicon-user"></i> &nbsp; DATA ORANG TUA </legend>

								<div class="form-group">
									<label class="col-md-3 control-label" for="nama_ayah_wali">
										NAMA AYAH / WALI<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-8">
										<input type="text" required class="form-control" name="nama_ayah_wali" id="nama_ayah_wali">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="temlahir_ayah">
										TEMPAT LAHIR<sup style="color: red;">*</sup> : 
									</label>
									<div class="col-md-3">
										<input type="text" required class="form-control" name="temlahir_ayah" id="temlahir_ayah">
									</div>
									<label class="col-md-2 control-label" id="label_tanggal_lahir_ayah" for="tanggal_lahir_ayah">
										TANGGAL LAHIR<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-3">
			                          <div class="controls input-append date form_date" data-date="1985-01-01" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
			                              <input class="form-control" id="tanggal_lahir_ayah" type="text" name="tanglahir_ayah" value="" required="">
			                              <span class="add-on"><i class="icon-th"></i></span>
			                          </div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_agama" for="agama_ayah">
										AGAMA<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-2">
										<select required class="form-control pilih_agama" name="agama_ayah" id="agama_ayah">
											<option value="kosong_agamaayah"> -- PILIH -- </option>
											<option value="ISLAM"> ISLAM </option>
											<option value="LAINNYA"> LAINNYA </option>
										</select>
									</div>
									<div class="agamalainayah">

										<div class="col-md-3">
											<input type="text" class="form-control" name="agamalainayah" id="agamalainayah">
										</div>
										
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_pend_ayah" for="pend_ayah">
										PENDIDIKAN TERAKHIR<sup style="color: red;">*</sup> : 
									</label>
									<div class="col-md-2">
										<select required class="form-control pilih_pendayah" name="pend_ayah" id="pend_ayah">
											<option value="kosong_pendayah"> -- PILIH -- </option>
											<?php foreach ($arrIsiPddAyah as $data): ?>
												<option value="<?= $data; ?>"> <?= $data; ?> </option>
											<?php endforeach ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="pekerjaan_ayah">
										PEKERJAAN<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-3">
										<select required class="form-control pilih_pekerjaan_ayah" name="pekerjaan_ayah" id="pekerjaan_ayah">
											<option value="kosong_pekerjaan_ayah"> -- PILIH -- </option>
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
									</div>
									<div class="pekerjaanlainayah">

										<div class="col-md-3">
											<input type="text" class="form-control" name="pekerjaanlainayah" id="pekerjaanlainayah">
										</div>
										
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="alamat_ayah">
										ALAMAT RUMAH<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-8">
										<textarea required class="form-control" name="alamat_ayah" id="alamat_ayah" style="resize:vertical; max-height:150px;"></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="nomorhpayah">
										NOMOR HANDPHONE<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-6">
										<input required type="text" pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" name="nomorhpayah" id="nomorhpayah" placeholder="Ex : 08xx">
									</div>
								</div>

								<hr>

								<div class="form-group">
									<label class="col-md-3 control-label" for="nama_ibu">
										NAMA IBU<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-8">
										<input type="text" required class="form-control" name="nama_ibu" id="nama_ibu">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="temlahir_ibu">
										TEMPAT LAHIR<sup style="color: red;">*</sup> : 
									</label>
									<div class="col-md-3">
										<input type="text" required class="form-control" name="temlahir_ibu" id="temlahir_ibu">
									</div>
									<label class="col-md-2 control-label" id="label_tanggal_lahir_ibu" for="tanggal_lahir_ibu">
										TANGGAL LAHIR<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-3">
			                          <div class="controls input-append date form_date" data-date="1985-01-01" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
			                              <input class="form-control" id="tanggal_lahir_ibu" type="text" name="tanglahir_ibu" value="" required="">
			                              <span class="add-on"><i class="icon-th"></i></span>
			                          </div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_agama_ibu" for="agama_ibu">
										AGAMA<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-2">
										<select required class="form-control pilih_agama_ibu" name="agama_ibu" id="agama_ibu">
											<option value="kosong_agamaibu"> -- PILIH -- </option>
											<option value="ISLAM"> ISLAM </option>
											<option value="LAINNYA"> LAINNYA </option>
										</select>
									</div>
									<div class="agamalainibu">

										<div class="col-md-3">
											<input type="text" class="form-control" name="agamalainibu" id="agamalainibu">
										</div>
										
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" id="label_pend_ibu" for="pend_ibu">
										PENDIDIKAN TERAKHIR<sup style="color: red;">*</sup> : 
									</label>
									<div class="col-md-2">
										<select required class="form-control pilih_pendibu" name="pend_ibu" id="pend_ibu">
											<option value="kosong_pendibu"> -- PILIH -- </option>
											<?php foreach ($arrIsiPddAyah as $data): ?>
												<option value="<?= $data; ?>"> <?= $data; ?> </option>
											<?php endforeach ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="pekerjaan_ibu">
										PEKERJAAN<sup style="color: red;">*</sup>:
									</label>
									<div class="col-md-3">
										<select required class="form-control pilih_pekerjaan_ibu" name="pekerjaan_ibu" id="pekerjaan_ibu">
											<option value="kosong_pekerjaan_ibu"> -- PILIH -- </option>
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
									</div>
									<div class="pekerjaanlainibu">

										<div class="col-md-3">
											<input type="text" class="form-control" name="pekerjaanlainibu" id="pekerjaanlainibu">
										</div>
										
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="alamat_ibu">
										ALAMAT RUMAH<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-8">
										<textarea required class="form-control" name="alamat_ibu" id="alamat_ibu" style="resize:vertical; max-height:150px;"></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="nomorhpibu">
										NOMOR HANDPHONE<sup style="color: red;">*</sup> :
									</label>
									<div class="col-md-6">
										<input required type="text" pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" name="nomorhpibu" id="nomorhpibu" placeholder="Ex : 08xx">
									</div>
								</div>

								<div class="form-group">
									
									<label class="col-md-3 control-label"> PENGHASILAN ORANG TUA / WALI CALON MURID PER BULAN<sup style="color: red;">*</sup> : </label>
									<br>
									<div class="col-md-6">
										<div class="form-check">
										  <input class="form-check-input" type="radio" name="pendapatan_ortu" value="pen1" id="flexRadioDefault1">
										  <label class="form-check-label" for="flexRadioDefault1">
										    1 - 5 JUTA RUPIAH
										  </label>
										</div>
										<div class="form-check">
										  <input class="form-check-input" type="radio" name="pendapatan_ortu" value="pen2" id="flexRadioDefault2">
										  <label class="form-check-label" for="flexRadioDefault2">
										    6 - 10 JUTA RUPIAH
										  </label>
										</div>
										<div class="form-check">
										  <input class="form-check-input" type="radio" name="pendapatan_ortu" value="pen3" id="flexRadioDefault3">
										  <label class="form-check-label" for="flexRadioDefault3">
										    11 - 15 JUTA RUPIAH
										  </label>
										</div>
										<div class="form-check">
										  <input class="form-check-input" type="radio" name="pendapatan_ortu" value="pen4" id="flexRadioDefault14">
										  <label class="form-check-label" for="flexRadioDefault14">
										    DI ATAS 15 JUTA RUPIAH
										  </label>
										</div>
									</div>
								</div>

								<hr>

								<br><br>

								<label id="labelpernyataan"> PERNYATAAN ORANG TUA / WALI CALON MURID </label>

								<div class="utk_pernyataan">
									<p id="pernyataan">  
									Setelah membaca dan meneliti dengan seksama semua ketentuan dan pesyaratan penerimaan murid baru Akhyar International Islamic School, dengan ini menyatakan bahwa Saya bersedia mengikuti syarat dan ketentuan penerimaan yang berlaku, serta menyatakan sanggup untuk melaksanakan hal-hal sebagai berikut :

									<ol>
									  <li>Orang Tua/Wali Calon Murid wajib menyelesaikan Biaya Registrasi sebelum mengisi formulir (Biaya Pendaftaran).</li>
									  <li>Orang Tua/Wali Calon Murid wajib menyelesaikan Biaya Masuk (Uang Pangkal) sebesar minimal 50%, 15 hari setelah murid dinyatakan diterima, dilanjutkan sisa nya pada waktu yang telah ditentukan. Jika tidak maka murid dianggap mengundurkan diri.</li>
									  <li>Orang Tua Calon murid Siap Menerima keputusan dari Panitia penerimaan murid baru tanpa syarat apapun.</li>
									  <li> Orang Tua/Wali Calon Murid menyetujui tanpa syarat bahwa semua biaya yang telah di bayarkan tidak dapat dikembalikan atau dipindahkan ke calon murid lain, atau diundur ke tahun berikutnya dalam kondisi atau alasan apapun. </li>
									</ol>

								</p>

								</div>

								<br>

							</div>

							<div class="panel-footer text-center">
								<button type="submit" name="proses" id="proses" class="btn btn-success"> <i class="glyphicon glyphicon-floppy-disk"></i> Simpan Pendaftaran </button>
							</div>

						</form>
					</div>
		    	</div>
	    	</div>
		</div>

	<?php elseif($sesi == 3): ?>
		<!-- Bagian Crosscheck Data -->
		<div class="container document" id="crosscheck_data">
	    	<div class="row">
		    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		    		<div class="panel panel-default">
						<form class="form form-horizontal validetta" method="post" action="">
							<input type="hidden" name="token" value="<?= $_SESSION['form_token'] ?>">
							<!-- <div class="panel-heading"><h4 id="tahunajar" class="text-center">Tahun Ajaran Aktif : <strong><?php echo $ta_aktif; ?></strong></h4></div> -->
							<div class="panel-body">
								<!-- <input type="hidden" value="simpan_calon_siswa" name="aksi" id="aksi"> -->

								<!-- Data Calon Siswa Review -->
									<legend> <i class="glyphicon glyphicon-user"></i> &nbsp; DATA CALON SISWA </legend>
									<div class="form-group">
										<label class="col-md-3 control-label"> PENDAFTARAN UNTUK KELAS : </label>
										<div class="col-md-2">
											<input type="text" class="form-control" readonly name="jenjang_sekolah_reviewx" value="1 SD">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_nama_calon_siswa" for="nisn_calon_siswa">
											NISN (Jika Ada) :
										</label>
										<div class="col-md-2">
											<input type="text" class="form-control" readonly name="nisn_calon_siswa_rev" value="<?= $nisnCalonSiswa; ?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											ASAL SEKOLAH :
										</label>
										<div class="col-md-2">
											<?php if ($asalSekolah == "kosong"): ?>
												<input type="hidden" name="asal_sekolah_review" value="-">
												<input type="text" readonly class="form-control" value="">
											<?php else: ?>
												<input type="text" readonly class="form-control" name="asal_sekolah_review" value="<?= $asalSekolah; ?>">
											<?php endif ?>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-3 control-label" id="label_nama_calon_siswa" for="nama_calon_siswa">
											NAMA LENGKAP<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<input readonly type="text" class="form-control" name="nama_calon_siswa_review" value="<?= $calonNamaSiswa; ?>" id="nama_calon_siswa">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_namapanggilan_calon_siswa" for="nama_panggilan_siswa">
											NAMA PANGGILAN<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<input readonly type="text" name="namapanggilan_calon_siswa_review" class="form-control" value="<?= $namaPanggilan; ?>" id="nama_panggilan_siswa">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label"> JENIS KELAMIN<sup style="color: red;">*</sup> : </label>
										<div class="col-md-2">
											<input type="text" class="form-control" name="jenis_kelamin_review" readonly value="<?= $jenisKelamin; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-3 control-label" id="label_tempat_lahir_calon_siswa" for="tempat_lahir_calon_siswa">
											TEMPAT LAHIR<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3">
											<input type="text" readonly name="tempat_lahir_calon_siswa_review" required class="form-control" value="<?= $tempatLahir; ?>" id="tempat_lahir_calon_siswa">
										</div>
										<label class="col-md-2 control-label label_tanggal_lahir_calon_siswa_rev" id="label_tanggal_lahir_calon_siswa" for="tanggal_lahir_calon_siswa">
											TANGGAL LAHIR<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3">
											<input type="hidden" name="tanglahir_anak_review" value="<?= $tanggalLahirSiswa; ?>">
				                          	<div class="controls input-append date form_date" data-date="2012-01-01" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
				                              	<input readonly disabled class="form-control" value="<?= $tanggalLahirSiswa1; ?>" id="tanggal_lahir_calon_siswa" type="text" value="" required="">
				                              	<span class="add-on"><i class="icon-th"></i></span>
				                          	</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_anak_ke" for="anak_ke">
											ANAK KE<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input readonly type="text" value="<?= $anak_ke; ?>" pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 1" name="anak_ke_review" id="anak_ke">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_daribrp_sdr" for="daribrp_saudara">
											DARI BERAPA SAUDARA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input type="text" value="<?= $dari_berapa_sdr; ?>" readonly pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 2" name="daribrp_saudara_review" id="daribrp_saudara">
										</div>
									</div>
								<!-- Akhir Data Calon Siswa Review -->

								<br>

								<!-- Data Tambahan Siswa Review -->

									<legend> <i class="glyphicon glyphicon-file"></i> &nbsp; DATA TAMBAHAN </legend>
									<div class="form-group">
										<label class="col-md-3 control-label" id="label_riwayat_penyakit" for="rwyt_penyakit">
											APAKAH ADA ADIK/KAKAK KANDUNG YANG SUDAH BERSEKOLAH DI AIIS<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2 add10px">
											<input type="text" class="form-control" readonly name="ada_adik_kakak_rev" value="<?= $adaAdikAtauKakakDiAiis; ?>">
										</div>

										<?php if ($adaAdikAtauKakakDiAiis == "ADA"): ?>
											
											<label class="col-md-2 control-label tingkat_kelas_rev" for="pilih_tingkat">
												TINGKAT KELAS ADIK/KAKAK TERSEBUT<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-2 add10px">
												<?php if ($tingkatKelasAdikAtauKakak == "KB"): ?>
													
													<input type="hidden" name="tingkat_kelas_adik_kakak_rev" value="<?= $tingkatKelasAdikAtauKakak; ?>">
													<input type="text" class="form-control" readonly value="PG/KB">

												<?php else: ?>

													<input type="hidden" name="tingkat_kelas_adik_kakak_rev" value="<?= $tingkatKelasAdikAtauKakak; ?>">
													<input type="text" class="form-control" readonly value="<?= str_replace(["SD"], " SD", $tingkatKelasAdikAtauKakak); ?>">

													
												<?php endif ?>
											</div>

											<div class="col-md-3 label_nama_adik_kakak_rev add10px">
												<input type="text" readonly class="form-control" name="nama_adik_kakak_rev" value="<?= $namaAdikAtauKK; ?>">
											</div>
											
										<?php endif ?>

									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_riwayat_penyakit" for="rwyt_penyakit">
											RIWAYAT PENYAKIT ANAK, APAKAH ADA ALERGI ? :
										</label>
										<div class="col-md-4 add8px">
											<input type="text" name="rwyt_penyakit_review" readonly value="<?= $riwayatPenyakit1; ?>" class="form-control" placeholder="Ex : Penyakit Anemia (kosongkan jika tidak ada)">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_bacaan_tahsin" for="bacaan_tahsin">
											TAHSIN / BACA AL-QUR'AN<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input readonly type="text" class="form-control" value="<?= str_replace(["_"], " ", $tahsinQuran); ?>" name="tahsin_rev">
										</div>
									</div>

									<?php if ($tahfidzQuran == "belumtahfidz"): ?>

										<div class="form-group">
											<label class="col-md-3 control-label" id="label_tahfidz" for="pilihan_tahfidz">
												TAHFIDZ/HAFALAN AL-QUR'AN<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-2">
												<input type="text" class="form-control" readonly name="pilihan_tahfidz_review" value="BELUM">
												<input type="hidden" name="berapajuzhafal_review" value="BELUM ADA">
												<input type="hidden" name="isi_juz_review" value="BELUM ADA">
												<input type="hidden" name="isi_surat_review" value="BELUM ADA">
											</div>
										</div>

									<?php elseif($tahfidzQuran == "sudahtahfidz"): ?>

										<div class="form-group">
											<label class="col-md-3 control-label" id="label_tahfidz" for="pilihan_tahfidz">
												TAHFIDZ/HAFALAN AL-QUR'AN<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-2">
												<input type="text" class="form-control" readonly name="pilihan_tahfidz_review" value="SUDAH">
											</div>
										</div>

										<div class="form-group isianberapajuzrev">
											<label class="col-md-3 control-label" id="label_berapajuz" for="isiberapajuz">
												BERAPA JUZ<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-2">
												<input type="text" pattern="[0-9]*" readonly inputmode="numeric" value="<?= $jumlahJuzDihafal; ?>" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 30" name="berapajuzhafal_review" id="isiberapajuz">
											</div>
										</div>

										<div class="form-group isianjuzerror">
											<label class="col-md-3 control-label" id="label_tahfidz" for="errisijuzberapa">
												JUZ BERAPA SAJA<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-5">
												<input type="text" value="<?= $juzBerapaSaja; ?>" pattern="[0-9]*" readonly inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 30" name="isi_juz_review" id="errisijuzberapa">
											</div>
										</div>

										<div class="form-group isiansuraherror">
											<label class="col-md-3 control-label" id="label_tahfidz" for="err_isian_surat">
												SURAT TERAKHIR<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-5">
												<input type="hidden" name="isi_surat_review" value="<?= $isiSuratSkr; ?>">
												<input type="text" value="<?= $suratTerakhir1; ?>" readonly class="form-control" id="err_isian_surat">
											</div>
										</div>
									
									<?php endif ?>

									<br>
									<hr>

									<center style="font-weight: bold; font-size: 20px;"> RIWAYAT PERKEMBANGAN </center>

									<br>

									<div class="form-group">
										<label class="col-md-3 control-label" for="usia_anak_dapat_berjalan">
											ANANDA DAPAT BERJALAN PADA USIA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2 add8px">
											<input type="text" readonly class="form-control" value="<?= $dapatBerjalan; ?>" name="usia_anak_dapat_berjalan_rev">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="dapat_bicara">
											ANANDA DAPAT BERBICARA BERMAKNA MIN. 2 KATA PADA USIA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2 anak_dapat_bicara_rev add10px">
											<input type="text" readonly class="form-control" value="<?= $dapatBerbicara; ?>" name="anak_dapat_bicara_rev">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											APAKAH ANANDA PERNAH MENJALANI TERAPI<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-4 add10px">
											<?php if ($pernahTerapi == "PERNAH"): ?>
												<input type="hidden" name="pernah_terapi_rev" value="PERNAH">
												<input type="text" readonly disabled class="form-control" value="IYA, PERNAH MENJALANI TERAPI">
											<?php else: ?>
												<input type="hidden" name="pernah_terapi_rev" value="BELUM PERNAH">
												<input type="text" readonly class="form-control" value="BELUM PERNAH MENJALANI TERAPI">
											<?php endif ?>
										</div>
									</div>
									
									<?php if ($pernahTerapi == "PERNAH"): ?>

										<div class="form-group">
											<label class="col-md-3 control-label" for="jenis_terapi">
												JENIS TERAPI APA<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-3">
												<input type="text" readonly class="form-control" name="jenis_terapi_rev" value="<?= $jenisTerapi; ?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label" for="alasan_terapi">
												ALASAN MENJALANI TERAPI TERSEBUT<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-8">
												<input type="text" readonly class="form-control" name="alasan_terapi_rev" value="<?= $alasanTerapi; ?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label" for="durasi_terapi">
												DURASI TERAPI TERSEBUT<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-3">
												<input type="text" readonly class="form-control" name="durasi_terapi_rev" value="<?= $durasiTerapi; ?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label" for="waktu_mulai_akhir_terapi">
												WAKTU MULAI DAN WAKTU SELESAI TERAPI<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-3">
												<input type="text" class="form-control" readonly name="waktu_mulai_akhir_terapi_rev" value="<?= $mulaiSelesaiTrp; ?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label">
												APAKAH SAAT INI MASIH MENJALANI TERAPI<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-2">
												<input type="text" readonly name="masih_atau_tidak_terapi_rev" value="<?= $masihTerapi; ?>" class="form-control">
											</div>
										</div>
									
									<?php endif; ?>	

									<div class="form-group">
										<label class="col-md-3 control-label" for="keterlambatan_perkembangan">
											<?= strtoupper('apakah ananda memiliki keterlambatan perkembangan atau masalah tumbuh kembang'); ?><sup style="color: red;">*</sup>
										</label>
										<div class="col-md-5 add10px" style="margin-top: 10px;">
											<input type="text" readonly class="form-control" name="keterlambatan_perkembangan_rev" value="<?= $terlambatBerkembang; ?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											<?= strtoupper('Apakah ananda sudah terbiasa sholat 5 waktu'); ?><sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3" style="margin-top: 10px;">
											<?php if ($trSolat == "terbiasa"): ?>
												<input type="text" readonly name="solat_option_rev" class="form-control" value="SUDAH TERBIASA">
											<?php elseif($trSolat == "belum"): ?>
												<input type="text" readonly name="solat_option_rev" class="form-control" value="BELUM TERBIASA">
											<?php endif ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											<?= strtoupper("TAHSIN / BACA AL-QUR'AN AYAH BUNDA"); ?><sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2" style="margin-top: 10px;">
											<input type="text" readonly class="form-control" name="ayah_bunda_bacaquran_rev" value="<?= $tahsinOrtu; ?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											<?= strtoupper("TAHFIDZ / HAFALAN AL-QUR'AN AYAH BUNDA"); ?><sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2" style="margin-top: 10px;">
											<input type="text" readonly name="hafalan_ortu_rev" class="form-control" value="<?= $tahfidzOrtu; ?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="peran_ortu">
											<?= strtoupper("Bagaimana peran ayah bunda dalam membantu perkembangan hafalan Al-Qur'an Ananda"); ?><sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8" style="margin-top: 10px;">
											<input type="text" readonly class="form-control" name="peran_ortu_rev" value="<?= $peranOrtu; ?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											<?= strtoupper('Apakah anak terbiasa menonton TV atau menggunakan gadget'); ?><sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2" style="margin-top: 10px;">
											<input type="text" readonly class="form-control" name="terbiasa_gadget_rev" value="<?= $terbiasaGadget; ?>">
										</div>
									</div>

									<?php if ($terbiasaGadget == "IYA"): ?>
										
										<div class="form-group">
											<label class="col-md-3 control-label" for="waktu_bermain_gadget">
												<?= strtoupper('berapa jam dalam sehari menonton TV ataupun menggunakan gadget'); ?><sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-3" style="margin-top: 10px;">
												<input type="text" readonly class="form-control" name="waktu_bermain_gadget_rev" value="<?= $waktuBermainGadget; ?>">
											</div>
										</div>

									<?php endif ?>

								<!-- Akhir Data Tambahan Siswa Review -->

								<br>

								<!-- Data Orang Tua Review -->

									<legend> <i class="glyphicon glyphicon-user"></i> &nbsp; DATA ORANG TUA </legend>

									<div class="form-group">
										<label class="col-md-3 control-label" for="nama_ayah_wali">
											NAMA AYAH / WALI<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<input type="text" name="nama_ayah_wali_review" readonly value="<?= $namaAyah1; ?>" class="form-control" id="nama_ayah_wali">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="temlahir_ayah">
											TEMPAT LAHIR<sup style="color: red;">*</sup> : 
										</label>
										<div class="col-md-3">
											<input type="text" name="temlahir_ayah_review" readonly class="form-control" value="<?= $tempatLahirAyah; ?>" id="temlahir_ayah">
										</div>

										<label class="col-md-2 control-label label_tanggal_lahir_ayah_rev" id="label_tanggal_lahir_ayah" for="tanggal_lahir_ayah">
											TANGGAL LAHIR<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3">
											<input type="hidden" name="tanglahir_ayah_review" value="<?= $tanggalLahirAyah; ?>">
				                          	<div class="controls input-append date form_date" data-date="1985-01-01" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
				                              	<input class="form-control" id="tanggal_lahir_ayah" type="text" value="<?= $tanggalLahirAyah1; ?>" disabled readonly>
				                              	<span class="add-on"><i class="icon-th"></i></span>
				                          	</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_agama" for="agama_ayah">
											AGAMA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input type="text" readonly value="<?= $agamaAyah; ?>" class="form-control" name="agama_ayah_review">
										</div>			
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_pend_ayah" for="pend_ayah">
											PENDIDIKAN TERAKHIR<sup style="color: red;">*</sup> : 
										</label>
										<div class="col-md-2">
											<input type="text" class="form-control" readonly value="<?= $pendTerakhirAyah; ?>" name="pend_ayah_review">
										</div>
									</div>

									<?php if ($pekerjaanAyah != "LAINNYA"): ?>
									
										<div class="form-group">
											<label class="col-md-3 control-label" for="pekerjaan_ayah">
												PEKERJAAN<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-3">
												<?php if ($pekerjaanAyah == "pegawai_pns"): ?>
													<input type="text" readonly class="form-control" value="<?= str_replace(["pegawai_pns"], "PEGAWAI PNS", $pekerjaanAyah); ?>" name="pekerjaan_ayah_review">
												<?php elseif($pekerjaanAyah == "pegawai_bumn"): ?>
													<input type="text" readonly class="form-control" value="<?= str_replace(["pegawai_bumn"], "PEGAWAI BUMN / BUMD", $pekerjaanAyah); ?>" name="pekerjaan_ayah_review">
												<?php elseif($pekerjaanAyah == "karyawan_swasta"): ?>
													<input type="text" readonly class="form-control" value="<?= str_replace(["karyawan_swasta"], "KARYAWAN SWASTA", $pekerjaanAyah); ?>" name="pekerjaan_ayah_review">
												<?php else: ?>
													<input type="text" readonly class="form-control" value="<?= $pekerjaanAyah; ?>" name="pekerjaan_ayah_review">
												<?php endif ?>
											</div>
										</div>

									<?php elseif($pekerjaanAyah == "LAINNYA"): ?>

										<div class="form-group">
											<label class="col-md-3 control-label" for="pekerjaan_ayah">
												PEKERJAAN<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-3">
												<input type="text" class="form-control" readonly name="pekerjaan_ayah_review" value="<?= $pekerjaanLainAyah; ?>">
											</div>
										</div>

									<?php endif ?>

									<div class="form-group">
										<label class="col-md-3 control-label" for="alamat_ayah">
											DOMISILI SAAT INI<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<textarea readonly name="alamat_ayah_review" class="form-control" id="alamat_ayah" style="resize:vertical; max-height:150px;"> <?= $alamatAyah1; ?> </textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="nomorhpayah">
											NOMOR HANDPHONE<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input readonly type="text" pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" name="nomorhpayah_review" id="nomorhpayah" value="<?= $nomorHpAyah; ?>" >
										</div>
									</div>

									<hr>

									<div class="form-group">
										<label class="col-md-3 control-label" for="nama_ibu">
											NAMA IBU<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<input type="text" name="nama_ibu_review" readonly value="<?= $namaIbu1; ?>" class="form-control" id="nama_ibu">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="temlahir_ibu">
											TEMPAT LAHIR<sup style="color: red;">*</sup> : 
										</label>
										<div class="col-md-3">
											<input type="text" name="temlahir_ibu_review" readonly value="<?= $tempatLahirIbu; ?>" class="form-control" id="temlahir_ibu">
										</div>
										<label class="col-md-2 control-label label_tanggal_ibu_rev" id="label_tanggal_lahir_ibu" for="tanggal_lahir_ibu">
											TANGGAL LAHIR<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3">
											<input type="hidden" name="tanglahir_ibu_review" value="<?= $tanggalLahirIbu; ?>">
				                          	<div class="controls input-append date form_date" data-date="1985-01-01" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
				                              	<input class="form-control" disabled id="tanggal_lahir_ibu" type="text" readonly value="<?= $tanggalLahirIbu1; ?>">
				                              	<span class="add-on"><i class="icon-th"></i></span>
				                          	</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_agama_ibu" for="agama_ibu">
											AGAMA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input type="text" readonly value="<?= $agamaIbu; ?>" class="form-control" name="agama_ibu_review">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_pend_ibu" for="pend_ibu">
											PENDIDIKAN TERAKHIR<sup style="color: red;">*</sup> : 
										</label>
										<div class="col-md-2">
											<input type="text" class="form-control" readonly value="<?= $pendTerakhirIbu; ?>" name="pend_ibu_review">
										</div>
									</div>

									<?php if ($pekerjaanIbu != "LAINNYA"): ?>
								
										<div class="form-group">
											<label class="col-md-3 control-label" for="pekerjaan_ayah">
												PEKERJAAN<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-3">
												<?php if ($pekerjaanIbu == "pegawai_pns"): ?>
													<input type="text" readonly class="form-control" value="<?= str_replace(["pegawai_pns"], "PEGAWAI PNS", $pekerjaanIbu); ?>" name="pekerjaan_ibu_review">
												<?php elseif($pekerjaanIbu == "pegawai_bumn"): ?>
													<input type="text" readonly class="form-control" value="<?= str_replace(["pegawai_bumn"], "PEGAWAI BUMN / BUMD", $pekerjaanIbu); ?>" name="pekerjaan_ibu_review">
												<?php elseif($pekerjaanIbu == "karyawan_swasta"): ?>
													<input type="text" readonly class="form-control" value="<?= str_replace(["karyawan_swasta"], "KARYAWAN SWASTA", $pekerjaanIbu); ?>" name="pekerjaan_ibu_review">
												<?php else: ?>
													<input type="text" readonly class="form-control" value="<?= $pekerjaanIbu; ?>" name="pekerjaan_ibu_review">
												<?php endif ?>
											</div>
										</div>

									<?php elseif($pekerjaanIbu == "LAINNYA"): ?>
									
										<div class="form-group">
											<label class="col-md-3 control-label" for="pekerjaan_ayah">
												PEKERJAAN<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-3">
												<input type="text" class="form-control" readonly value="<?= $pekerjaanLainIbu; ?>" name="pekerjaan_ibu_review">
											</div>
										</div>

									<?php endif ?>

									<div class="form-group">
										<label class="col-md-3 control-label" for="alamat_ibu">
											DOMISILI SAAT INI<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<textarea readonly name="alamat_ibu_review" class="form-control" id="alamat_ibu" style="resize:vertical; max-height:150px;"> <?= $alamatIbu1; ?> </textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="nomorhpibu">
											NOMOR HANDPHONE<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input readonly type="text" pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" name="nomorhpibu_review" id="nomorhpibu" value="<?= $nomorHpIbu; ?>">
										</div>
									</div>

									<div class="form-group">
										
										<label class="col-md-3 control-label"> PENGHASILAN ORANG TUA / WALI CALON MURID PER BULAN<sup style="color: red;">*</sup> : </label>
										<br>
										<div class="col-md-6" id="pendapatan_ortu_review">
											<input type="text" readonly class="form-control" value="<?= $pendapatanOrtu; ?>" name="pendapatan_ortu_review">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="nomorhpibu">
											APAKAH ADA RENCANA UNTUK MUTASI/PINDAH KE LUAR KOTA (dalam 1-3 tahun kedepan)<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2 div_rencana_mutasi_review">
											<input type="text" readonly class="form-control" value="<?= strtoupper($rencanaMutasi); ?>" name="rencana_mutasi_review">
										</div>
									</div>

									<?php if ($rencanaMutasi != 'tidak'): ?>
										
										<div class="form-group askinstansirev">
											<label class="col-md-3 control-label" for="nomorhpibu">
												APAKAH INI KEWAJIBAN DARI INSTANSI/PERUSAHAAN<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-7 add10px">
												<input type="text" class="form-control" name="alasan_pindah_review" readonly value="<?= $alasanMutasi; ?>" id="alasan_pindah">
											</div>
										</div>

									<?php endif ?>

									<!-- <div class="form-group" id="infaq">
										<label class="col-md-12" style="text-align: justify; text-justify: inter-word;">  
											<?= strtoupper("Bersedia berinfaq untuk membantu proses pembangunan dan perawatan Gedung serta Fasilitas Sekolah sesuai kadar kesanggupan");?> :
										</label>
									</div> -->

									<!-- <div class="form-group" id="rp">
										<label class="col-md-3 control-label">
											Rp<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2" id="iptrp">
											<input type="text" required inputmode="numeric" readonly value="<?= $nominal_infaq; ?>" class="form-control" name="nominal_infaq_rev">
										</div>
									</div>

									<div class="form-group" id="terbilang">
										<label class="col-md-3 control-label">
											Terbilang<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<input type="text" required class="form-control" name="nominal_terbilang_rev" value="<?= $nominal_terbilang; ?>" readonly>
										</div>
									</div> -->

								<!-- AKhir Data Orang Tua Review -->

								<br>

								<!-- Upload Berkas Review -->

									<legend> <i class="glyphicon glyphicon-upload"></i> &nbsp; UPLOAD BERKAS </legend>

									<div class="utk_pernyataan">
										
										<div class="form-group">
											<label class="col-md-3 control-label" for="isian_surat_akte">
												UPLOAD AKTE KELAHIRAN<sup style="color: red;">*</sup> :
												(PDF)(MAX 2 MB)
											</label>
											<div class="col-md-5 add10px">
												<input type="hidden" name="berkas_akte_rev" value="<?= $namaFileBaruAkte; ?>">
												<input type="text" readonly value="<?= $namaFileUploadAkte; ?>" class="form-control" id="isian_surat_akte">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label" for="isian_surat_kk">
												UPLOAD KARTU KELUARGA<sup style="color: red;">*</sup> :
												(PDF)(MAX 2 MB)
											</label>
											<div class="col-md-5 add10px">
												<input type="hidden" name="berkas_kk_rev" value="<?= $namaFileBaruKK; ?>">
												<input type="text" readonly value="<?= $namaFileUploadKK; ?>" class="form-control" id="isian_surat_kk">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label" for="isian_surat_kk">
												UPLOAD KTP AYAH KANDUNG<sup style="color: red;">*</sup> :
												(PDF)(MAX 2 MB)
											</label>
											<div class="col-md-5 add10px">
												<input type="hidden" name="berkas_ktp_ayah_rev" value="<?= $namaFileBaruKtp1; ?>">
												<input type="text" readonly value="<?= $namaFileUploadKtp1; ?>" class="form-control" id="isian_surat_kk">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-3 control-label" for="isian_surat_kk">
												UPLOAD KTP IBU KANDUNG<sup style="color: red;">*</sup> :
												(PDF)(MAX 2 MB)
											</label>
											<div class="col-md-5 add10px">
												<input type="hidden" name="berkas_ktp_ibu_rev" value="<?= $namaFileBaruKtp2; ?>">
												<input type="text" readonly value="<?= $namaFileUploadKtp2; ?>" class="form-control" id="isian_surat_kk">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label" for="isian_sertif_tahsin">
												UPLOAD SURAT KETERANGAN / SERTIFIKAT PENCAPAIAN TAHSIN AL - QUR'AN :
												(PDF)(MAX 2 MB)
												(JIKA ADA)
											</label>
											<div class="col-md-5 add10px">
												<input type="hidden" name="sertif_tahsin_rev" value="<?= $namaFileBaruSertif1; ?>">
												<input type="text" readonly value="<?= $namaFileUpdSertif1; ?>" class="form-control">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label" for="isian_sertif_tahfidz">
												UPLOAD SURAT KETERANGAN / SERTIFIKAT PENCAPAIAN TAHFIDZ AL - QUR'AN :
												(PDF)(MAX 2 MB)
												(JIKA ADA)
											</label>
											<div class="col-md-5 add10px">
												<input type="hidden" name="sertif_tahfidz_rev" value="<?= $namaFileBaruSertif2; ?>">
												<input type="text" readonly value="<?= $namaFileUpdSertif2; ?>" class="form-control">
											</div>
										</div>

									</div>

								<!-- Akhir Upload Berkas Review -->

								<br>

								<!-- Bagian Pernyataan -->

									<legend> <i class="glyphicon glyphicon-book"></i> &nbsp; PERNYATAAN </legend>

									<div class="form-group">
										<label id="labelpernyataan" class="col-md-4 control-label"> PERNYATAAN ORANG TUA / WALI CALON MURID </label>
									</div>

									<div class="utk_pernyataan">
										<p id="pernyataan" style="margin-top: -20px;">  
											Bahwa segala Peraturan dan Ketentuan pada Penerimaan Peserta Didik Baru (PPDB) Akhyar International, termasuk Pernyataan sebagai berikut :

											<ol>
											  <li>Orang Tua / Wali Calon Murid bagi yang dinyatakan lolos TAHAP 1 (ONLINE), akan diinformasikan melakukan PENDAFTARAN TAHAP 2 (OFFLINE) dan akan dihubungi oleh Tim Administrasi untuk siap menyelesaikan Biaya Registrasi (Formulir Pendaftaran).</li>
											  <li>Orang Tua/Wali Calon Murid wajib menyelesaikan Biaya Masuk (Uang Pangkal) sebesar minimal 50%, 15 hari setelah murid dinyatakan diterima, dilanjutkan sisa nya pada waktu yang telah ditentukan. Jika tidak maka murid dianggap mengundurkan diri.</li>
											  <li>Orang Tua Calon murid Siap Menerima keputusan dari Panitia penerimaan murid baru tanpa syarat apapun.</li>
											  <li> Orang Tua / Wali Calon Murid menyetujui tanpa syarat bahwa dalam kondisi siswa yang dinyatakan diterima kemudian mengundurkan diri, maka seluruh biaya yang telah dibayarkan dinilai sebagai infaq untuk sekolah yang tidak dapat dikembalikan atau dipindahkan ke calon murid lain, atau diundur ke tahun berikutnya dalam kondisi atau alasan apapun. </li>
											  <li> Orang Tua / Wali Calon Murid, bersedia berinfaq dan berkomitmen untuk membantu proses pembangunan dan perawatan Gedung serta Fasilitas Sekolah sesuai kesanggupan. </li>
											</ol>

										</p>

										<p id="pernyataan">
											Setelah membaca dan meneliti dengan seksama, dengan ini saya menyatakan mengikuti Peraturan - Ketentuan Panitia PPDB dan pernyataan tersebut diatas dengan sebenarnya dan sejujurnya, ikhlas tanpa tekanan dan paksaan dari pihak manapun, untuk dapat digunakan sebagaimana mestinya.
										</p>
										
										<div class="form-check" id="div_pernyataan">
											<input type="checkbox" checked disabled class="form-check-input check" id="approverules">
											<label id="label_pernyataan"> SAYA BERSEDIA MENGIKUTI KETENTUAN YANG BERLAKU </label>
										</div>

									</div>

								<!-- Akhir Bagian Pernyataan -->

							</div>

							<div class="panel-footer text-center">
								<div class="outsidereview">
									<a href="<?= $base_pendaftar_ppdb; ?>" class="btn btn-primary"> <i class="glyphicon glyphicon-pencil"></i> ISI ULANG </a>
									<button type="submit" name="simpan_ppdb" id="simpan_ppdb" class="btn btn-success"> <i class="glyphicon glyphicon-ok"></i> SUBMIT </button>
								</div>
							</div>

						</form>
					</div>

		    	</div>
	    	</div>
		</div>

 	<?php elseif($sesi == 4): ?>

		<div class="container document">
	    	<div class="row">
		    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		    		<div class="panel panel-default">
							<!-- <div class="panel-heading"><h4 id="tahunajar" class="text-center">Tahun Ajaran Aktif : <strong><?php echo $ta_aktif; ?></strong></h4></div> -->
						<div class="panel-body">
							<input type="hidden" value="simpan_calon_siswa" name="aksi" id="aksi">

							<div class="form-group">
								<!-- <label class="col-md-3 control-label"> PENDAFTARAN UNTUK KELAS<sup style="color: red;">*</sup> : </label> -->
								<div class="col-md-12">
									<center> <h1> PENDAFTARAN BERHASIL </h1> </center>
								</div>
							</div>
							
						</div>

					</div>
		    	</div>
	    	</div>
		</div>

	<?php else: ?>

		<div class="container document">
	    	<div class="row">
		    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		    		<div class="panel panel-default">
						<form class="form form-horizontal validetta" method="post" action="" enctype="multipart/form-data">
							<!-- <div class="panel-heading"><h4 id="tahunajar" class="text-center">Tahun Ajaran Aktif : <strong><?php echo $ta_aktif; ?></strong></h4></div> -->
							<div class="panel-body">
								<input type="hidden" value="simpan_calon_siswa" name="aksi" id="aksi">

								<!-- Data Calon Siswa -->

									<legend> <i class="glyphicon glyphicon-user"></i> &nbsp; DATA CALON SISWA </legend>
									<div class="form-group">
										<label class="col-md-3 control-label"> PENDAFTARAN UNTUK KELAS<sup style="color: red;">*</sup> : </label>
										<div class="col-md-2">
											<input type="text" class="form-control" name="" value="1 SD" readonly disabled>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-3 control-label" id="label_nama_calon_siswa" for="nisn_calon_siswa">
											NISN (Jika Ada) :
											<br>
											<small style="font-weight: normal;"> NISN : Nomor Induk Siswa Nasional </small>
										</label>
										<div class="col-md-2">
											<input type="text" pattern="[0-9]*" placeholder="10 Digit Angka" inputmode="numeric" onkeypress="return onlyNumberKey(event)" maxlength="10" class="form-control" name="nisn_calon_siswa" id="nisn_calon_siswa">
										</div>
										<div id="error-message" class="error"> Angka yang dimasukkan kurang dari 10 digit!</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											ASAL SEKOLAH :
										</label>
										<div class="col-md-2">
											<select class="form-control target_asal_sekolah" name="asal_sekolah">
												<option value="kosong"> -- PILIH -- </option>
												<?php foreach ($arrAsalSekolahAwal as $data): ?>

													<option value="<?= $data; ?>"> <?= str_replace(["_"], " ", $data); ?> </option>

												<?php endforeach ?>
											</select>
										</div>
										<label class="col-md-3 sklh_lain control-label" id="label_sklh_lain" for="sekolah_lain">
											NAMA SEKOLAH ASAL<sup style="color: red;">*</sup> :
										</label>

										<!-- SD -->
										<div class="col-md-3 sklh_lain">
				                          <input type="text" class="form-control" id="sekolah_lain" placeholder="Nama Sekolah Asal" name="nama_sekolah_lainnya">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_nama_calon_siswa" for="nama_calon_siswa">
											NAMA LENGKAP<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<input type="text" required class="form-control" name="nama_calon_siswa" id="nama_calon_siswa">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_namapanggilan_calon_siswa" for="nama_panggilan_siswa">
											NAMA PANGGILAN<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<input type="text" required class="form-control" name="namapanggilan_calon_siswa" id="nama_panggilan_siswa">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label"> JENIS KELAMIN<sup style="color: red;">*</sup> : </label>
										<div class="col-md-2">
											<select class="form-control target" name="jenis_kelamin" required>
												<option value=""> -- PILIH -- </option>
												<?php foreach ($arrJenisKelamin as $data): ?>

													<option value="<?= $data; ?>"> <?= $data; ?> </option>

												<?php endforeach ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-3 control-label" id="label_tempat_lahir_calon_siswa" for="tempat_lahir_calon_siswa">
											TEMPAT LAHIR<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3">
											<input type="text" required class="form-control" name="tempat_lahir_calon_siswa" id="tempat_lahir_calon_siswa">
										</div>
										<label class="col-md-2 control-label label_tgl_lahir_calon_siswa" id="label_tanggal_lahir_calon_siswa" for="tanggal_lahir_calon_siswa">
											TANGGAL LAHIR<sup style="color: red;">*</sup> :
										</label>

										<!-- SD -->
										<div class="col-md-3">
				                          <input type="date" class="form-control" placeholder="(Tanggal-Bulan-Tahun)" min="2018-01-01" max="2019-02-01" name="tanglahir_anak_sd">
										</div>

									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_anak_ke" for="anak_ke">
											ANAK KE<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input required type="text" pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 1" name="anak_ke" id="anak_ke">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_daribrp_sdr" for="daribrp_saudara">
											DARI BERAPA SAUDARA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input type="text" required pattern="[0-9]*" inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="Ex : 2" name="daribrp_saudara" id="daribrp_saudara">
										</div>
									</div>

									<br>

									<!-- Data Tambahan Calon Siswa -->

										<legend> <i class="glyphicon glyphicon-file"></i> &nbsp; DATA TAMBAHAN </legend>
										<div class="form-group">
											<label class="col-md-3 control-label" id="label_riwayat_penyakit" for="rwyt_penyakit">
												APAKAH ADA ADIK/KAKAK KANDUNG YANG SUDAH BERSEKOLAH DI AIIS<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-2">
												<select class="form-control tingkatkelas_adik_kakak adik_kakak" required name="ada_adik_kakak">
													<option value=""> -- PILIH -- </option>
													<option value="tidak"> TIDAK </option>
													<option value="ada"> ADA </option>
												</select>
											</div>
											<label class="col-md-2 tingkatkls_adik_kakak control-label" id="label_tingkatkls_adik_kakak" for="pilih_tingkat">
												TINGKAT KELAS ADIK/KAKAK TERSEBUT<sup style="color: red;">*</sup> :
											</label>
											<div class="col-md-2 tingkatkls_adik_kakak">
				                              <select class="form-control pilih_kelas_adik_kakak adik_kakak" id="pilih_tingkat" name="tingkat_kelas_adik_kakak">
													<option value=""> -- PILIH -- </option>
													<?php foreach ($arrJenjangPiihanKelas as $data): ?>
														<?php if ($data == "KB"): ?>
															<option value="<?= $data; ?>"> PG/KB </option>
														<?php else: ?>
															<option value="<?= $data; ?>">  <?= str_replace(["SD"], " SD", $data); ?> </option>
														<?php endif ?>
													<?php endforeach ?>
												</select>
											</div>
											<div class="col-md-3 nama_adik_kakak">
												<input type="text" class="form-control adik_kakak" placeholder="Nama Adik atau Kakak Tersebut" id="nama_adik_kakak" name="nama_adik_kakak">
											</div>

										</div>

									<!-- Akhir Data Tambahan Calon Siswa -->

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_riwayat_penyakit" for="rwyt_penyakit">
											RIWAYAT PENYAKIT ANAK, APAKAH ADA ALERGI ? :
										</label>
										<div class="col-md-5">
											<input type="text" class="form-control" placeholder="Ex : Penyakit Anemia (kosongkan jika tidak ada)" name="rwyt_penyakit" id="rwyt_penyakit">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_bacaan_tahsin" for="bacaan_tahsin">
											TAHSIN / BACA AL-QUR'AN<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<select class="form-control pilihantahsin" required name="bacaan_tahsin">
												<option value="kosong_tahsin"> -- PILIH -- </option>
												<?php foreach ($arrIsiTahsin as $data): ?>

													<?php if ($data == "SANGAT_BAIK"): ?>
														<option value="<?= $data; ?>"> SANGAT BAIK </option>
													<?php else: ?>
														<option value="<?= $data; ?>"> <?= $data; ?> </option>
													<?php endif ?>

												<?php endforeach ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_tahfidz" for="pilihan_tahfidz">
											TAHFIDZ / HAFALAN AL-QUR'AN<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<select required class="form-control target_tahfidz" name="pilihan_tahfidz">
												<option value="kosong_tahfidz"> -- PILIH -- </option>
												<option value="belumtahfidz"> BELUM </option>
												<option value="sudahtahfidz"> SUDAH </option>
											</select>
										</div>
									</div>

									<div class="form-group isianberapajuz">
										<label class="col-md-3 control-label" id="label_berapajuz" for="isiberapajuz">
											BERAPA JUZ<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input type="text" pattern="[0-9]*" required inputmode="numeric" onkeypress="return onlyNumberKey(event)" class="form-control" name="berapajuzhafal" id="isiberapajuz">
										</div>
									</div>

									<div class="form-group isianjuz">
										<label class="col-md-3 control-label" id="label_tahfidz" for="isijuzberapa">
											JUZ BERAPA SAJA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-5">
											<input type="text" class="form-control" placeholder="Ex : JUZ 30, JUZ 29, JUZ 1, JUZ 2" name="isi_juz" id="isijuzberapa">
										</div>
									</div>

									<div class="form-group isiansurah">
										<label class="col-md-3 control-label" id="label_tahfidz" for="isian_surat">
											SURAT TERAKHIR<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-5">
											<input type="text" required class="form-control" placeholder="Ex : Surat An-Naba" name="isi_surat" id="isian_surat">
										</div>
									</div>

									<br>
									<hr>

									<center style="font-weight: bold; font-size: 20px;"> RIWAYAT PERKEMBANGAN </center>

									<br>

									<div class="form-group">
										<label class="col-md-3 control-label" for="usia_anak_dapat_berjalan">
											ANANDA DAPAT BERJALAN PADA USIA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2 add10px">
											<input type="text" class="form-control" placeholder="Ex : Usia 11 Bulan" name="usia_anak_dapat_berjalan" id="usia_anak_dapat_berjalan">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="dapat_bicara">
											ANANDA DAPAT BERBICARA BERMAKNA MIN. 2 KATA PADA USIA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2 add10px">
											<input type="text" class="form-control" placeholder="Ex : Usia 3 Tahun" name="anak_dapat_bicara" id="dapat_bicara">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											APAKAH ANANDA PERNAH MENJALANI TERAPI<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-4 add10px">
											<select class="form-control apakah_terapi" name="pernah_terapi">
												<option value=""> -- PILIH -- </option>
												<?php foreach ($arrPernahTerapi as $data): ?>
													<?php if ($data == "PERNAH"): ?>
														<option value="<?= $data; ?>"> IYA, PERNAH MENJALANI TERAPI </option>
													<?php else: ?>
														<option value="<?= $data; ?>"> BELUM PERNAH MENJALANI TERAPI </option>
													<?php endif ?>
												<?php endforeach ?>
											</select>
										</div>
									</div>

									<div class="form-group is_terapi">
										<label class="col-md-3 control-label" for="jenis_terapi">
											JENIS TERAPI APA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3">
											<input type="text" class="form-control" placeholder="Ex : Terapi Tingkah Laku" name="jenis_terapi" id="jenis_terapi">
										</div>
									</div>

									<div class="form-group is_terapi">
										<label class="col-md-3 control-label" for="alasan_terapi">
											ALASAN MENJALANI TERAPI TERSEBUT<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8 add10px">
											<input type="text" class="form-control" name="alasan_terapi" id="alasan_terapi">
										</div>
									</div>

									<div class="form-group is_terapi">
										<label class="col-md-3 control-label" for="durasi_terapi">
											DURASI TERAPI TERSEBUT<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3">
											<input type="text" class="form-control" placeholder="Ex : Durasi Terapi Selama 3 bulan" name="durasi_terapi" id="durasi_terapi">
										</div>
									</div>

									<div class="form-group is_terapi">
										<label class="col-md-3 control-label" for="waktu_mulai_akhir_terapi">
											WAKTU MULAI DAN WAKTU SELESAI TERAPI<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3 add10px">
											<input type="text" class="form-control" name="waktu_mulai_akhir_terapi" id="waktu_mulai_akhir_terapi">
										</div>
									</div>

									<div class="form-group is_terapi">
										<label class="col-md-3 control-label">
											APAKAH SAAT INI MASIH MENJALANI TERAPI<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2 add10px">
											<select class="form-control" id="masih_atau_tidak_terapi" name="masih_atau_tidak_terapi">
												<option value=""> -- PILIH -- </option>
												<option value="masih"> IYA MASIH </option>
												<option value="tidak"> SUDAH TIDAK </option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="keterlambatan_perkembangan">
											<?= strtoupper('apakah ananda memiliki keterlambatan perkembangan atau masalah tumbuh kembang'); ?><sup style="color: red;">*</sup>
										</label>
										<div class="col-md-5" style="margin-top: 10px;">
											<input type="text" class="form-control" placeholder="Jika tidak ada harap isi dengan TIDAK ADA" name="keterlambatan_perkembangan" id="keterlambatan_perkembangan">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											<?= strtoupper('Apakah ananda sudah terbiasa sholat 5 waktu'); ?><sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3" style="margin-top: 10px;">
											<select name="solat_option" id="solat_option" class="form-control">
												<option value=""> -- PILIH -- </option>
												<option value="terbiasa"> IYA SUDAH TERBIASA </option>
												<option value="belum"> BELUM TERBIASA </option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											<?= strtoupper("TAHSIN / BACA AL-QUR'AN AYAH BUNDA"); ?><sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2" style="margin-top: 10px;">
											<select class="form-control" required name="ayah_bunda_bacaquran">
												<option value=""> -- PILIH -- </option>
												<?php foreach ($arrIsiTahsin as $data): ?>
													<option value="<?= $data; ?>"> <?= str_replace(["_"], " ", $data); ?> </option>
												<?php endforeach ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											<?= strtoupper("TAHFIDZ / HAFALAN AL-QUR'AN AYAH BUNDA"); ?><sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2" style="margin-top: 10px;">
											<select class="form-control" required name="hafalan_ortu">
												<option value=""> -- PILIH -- </option>
												<option value="BELUM"> BELUM </option>
												<option value="SUDAH"> SUDAH </option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="peran_ortu">
											<?= strtoupper("Bagaimana peran ayah bunda dalam membantu perkembangan hafalan Al-Qur'an Ananda"); ?><sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8" style="margin-top: 10px;">
											<input type="text" required class="form-control" name="peran_ortu" id="peran_ortu">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											<?= strtoupper('Apakah anak terbiasa menonton TV atau menggunakan gadget'); ?><sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2" style="margin-top: 10px;">
											<select class="form-control terbiasa_gadget" required name="terbiasa_gadget">
												<option value=""> -- PILIH -- </option>
												<option value="IYA"> IYA </option>
												<option value="TIDAK"> TIDAK </option>
											</select>
										</div>
									</div>

									<div class="form-group waktu_main_gadget">
										<label class="col-md-3 control-label" for="waktu_bermain_gadget">
											<?= strtoupper('berapa jam dalam sehari menonton TV ataupun menggunakan gadget'); ?><sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3" style="margin-top: 10px;">
											<input type="text" class="form-control" placeholder="Ex : 30 Menit" name="waktu_bermain_gadget" id="waktu_bermain_gadget">
										</div>
									</div>

								<!-- Akhir Data Calon Siswa -->

								<br>

								<!-- Data Orang Tua -->

									<legend> <i class="glyphicon glyphicon-user"></i> &nbsp; DATA ORANG TUA </legend>

									<div class="form-group">
										<label class="col-md-3 control-label" for="nama_ayah_wali">
											NAMA AYAH / WALI<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<input type="text" required class="form-control" name="nama_ayah_wali" id="nama_ayah_wali">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="temlahir_ayah">
											TEMPAT LAHIR<sup style="color: red;">*</sup> : 
										</label>
										<div class="col-md-3">
											<input type="text" required class="form-control" name="temlahir_ayah" id="temlahir_ayah">
										</div>
										<label class="col-md-2 control-label" id="label_tanggal_lahir_ayah" for="tanggal_lahir_ayah">
											TANGGAL LAHIR<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3">
			                              <input class="form-control" placeholder="(Tanggal-Bulan-Tahun)" id="tanggal_lahir_ayah" type="date" name="tanglahir_ayah" required="">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_agama" for="agama_ayah">
											AGAMA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<select required class="form-control pilih_agama" name="agama_ayah" id="agama_ayah">
												<option value=""> -- PILIH -- </option>
												<option value="ISLAM"> ISLAM </option>
												<option value="LAINNYA"> LAINNYA </option>
											</select>
										</div>
										<div class="agamalainayah">

											<div class="col-md-3">
												<input type="text" required class="form-control" name="agamalainayah" placeholder="Ex : Kristen, Hindu, Budha" id="agamalainayah">
											</div>
											
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_pend_ayah" for="pend_ayah">
											PENDIDIKAN TERAKHIR<sup style="color: red;">*</sup> : 
										</label>
										<div class="col-md-2">
											<select required class="form-control pilih_pendayah" name="pend_ayah" id="pend_ayah">
												<option value=""> -- PILIH -- </option>
												<?php foreach ($arrIsiPddAyah as $data): ?>
													<option value="<?= $data; ?>"> <?= $data; ?> </option>
												<?php endforeach ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="pekerjaan_ayah">
											PEKERJAAN<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3">
											<select required class="form-control pilih_pekerjaan_ayah" name="pekerjaan_ayah" id="pekerjaan_ayah">
												<option value="kosong_pekerjaan_ayah"> -- PILIH -- </option>
												<?php foreach ($arrJobFather as $data): ?>
													<?php if ($data == "pegawai_pns"): ?>
														<option value="<?= $data; ?>"> PEGAWAI PNS </option>
													<?php elseif($data == "pegawai_bumn"): ?>
														<option value="<?= $data; ?>"> PEGAWAI BUMN / BUMD </option>
													<?php elseif($data == "karyawan_swasta"): ?>
														<option value="<?= $data; ?>"> KARYAWAN SWASTA </option>
													<?php else: ?>
														<option value="<?= $data; ?>"> <?= $data; ?> </option>
													<?php endif ?>
												<?php endforeach ?>
											</select>
										</div>
										<div class="pekerjaanlainayah">

											<div class="col-md-3">
												<input type="text" placeholder="PEKERJAAN LAINNYA" class="form-control" name="pekerjaanlainayah" id="pekerjaanlainayah">
											</div>
											
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="alamat_ayah">
											DOMISILI SAAT INI<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<textarea required class="form-control" name="alamat_ayah" id="alamat_ayah" style="resize:vertical; max-height:150px;"></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="nomorhpayah">
											NOMOR HANDPHONE <small>(Yang terhubung dengan Whatsapp)</small> <sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<input required type="text" pattern="[0-9]*" inputmode="numeric" maxlength="13" onkeypress="return onlyNumberKey(event)" class="form-control nomorhp1" name="nomorhpayah" id="nomorhpayah" placeholder="Ex : 08xx">
										</div>
										<div id="error-message-hp1" class="error"> Angka depan wajib di isi dengan 08 !</div>
									</div>

									<hr>

									<div class="form-group">
										<label class="col-md-3 control-label" for="nama_ibu">
											NAMA IBU<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<input type="text" required class="form-control" name="nama_ibu" id="nama_ibu">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="temlahir_ibu">
											TEMPAT LAHIR<sup style="color: red;">*</sup> : 
										</label>
										<div class="col-md-3">
											<input type="text" required class="form-control" name="temlahir_ibu" id="temlahir_ibu">
										</div>
										<label class="col-md-2 control-label" id="label_tgl_lahir_ibu" for="tanggal_lahir_ibu">
											TANGGAL LAHIR<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-3">
			                              <input class="form-control" placeholder="(Tanggal-Bulan-Tahun)" id="tanggal_lahir_ibu" type="date" name="tanglahir_ibu" required="">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_agama_ibu" for="agama_ibu">
											AGAMA<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2">
											<select required class="form-control pilih_agama_ibu" name="agama_ibu" id="agama_ibu">
												<option value=""> -- PILIH -- </option>
												<option value="ISLAM"> ISLAM </option>
												<option value="LAINNYA"> LAINNYA </option>
											</select>
										</div>
										<div class="agamalainibu">

											<div class="col-md-3">
												<input type="text" required class="form-control" placeholder="Ex : Kristen, Hindu, Budha" name="agamalainibu" id="agamalainibu">
											</div>
											
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" id="label_pend_ibu" for="pend_ibu">
											PENDIDIKAN TERAKHIR<sup style="color: red;">*</sup> : 
										</label>
										<div class="col-md-2">
											<select required class="form-control pilih_pendibu" name="pend_ibu" id="pend_ibu">
												<option value=""> -- PILIH -- </option>
												<?php foreach ($arrIsiPddAyah as $data): ?>
													<option value="<?= $data; ?>"> <?= $data; ?> </option>
												<?php endforeach ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="pekerjaan_ibu">
											PEKERJAAN<sup style="color: red;">*</sup>:
										</label>
										<div class="col-md-3">
											<select required class="form-control pilih_pekerjaan_ibu" name="pekerjaan_ibu" id="pekerjaan_ibu">
												<option value="kosong_pekerjaan_ibu"> -- PILIH -- </option>
												<?php foreach ($arrJobMother as $data): ?>
													<?php if ($data == "pegawai_pns"): ?>
														<option value="<?= $data; ?>"> PEGAWAI PNS </option>
													<?php elseif($data == "pegawai_bumn"): ?>
														<option value="<?= $data; ?>"> PEGAWAI BUMN / BUMD</option>
													<?php elseif($data == "karyawan_swasta"): ?>
														<option value="<?= $data; ?>"> KARYAWAN SWASTA </option>
													<?php else: ?>
														<option value="<?= $data; ?>"> <?= $data; ?> </option>
													<?php endif ?>
												<?php endforeach ?>
											</select>
										</div>
										<div class="pekerjaanlainibu">

											<div class="col-md-3">
												<input type="text" placeholder="PEKERJAAN LAINNYA" class="form-control" name="pekerjaanlainibu" id="pekerjaanlainibu">
											</div>
											
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="alamat_ibu">
											DOMISILI SAAT INI<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<textarea required class="form-control" name="alamat_ibu" id="alamat_ibu" style="resize:vertical; max-height:150px;"></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="nomorhpibu">
											NOMOR HANDPHONE <small>(Yang terhubung dengan Whatsapp)</small> <sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2" id="nomorhpibux">
											<input required type="text" pattern="[0-9]*" inputmode="numeric" maxlength="13" onkeypress="return onlyNumberKey(event)" class="form-control nomorhp2" name="nomorhpibu" id="nomorhpibu" placeholder="Ex : 08xx">
										</div>
										<div id="error-message-hp2" class="error"> Angka depan wajib di isi dengan 08 !</div>
									</div>

									<div class="form-group">
										
										<label class="col-md-3 control-label"> PENGHASILAN ORANG TUA / WALI CALON MURID PER BULAN<sup style="color: red;">*</sup> : </label>
										<br>
										<div class="col-md-6" id="pdt_otm">
											<div class="form-check">
											  <input class="form-check-input" type="radio" name="pendapatan_ortu" value="pen1" id="flexRadioDefault1">
											  <label class="form-check-label" for="flexRadioDefault1">
											    1 - 5 JUTA RUPIAH
											  </label>
											</div>
											<div class="form-check">
											  <input class="form-check-input" type="radio" name="pendapatan_ortu" value="pen2" id="flexRadioDefault2">
											  <label class="form-check-label" for="flexRadioDefault2">
											    6 - 10 JUTA RUPIAH
											  </label>
											</div>
											<div class="form-check">
											  <input class="form-check-input" type="radio" name="pendapatan_ortu" value="pen3" id="flexRadioDefault3">
											  <label class="form-check-label" for="flexRadioDefault3">
											    11 - 15 JUTA RUPIAH
											  </label>
											</div>
											<div class="form-check">
											  <input class="form-check-input" type="radio" name="pendapatan_ortu" value="pen4" id="flexRadioDefault14">
											  <label class="form-check-label" for="flexRadioDefault14">
											    DI ATAS 15 JUTA RUPIAH
											  </label>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="nomorhpibu">
											APAKAH ADA RENCANA UNTUK MUTASI/PINDAH KE LUAR KOTA (dalam 1-3 tahun kedepan)<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2" id="mts">
											<select class="form-control rencanapdh" name="rencana_mutasi">
												<option value="tidak"> TIDAK </option>
												<option value="ada"> ADA </option>
											</select>
										</div>
									</div>

									<div class="form-group askinstansi">
										<label class="col-md-3 control-label" for="nomorhpibu">
											APAKAH INI KEWAJIBAN DARI INSTANSI/PERUSAHAAN<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-7" id="divpdh">
											<input type="text" class="form-control" name="alasan_pindah" id="alasan_pindah">
										</div>
									</div>

									<!-- <div class="form-group" id="infaq">
										<label class="col-md-12" style="text-align: justify; text-justify: inter-word;">  
											<?= strtoupper("Bersedia berinfaq untuk membantu proses pembangunan dan perawatan Gedung serta Fasilitas Sekolah sesuai kadar kesanggupan");?> :
										</label>
									</div>

									<div class="form-group" id="rp">
										<label class="col-md-3 control-label">
											Rp<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-2" id="iptrp">
											<input type="text" required inputmode="numeric" placeholder="Ex : 100000" class="form-control" name="nominal_infaq" id="nominal_infaq">
										</div>
									</div>

									<div class="form-group" id="terbilang">
										<label class="col-md-3 control-label">
											Terbilang<sup style="color: red;">*</sup> :
										</label>
										<div class="col-md-8">
											<input type="text" required class="form-control" name="nominal_terbilang" id="" placeholder="Ex : Seratus Ribu Rupiah">
										</div>
									</div> -->

								<!-- Akhir Data Orang Tua -->

								<br>

								<!-- Upload Berkas -->

									<legend> <i class="glyphicon glyphicon-upload"></i> &nbsp; UPLOAD BERKAS </legend>

									<div class="utk_pernyataan">
										
										<div class="form-group">
											<label class="col-md-3 control-label" for="isian_surat_akte">
												UPLOAD AKTE KELAHIRAN<sup style="color: red;">*</sup> :
												(PDF)(MAX 2 MB)
											</label>
											<div class="col-md-5 add10px">
												<input type="file" accept=".pdf" required class="form-control" name="berkas_akte" id="isian_surat_akte">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label" for="isian_surat_kk">
												UPLOAD KARTU KELUARGA<sup style="color: red;">*</sup> :
												(PDF)(MAX 2 MB)
											</label>
											<div class="col-md-5 add10px">
												<input type="file" accept=".pdf" required class="form-control" name="berkas_kk" id="isian_surat_kk">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label" for="isian_ktp_ayah">
												UPLOAD KTP AYAH KANDUNG<sup style="color: red;">*</sup> :
												(PDF)(MAX 2 MB)
											</label>
											<div class="col-md-5 add10px">
												<input type="file" accept=".pdf" required class="form-control" name="berkas_ktp_ayah" id="isian_ktp_ayah">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label" for="isian_ktp_ibu">
												UPLOAD KTP IBU KANDUNG<sup style="color: red;">*</sup> :
												(PDF)(MAX 2 MB)
											</label>
											<div class="col-md-5 add10px">
												<input type="file" accept=".pdf" required class="form-control" name="berkas_ktp_ibu" id="isian_ktp_ibu">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label" for="isian_sertif_tahsin">
												UPLOAD SURAT KETERANGAN / SERTIFIKAT PENCAPAIAN TAHSIN AL - QUR'AN :
												(PDF)(MAX 2 MB)
												(JIKA ADA)
											</label>
											<div class="col-md-5 add10px">
												<input type="file" accept=".pdf" class="form-control" name="sertif_tahsin" id="isian_sertif_tahsin">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label" for="isian_sertif_tahfidz">
												UPLOAD SURAT KETERANGAN / SERTIFIKAT PENCAPAIAN TAHFIDZ AL - QUR'AN :
												(PDF)(MAX 2 MB)
												(JIKA ADA)
											</label>
											<div class="col-md-5 add10px">
												<input type="file" accept=".pdf" class="form-control" name="sertif_tahfidz" id="isian_sertif_tahfidz">
											</div>
										</div>
										
									</div>

								<!-- Akhir Upload Berkas -->

								<br>

								<!-- Bagian Pernyataan -->

									<legend> <i class="glyphicon glyphicon-book"></i> &nbsp; PERNYATAAN </legend>

									<div class="form-group">
										<label id="labelpernyataan" class="col-md-4 control-label"> PERNYATAAN ORANG TUA / WALI CALON MURID </label>
									</div>

									<div class="utk_pernyataan">
										<p id="pernyataan" style="margin-top: -20px;">  
											Bahwa segala Peraturan dan Ketentuan pada Penerimaan Peserta Didik Baru (PPDB) Akhyar International, termasuk Pernyataan sebagai berikut :

											<ol>
											  <li>Orang Tua / Wali Calon Murid bagi yang dinyatakan lolos TAHAP 1 (ONLINE), akan diinformasikan melakukan PENDAFTARAN TAHAP 2 (OFFLINE) dan akan dihubungi oleh Tim Administrasi untuk siap menyelesaikan Biaya Registrasi (Formulir Pendaftaran).</li>
											  <li>Orang Tua/Wali Calon Murid wajib menyelesaikan Biaya Masuk (Uang Pangkal) sebesar minimal 50%, 15 hari setelah murid dinyatakan diterima, dilanjutkan sisa nya pada waktu yang telah ditentukan. Jika tidak maka murid dianggap mengundurkan diri.</li>
											  <li>Orang Tua Calon murid Siap Menerima keputusan dari Panitia penerimaan murid baru tanpa syarat apapun.</li>
											  <li> Orang Tua / Wali Calon Murid menyetujui tanpa syarat bahwa dalam kondisi siswa yang dinyatakan diterima kemudian mengundurkan diri, maka seluruh biaya yang telah dibayarkan dinilai sebagai infaq untuk sekolah yang tidak dapat dikembalikan atau dipindahkan ke calon murid lain, atau diundur ke tahun berikutnya dalam kondisi atau alasan apapun. </li>
											  <li> Orang Tua / Wali Calon Murid, bersedia berinfaq dan berkomitmen untuk membantu proses pembangunan dan perawatan Gedung serta Fasilitas Sekolah sesuai kesanggupan. </li>
											</ol>

										</p>

										<p id="pernyataan">
											Setelah membaca dan meneliti dengan seksama, dengan ini saya menyatakan mengikuti Peraturan - Ketentuan Panitia PPDB dan pernyataan tersebut diatas dengan sebenarnya dan sejujurnya, ikhlas tanpa tekanan dan paksaan dari pihak manapun, untuk dapat digunakan sebagaimana mestinya.
										</p>
										
										<div class="form-check" id="div_pernyataan">
											<input type="checkbox" class="form-check-input check" id="approverules">
											<label id="label_pernyataan"> SAYA BERSEDIA MENGIKUTI KETENTUAN YANG BERLAKU </label>
										</div>

									</div>

								<!-- Akhir Bagian Pernyataan -->

							</div>

							<div class="panel-footer text-center">
								<button type="submit" name="proses" id="proses_simpan" class="btn btn-success"> <i class="glyphicon glyphicon-refresh"></i> CHECK ULANG </button>
							</div>

						</form>
					</div>

					<br>

		    	</div>
	    	</div>
		</div>

	<?php endif ?>

<?php  
	
	include("./footer_calonsiswa.php");

?>