<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 28.02.2015
 * Time: 18:50
 */
include './config.php';

ini_set('memory_limit', '256M');
ini_set('max_execution_time', 9000);

$incname = "decrypt.txt"; //Do not change
$desc = "desc.txt"; //Do not change

if(!defined('GU'))
    define('VERSION', "bsb_");
else
    define('VERSION', "gu_");

$installpath = $installpath.VERSION;
echo '<head><meta charset="windows-1251"></head>';
$patharr = array(
    0=>"00_FaceItem",
    1=>"01_UpperItem",
    2=>"02_LowerItem",
    3=>"03_GauntletItem",
    4=>"04_ShoeItem",
    5=>"05_HelmetItem",
    6=>"06_WeaponItem",
    7=>"07_ShieldItem",
    8=>"08_CloakItem",
    9=>"09_RingItem",
    10=>"10_AmuletItem",
    11=>"11_BulletItem",
    12=>"12_MakeToolItem",
    13=>"13_PotionItem",
    14=>"14_BagItem",
    15=>"15_BatteryItem",
    16=>"16_OreItem",
    17=>"17_ResourceItem",
    18=>"18_ForceItem",
    19=>"19_UnitKeyItem",
    20=>"20_BootyItem",
    21=>"21_MapItem",
    22=>"22_TownItem",
    23=>"23_BattleDungeonItem",
    24=>"24_AnimusItem",
    25=>"25_GuardTowerItem",
    26=>"26_TrapItem",
    27=>"27_SiegeKitItem",
    28=>"28_TicketItem",
    29=>"29_EventItem",
    30=>"30_RecoveryItem",
    31=>"31_BoxItem",
    32=>"32_Firecracker",
    33=>"33_Unmannedminer",
    34=>"34_RadarItem",
    35=>"35_NPCLinkItem",
    36=>"36_CouponItem",
    37=>"37_UnitHead",
    38=>"38_UnitUpper",
    39=>"39_UnitLower",
    40=>"40_UnitArms",
    41=>"41_UnitShoulder",
    42=>"42_UnitBack",
    43=>"43_UnitBullet",
    44=>"44_ItemMakeData",
    45=>"45_ItemCombineData"
);

$qpatharr = array(
    0=>"QuestDummyEvent.txt",
    1=>"QuestNPCEvent.txt",
    2=>"QuestKillOtherRaceEvent.txt",
    3=>"QuestLvUpEvent.txt",
    4=>"QuestPromoteEvent.txt",
    5=>"QuestGradeEvent.txt",
    6=>"QuestGainItemEvent.txt");

$skfpatharr = array(
    0=> array('cli' => "in\\SkillForce.edf\\cliforce.txt", 'srv' => "in\\SkillForce.edf\\Force.txt", 'nd' => "in\\SkillForce.edf\\ndforce.txt"),
    1=> array('cli' => "in\\SkillForce.edf\\cliskill.txt", 'srv' => "in\\SkillForce.edf\\Skill.txt", 'nd' => "in\\SkillForce.edf\\ndskill.txt"),
    2=> array('cli' => "in\\SkillForce.edf\\cliclassskill.txt", 'srv' => "in\\SkillForce.edf\\ClassSkill.txt", 'nd' => "in\\SkillForce.edf\\ndclskill.txt"),
    3=> array('cli' => "in\\SkillForce.edf\\clibuliteff.txt", 'srv' => "in\\SkillForce.edf\\BulletItemEffect.txt", 'nd' => "in\\SkillForce.edf\\ndbullet.txt"),
    4=> array('cli' => "in\\SkillForce.edf\\clipotiteff.txt", 'srv' => "in\\SkillForce.edf\\PotionItemEffect.txt", 'nd' => "in\\SkillForce.edf\\ndpotion.txt"));

$res_file_path = array(
    '0_Player',
    '1_Monster',
    '2_Animus',
    '3_GuardTower',
    '4_NPC',
    '5_Item',
    '6_Unit',
    '7_Skill',
    '8_Force');

$res_file_type = array(
    'Bone.txt',
    'Mesh.txt',
    'Ani.txt');

$indexarr = array(
    0 => 0,
    1 => 1,
    2 => 2,
    3 => 3,
    4 => 4,
    5 => 5,
    6 => 6,
    7 => 7,
    8 => 8,
    9 => 9,
    10 => 10,
    11 => 11,
    12 => 12,
    13 => 13,
    14 => 14,
    15 => 15,
    16 => 16,
    17 => 17,
    18 => 18,
    19 => 19,
    20 => 20,
    21 => 21,
    22 => 22,
    23 => 23,
    24 => 24,
    25 => 25,
    26 => 26,
    27 => 27,
    28 => 28,
    29 => 29,
    30 => 30,
    31 => 31,
    32 => 45,
    33 => 46,
    34 => 47,
    35 => 48,
    36 => 49,
    37 => 32,
    38 => 33,
    39 => 34,
    40 => 35,
    41 => 36,
    42 => 37,
    43 => 38,
    44 => 39,
    45 => 40,
);

$typearr = array(
    "dword" => array('type' => "i", 'size' => 4),
    "long" => array('type' => "i", 'size' => 4),
    "word" => array('type' => "s", 'size' => 2),
    "byte" => array('type' => "c", 'size' => 1),
    "float" => array('type' => "f", 'size' => 4),
    "double" => array('type' => "d", 'size' => 8),
    "udword" => array('type' => "I", 'size' => 4),
    "uword" => array('type' => "S", 'size' => 2),
    "ubyte" => array('type' => "C", 'size' => 1),
    "hex" => array('type' => "H8", 'size' => 4),
    "xeh" => array('type' => "xeh", 'size' => 4),
    "xeh64" => array('type' => "xeh64", 'size' => 8),
    "qword" => array('type' => "xeh64", 'size' => 8),
    "clcode" => array('type' => "clcode", 'size' => 4),
    "exclcode" => array('type' => "exclcode", 'size' => 8),
    "ccode" => array('type' => "ccode", 'size' => 4),
    "store" => array('type' => "store", 'size' => 8),
    "bulltype" => array('type' => "bulltype", 'size' => 11),
    "bttype" => array('type' => "bttype", 'size' => 8),
    "effbttype" => array('type' => "effbttype", 'size' => 4),
    "stb" => array('type' => "stb", 'size' => 8),
    "stb4" => array('type' => "stb4", 'size' => 4),
    "stb12" => array('type' => "stb12", 'size' => 12),
    "stb16" => array('type' => "stb16", 'size' => 16),
    "res" => array('type' => "res", 'size' => 52),
    "param1" => array('type' => "param", 'size' => 12),
    "param2" => array('type' => "param", 'size' => 0),
    "qitid" => array('type' => "qitid", 'size' => 4),
    "lqitem" => array('type' => "lqitem", 'size' => 4),
    "qcode" => array('type' => "qcode", 'size' => 4),
    "spcode" => array('type' => "spcode", 'size' => 8),
    "text" => array('type' => "text", 'size' => 0)
);

$array = array(
    0=>"if", 1=>"iu",2=>"il",3=>"ig",4=>"is",5=>"ih",6=>"iw",7=>"id",8=>"ik",9=>"ii",10=>"ia",11=>"ib",12=>"im",13=>"ip",14=>"ie",15=>"it",
    16=>"io",17=>"ir",18=>"ic",19=>"in",20=>"iy",21=>"iz",22=>"iq",23=>"ix",24=>"ij",25=>"gt",26=>"tr",27=>"sk",28=>"ti",29=>"ev",30=>"re",
    31=>"bx",32=>"fi",33=>"un",34=>"rd",35=>"lk",36=>"cu");

$rad = 3.141592654 / 180; // need to convert between degrees and radians

$stop_error_msg = '';

function xeh($str)
{
    if($str=="-1")
    {
        $packed = pack("H8", "ffffffff");
        return $packed;
    }
    else
    {
        $len = strlen($str);
        if($len < 8)
        {
            for($i=$len; $i < 8; $i++)
            {
                $str="0".$str;
            }
        }
        $arr1 = str_split($str, 2);
        $str = $arr1[3].$arr1[2].$arr1[1].$arr1[0];
        $packed = pack("H8", $str);
        return $packed;
    }
}

function xeh64($str)
{
    $str = base_convert($str, 10, 16);
    $len=strlen($str);
    if($len < 16)
    {
        for($i=$len; $i < 16; $i++)
        {
            $str="0".$str."";
        }
    }
    $arr1 = str_split($str, 2);
    $str = $arr1[7].$arr1[6].$arr1[5].$arr1[4].$arr1[3].$arr1[2].$arr1[1].$arr1[0];
    $packed=pack("H16", $str);
    return $packed;
}

function strsize($arr)
{
    global $typearr;
    $bs = 0;

    for($i=0; $i < count($arr)-1; $i++)
    {
        if(stristr($arr[$i], 'string[') !== false)
        {
            preg_match("/^(string\[)?([\d]+)/", $arr[$i], $res_arr);
            $bs += $res_arr[2];
        }
        else
        {
            $bs += $typearr[$arr[$i]]['size'];
        }
        unset($res_arr);
    }

    return $bs;
}

function bulltype($type)
{
    global $stop_error_msg;
    $tmp = '';
    if($type=="0" || $type=="-1")
    {
        $tmp = pack("H22", "0000000000000000000000");
    }
    else
    {
        $arr2 = str_split($type);
        $count = count($arr2);
        if($count > 4)
        {
            $stop_error_msg .= '<br>More than 4 bullet types:"'.$type.'.';
            return false;
        }
        $array = array(0=>"A",1=>"B",2=>"C",3=>"D",4=>"E",5=>"F",6=>"G",7=>"H",8=>"I",9=>"J",10=>"K",11=>"L",12=>"M",13=>"N",14=>"O",
            15=>"P",16=>"Q",17=>"R",18=>"S",19=>"T",20=>"U",21=>"V",22=>"W",23=>"X",24=>"Y",25=>"Z");
        for($i=0; $i < $count; $i++)
        {
            $t=0;
            while($arr2[$i]!=$array[$t])
            {
                $t++;
            }
            $tmp .= pack("c", $t);
        }
        while($i != 4)
        {
            $tmp .= pack("c", 0);
            $i++;
        }
        $tmp .= pack("H6","000000").pack("i", $count);
    }
    return $tmp;
}

function bttype($type)
{
    global $stop_error_msg;
    $tmp = '';

    if($type=="0" || $type=="-1"){
        $tmp = pack("H16", "0000000000000000");
    }
    else{
        $arr2 = str_split($type);
        $count = count($arr2);
        if($count > 4){
            $stop_error_msg .= '<br>More than 4 bullet types:"'.$type.'.';
            return false;
        }
        $array = array(0=>"A",1=>"B",2=>"C",3=>"D",4=>"E",5=>"F",6=>"G",7=>"H",8=>"I",9=>"J",10=>"K",11=>"L",12=>"M",13=>"N",14=>"O",
            15=>"P",16=>"Q",17=>"R",18=>"S",19=>"T",20=>"U",21=>"V",22=>"W",23=>"X",24=>"Y",25=>"Z");
        for($i=0; $i < $count; $i++){
            $t=0;
            while($arr2[$i]!=$array[$t]){
                $t++;
            }
            $tmp .= pack("c", $t);
        }
        while($i != 4){
            $tmp .= pack("c", 0);
            $i++;
        }
        $tmp = pack("c", $count).$tmp.pack("H6","000000");
    }
    return $tmp;
}

function effbttype($type)
{
    global $stop_error_msg;
    $tmp = '';

    if($type=="0" || $type=="-1"){
        $tmp = pack("H8", "00000000");
    }
    else{
        $arr2 = str_split($type);
        $count = count($arr2);
        if($count > 1){
            $stop_error_msg .= '<br>More than 1 effect bullet types:"'.$type.'.';
            return false;
        }
        $array = array(1=>"A",2=>"B",3=>"C",4=>"D",5=>"E",6=>"F",7=>"G",8=>"H",9=>"I",10=>"J",11=>"K",12=>"L",13=>"M",14=>"N",15=>"O",
            16=>"P",17=>"Q",18=>"R",19=>"S",20=>"T",21=>"U",22=>"V",23=>"W",24=>"X",25=>"Y",26=>"Z");
        for($i=0; $i < $count; $i++){
            $t=1;
            while($arr2[$i]!=$array[$t]){
                $t++;
            }
            $tmp .= pack("c", $t);
        }
        while($i != 4){
            $tmp .= pack("c", 0);
            $i++;
        }
        //$tmp = pack("c", $count).$tmp.pack("H6","000000");
    }
    return $tmp;
}

function stb($str)
{
    global $stop_error_msg;
    $len = strlen($str);
    if($len > 8)
    {
        $stop_error_msg .= '<br>More than 8 parameters:"'.$str.'.';
        return false;
    }
    else
    {
        $arr1 = str_split($str);
        $str1 = '';
        for($i = 0;$i < $len; $i++){
            $str1 .= "0".$arr1[$i];
        }
        while($i!=8){
            $i++;
            $str1 .= "00";
        }
        $packed = pack("H16", $str1);
        return $packed;
    }
}

function stb4($str)
{
    global $stop_error_msg;
    $len=strlen($str);
    if($len > 4){
        $stop_error_msg .= '<br>More than 4 parameters:"'.$str.'.';
        return false;
    }
    else
    {
        $arr1 = str_split($str);
        $str1 = '';
        for($i = 0;$i < $len; $i++){
            $str1 .= "0".$arr1[$i];
        }
        while($i!=4){
            $i++;
            $str1 .= "00";
        }
        $packed = pack("H8", $str1);
        return $packed;
    }
}

function stb12($str)
{
    global $stop_error_msg;
    $len=strlen($str);
    if($len > 12)
    {
        $stop_error_msg .= '<br>More than 12 parameters:"'.$str.'.';
        return false;
    }
    else
    {
        $arr1 = str_split($str);
        $str1 = '';
        for($i = 0;$i < $len; $i++)
        {
            $str1 .= "0".$arr1[$i];
        }
        while($i!=12)
        {
            $i++;
            $str1 .= "00";
        }
        $packed = pack("H24", $str1);
        return $packed;
    }
}

function stb16($str)
{
    global $stop_error_msg;
    $len=strlen($str);
    if($len > 16)
    {
        $stop_error_msg .= '<br>More than 16 parameters:"'.$str.'.';
        return false;
    }
    else
    {
        $arr1 = str_split($str);
        $str1 = '';
        for($i = 0;$i < $len; $i++)
        {
            $str1 .= "0".$arr1[$i];
        }
        while($i!=16)
        {
            $i++;
            $str1 .= "00";
        }
        $packed = pack("H32", $str1);
        return $packed;
    }
}

function resource($code)
{
    global $installpath, $patharr;
    $file2 = $installpath."in\\Item.edf\\".$patharr[17]."\\ItemUpgrade.txt";
    $file_load2 = file($file2, FILE_SKIP_EMPTY_LINES);
    $trans = array("," => ".");
    $upg = array();
    $tmp = '';
    for($i = 2; $i < sizeof($file_load2); $i++)
    {
        $upg[$i]=explode("\t", trim($file_load2[$i]));
    }
    for($j = 2; $j < sizeof($file_load2); $j++)
    {
        if($code==$upg[$j][0])
        {
            if($upg[$j][2]==0)
            {
                $jtype = 1;
            }
            elseif($upg[$j][2]==1)
            {
                $jtype = 2;
            }
            elseif($upg[$j][2]==2)
            {
                $jtype = 3;
            }
            elseif($upg[$j][2]==4)
            {
                $jtype = 4;
            }
            else
            {
                $jtype = 5;
            }
            $tmp = pack("i", 1).pack("i", $jtype).pack("c", $upg[$j][4]).pack("c", $upg[$j][5]).pack("c", $upg[$j][6]).pack("c", $upg[$j][7]).pack("c", $upg[$j][8]).pack("c", $upg[$j][10]).pack("c", $upg[$j][9]).pack("c", $upg[$j][11]).pack("c", $upg[$j][12]).pack("c", $upg[$j][13]).pack("s", $upg[$j][14]).pack("f", strtr($upg[$j][16], $trans)).pack("f", strtr($upg[$j][17], $trans)).pack("f", strtr($upg[$j][18], $trans)).pack("f", strtr($upg[$j][19], $trans)).pack("f", strtr($upg[$j][20], $trans)).pack("f", strtr($upg[$j][21], $trans)).pack("f", strtr($upg[$j][22], $trans)).pack("f", strtr($upg[$j][3], $trans));
            break;
        }
        elseif($j == (sizeof($file_load2)-1)){
            $tmp = pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0);
        }
        else{
            continue;
        }
    }
    return $tmp;
}
/**/
function getclcode($type, $hex)
{
    global $array;
    if($type == "-1")
    {
        return "-1";
    }
    $carray = array(0=>'a', 1=>'b', 2=>'c', 3=>'d', 4=>'e', 5=>'f', 6=>'g', 7=>'h', 8=>'i', 9=>'j', 10=>'k', 11=>'l', 12=>'m', 13=>'n', 14=>'o', 15=>'p', 16=>'q', 17=>'r', 18=>'s', 19=>'t', 20=>'u', 21=>'v', 22=>'w', 23=>'x', 24=>'y', 25=>'z');
    $tarrays = array('a'=> 4,'b'=> 5,'c'=> 6,'d'=> 7,'e'=> 8,'f'=> 9,'g'=> 10,'h'=> 11,'i'=> 12,'j'=> 13,'k'=> 14,'l'=> 15,'m'=> 0,'n'=> 1,'o'=> 2,'p'=> 3,'q'=> 4,'r'=> 5,'s'=> 6,'t'=> 7,'u'=> 8,'v'=> 9,'w'=> 10,'x'=> 11,'y'=> 12,'z'=> 13);

    $arr = str_split($hex, 2);
    $tarr = str_split($array[$type]);
    $tmp = '';
    $tmp .= $array[$type];
    $unp = unpack("C", pack("H2", $arr[3]));
    $tmp .= $carray[$unp[1] - 16 * $tarrays[$tarr[0]]];
    $unp = unpack("C", pack("H2", $arr[2]));
    $tmp .= $carray[$unp[1]];
    $unp = unpack("C", pack("H2", $arr[1]));
    $tmp .= $carray[$unp[1]];
    $tmp .= $arr[0];
    return $tmp;
}

function clcode($code)
{
    if($code == "-1")
    {
        $tmp = pack("H8", "ffffffff");
        return $tmp;
    }
    preg_match("/([a-z]+)([0-9]+)/", $code, $arr);
    $arrc = str_split($arr[1]);
    $arrd = str_split($arr[2]);
    $arrcs = count($arrc);
    $arrds = count($arrd) - 1;
    $hex = pack("H2", $arrd[$arrds-1].$arrd[$arrds]);
    $dec = unpack("C", $hex);
    $out = array(0 => 0, 1 => 0, 2 => 0, 3 => 0);

    $array = array('a'=>0,'b'=>1,'c'=>2,'d'=>3,'e'=>4,'f'=>5,'g'=>6,'h'=>7,'i'=>8,'j'=>9,'k'=>10,'l'=>11,'m'=>12,'n'=>13,'o'=>14,'p'=>15,'q'=>16,'r'=>17,'s'=>18,'t'=>19,'u'=>20,'v'=>21,'w'=>22,'x'=>23,'y'=>24,'z'=>25);
    $arrays = array('a'=>4,'b'=>5,'c'=>6,'d'=>7,'e'=>8,'f'=>9,'g'=>10,'h'=>11,'i'=>12,'j'=>13,'k'=>14,'l'=>15,'m'=>0,'n'=>1,'o'=>2,'p'=>3,'q'=>4,'r'=>5,'s'=>6,'t'=>7,'u'=>8,'v'=>9,'w'=>10,'x'=>11,'y'=>12,'z'=>13);

    $out[0] = 16 * $arrays[$arrc[0]];
    $lj = 2;
    for($li = 0; $li < 4; $li++)
    {
        if($lj < $arrcs)
        {
            $out[$li] += $array[$arrc[$lj]];
            $lj++;
        }
        else
        {
            $out[$li] += $dec[1];
            break;
        }
    }

    $tmp = pack("C", $out[3]).pack("C", $out[2]).pack("C", $out[1]).pack("C", $out[0]);
    //$ret = unpack("H8", $tmp);
    //return $ret[1];
    return $tmp;
}

function exclcode($code)
{
    global $array, $stop_error_msg;
    if($code == "0" || $code == "-1")
    {
        $tmp = pack("H16", "ff000000ffffffff");
        return $tmp;
    }
    preg_match("/([a-z]+)([0-9]+)/", $code, $arr);
    $arrc = str_split($arr[1]);
    $arrd = str_split($arr[2]);
    $arrcs = count($arrc);
    $arrds = count($arrd) - 1;
    $hex = pack("H2", $arrd[$arrds-1].$arrd[$arrds]);
    $dec = unpack("C", $hex);
    $out = array(0 => 0, 1 => 0, 2 => 0, 3 => 0);
    $arraya = array('a'=>0,'b'=>1,'c'=>2,'d'=>3,'e'=>4,'f'=>5,'g'=>6,'h'=>7,'i'=>8,'j'=>9,'k'=>10,'l'=>11,'m'=>12,'n'=>13,'o'=>14,'p'=>15,'q'=>16,'r'=>17,'s'=>18,'t'=>19,'u'=>20,'v'=>21,'w'=>22,'x'=>23,'y'=>24,'z'=>25);
    $arrays = array('a'=>4,'b'=>5,'c'=>6,'d'=>7,'e'=>8,'f'=>9,'g'=>10,'h'=>11,'i'=>12,'j'=>13,'k'=>14,'l'=>15,'m'=>0,'n'=>1,'o'=>2,'p'=>3,'q'=>4,'r'=>5,'s'=>6,'t'=>7,'u'=>8,'v'=>9,'w'=>10,'x'=>11,'y'=>12,'z'=>13);
    $out[0] = 16 * $arrays[$arrc[0]];
    $lj = 2;
    for($li = 0; $li < 4; $li++)
    {
        if($lj < $arrcs)
        {
            $out[$li] += $arraya[$arrc[$lj]];
            $lj++;
        }
        else
        {
            $out[$li] += $dec[1];
            break;
        }
    }
    if(($a = array_search($arrc[0].$arrc[1], $array)) === false)
    {
        $stop_error_msg .= '<br>Type:"'.$arrc[0].$arrc[1].'" not found.';
        return false;
    }
    $tmp = pack("i", $a).pack("C", $out[3]).pack("C", $out[2]).pack("C", $out[1]).pack("C", $out[0]);
    //$ret = unpack("H8", $tmp);
    //return $ret[1];
    return $tmp;
}

function ccode($code)
{
    if($code == "-1")
    {
        $tmp = pack("H8", "ffffffff");
        return $tmp;
    }
    preg_match("/([A-Z]+)([0-9]+)/", $code, $arr);
    $arrc = str_split($arr[1]);
    $arrd = $arr[2];
    $unp = array();
    $array = array('A'=>0,'B'=>1,'C'=>2,'D'=>3,'E'=>4,'F'=>5,'G'=>6,'H'=>7,'I'=>8,'J'=>9,'K'=>10,'L'=>11,'M'=>12,'N'=>13,'O'=>14,'P'=>15,'Q'=>16,'R'=>17,'S'=>18,'T'=>19,'U'=>20,'V'=>21,'W'=>22,'X'=>23,'Y'=>24,'Z'=>25);
    for($i = 0; $i < 3; $i++)
    {
        $unp[$i] = unpack("H*", pack("C", $array[$arrc[$i]]));
    }
    $unp = str_split("0".$unp[0][1].$unp[1][1].$unp[2][1].$arrd, 2);
    $tmp = pack("H8", $unp[3].$unp[2].$unp[1].$unp[0]);
    //echo "0".$unp[0][1].$unp[1][1].$unp[2][1].$arrd."<br>";
    //$ret = unpack("H8", $tmp);
    //return $ret[1];
    return $tmp;
}

function parser($output, $input, $indexing, $blockheader)
{
    global $typearr, $stop_error_msg;
    $filearray = file($input, FILE_SKIP_EMPTY_LINES);
    $filesize = sizeof($filearray);
    $struct = explode("\t", trim($filearray[0]));
    $col_names = explode("\t", trim($filearray[1]));
    if($blockheader == 1)
    {
        $block = strsize($struct);
        if($indexing == 1)
            $block += 4;
        $filesize_bin = pack("i", ($filesize - 2));
        fwrite($output, $filesize_bin);
        $blockbin = pack("i", $block);
        fwrite($output, $blockbin);
    }
    for($i = 2; $i < $filesize; $i++)
    {
        $store = 0;
        $temporary = explode("\t", trim($filearray[$i]));
        if($indexing == 1)
            fwrite($output, pack("i", $i - 2));
        for($st = 0; $st < count($struct) - 1; $st++)
        {
            if($temporary[$st] == '')
            {
                $stop_error_msg .= "<br>Empty cell. Probably mistake at excel file:<br>ROW:".($i+1)."<br>COLUMN:".($st+1)."<br>NAME:".$col_names[$st]."<br>DATA:".$temporary[$st];
                return false;
            }

            if(stristr($struct[$st], 'string[') !== false)
            {
                preg_match("/^(string\[)?([\d]+)/", $struct[$st], $str_ret);
                if(strlen($temporary[$st]) >= $str_ret[2])
                {
                	$temporary[$st] = substr($temporary[$st], 0, $str_ret[2] - 1);
                  echo "<br>Warning! Text overflow. Tail of string had been cut: ROW:".($i+1)." COLUMN:".($st+1)." NAME:".$col_names[$st]." DATA:'".$temporary[$st]. "' SIZE:". $str_ret[2];
                }
                //if(strlen($temporary[$st]) >= 255 && stristr($input, 'Desc') !== false)
               // {
               //     echo "<br>Warning! Exceeded max length of 255 symbols at item description. Tail of string wont be shown in game: ROW:".($i+1)." COLUMN:".($st+1)." NAME:".$col_names[$st]." DATA:'".$temporary[$st]. "' SIZE:". $str_ret[2];
                    //$temporary[$st] = substr($temporary[$st], 0, 254);
               // }
                $resulthex = pack("a".$str_ret[2], trim(str_replace("\x22\x22\x22\x22", "\x22\x22", $temporary[$st]), "\x22"));
                fwrite($output, $resulthex);
                continue;
            }
            $type = $typearr[$struct[$st]]['type'];
            switch($type)
            {
                case "xeh":
                    $resulthex = xeh($temporary[$st]);
                    break;
                case "xeh64":
                    $resulthex = xeh64($temporary[$st]);
                    break;
                case "clcode":
                    $resulthex = clcode($temporary[$st]);
                    break;
                case "exclcode":
                    if(($resulthex = exclcode($temporary[$st])) === false)
                    {
                        $stop_error_msg .= " Probably mistake at excel file:<br>ROW:".($i+1)."<br>COLUMN:".($st+1)."<br>NAME:".$col_names[$st]."<br>DATA:".$temporary[$st];
                        return false;
                    }
                    break;
                case "ccode":
                    $resulthex = ccode($temporary[$st]);
                    break;
                case "f":
                case "d":
                    $trans = array("," => ".");
                    $resulthex = pack($type, strtr("".$temporary[$st]."", $trans));
                    break;
                case "bulltype":
                    if(($resulthex = bulltype($temporary[$st])) === false)
                    {
                        $stop_error_msg .= " Probably mistake at excel file:<br>ROW:".($i+1)."<br>COLUMN:".($st+1)."<br>NAME:".$col_names[$st]."<br>DATA:".$temporary[$st];
                        return false;
                    }
                    break;
                case "bttype":
                    if(($resulthex = bttype($temporary[$st])) === false)
                    {
                        $stop_error_msg .= " Probably mistake at excel file:<br>ROW:".($i+1)."<br>COLUMN:".($st+1)."<br>NAME:".$col_names[$st]."<br>DATA:".$temporary[$st];
                        return false;
                    }
                    break;
                case "effbttype":
                    if(($resulthex = effbttype($temporary[$st])) === false)
                    {
                        $stop_error_msg .= " Probably mistake at excel file:<br>ROW:".($i+1)."<br>COLUMN:".($st+1)."<br>NAME:".$col_names[$st]."<br>DATA:".$temporary[$st];
                        return false;
                    }
                    break;
                case "stb":
                    if(($resulthex = stb($temporary[$st])) === false)
                    {
                        $stop_error_msg .= " Probably mistake at excel file:<br>ROW:".($i+1)."<br>COLUMN:".($st+1)."<br>NAME:".$col_names[$st]."<br>DATA:".$temporary[$st];
                        return false;
                    }
                    break;
                case "stb4":
                    if(($resulthex = stb4($temporary[$st])) === false)
                    {
                        $stop_error_msg .= " Probably mistake at excel file:<br>ROW:".($i+1)."<br>COLUMN:".($st+1)."<br>NAME:".$col_names[$st]."<br>DATA:".$temporary[$st];
                        return false;
                    }
                    break;
                case "stb12":
                    if(($resulthex = stb12($temporary[$st])) === false)
                    {
                        $stop_error_msg .= " Probably mistake at excel file:<br>ROW:".($i+1)."<br>COLUMN:".($st+1)."<br>NAME:".$col_names[$st]."<br>DATA:".$temporary[$st];
                        return false;
                    }
                    break;
                case "stb16":
                    if(($resulthex = stb16($temporary[$st])) === false)
                    {
                        $stop_error_msg .= " Probably mistake at excel file:<br>ROW:".($i+1)."<br>COLUMN:".($st+1)."<br>NAME:".$col_names[$st]."<br>DATA:".$temporary[$st];
                        return false;
                    }
                    break;
                case "res":
                    $resulthex = resource($temporary[0]);
                    break;
                case "qitid":
                    $resulthex = qitid($temporary[$st]);
                    break;
                case "lqitem":
                    $resulthex = lqitem($temporary[$st]);
                    break;
                case "store":
                    $maxVal = isset($temporary[10]) ? $temporary[10] : "0";
                    if (($resulthex = store($temporary[$st], $store, $maxVal)) === false)
                    {
                        $stop_error_msg .= " Probably mistake at excel file:<br>ROW:".($i+1)."<br>COLUMN:".($st+1)."<br>NAME:".$col_names[$st]."<br>DATA:".$temporary[$st];
                        return false;
                    }
                    $store++;
                    break;
                case "qcode":
                    $resulthex = qcode($temporary[$st]);
                    break;
                case "spcode":
                    $resulthex = spcode($temporary[$st]);
                    break;
                case "text":
                    $len = strlen($temporary[$st]);
                    $len = $len + 1;
                    $resulthex=pack("a".$len, $temporary[$st]);
                    $plen=pack("i", $len);
                    fwrite($output, $plen);
                    break;
                case "param":
                    if(($resulthex = param($temporary[$st], $temporary[$st+1])) === false)
                    {
                        $stop_error_msg .= " Probably mistake at excel file:<br>ROW:".($i+1)."<br>COLUMN:".($st+1)."<br>NAME:".$col_names[$st]."<br>DATA:".$temporary[$st];
                        return false;
                    }
                    $st++;
                    break;
                default:
                    //echo $type." ".$temporary[$st]."<br>";
                    $resulthex = pack($type, $temporary[$st]);
            }
            $err_arr = error_get_last();
            if(!is_null($err_arr))
            {
                if(stristr('function.date', $err_arr['Message']) !== false)
                {
                    $stop_error_msg .= "<br>Pack error. Probably mistake at excel file:<br>ROW:".($i+1)."<br>COLUMN:".($st+1)."<br>NAME:".$col_names[$st]."<br>DATA:".$temporary[$st];
                    return false;
                }
            }
            fwrite($output, $resulthex);
        }
    }
    return true;
}

function qcode($code)
{
    if($code == "-1" || $code == "0")
    {
        $tmp2 = pack("i", "-1");
        return $tmp2;
    }
    else
    {
        $arr2 = str_split($code);
        $tmp2 = pack("H6", $arr2[5].$arr2[6].$arr2[3].$arr2[4].$arr2[1].$arr2[2]).pack("H2", "10");
        return $tmp2;
    }
}

function dval($code, $list)
{
    global $stop, $array;
    if(is_numeric($code) && $list == 1)
    {
        $tmp2 = pack("i", $code).pack("i", 0);
        return $tmp2;
    }
    elseif(is_numeric($code))
    {
        $tmp2 = xeh($code).pack("i", 0);
        return $tmp2;
    }
    elseif(strlen($code) == 4)
    {
        $tmp2 = ccode($code).pack("i", 0);
        return $tmp2;
    }
    else
    {
        $arr2 = str_split($code);
        $type = $arr2[0].$arr2[1];
        $a=0;
        while($array[$a]!=$type && $a!=37)
        {
            $a++;
        }
        if($a == 37)
        {
            $stop = true;
            echo "Undefined item type founded at function dval:".$type."<br>";
            flush();
            return false;
        }
        else
        {
            $tmp2 = clcode($code).pack("i", $a);
            return $tmp2;
        }
    }
}

function store($code, $pos, $max)
{
    if($code == "0" && $pos < $max)
    {
        $tmp2 = pack("H16", "ff000000ffffffff");
        return $tmp2;
    }
    elseif($code == "0")
    {
        $tmp2 = pack("H16", "0000000000000000");
        return $tmp2;
    }
    else
    {
        $tmp2 = exclcode($code);
        return $tmp2;
    }
}

function lqitem($code)
{
    $arr2 = str_split($code);
    $tmp2 = pack("H4", $arr2[5].$arr2[6].$arr2[3].$arr2[4]).pack("a2", $arr2[0].$arr2[1]);
    return $tmp2;
}

function param($param1, $param2)
{
    $arr = str_split($param1);
    $len = strlen($param1);
    if($arr[0] == "Q")
    {
        $tmp = pack("i", 0).pack("i", "-1").pack("i", 0);
        return $tmp;
    }
    elseif($len == 7)
    {
        $tmp = exclcode($param1).pack("i", 0);
        return $tmp;
    }
    elseif($param2 == "-1")
    {
        $tmp = xeh($param1).pack("i", "-1").pack("i", 0);
        return $tmp;
    }
    else
    {
        $tmp = xeh($param1).exclcode($param2);
        return $tmp;
    }
}

function qitid($code)
{
    global $installpath, $stop;
    $fl = file($installpath."in\\Quest.edf\\QuestItem.txt", FILE_SKIP_EMPTY_LINES);
    $r = 2;
    $trow = explode("\t", trim($fl[$r]));
    if($code == "-1" || $code == "0")
    {
        $tmp = pack("i", "-1");
        return $tmp;
    }
    else
    {
        while($code != $trow[0] && $r != sizeof($fl))
        {
            $r++;
            $trow = explode("\t", trim($fl[$r]));
        }
        if($r == sizeof($fl))
        {
            $stop = true;
            echo "Quest item not found<br>";
            flush();
            $tmp = pack("i", 0);
            return $tmp;
        }
        else
        {
            $tmp = pack("i", $r-2);
            return $tmp;
        }
    }
}

function rule($str)
{
    if($str == "0000")
    {
        $i = 1;
        $str2 = "0";
        while($i != 72)
        {
            $str2 = $str2."0";
            $i++;
        }
        $packed=pack("H72", $str2);
        return $packed;
    }
    else
    {
        $arr1 = str_split($str,4);
        $arr1s = count($arr1);
        $str2 = pack("c", $arr1s);
        $i = (2 + $arr1s * 4)/2;
        $str2= $str2.pack("H".($i - 1)*2, $str);
        while($i != 36)
        {
            $i++;
            $str2=$str2.pack("H2","00");
        }
        return $str2;
    }
}

function totxtparser($output, $input, $struct)
{
    if(!file_exists($input))
    {
        echo "Not found ".$input."<br>";
        return;
    }
    $fo = fopen($input, "rb");
    $ncount = fread($fo, 4);
    $count = unpack("i", $ncount);
    totxt($fo, $count[1], $output, $struct);
    fclose($fo);
}

function totxt($input, $count, $output, $struct, $skip_index = true, $skip_header = true)
{
    global $typearr;

    $fw = fopen($output, "w+");
    $strfile = file($struct, FILE_SKIP_EMPTY_LINES);
    $str = explode("\t", trim($strfile[0]));
    fwrite($fw, $strfile[0].$strfile[1]);
    if($skip_header)
        fseek($input, 8, SEEK_CUR);
    for($i = 0; $i < $count; $i++)
    {
        if($skip_index)
            fseek($input, 4, SEEK_CUR);
        for($j = 0; $j < count($str) - 1; $j++)
        {
            preg_match("/^(string\[)?([\d]+)/", $str[$j], $str_ret);
            if (!empty($str_ret[1]) && $str_ret[1] === "string[") {
    		$indata = fread($input, $str_ret[2]);
    		$findme = "\x00";
    		$pos = strpos($indata, $findme);
    		$pos = ($pos === 0) ? "*" : $pos;
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
            $indata = fread($input, $typearr[$str[$j]]['size']);
            $unpdata = unpack($typearr[$str[$j]]['type'], $indata);
            if($typearr[$str[$j]]['type'] == "f" || $typearr[$str[$j]]['type'] == "d")
            {
    		$floatVal = (float)$unpdata[1];

    		if (fmod($floatVal, 1.0) === 0.0) {
        		$unpdata[1] = (string)(int)$floatVal;
    		} else {
        		$unpdata[1] = sprintf('%.12g', $floatVal);//use php 5 style: up to 12 significant digits
    		}
		}
            fwrite($fw, $unpdata[1]."\t");
        }
        fwrite($fw, "\r\n");
    }
    fclose($fw);
}

function unxeh64($str)
{
    $unp = unpack("H*", $str);
    $arr1 = str_split($unp[1], 2);
    $str = $arr1[7].$arr1[6].$arr1[5].$arr1[4].$arr1[3].$arr1[2].$arr1[1].$arr1[0];
    $str = base_convert($str, 16, 10);
    return $str;
}

function unxeh($str)
{
    $arr1 = str_split($str, 2);
    $packed = $arr1[3].$arr1[2].$arr1[1].$arr1[0];
    return $packed;
}

function check($code)
{
    $arr = str_split($code);
    if($arr[0].$arr[1] == "LL")
    {
        return true;
    }
    else
    {
        return false;
    }
}

function linst($code)
{
    global $linkarr;
    $result = pack("i", 255).pack("i", $linkarr[$code]).pack("i", "-1");
    return $result;
}

function lcode($code)
{
    global $array;
    if($code == "-1"){
        $ret = pack("i", 0).pack("i", 0).pack("i", 0);
        return $ret;
    }
    else
    {
        $arr = str_split($code);
        $type = $arr[0].$arr[1];
        $h=0;
        while($array[$h]!=$type && $h!=37){
            $h++;
        }
        if($h == 37){
            echo "Undefined item type founded at function: lcode<br>";
            flush();
            return false;
        }
        else{
            $tmp2 = pack("i", $h).pack("i", 0).clcode($code);
            return $tmp2;
        }
    }
}

function spcode($str)
{
    global $monai;
    $res = '';
    if($str == '-1')
        $res .= pack('ii', 0, 0);
    else
        $res .= pack("i", $monai[$str][0]).xeh($monai[$str][1]);
    return $res;
}

function str_check($code)
{
    $pos = 0;
    switch($code)
    {
        case "Class":
            $pos = 15;
            break;
        case "MonsterCharacter":
            $pos = 1;
            break;
        case "FaceItem":
            $pos = 3;
            break;
        case "UpperItem":
        case "LowerItem":
        case "GauntletItem":
        case "ShoeItem":
        case "HelmetItem":
        case "WeaponItem":
        case "shielDItem":
        case "cloaKItem":
        case "rIngItem":
        case "AmuletItem":
        case "BulletItem":
        case "MakeToolItem":
        case "PotionItem":
        case "bagItem":
        case "baTteryItem":
        case "OreItem":
        case "ResourceItem":
        case "forCeItem":
        case "UnitkeyItem":
        case "bootYItem":
        case "MAPItem":
        case "TOWNItem":
        case "BattleDungeonItem":
        case "AnimusItem":
            $pos = 4;
            break;
        case "GuardTowerItem":
            $pos = 3;
            break;
        case "TrapItem":
            $pos = 5;
            break;
        case "SiegeKitItem":
        case "TicketItem":
            $pos = 4;
            break;
        case "EventItem":
            $pos = 2;
            break;
        case "RecoveryItem":
        case "BoxItem":
        case "FIrecracker":
        case "UNmannedminer":
        case "RadarItem":
        case "NPCLinkItem":
        case "CouponItem":
            $pos = 4;
            break;
        case "UnitHead":
        case "UnitUpper":
        case "UnitLower":
        case "UnitArms":
        case "UnitShoulder":
        case "UnitBack":
        case "UnitBullet":
            $pos = 3;
            break;
        case "QuestItem":
            $pos = 2;
            break;
        case "StoreList":
            $pos = 3;
            break;
        case "BulletItemEffect":
        case "PotionItemEffect":
        case "Skill":
        case "ClassSkill":
        case "Force":
            $pos = 6;
            break;
        case "PlayerCharacter":
        case "NPCharacter":
            $pos = 1;
            break;
    }
    return $pos;
}

function proceed($path)
{
    global $installpath, $stop_error_msg;
    $stop = false;
    $spt = "\\\\";
    $arr = explode($spt, trim($path));
    $max = (count($arr) - 1);
    if(!$stop)
    {
        $fp = fopen($installpath."out\\ServerScript\\".$arr[$max].".dat", "w+");
        $decrypt = $installpath.trim($path).".txt";
        $struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
        $schet = sizeof($struct_load);
        fwrite($fp, pack("i", ($schet-2)));
        $row = explode("\t", trim($struct_load[0]));
        fwrite($fp, pack("i", count($row)));
        $block = strsize($row) + 4;
        $blockhex = pack("i", $block);
        fwrite($fp, $blockhex);
        if(!parser($fp, $decrypt, 1, 0))
        {
            die($stop_error_msg);
        }
        fclose($fp);
        $pos = str_check($arr[$max]);
        if($pos != 0)
        {
            $fp = fopen($installpath."out\\ServerScript\\".$arr[$max]."_str.dat", "w+");
            fwrite($fp, pack("i", ($schet-2)));
            if(defined('GU'))
            {
                fwrite($fp, pack("i", 13));
                fwrite($fp, pack("i", 772));
            }
            else
            {
                fwrite($fp, pack("i", 11));
                fwrite($fp, pack("i", 644));
            }
            for($i = 2; $i < $schet; $i++)
            {
                $row = explode("\t", trim($struct_load[$i]));
                //fwrite($fp, pack("i", ($i-2)).pack("a64", $row[0]).pack("a64", " ").pack("a64", " ").pack("a64", " ").pack("a64", " ").pack("a64", " ").pack("a64", " ").pack("a64", " ").pack("a64", $row[$pos]).pack("a64", " "));
                fwrite($fp, pack("i", ($i-2)).pack("a64", $row[0]).pack("a64", " ").pack("a64", " ").pack("a64", " ").pack("a64", $row[$pos]).pack("a64", " ").pack("a64", " ").pack("a64", " ").pack("a64", " ").pack("a64", " "));
                if(defined('GU'))
                    fwrite($fp, pack("a64", " ").pack("a64", " "));
            }
            fclose($fp);
        }
    }
    return $stop;
}

function mapclcode($code)
{
    global $array;
    $tmp = array();
    if($code == "0" || $code == "-1")
    {
        $tmp[0] = pack("H2", "ff");
        $tmp[1] = pack("H8", "ffffffff");
        return $tmp;
    }
    preg_match("/([a-z]+)([0-9]+)/", $code, $arr);
    $arrc = str_split($arr[1]);
    $arrd = str_split($arr[2]);
    $arrcs = count($arrc);
    $arrds = count($arrd) - 1;
    $hex = pack("H2", $arrd[$arrds-1].$arrd[$arrds]);
    $dec = unpack("C", $hex);
    $out = array(0 => 0, 1 => 0, 2 => 0, 3 => 0);
    $arraya = array('a'=>0,'b'=>1,'c'=>2,'d'=>3,'e'=>4,'f'=>5,'g'=>6,'h'=>7,'i'=>8,'j'=>9,'k'=>10,'l'=>11,'m'=>12,'n'=>13,'o'=>14,'p'=>15,'q'=>16,'r'=>17,'s'=>18,'t'=>19,'u'=>20,'v'=>21,'w'=>22,'x'=>23,'y'=>24,'z'=>25);
    $arrays = array('a'=>4,'b'=>5,'c'=>6,'d'=>7,'e'=>8,'f'=>9,'g'=>10,'h'=>11,'i'=>12,'j'=>13,'k'=>14,'l'=>15,'m'=>0,'n'=>1,'o'=>2,'p'=>3,'q'=>4,'r'=>5,'s'=>6,'t'=>7,'u'=>8,'v'=>9,'w'=>10,'x'=>11,'y'=>12,'z'=>13);
    $out[0] = 16 * $arrays[$arrc[0]];
    $lj = 2;
    for($li = 0; $li < 4; $li++)
    {
        if($lj < $arrcs)
        {
            $out[$li] += $arraya[$arrc[$lj]];
            $lj++;
        }
        else
        {
            $out[$li] += $dec[1];
            break;
        }
    }
    $a = 0;
    while($array[$a] != $arrc[0].$arrc[1] && $a!=37)
    {
        $a++;
    }
    if($a == 37)
    {
        echo "Undefined item type founded at function: mapclcode ".$arrc[0].$arrc[1]."<br>";
        flush();
    }
    $tmp[0] = pack("C", $a);
    $tmp[1] = pack("C", $out[3]).pack("C", $out[2]).pack("C", $out[1]).pack("C", $out[0]);
    return $tmp;
}

function cstrcut($str) // removes garbage after null char
{
    return substr($str,0,strpos($str,"\0"));
}

function findmapfiles($path)
{
    $d = dir($path);
    while($file = $d->read())
    {
        if ($file != "." && $file != "..")
        {
            $e = explode("_", $file, 2);
            if (is_dir($path."/".$file) || stristr($e[1], ".txt") === false || !is_numeric($e[0]))
            {
                continue;
            }
            else
            {
                $fhmap = file($path."/".$file, FILE_SKIP_EMPTY_LINES);
                if(stristr($fhmap[0], "[MAP]") !== false)
                {
                    $filearr[$e[0]] = $e[1];
                }
            }
        }
    }
    $d->close();
    $i = 0;
    while(isset($filearr[$i]))
    {
        $i++;
    }
    if(sizeof($filearr) != $i || sizeof($filearr) == 0)
    {
        return false;
    }
    return $filearr;
}