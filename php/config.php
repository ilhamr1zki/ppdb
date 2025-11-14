<?php
$dbhost ='localhost';
$dbuser ='root';
$dbpass ='';
// $dbpass ='Admin@2023';
$dbname ='ppdb_update_sd';
$db_dsn = "mysql:dbname=$dbname;host=$dbhost";
try {
  $db = new PDO($db_dsn, $dbuser, $dbpass);
} catch (PDOException $e) {
  echo 'Connection failed: '.$e->getMessage();
}
include_once 'Auth.php';
$user = new Auth($db);
$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
($GLOBALS["___mysqli_ston"] = mysqli_connect($dbhost, $dbuser, $dbpass));mysqli_select_db($GLOBALS["___mysqli_ston"], $dbname);
/* css.plugin.hancon <?php echo $base; ?> */
// $base='http://localhost:8080/ppdb_update_sd/';
$base='https://fe00a718e587.ngrok-free.app/ppdb_update_sd/';
// $base='http://localhost:8080/daily_act/';
$base_pendaftar_ppdb = 'http://localhost:8080/ppdb_update_sd/';
// $base_jumlahpendaftar_ppdb = 'http://10.10.10.239/ppdb/totalpendaftarppdb';
/* control(link.redirect) <?php echo $basecon; ?> */
// $basead='http://localhost:8080/daily_act/admin/';
// $basead='https://fe00a718e587.ngrok-free.app/admin/'; 
$basead = 'https://fe00a718e587.ngrok-free.app/ppdb_update_sd/admin/';
/*kelas(link.redirect) <?php echo $basekel; ?>*/
/* $basegu='https://apps.aiis.sch.id/guru/'; */
// $basegu='http://localhost/daily_act/guru/';
// $basekepsek='http://localhost/daily_act/kepala_sekolah/';
// $basegu='http://localhost/daily_activity/guru/';
// $basewa='http://localhost/daily_activity/walikelas/';
/* $basewa='https://daily_activity.aiis.sch.id/walikelas/'; */
// $basewam='http://localhost/daily_act/walimurid/';
/* $basewam='https://daily_activity.aiis.sch.id/walimurid/'; */

// $aplikasi=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM aplikasi limit 1"));
// $ata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tahun_ajaran where status='aktif' ")); 
// $c_ta = $ata['id_tahun_ajaran'];

?>
