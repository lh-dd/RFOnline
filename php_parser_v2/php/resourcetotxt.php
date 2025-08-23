<?php
include './include.php'; // necessary include

$incname = "unpacker\\Resource.dat";

$data_file = $installpath.$incname;
$fo = fopen($data_file, "rb");
for($i = 0; $i < 9; $i++) {
    for ($j = 0; $j < 3; $j++) {
        $nblock = fread($fo, 4);
        $count = unpack("i", $nblock);
        @mkdir($installpath . "unpacker\\Resource\\" . $res_file_path[$i]);
        $out_file = $installpath . "unpacker\\Resource\\" . $res_file_path[$i] . "\\" . $res_file_type[$j];
        $str_file = $installpath . "in\\Resource.edf\\" . $res_file_path[$i] . "\\" . $res_file_type[$j];
        totxt($fo, $count[1], $out_file, $str_file, false, false);
    }
}
fclose($fo);
echo "<br>Script finished";