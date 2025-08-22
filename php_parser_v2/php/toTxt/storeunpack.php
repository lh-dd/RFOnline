<?
include './include.php';

$open = $installpath."unpacker\\store.dat";
$opennd = $installpath."unpacker\\ndstore.dat";
$write = $installpath."unpacker\\clientsource\\clistore.txt";
$ndwrite = $installpath."unpacker\\clientsource\\ndstore.txt";

function codegen($type, $a, $b,  $c, $d)
{
	global $array;
	$arraya = array(0=>'a',1=>'b',2=>'c',3=>'d',4=>'e',5=>'f',6=>'g',7=>'h',8=>'i',9=>'j',10=>'k',11=>'l',12=>'m',13=>'n',14=>'o',15=>'p',16=>'q',17=>'r',18=>'s',19=>'t',20=>'u',21=>'v',22=>'w',23=>'x',24=>'y',25=>'z');
	$arrays = array('a'=>4,'b'=>5,'c'=>6,'d'=>7,'e'=>8,'f'=>9,'g'=>10,'h'=>11,'i'=>12,'j'=>13,'k'=>14,'l'=>15,'m'=>0,'n'=>1,'o'=>2,'p'=>3,'q'=>4,'r'=>5,'s'=>6,'t'=>7,'u'=>8,'v'=>9,'w'=>10,'x'=>11,'y'=>12,'z'=>13);	
	$unp = unpack("i", $type);
	if($unp[1] == 255 || $unp[1] == 0)
		return "0";
	$ret = $array[$unp[1]];
	$param = str_split($ret);
	$unp = unpack("C", $d);
	$ret .= $arraya[$unp[1] - 16 * $arrays[$param[0]]];
	$unp = unpack("C", $c);
	$ret .= $arraya[$unp[1]];
	$unp = unpack("C", $b);
	$ret .= $arraya[$unp[1]];
	$unp = unpack("H2", $a);
	$ret .= $unp[1];
	return $ret;
}

function totxtparser2($output, $input, $struct, $skip_index = true, $skip_header = true)
{
    if(!file_exists($input))
    {
        echo "Not found ".$input."<br>";
        return;
    }
    $fo = fopen($input, "rb");
    $ncount = fread($fo, 4);
    $count = unpack("i", $ncount);
    totxt2($fo, $count[1], $output, $struct, $skip_index, $skip_header);
    fclose($fo);
}

function totxt2($input, $count, $output, $struct, $skip_index = true, $skip_header = true)
{
    global $typearr;

    $fw = fopen($output, "w+");
    $strfile = file($struct, FILE_SKIP_EMPTY_LINES);
    $str = split("\t", trim($strfile[0]));
    fwrite($fw, $strfile[0].$strfile[1]);
    if($skip_header)
        fseek($input, 4, SEEK_CUR);
    for($i = 0; $i < $count; $i++)
    {
        if($skip_index)
            fseek($input, 4, SEEK_CUR);
        for($j = 0; $j < count($str) - 1; $j++)
        {
            preg_match("/^(string\[)?([\d]+)/", $str[$j], $str_ret);
            if($str_ret[1] == "string[")
            {
                $indata = fread($input, $str_ret[2]);
                $findme = "\x00";
                $pos = strpos($indata, $findme);
                $pos = ($pos == 0) ? "*" : $pos;
                $unpdata = unpack("a".$pos, $indata);
                fwrite($fw, $unpdata[1]."\t");
                continue;
            }
            if($str[$j] == "text")
            {
                $indata = fread($input, 4);
                $unp = unpack("i", $indata);
                $indata = fread($input, $unp[1]);
                $findme = "\x00";
                $pos = strpos($indata, $findme);
                $pos = ($pos == 0) ? "*" : $pos;
                $unpdata = unpack("a".$pos, $indata);
                fwrite($fw, $unpdata[1]."\t");
                continue;
            }
            if($typearr[$str[$j]]['type'] == "qword" || $typearr[$str[$j]]['type'] == "xeh64")
            {
                $indata = fread($input, 8);
                $unpdata[1] = unxeh64($indata);
                fwrite($fw, $unpdata[1]."\t");
                continue;
            }
            if($typearr[$str[$j]]['type'] == "xeh")
            {
                $indata = fread($input, 4);
                $unpdata = unpack("H*", $indata);
                $unpdata[1] = unxeh($unpdata[1]);
                fwrite($fw, $unpdata[1]."\t");
                continue;
            }
            if($typearr[$str[$j]]['type'] == "store")
            {
                $indata1 = fread($input, 4);
                $indata2 = fread($input, 1);
                $indata3 = fread($input, 1);
                $indata4 = fread($input, 1);
                $indata5 = fread($input, 1);
                $unpdata[1] = codegen($indata1, $indata2, $indata3, $indata4, $indata5);
                fwrite($fw, $unpdata[1]."\t");
                continue;
            }
            $indata = fread($input, $typearr[$str[$j]]['size']);
            $unpdata = unpack($typearr[$str[$j]]['type'], $indata);
            if($typearr[$str[$j]]['type'] == "f" || $typearr[$str[$j]]['type'] == "d")
            {
                $trans = array("." => ",");
                $unpdata[1] = strtr("".$unpdata[1]."", $trans);
            }
            fwrite($fw, $unpdata[1]."\t");
        }
        fwrite($fw, "\r\n");
    }
    fclose($fw);
}

totxtparser2($write, $open, $installpath."in\\store.edf\\storecli.txt");
totxtparser2($ndwrite, $opennd, $installpath."in\\store.edf\\ndstore.txt", true, false);

?>