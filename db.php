<?php
// db.php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable exceptions

try {
    $conn = new mysqli("localhost", "root", "", "attendance_db");
    $conn->set_charset("utf8mb4"); // Support special characters
} catch (Exception $e) {
    // In production, log this error instead of showing it to the user
    error_log($e->getMessage());
    die("Database connection problem."); 
}
?>