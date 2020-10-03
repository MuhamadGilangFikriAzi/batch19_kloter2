<?php

function cetakGambar($length){
    $pattern = [
        even($length),
        odd($length)        
    ];

    for ($i=0; $i < $length; $i++) { 
        $oddEven = $i % 2;
                
        foreach ($pattern[$oddEven] as $key => $value) {
            echo $value. '&nbsp';
        }
        echo '<br>';
    }
}

function odd($number){
    $array = [];
    for ($i=0; $i < $number; $i++) {         
        if($i % 2 == 0){
            array_push($array, '*');
        }else{
            array_push($array, '=');
        }                 
    }        
    return $array;
}

function even($number){
    $array = [];
    for ($i=1; $i <= $number; $i++) { 
        
        if($i % 2 == 0 && $i % 3 != 0){
            array_push($array, '*');
        }elseif($i % 3 == 0){
            array_push($array, '=');
        }else{
            array_push($array, '*');
        }                     
    }    
    return $array;
}

cetakGambar(8);

?>