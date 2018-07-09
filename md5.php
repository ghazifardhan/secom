<?php
header("Content-Type: application/json");

// $input = "3173080302960006";
$input = $_GET['decrypted'];

$data = [
    'md5' => md5($input)
];

echo json_encode($data);

?>