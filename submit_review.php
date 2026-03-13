<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "swarajya_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // डेटा उपलब्ध आहे की नाही हे तपासणे (Validation)
    $name     = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $rating   = isset($_POST['rating']) ? mysqli_real_escape_string($conn, $_POST['rating']) : 0;
    $review   = isset($_POST['review']) ? mysqli_real_escape_string($conn, $_POST['review']) : '';
    $category = isset($_POST['category']) ? mysqli_real_escape_string($conn, $_POST['category']) : 'General';

    // जर रेटिंग रिकामे नसेल तरच सेव्ह करा
    if (!empty($name) && $rating > 0) {
        $sql = "INSERT INTO hotel_reviews (customer_name, rating, review_text, category) 
                VALUES ('$name', '$rating', '$review', '$category')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('तुमचा रिव्ह्यू यशस्वीरित्या नोंदवला गेला आहे!');
                    window.location.href = document.referrer; 
                  </script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>alert('कृपया सर्व माहिती भरा!'); window.history.back();</script>";
    }
}
$conn->close();
?>