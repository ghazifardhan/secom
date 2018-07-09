<?php
header("Content-Type: application/json");
// SHSMEADYIAKDZARLXDCUAUQIXOGQURRDT
// STEGANOGRAPHYADALAHSEBUAHMETODEPENYAMARANPESAN
// CICGRVTLCSOJLBXPMRKPVZLGLEUJRRTHSVCH

$alpha = $key = range('A', 'Z');

$encrypted = $_GET['encrypted'];
$decrypted = $_GET['decrypted'];
$key = $_GET['key'];

if(empty($encrypted) && !empty($decrypted)){
    $text = $decrypted;
    $text_count = strlen($text);
    $key_count = strlen($key);
    $type = 'plain';

    if($text_count >= $key_count){
        $x = $text_count/$key_count;
    }

    for($i=0;$i<ceil($x);$i++){
        $key_update .= $key;
    }

    $key_update = substr($key_update, 0, $text_count);

    $text_array = str_split($text);
    $key_array = str_split($key_update);

    for($i=0;$i<$text_count;$i++){
        $indexA = array_search($text_array[$i], $alpha);
        $indexB = array_search($key_array[$i], $alpha);
        $resIndex = $indexA + $indexB;
        if($resIndex >= 26){
            $resIndex -= 26;
            $alp = $alpha[$resIndex];
        } else {
            // $resIndex += 26;
            $alp = $alpha[$resIndex];
        }
        $chiper[$i] = $alp;
    }

} else {
    $text = $encrypted;
    $text_count = strlen($text);
    $key_count = strlen($key);
    $type = 'chiper';

    if($text_count >= $key_count){
        $x = $text_count/$key_count;
    }

    for($i=0;$i<ceil($x);$i++){
        $key_update .= $key;
    }

    $key_update = substr($key_update, 0, $text_count);

    $text_array = str_split($text);
    $key_array = str_split($key_update);

    for($i=0;$i<$text_count;$i++){
        $indexA = array_search($text_array[$i], $alpha);
        $indexB = array_search($key_array[$i], $alpha);
        $resIndex = $indexA - $indexB;
        if($resIndex >= 0){
            $alp = $alpha[$resIndex];
        } else {
            $resIndex += 26;
            $alp = $alpha[$resIndex];
        }
        $chiper[$i] = $alp;
    }
}

$data = [
    'text' => $text,
    'key' => $key,
    'text_count' => strlen($text),
    'key_count' => $key_count,
    'x' => ceil($x),
    'key_update' => $key_update,
    'result' => implode($chiper),
    'type' => $type
];

echo json_encode($data);

?>