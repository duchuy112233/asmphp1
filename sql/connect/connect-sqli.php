<?php

$servername = 'localhost';
$username = 'root';
$password = '';


// Connect By MYSQLi
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("connect failed" . $conn->connect_error);
}