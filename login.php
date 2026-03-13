<?php
session_start(); // १. सेशन सुरू करणे (हे सर्वात वर हवे)

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
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // २. जर लॉगिन 'Navnath Mali' चे असेल तर 'is_admin' true करा
        if ($user == "admin" && $pass == "admin123") {
            $_SESSION['is_admin'] = true;
            $_SESSION['username'] = $user;
            
            echo "<script>
                    alert('स्वागत आहे मालक! ॲडमिन डॅशबोर्ड अनलॉक झाला आहे.'); 
                    window.location.href='main.php'; // इकडे main.php केले आहे
                  </script>";
        } else {
            // सामान्य युजरसाठी लॉगिन
            $_SESSION['is_admin'] = false;
            $_SESSION['username'] = $user;

            echo "<script>
                    alert('लॉगिन यशस्वी झाले! स्वराज्यामध्ये आपले स्वागत आहे.'); 
                    window.location.href='main.php'; // इकडे main.php केले आहे
                  </script>";
        }
    } else {
        echo "<script>
                alert('चुकीचा युजरनेम किंवा पासवर्ड! कृपया पुन्हा प्रयत्न करा.'); 
                window.location.href='index.html';
              </script>";
    }
}
$conn->close();
?>