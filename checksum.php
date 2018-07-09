<?php
header("Content-Type: application/json");

// $nim = "3173080302960006";
$nim = $_GET['input'];
$newNim = str_split($nim);

for($i = 0; $i < count($newNim); $i++){
    $ascii += $newNim[$i]+48;
    // echo $newNim[$i] . " = " . decbin($newNim[$i]+48)  . "<br/>";
    $input[$i] = array(
        'ascii' => $newNim[$i],
        'binary' => decbin($newNim[$i]+48)
    );
}

// echo "Total $ascii = " . decbin($ascii) . "<br/>";
$eightBit = (string) decbin($ascii);
$eightBit = substr($eightBit, -8);


// echo "8 bit = " . $eightBit . "<br/>";

$eightBitArr = str_split($eightBit);

for($i = 0; $i < count($eightBitArr); $i++){
    if($eightBitArr[$i] == "0"){
        $eightBitArrInverse[$i] = "1";
    } else {
        $eightBitArrInverse[$i] = "0";
    }
}

$eightBitInverse = implode($eightBitArrInverse);

// echo "Inverse = " . $eightBitInverse . "<br/>";
$eightBitPlusOne = bindec($eightBitInverse) + 1;

// echo "Checksum 8 Bit = " . decbin($eightBitPlusOne) . " atau " . dechex($eightBitPlusOne);
// print_r(str_split($eightBit));
$resultBit = (string) decbin($ascii);

if(strlen($resultBit) < 16){
    $minus = 16 - strlen($resultBit);
    for($i = 0; $i < $minus ; $i++){
        $temp[$i] = 0; 
    }

    $newResultBit = (string) implode($temp) . $resultBit;
    // echo "<br/><br/> 16 bit = " . $newResultBit . "<br/>";
    $sixteenBitArr = str_split($newResultBit);
    
    for($i = 0; $i < count($sixteenBitArr); $i++){
        if($sixteenBitArr[$i] == "0"){
            $sixteenBitArrInverse[$i] = "1";
        } else {
            $sixteenBitArrInverse[$i] = "0";
        }
    }

    $sixteenBitInverse = implode($sixteenBitArrInverse);

    // echo "Inverse = " . $sixteenBitInverse . "<br/>";
    $sixteenBitPlusOne = bindec($sixteenBitInverse) + 1;

    // echo "Checksum 16 Bit = " . decbin($sixteenBitPlusOne) . " atau " . dechex($sixteenBitPlusOne);
}

$data = [
    "input" => $input,
    "total_bit" => decbin($ascii),
    "eight_bit_checksum" => [
        "carry_remove" => $eightBit,
        "inverse" => $eightBitInverse,
        "result" => [
            "binary" => decbin($eightBitPlusOne),
            "hex" => dechex($eightBitPlusOne)
        ]
    ],
    "sixteen_bit_checksum" => [
        "carry_remove" => $newResultBit,
        "inverse" => $sixteenBitInverse,
        "result" => [
            "binary" => decbin($sixteenBitPlusOne),
            "hex" => dechex($sixteenBitPlusOne)
        ]
    ],     
];

echo json_encode($data);

?>