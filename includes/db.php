<?php

// includes/db.php

// Include the database configuration
include_once('config/config.php');

// Function to connect to the database
function connect_db() {
    try {
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        // Display error message if connection fails
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}
