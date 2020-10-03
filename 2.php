<?php 

function betweenDays($first, $end){
    $firstDay = new DateTime($first);
    $endDay = new DateTime($end);
    $endDay = $endDay->modify('+1 day');

    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($firstDay, $interval ,$endDay);

    foreach ($dateRange as $key =>  $date) {  
        if($date->format("Y-m-d") == $end){
            $coma = '';
        }else{
            $coma = ', ';
        }
                    
        echo "'".$date->format("Y-m-d")."'" . $coma;
    }
}

betweenDays('2019-11-01', '2019-11-05');

?>