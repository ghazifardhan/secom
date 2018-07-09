<?php
header("Content-Type: application/json");

// PERINTAHSUDAHSAYATERIMADANSIAPLAKSANAKAN

$alpha = $key = range('A', 'Z');

$encrypted = $_GET['encrypted'];
$decrypted = $_GET['decrypted'];
$key = $_GET['key'];

if(empty($encrypted) && !empty($decrypted)){
    $text = $decrypted;
    
    $text_count = strlen($text);
    $text_array = str_split($text);
    $type = 'plain';

    for($i=0;$i<$text_count;$i++){
        $indexA = array_search($text_array[$i], $alpha);
        $resIndex = ($indexA + $key) % 26;
        $test[$i] = $resIndex; 
        $alp = $alpha[$resIndex];
        
        $chiper[$i] = $alp;
    }
} else {
    $text = $encrypted;
    
    $text_count = strlen($text);
    $text_array = str_split($text);
    $type = 'chiper';

    for($i=0;$i<$text_count;$i++){
        $indexA = array_search($text_array[$i], $alpha);
        $resIndex = ($indexA - $key) % 26 < 0 ? (($indexA - $key) % 26) + 26 : ($indexA - $key) % 26;
        // $test[$i] = ($indexA - $key) % 26 < 0 ? $resIndex += 26 : $resIndex;
        $alp = $alpha[$resIndex];
        
        $chiper[$i] = $alp;
    }
}

$data = [
    'text' => $text,
    'key' => $key,
    'text_count' => strlen($text),
    'result' => implode($chiper),
    'type' => $type,
    'test' => $test
];

echo json_encode($data);
