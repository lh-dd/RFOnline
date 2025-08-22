<?php
include './include.php'; // necessary include

$fo = fopen($installpath."out\\resource.dat", "w+");

for($i = 0; $i < 9; $i++) {
	for($j = 0; $j < 3; $j++) {
        $inp_file = $installpath."in\\Resource.edf\\".$res_file_path[$i]."\\".$res_file_type[$j];
		if(!file_exists($inp_file)) {
			die("Aborted cause of file mising: ".$res_file_path[$i]."\\".$res_file_type[$j]."<br>");
		}
        $file_load = file($inp_file, FILE_SKIP_EMPTY_LINES);
        fwrite($fo, pack('i', sizeof($file_load) - 2));
        parser($fo, $inp_file, 0, 0);
	}
}
echo "<br>Script finished";