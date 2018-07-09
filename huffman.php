<?php
header("Content-Type: application/json");
// $input = "31730803029600063173080302960006";
$input = $_GET['input_huffman'];

$inputsplit = str_split($input);

$inputarr = array_count_values($inputsplit);

$i = 0;
foreach($inputarr as $key => $value){
    $newArr[$i++] = [
        'ascii' => $key,
        'total' => $value
    ];
}

$newArrSort = array();
foreach($newArr as $key => $value){
    $newArrSort[$key] = $value['total'];
}

array_multisort($newArrSort, SORT_DESC, $newArr);

$data = [
    "langkah_1" => $newArr
];

$x = 0;
while(count($newArr) > 1){
    if(count($newArr) > 1){
        $newBil = [
            "ascii" => $newArr[count($newArr)-2]["ascii"] . "" . $newArr[count($newArr)-1]["ascii"],
            "total" => $newArr[count($newArr)-1]["total"] + $newArr[count($newArr)-2]["total"],
        ];
        array_pop($newArr);
        array_pop($newArr);
        array_push($newArr, $newBil);
        $newArrSort2 = array();
        foreach($newArr as $key => $value){
            $newArrSort2[$key] = $value['total'];
        }

        array_multisort($newArrSort2, SORT_DESC, $newArr);

        $mynewarr[$x] = $newArr;
    }
    $x++;
}
$data["langkah_2"] = $mynewarr;
// array_push($data, ["langkah_2" => $newArr]);

echo json_encode($data);

?>