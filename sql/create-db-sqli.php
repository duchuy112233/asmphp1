<?php

global $conn;

require_once 'connect/connect-sqli.php';

$sql = "CREATE DATABASE asmphp";

// $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Kết nối thàng công";
} else {
    echo "Kết nối không thành công: " . $conn->error;
}

require_once 'connect/close-sqli.php';