<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// डेटाबेस कनेक्शन सेटिंग्ज
$servername = "localhost";
$username = ""; 
$password = "";     
$dbname = "swarajya_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// फॉर्म मधून आलेला डेटा घेणे
$item    = $_POST['item_name'] ?? 'Unknown';
$cat     = $_POST['category'] ?? 'Veg';
$u_name  = $_POST['user_name'] ?? '';
$u_phone = $_POST['user_phone'] ?? '';
$u_addr  = $_POST['user_address'] ?? '';

// SQL Query (Prepared Statement वापरून)
$stmt = $conn->prepare("INSERT INTO orders (item_name, category, customer_name, phone, address) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $item, $cat, $u_name, $u_phone, $u_addr);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
$conn->close();
?>