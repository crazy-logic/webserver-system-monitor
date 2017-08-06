<?php



$proc = file('/proc/stat'); 

$cpucount=0;
$cpuinfo;
$cputotals=array();
$li=0;
foreach($proc as $line)
{
    $data=explode(" ", $line);
    if(preg_match("/cpu[0-9]/", $data[0])==1)
    {
        $cpucount++;
        $cpuinfo[0]=$data[0];
        $cpuinfo[1]=$data[1]; //user
        $cpuinfo[2]=$data[2]; //nice
        $cpuinfo[3]=$data[3]; //system
        $cpuinfo[4]=$data[4]; //idle
        $total=$cpuinfo[1]+$cpuinfo[2]+$cpuinfo[3]+$cpuinfo[4];
        $used = $total-$cpuinfo[4];
        //echo $cpuinfo[0]." ".round($used / $total * 100, 1)."</br>";
        $cputotals[$li]['cpu']=$data[0];
        $cputotals[$li]['used']=$used;
        $cputotals[$li]['total']=$total;
    }
    $li++;
}
// echo "cpu count; $cpucount </br>";
 
 
 
usleep(100000);
$proc2 = file('/proc/stat'); 
$cputotals2=array();
$li=0;

foreach($proc2 as $line)
{
    $data=explode(" ", $line);
    if(preg_match("/cpu[0-9]/", $data[0])==1)
    {
        $cpucount++;
        $cpuinfo[0]=$data[0];
        $cpuinfo[1]=$data[1]; //user
        $cpuinfo[2]=$data[2]; //nice
        $cpuinfo[3]=$data[3]; //system
        $cpuinfo[4]=$data[4]; //idle
        $total=$cpuinfo[1]+$cpuinfo[2]+$cpuinfo[3]+$cpuinfo[4];
        $used = $total-$cpuinfo[4];
        //echo $cpuinfo[0]." ".round($used / $total * 100, 1)."</br>";
        //$cputotals2[$li]['cpu']=$data[0];
        $cputotals[$li]['used2']=$used;
        $cputotals[$li]['total2']=$total;
    }
    $li++;
}

//print_r($cputotals);

foreach($cputotals as $cpu)
{
    $useddif=$cpu['used2']-$cpu['used'];
    $totaldif=$cpu['total2']-$cpu['total'];
    $percent = round($useddif / $totaldif * 100, 1);
    echo "$percent";
    break;
}


?>