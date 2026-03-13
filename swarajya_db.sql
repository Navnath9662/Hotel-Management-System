-- १. डेटाबेस तयार करा
CREATE DATABASE IF NOT EXISTS swarajya_db;
USE swarajya_db;

-- २. Contact Messages टेबल (संपर्क संदेशांसाठी)
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    customer_msg TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ३. Hotel Reviews टेबल (ग्राहकांच्या अभिप्रायासाठी)
CREATE TABLE IF NOT EXISTS hotel_reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    rating INT NOT NULL,
    review_text TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ४. Orders टेबल (जेवणाच्या ऑर्डर्ससाठी)
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    item_name TEXT NOT NULL,          -- उदा: वडापाव (२), मिसळ (१)
    total_price VARCHAR(50) NOT NULL, -- बिलाची रक्कम
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ५. Reservations टेबल (टेबल बुकिंगसाठी)
CREATE TABLE IF NOT EXISTS reservations (
    res_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    guest_count INT NOT NULL,
    res_date DATE NOT NULL,
    res_time TIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ६. Users टेबल (लॉगिन आणि ॲडमिनसाठी)
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ७. डीफॉल्ट ॲडमिन युजर ॲड करा (लॉगिन करण्यासाठी)
-- इथे तू तुझा हवा तो युजरनेम आणि पासवर्ड बदलू शकतोस.
INSERT INTO users (username, password) VALUES ('admin', 'admin123');