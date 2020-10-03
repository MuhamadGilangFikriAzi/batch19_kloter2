<?php 
function totalElement($array){

    $count = count($array);

    for ($i=0; $i < $count; $i++) { 
        $number = $array;
        unset($number[$i]);
        
        echo "angka ".($i + 1) ." : ";
        foreach ($number as $key => $value) {
            echo $value.'+';
        }    
        $total = array_sum($number);
        echo ' = '.$total.'<br>';
        $totalNumber[$i] = $total;
        
    }
    
    $max = max($totalNumber);
    $min = min($totalNumber);
    
    echo 'Nilai terbesar adalah = '. $max;
    echo ' dan nilai terkecil adalah = '.$min;
}

totalElement([1,2,3,4,5]);

?>