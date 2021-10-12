<?php
session_start();
if (isset($_SESSION['result_table'])) {
    foreach ($_SESSION['result_table'] as $line) {
        if($line[5]){
            print_r('<tr class="hit"><td class="res-table-X-clmn">'.$line[0].'</td><td class="res-table-Y-clmn">'.$line[1].'</td><td class="res-table-R-clmn">'.$line[2].'</td><td class="res-table-extime-clmn">'.$line[3].'</td><td class="res-table-systime-clmn">'.$line[4].'</td></tr>');
        }
        else{
            print_r('<tr class="miss"><td class="res-table-X-clmn">'.$line[0].'</td><td class="res-table-Y-clmn">'.$line[1].'</td><td class="res-table-R-clmn">'.$line[2].'</td><td class="res-table-extime-clmn">'.$line[3].'</td><td class="res-table-systime-clmn">'.$line[4].'</td></tr>');
        }
    }
}?>