<?php

session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: main.php"); 
    exit();
}
$conn = new mysqli("localhost", "root", "navnath9662", "swarajya_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// १. Orders (कॉलम: id)
$orders = $conn->query("SELECT * FROM orders ORDER BY id DESC"); 

// २. Reservations (कॉलम: res_id) - तुमच्या स्क्रीनशॉटनुसार
$reservations = $conn->query("SELECT * FROM reservations ORDER BY res_id DESC");

// ३. Hotel Reviews (कॉलम: id)
$reviews = $conn->query("SELECT * FROM hotel_reviews ORDER BY id DESC");

// ४. Contact Messages (कॉलम: id) - तुमच्या स्क्रीनशॉटनुसार
$contacts = $conn->query("SELECT * FROM contact_messages ORDER BY id DESC");

// ५. Users (कॉलम: user_id) - तुमच्या स्क्रीनशॉटनुसार
$users = $conn->query("SELECT * FROM users ORDER BY user_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Swaraj | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0faddc1af8.js" crossorigin="anonymous"></script> 
    <style>
        body { background-color: #1a1d20; color: #f8f9fa; }
        .nav-tabs .nav-link { color: #f8f9fa; background-color: #2c3136; border: none; margin-right: 5px; }
        .nav-tabs .nav-link.active { color: #ffc107; background-color: #343a40; border-bottom: 3px solid #ffc107; }
        .tab-content { background-color: #2c3136; padding: 25px; border-radius: 0 8px 8px 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.3); }
        .table { --bs-table-bg: #343a40; color: #f8f9fa; vertical-align: middle; }
        .btn-delete { color: #dc3545; cursor: pointer; border: none; background: none; text-decoration: none; }
        .btn-delete:hover { color: #ff4d5e; }
    </style>
</head>
<body>
    <div class="container-fluid px-4 mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-warning"><i class="fas fa-crown me-2"></i> स्वराज्य Admin Dashboard</h1>
            <a href="index.html" class="btn btn-outline-warning"><i class="fas fa-home me-1"></i> View Website</a>
        </div>

        <ul class="nav nav-tabs" id="adminTabs" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#orders-tab"><i class="fas fa-shopping-cart me-1"></i> Orders</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#reservations-tab"><i class="fas fa-chair me-1"></i> Table Booking</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews-tab"><i class="fas fa-star me-1"></i> Reviews</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#contacts-tab"><i class="fas fa-envelope me-1"></i> Contacts</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#users-tab"><i class="fas fa-users me-1"></i> Users</button></li>
        </ul>

        <div class="tab-content mt-1">
            
            <div class="tab-pane fade show active" id="orders-tab">
                <h3 class="mb-3 text-info">Food Orders</h3>
                <table class="table table-hover">
                    <thead><tr><th>ID</th><th>Customer</th><th>Item</th><th>Category</th><th>Action</th></tr></thead>
                    <tbody>
                        <?php while($row = $orders->fetch_assoc()): ?>
                        <tr>
                            <td>#<?= $row['id'] ?></td>
                            <td><?= $row['customer_name'] ?></td>
                            <td><span class="badge bg-primary"><?= $row['item_name'] ?></span></td>
                            <td><?= $row['category'] ?></td>
                            <td><a href="delete.php?type=order&id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Delete order?')"><i class="fas fa-trash"></i></a></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="reservations-tab">
                <h3 class="mb-3 text-info">Table Bookings</h3>
                <table class="table table-hover">
                    <thead><tr><th>Res ID</th><th>Customer</th><th>Email</th><th>Guests</th><th>Date/Time</th><th>Action</th></tr></thead>
                    <tbody>
                        <?php while($row = $reservations->fetch_assoc()): ?>
                        <tr>
                            <td>#<?= $row['res_id'] ?></td>
                            <td><?= $row['customer_name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['guest_count'] ?> Persons</td>
                            <td><?= $row['res_date'] ?> (<?= $row['res_time'] ?>)</td>
                            <td><a href="delete.php?type=reservation&id=<?= $row['res_id'] ?>" class="btn-delete"><i class="fas fa-trash"></i></a></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="reviews-tab">
                <h3 class="mb-3 text-info">Customer Reviews</h3>
                <table class="table table-hover">
                    <thead><tr><th>Customer</th><th>Rating</th><th>Message</th><th>Type</th><th>Action</th></tr></thead>
                    <tbody>
                        <?php while($row = $reviews->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['customer_name'] ?></td>
                            <td class="text-warning"><?= str_repeat("⭐", (int)$row['rating']) ?></td>
                            <td><?= $row['review_text'] ?></td>
                            <td><span class="badge bg-secondary"><?= $row['category'] ?></span></td>
                            <td><a href="delete.php?type=review&id=<?= $row['id'] ?>" class="btn-delete"><i class="fas fa-trash"></i></a></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="contacts-tab">
                <h3 class="mb-3 text-info">Messages</h3>
                <table class="table table-hover">
                    <thead><tr><th>Name</th><th>Email</th><th>Message</th><th>Date</th><th>Action</th></tr></thead>
                    <tbody>
                        <?php while($row = $contacts->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['customer_name'] ?></td>
                            <td><?= $row['customer_email'] ?></td>
                            <td><?= $row['customer_msg'] ?></td>
                            <td><?= $row['submitted_at'] ?></td>
                            <td><a href="delete.php?type=contact&id=<?= $row['id'] ?>" class="btn-delete"><i class="fas fa-trash"></i></a></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="users-tab">
                <h3 class="mb-3 text-info">Registered Users</h3>
                <table class="table table-hover">
                    <thead><tr><th>User ID</th><th>Username</th><th>Created At</th><th>Action</th></tr></thead>
                    <tbody>
                        <?php while($row = $users->fetch_assoc()): ?>
                        <tr>
                            <td>#<?= $row['user_id'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['created_at'] ?></td>
                            <td><a href="delete.php?type=user&id=<?= $row['user_id'] ?>" class="btn-delete"><i class="fas fa-trash"></i></a></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>