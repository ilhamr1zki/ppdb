<?php
/*for ($q=1; $q <=5; $q++) { 
	# code...
	echo $q.'- ';
	for ($i=1; $i <=5; $i++) {
		//$tes=2+$i; 
		echo $hasil[]=$i;
	}
	$bat=count($hasil);
	for ($v=0; $v < $bat; $v++) {
		$bb[]=$v;

		echo '-'.$v;
	}
	echo '-';
	unset($hasil[0]);
	echo "<br>";
	$hasil=[];
}*/

?>
<form action="" method="post">
	<?php for ($t=0; $t <4 ; $t++) { ?>
		<label><input type="checkbox" name="in[]" value="<?php echo $t; ?>"><?php echo $t; ?></label>
	<?php } ?>
	
	<button name="submit" value="ya">Submit lor</button>
</form>
<?php if(isset($_POST['submit'])){
	$hasil= $_POST['in'];
	$j = count($hasil);
	echo $j;
	for ($i=0; $i <$j ; $i++) { 
		echo $hasil[$i];
	}
}
$pass='rino2018';
echo $pass.'<br>';
echo crypt($pass,'1427').'<br>';
echo md5($pass).'<br>';

echo ($pass).'<br>';
$rio=100*0;
if($rio==NULL){
	echo $v=0;
}else{
	echo $v=$rio;
}

?>