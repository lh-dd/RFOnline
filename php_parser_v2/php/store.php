<?php
include './include.php'; // necessary include

$name = "storecli.txt";
$stop = false;

if(!$stop)
{
	$fp = fopen($installpath."out\\store.dat", "w+");
	$a=0;
	if(!file_exists($installpath."in\\Store.edf\\".$name))
	{
		$stop = true;
		fclose($fp);
		echo "Aborted cause of file missing: ".$name."<br>";
	}
	else
	{
		$decrypt = $installpath."in\\Store.edf\\".$name;
        if(!parser($fp, $decrypt, 1, 1))
        {
            die($stop_error_msg);
        }
	}
	fclose($fp);
	if(defined('GU'))
	{
		$fp = fopen($installpath."out\\en-gb\\ndstore.dat", "w+");
		if(!file_exists($installpath."in\\Store.edf\\ndstore.txt"))
			echo "Aborted cause of file missing: ndstore.txt<br>";
		else
		{
			$decrypt = $installpath."in\\Store.edf\\ndstore.txt";
			$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
			$schet = sizeof($struct_load) - 2;
			fwrite($fp, pack("i", $schet));
            if(!parser($fp, $decrypt, 1, 0))
            {
                die($stop_error_msg);
            }
		}
		fclose($fp);
	}
}
echo "<br>Script finished";