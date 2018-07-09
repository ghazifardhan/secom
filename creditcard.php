<?php

header("Content-Type: application/json");

$input = str_split($_GET['input']);

for($i=0;$i<16;$i++){
    if(($i+1) % 2 == 0){
        $index_even[] = $input[$i];
    } else {
        $index_odd[] = $input[$i];
    }
}

for($i = 0; $i < count($index_odd); $i++){
    $multiply = $index_odd[$i] * 2;
    if($multiply > 9){
        $split = str_split($multiply);
        $implode = $split[0] + $split[1];
        $odd_result[$i] = $implode;
    } else {
        $odd_result[$i] = $multiply;
    }
}

$data = [
    'digit' => $_GET['input'],
    'index_odd' => $index_odd,
    'index_even' => $index_even,
    'odd_result' => $odd_result,
    'total_odd' => array_sum($odd_result),
    'total_even' => array_sum($index_even),
    'odd_plus_even' => array_sum($odd_result) + array_sum($index_even),
    'result' => (array_sum($odd_result) + array_sum($index_even)) % 10 == 0 ? true : false
];

echo json_encode($data);

?>