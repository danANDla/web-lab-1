<?php
session_start();
if (isset($_GET['x-val']) && isset($_GET['y-val']) && isset($_GET['r-val'])) {
    $r = htmlspecialchars($_GET["r-val"]);
    $x = htmlspecialchars($_GET["x-val"]);
    $y = htmlspecialchars($_GET["y-val"]);
    if(validate($x, $y, $r)){
        $x = floatval($x);
        $y = floatval($y);
        $r = floatval($r);
        $cur_time = date('H:i:s', time() - $_GET['date'] * 60);
        result($x, $y, $r, $cur_time);
    }
    else{
        echo "invalid values";
    }
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
    $line = array($x, $y, $r, $ex_time, $cur_time, $res);
    if (!isset($_SESSION['result_table'])) {
        $_SESSION['result_table'] = array();
    }
    array_push($_SESSION['result_table'], $line);
    if($res){
        print_r('<tr class="hit"><td class="res-table-X-clmn">'.$x.'</td><td class="res-table-Y-clmn">'.$y.'</td><td class="res-table-R-clmn">'.$r.'</td><td class="res-table-extime-clmn">'.$ex_time.'</td><td class="res-table-systime-clmn">'.$cur_time.'</td></tr>');
    }
    else{
        print_r('<tr class="miss"><td class="res-table-X-clmn">'.$x.'</td><td class="res-table-Y-clmn">'.$y.'</td><td class="res-table-R-clmn">'.$r.'</td><td class="res-table-extime-clmn">'.$ex_time.'</td><td class="res-table-systime-clmn">'.$cur_time.'</td></tr>');
    }
}

function validate($x, $y, $r){
    $nums = is_numeric($x) && is_numeric($y) && is_numeric($r);
    $nulls = is_null($x) || is_null($y) || is_null($r);
    $x_fl = false;
    $y_fl = false;
    $r_fl = false;
    if($nums && !$nulls){
        if($x==-2 || $x==-1.5 || $x==-1 || $x==-0.5 || $x==0 || $x==2 || $x==1.5 || $x==1 || $x==0.5){
            $x_fl = true;
        }
        if($r==1 || $r==1.5 || $r==2 || $r==2.5 || $r==3){
            $r_fl = true;
        }
        if($y >= -3 && $y <= 3){
            $y_fl = true;
        }
    }
    else{
        return false;
    }
    return $x_fl && $y_fl && $r_fl;
}
?>