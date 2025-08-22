<?php
include './include.php'; // necessary include

$stop = false;
$fo = fopen($installpath."in\\PcRoom.edf\\itempremium.txt", "w+");
if(defined('GU'))
{
	$r1 = "dword\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tEND\r\n";
	$r2 = "2\t3\t4\t5\t6\t7\t8\t9\t10\t11\t12\t13\t14\t15\t16\t17\t18\t19\t20\t21\t22\t23\t24\t25\t26\t27\t28\t29\t30\t31\t32\t33\t34\t35\t36\t37\t38\t39\t40\t41\t42\t43\t44\t45\t46\t47\t48\t49\t50\t51\t52\t53\t54\t55\t56\t57\t58\t59\t60\t61\t62\t63\t64\t65\t66\t67\t68\t69\t70\t71\t72\t73\t74\t75\t76\t77\t78\t79\t80\t81\t82\t83\t84\t85\t86\t87\t88\t89\t90\t91\t92\t93\t94\t95\t96\t97\t98\t99\t100\t101\t102\t103\t104\t105\t106\t107\t108\t109\t110\t111\t112\t113\t114\t115\t116\t117\t118\t119\t120\t121\t122\t123\t124\t125\t126\t127\t128\t129\t130\t131\t132\t133\t134\t135\t136\t137\t138\t139\t140";
}
else
{
	$r1 = "dword\tstring[32]\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tEND\r\n";
	$r2 = "1\t2\t3\t4\t5\t6\t7\t8\t9\t10\t11\t12\t13\t14\t15\t16\t17\t18\t19\t20\t21\t22\t23\t24\t25\t26\t27\t28\t29\t30\t31\t32\t33\t34\t35\t36\t37\t38\t39\t40\t41\t42\t43\t44\t45\t46\t47\t48\t49\t50\t51\t52\t53\t54\t55\t56\t57\t58\t59\t60\t61\t62\t63\t64\t65\t66\t67\t68\t69\t70\t71\t72\t73\t74\t75\t76\t77\t78\t79\t80\t81\t82\t83\t84\t85\t86\t87\t88\t89\t90\t91\t92\t93\t94\t95\t96\t97\t98\t99\t100\t101\t102\t103\t104\t105\t106\t107\t108\t109\t110\t111\t112\t113\t114\t115\t116\t117\t118\t119\t120\t121\t122\t123\t124\t125\t126\t127\t128\t129\t130\t131\t132\t133\t134\t135\t136\t137\t138\t139\t140";
}
fwrite($fo, $r1);
fwrite($fo, $r2);
$file1 = $installpath."in\\PcRoom.edf\\PcRoom.txt";
$file_load1 = file($file1, FILE_SKIP_EMPTY_LINES);
$schet1 = sizeof($file_load1);
for($i = 2; $i < $schet1; $i++)
{
	$pcr = split("\t", trim($file_load1[$i]));
	if(defined('GU'))
		fwrite($fo, "\r\n".$pcr[1]."\t");
	else
		fwrite($fo, "\r\n".$pcr[1]."\t".$pcr[2]."\t");
	for($sel = 0; $sel < 5; $sel++)
	{
		for($cln = 0; $cln < 10; $cln++)
		{
			if($pcr[$sel * 11 + 3 + $cln] != "-1")
			{
				$a = 0;
				$tmptype = str_split($pcr[$sel * 11 + 3 + $cln]);
				$type = $tmptype[0].$tmptype[1];
				while($array[$a]!=$type && $a!=37)
				{
					$a++;
				}
				if($a == 37)
				{
					echo "Undefined item type: column $cln <br>";
					flush();
					$stop = true;
				}
				fwrite($fo, $a."\t");
			}
			else
			{
				fwrite($fo, "-1\t");
			}
		}	
	}
	fwrite($fo, "0\t");
	for($sel = 0; $sel < 5; $sel++)
	{
		for($cln = 0; $cln < 10; $cln++)
		{
			fwrite($fo, $pcr[$sel * 11 + 3 + $cln]."\t");
		}	
	}
	for($sel = 0; $sel < 5; $sel++)
	{
		fwrite($fo, $pcr[$sel * 11 + 13]."\t");
	}
	for($cln = 0; $cln < 10; $cln++)
	{
		if($pcr[$cln * 2 + 58] != "-1")
		{
			$a = 0;
			$tmptype = str_split($pcr[$cln * 2 + 58]);
			$type = $tmptype[0].$tmptype[1];
			while($array[$a]!=$type && $a!=37)
			{
				$a++;
			}
			if($a == 37)
			{
				echo "Undefined item type: column $cln <br>";
				flush();
				$stop = true;
			}
			fwrite($fo, $a."\t");
		}
		else
		{
			fwrite($fo, "-1\t");
		}
	}	
	fwrite($fo, "0\t");
	for($cln = 0; $cln < 10; $cln++)
	{
		fwrite($fo, $pcr[$cln * 2 + 58]."\t");
	}
	for($cln = 0; $cln < 10; $cln++)
	{
		fwrite($fo, $pcr[$cln * 2 + 59]."\t");
	}
		fwrite($fo, "0");
}
fclose($fo);


if(!$stop)
{
	if(defined('GU'))
		$fp = fopen($installpath."out\\itempremium.dat", "w+");
	else
		$fp = fopen($installpath."out\\PcRoom.dat", "w+");
	if(!file_exists($installpath."in\\PcRoom.edf\\itempremium.txt"))
	{
		$stop = true;
		fclose($fp);
		echo "Aborted cause of file mising: in\\PcRoom.edf\\itempremium.txt <br>";
	}
	else
	{
		$decrypt = $installpath."in\\PcRoom.edf\\itempremium.txt";
        if(!parser($fp, $decrypt, 1, 1))
        {
            die($stop_error_msg);
        }
	}
	fclose($fp);
}
echo "<br>Script finished";