<?php
$servername = "localhost";
$username_db = ""; 
$password_db = ""; 
$dbname = "swarajya_db"; 
$port = 3306; 

$conn = new mysqli($servername, $username_db, $password_db, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // फोटोमधील कॉलम नुसार डेटा घेणे
    $name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $count = mysqli_real_escape_string($conn, $_POST['guest_count']);
    $date = mysqli_real_escape_string($conn, $_POST['res_date']);
    $time = mysqli_real_escape_string($conn, $_POST['res_time']);

    // SQL Query (तुमच्या फोटोमधील कॉलमची नावे वापरली आहेत)
    $sql = "INSERT INTO reservations (customer_name, email, phone, guest_count, res_date, res_time) 
            VALUES ('$name', '$email', '$phone', '$count', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('टेबल बुकिंग यशस्वी झाले!'); window.location.href='main.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>