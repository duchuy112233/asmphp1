<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'asmphp';

// Connect By MYSQLi
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối không thành công" . $conn->connect_error);
}

