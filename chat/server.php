<?php
session_start();
header('Content-Type: text/event-stream');
header("Cache-Control: no-cache"); 
$data = file_get_contents("chat.txt");

$trimmed = rtrim($data, "\n");

$data_array = explode("\n", $trimmed);

$last_line = end($data_array);

if($last_line != $_SESSION['last_line']){
     echo "data: $last_line\n\n";
    
    $_SESSION['last_line'] = $last_line;
}

echo "retry: 15000\n";
ob_flush();
flush();
?>