<?php
header("Content-Type: application/json");

// $input = "3173080302960006";
$input = $_GET['decrypted'];

$data = [
    'sha1' => hash("sha1", $input)
];

echo json_encode($data);

?>