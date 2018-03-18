<?php
echo "[INFO JUDUL DAN TAHUN KELUAR HARUS SPESIFIK]\n";
echo "+Judul			";
$keyword = trim(fgets(STDIN));
echo "+Tahun Keluar		";
$tahun = trim(fgets(STDIN));
$web = "http://server1.timepassbd.com/ftpdata1/Movies/Hollywood/$tahun/";
$ff = file_get_contents($web);
$ff = explode('alt="[VID]"></td><td><a href="',$ff);
$o = []; $url = []; $a=0;
while($a<count($ff)):
	 $a++;
	if($a==0) continue;
	$ffi = explode('</a></td><td align',$ff[$a]);
	$i = explode('">',$ffi[0]);
	$o[$a] = array($i[1],$i[0]);
endwhile;
for($u=0;$u<count($o);$u++){
	$s = strtolower($o[$u][0]);
	$sa = strtolower($keyword);
	$ss = strpos($s,$sa);
	if($ss !== FALSE) $url[$u] = $o[$u][1];
}
if(count($url)>0){
	print_r($url);
	echo "+Lanjut Download?(y/n)	";
	$l = trim(fgets(STDIN));
	if($l=="n"){
		exit("\n");
	}else{
		echo "+Pilih Nomor dari List	";
		$no = trim(fgets(STDIN));
		$ld = $web.$url[$no];
		if(!$url[$no]) die("Nomor Tidak Ada Di List\n");
		print("\nKalo ingin stop ctrl+z atau Volume Bawah+z\n\n");
		shell_exec("wget $ld");
	}
}else{
	die("Judul Film Tidak Ditemukan\n");
}
