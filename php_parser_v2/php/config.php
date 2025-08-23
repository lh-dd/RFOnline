<?php
define('GU', true); // Comment this row if you want to use compiler for BSB (2.2.3) scripts.
//define('LM', true); //For map unpacker. Comment to unpack GU map.
$basepath = dirname(__DIR__);
$installpath = str_replace("\\", "\\\\", $basepath) . "\\\\";
$map_folder = "F:\\testsrv\\_2.ZoneServer\\RF_bin\\Map"; // Path to serverside maps