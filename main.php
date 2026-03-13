<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>स्वराज्य - अस्सल महाराष्ट्रीयन चव</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Khand:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" />
    <style>

        
        body, h1, h2, h3, .logo { font-family: 'Poppins', 'Khand', sans-serif; }
        .logo { font-size: 2.5rem; font-weight: 700; color: #16a083; }

        /* Table Booking Modal Style */
        #reservation-modal {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.8); z-index: 9999; justify-content: center; align-items: center; padding: 20px;
        }
        .modal-content {
            background: white; padding: 30px; border-radius: 15px; width: 100%; max-width: 450px; position: relative;
        }
        .modal-content input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        .close-btn { position: absolute; top: 10px; right: 20px; font-size: 30px; cursor: pointer; color: #333; }

        /* Contact Section Modern Design */
        #contact { background: #f9f9f9; padding: 60px 0; }
        .contact-container { 
            display: flex; align-items: center; gap: 40px; background: #fff; 
            padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
        }
        .form-container { flex: 1; }
        .form-container h2 { font-size: 2.2rem; color: #16a083; margin-bottom: 15px; position: relative; }
        .form-container h2::after { content: ''; width: 50px; height: 3px; background: #16a083; display: block; margin-top: 5px; }
        
        .form-container input, .form-container textarea {
            width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; 
            border-radius: 8px; background: #fdfdfd; font-family: inherit; transition: 0.3s;
        }
        .form-container input:focus, .form-container textarea:focus {
            border-color: #16a083; outline: none; box-shadow: 0 0 8px rgba(22, 160, 131, 0.1);
        }
        .submit-btn {
            background: #16a083; color: white; border: none; padding: 12px 25px; 
            border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; transition: 0.3s;
        }
        .submit-btn:hover { background: #12876f; transform: translateY(-2px); }

        @media (max-width: 768px) {
            .contact-container { flex-direction: column; text-align: center; }
            .contact-img { display: none; }
            .form-container h2::after { margin: 5px auto; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-container container">
            <input type="checkbox" name="" id="menu-toggle">
            <div class="hamburger-lines">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
            </div>
            <ul class="menu-items" id="menu-items">
                <li><a href="main.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="#about"><i class="fas fa-info-circle"></i> About</a></li>
                <li><a href="#food"><i class="fas fa-utensils"></i> Category</a></li>
                <li><a href="javascript:void(0)" onclick="openBookingModal()"><i class="fas fa-calendar-check"></i> Table Book</a></li>
                <?php session_start(); ?>

<?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
    <li><a href="admin_dashboard.php"><i class="fas fa-user-shield"></i> Admin Dashboard</a></li>
<?php endif; ?>
               <li><a href="cart.html"><i class="fas fa-envelope"></i> Contact</a></li>
                <li><a href="cart.html">
        <i class="fas fa-shopping-basket"></i>  View Cart
    </a></li>
      <li><a href="index.html"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>

            </ul>
            <h1 class="logo">SWARAJYA</h1>
        </div>
    </nav>

    <div id="reservation-modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeBookingModal()">&times;</span>
            <h2 style="text-align:center; color:#16a083; margin-bottom:20px;">Book the Table</h2>
            <form action="booking.php" method="POST">
                <input type="text" name="customer_name" placeholder="your full name" required>
                <input type="email" name="email" placeholder="E-mail address" required>
                <input type="text" name="phone" placeholder="Mobile no" required>
                <input type="number" name="guest_count" placeholder="How many people? (Guest Count)" required>
                <div style="display:flex; gap:10px;">
                    <input type="date" name="res_date" required style="width:50%;">
                    <input type="time" name="res_time" required style="width:50%;">
                </div>
                <button type="submit" class="submit-btn">Confirm Booking</button>
            </form>
        </div>
    </div>

    <section class="showcase-area" id="home">
        <div class="showcase-container">
            <h1 class="main-title">Foodies Choice</h1>
            <p>pure veg and nonveg Maharashtrian Taste.</p>
            <a href="#food" class="btn btn-primary">See The Menu </a>
        </div>
    </section>

    <section id="about">
        <div class="about-wrapper container">
            <div class="about-text">
                <p class="small">About Us</p>
                <h2>we have been serving quqlity food for the last 10 years</h2>
<p>At Swarajya Restaurant you will find authentic Kolhapuri,Malwani,and exotic flavoured Dishes. Your happiness is our goal.</p> 
            </div>
           <div class="about-img">
            <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Swarajya Restaurant" />
        </div>
        </div>
    </section>

    <section id="food">
        <h2 style="text-align: center; margin-bottom: 20px;">our Food items</h2>
        <div class="food-container container">
            <div class="food-type veg">
                <div class="img-container">
                    <img src="https://nativchefs.com/singapore/wp-content/uploads/WM_-Maharashtrian-Veg-Thali-_1000x667.jpg" alt="Veg" />
                    <div class="img-content">
                        <h3>vegetarian (Veg)</h3>
                        <a href="vegmenu.html" class="btn btn-primary">look</a>
                    </div>
                </div>
            </div>
            <div class="food-type non-veg">
                <div class="img-container">
                    <img src="https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Non-Veg" />
                    <div class="img-content">
                        <h3> Non-Veg</h3>
                        <a href="Novegmenu.html" class="btn btn-primary">look</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="contact-container container">
            <div class="contact-img">
                <img src="https://images.unsplash.com/photo-1514933651103-005eec06c04b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Contact Us" />
            </div>
            <div class="form-container">
                <h2>contact us</h2>
                <form action="contact_process.php" method="POST">
                    <input type="text" name="customer_name" placeholder="your full name" required />
                    <input type="email" name="customer_email" placeholder="your E-mail" required />
     <textarea name="customer_msg" cols="30" rows="5" placeholder="tell us your message or complaint..." required></textarea>
                    <button type="submit" class="submit-btn">send Message</button>
                </form>
            </div>
        </div>
    </section>

    <footer id="footer">
        <h2>SWARAJYA Restaurant &copy; All Rights Reserved</h2>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function openBookingModal() {
            document.getElementById('reservation-modal').style.display = 'flex';
        }
        function closeBookingModal() {
            document.getElementById('reservation-modal').style.display = 'none';
        }
        window.onclick = function(event) {
            var modal = document.getElementById('reservation-modal');
            if (event.target == modal) { modal.style.display = "none"; }
        }

        $(document).ready(function () {
            $("a").on("click", function (event) {
                if (this.hash !== "" && this.hash !== "#") {
                    event.preventDefault();
                    var hash = this.hash;
                    $("html, body").animate({ scrollTop: $(hash).offset().top }, 800);
                }
            });
        });
    </script>

    <script>
    // To update the cart when the page loads
    function updateCartCount() {
        let cart = JSON.parse(localStorage.getItem('swarajya_cart')) || [];
        document.getElementById('cart-count').innerText = cart.length;
    }
    window.onload = updateCartCount;
</script>
</body>
</html>