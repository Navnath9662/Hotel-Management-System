<?php
// डेटाबेस कनेक्शन सेटिंग्ज
$servername = "localhost";
$username_db = ""; 
$password_db = ""; 
$dbname = "swarajya_db"; 
$port = 3306; 

// कनेक्शन तयार करणे
$conn = new mysqli($servername, $username_db, $password_db, $dbname, $port);

// कनेक्शन तपासणे
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // फॉर्ममधून डेटा मिळवणे
    $name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $message = mysqli_real_escape_string($conn, $_POST['customer_msg']);

    // SQL Query: डेटा स्टोअर करण्यासाठी
    $sql = "INSERT INTO contact_messages (customer_name, customer_email, customer_msg) 
            VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('तुमचा संदेश आम्हाला मिळाला आहे. आम्ही लवकरच तुमच्याशी संपर्क करू!'); 
                window.location.href='main.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>