<?php
$conn = new mysqli("localhost", "", "", "swarajya_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password']; // सुरक्षेसाठी पासवर्ड हॅश करणे चांगले असते

    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        if ($conn->errno == 1062) {
            echo "Username already exists!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
$conn->close();
?>