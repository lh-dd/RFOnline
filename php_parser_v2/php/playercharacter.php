<?php
include './include.php'; // necessary include

if(defined('GU'))
{
	$fp = fopen($installpath."out\\playercharacter.dat", "w+");
	if(!file_exists($installpath."in\\PlayerCharacter.edf\\cliplayer.txt"))		
		echo "Aborted cause of file missing: cliplayer.txt<br>";
	else
	{
		$decrypt = $installpath."in\\PlayerCharacter.edf\\cliplayer.txt";
        if(!parser($fp, $decrypt, 1, 1))
        {
            die($stop_error_msg);
        }
	}
	fclose($fp);
    echo "<br>Script finished";
}
else
{
	echo "<br>This script is not applicable for BSB server version.";
}