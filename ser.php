<?php
if (isset($_GET['x-val']) && isset($_GET['y-val']) && isset($_GET['r-val'])) {

    $r = floatval(htmlspecialchars($_GET["r-val"]));
    $x = floatval(htmlspecialchars($_GET["x-val"]));
    $y = floatval(htmlspecialchars($_GET["y-val"]));

    $cur_time = date('H:i:s', time() - $_GET['date'] * 60);

    result($x, $y, $r, $cur_time);
}

function hitted($x, $y, $r){
    $in_circle=false;
    $in_rect=false;
    $in_triangle=false;
    if($x*$x+$y*$y<=$r*$r && $x<=0 && $y>=0){
        $in_circle=true;
    }
    if($x>=0 && $x<=$r/2 && $y>=0 && $y<=$r){
        $in_rect=true;
    }
    if($x>=0 && $x<=$r/2 && $y>=-$r && $y<=0 && $y>=2*$x-$r){
        $in_triangle=true;
    }

    return $in_triangle || $in_rect || $in_circle;
}

function result($x, $y, $r, $cur_time)
{
    $ex_time = round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 7);
    $cur_time = date('H:i:s', time() - $_GET['date'] * 60);
    $res = hitted($x, $y, $r);
    if($res){
        print_r('<tr class="hit"><td class="res-table-X-clmn">'.$x.'</td><td class="res-table-Y-clmn">'.$y.'</td><td class="res-table-R-clmn">'.$r.'</td><td class="res-table-extime-clmn">'.$ex_time.'</td><td class="res-table-systime-clmn">'.$cur_time.'</td></tr>');
    }
    else{
        print_r('<tr class="miss"><td class="res-table-X-clmn">'.$x.'</td><td class="res-table-Y-clmn">'.$y.'</td><td class="res-table-R-clmn">'.$r.'</td><td class="res-table-extime-clmn">'.$ex_time.'</td><td class="res-table-systime-clmn">'.$cur_time.'</td></tr>');
    }

}