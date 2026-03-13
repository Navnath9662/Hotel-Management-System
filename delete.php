<?php
$conn = new mysqli("localhost", "root", "navnath9662", "swarajya_db");

if (isset($_GET['id']) && isset($_GET['type'])) {
    
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $type = $_GET['type'];
    $sql = "";

    // तुमच्या सांगण्यानुसार प्रत्येक टेबलसाठी वेगळा ID कॉलम सेट केला आहे
    if ($type == "order") {
        $sql = "DELETE FROM orders WHERE id = $id";
    } elseif ($type == "review") {
        $sql = "DELETE FROM hotel_reviews WHERE id = $id";
    } elseif ($type == "reservation") {
        $sql = "DELETE FROM reservations WHERE res_id = $id"; // इथे res_id वापरला आहे
    } elseif ($type == "contact") {
        $sql = "DELETE FROM contact_messages WHERE id = $id";
    } elseif ($type == "user") {
        $sql = "DELETE FROM users WHERE user_id = $id"; // इथे user_id वापरला आहे
    }

    if (!empty($sql)) {
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('यशस्वीरित्या डिलीट केले!');
                    window.location.href = 'admin_dashboard.php';
                  </script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
$conn->close();
?>