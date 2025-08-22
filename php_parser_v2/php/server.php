<?php
include './include.php'; // necessary include

if(!file_exists("./".VERSION."smd5.md5")){
	touch("./".VERSION."smd5.md5");
}
$smd5 = fopen("./".VERSION."smd5.md5", "r+b");
$path = file("./".VERSION."version.ini", FILE_SKIP_EMPTY_LINES);
$noffset = 0;
for($i = 0; $i < sizeof($path); $i++){
	$fmd5 = md5_file($installpath.trim($path[$i]).".txt");
	$noffset = ftell($smd5);
	$unp = unpack("H*", fread($smd5, 16));
	if($fmd5 == $unp[1]){
		echo "<font color=#ff0000>Same MD5 hash. Skipped: ".$path[$i]."<br>";
		flush();
	}
	else{
		echo "<font color=#00ff00>MD5 hash is different, proceed: ".$path[$i]."<br>";
		flush();
		if(!proceed($path[$i])){
			fseek($smd5, $noffset, SEEK_SET);
			fwrite($smd5, pack("H32", $fmd5));	
		}
		else{
			echo "<font color=#ff0000>Error!!!<br>";
			flush();
		}	
	}
}
fclose($smd5);
echo "<br><font color=#000000>Script finished";
