<?php

global $conn;

require_once 'connect/cn-db-sqli.php';

$sql = "
    CREATE TABLE myasmphp (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        img VARCHAR(255) NOT NULL,
        name VARCHAR(50) NOT NULL,
        hang VARCHAR(50),
        gia INT(30),
        theloai VARCHAR(50),
        tinhnang VARCHAR(50),
        mota VARCHAR(200)
        
    )
";

// $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating Table: " . $conn->error;
}

require_once 'connect/close-sqli.php';
