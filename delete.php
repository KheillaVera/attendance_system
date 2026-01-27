<?php
// delete.php
include 'db.php';

// Only allow deletion via POST request for security
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    
    $id = $_POST['id'];

    // Prepare statement (Security fix)
    $stmt = $conn->prepare("DELETE FROM attendance WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to view page
        header("Location: view_attendance.php?msg=deleted");
    } else {
        echo "Error deleting record.";
    }
    $stmt->close();
} else {
    // If someone tries to access this file directly via URL
    header("Location: view_attendance.php"); 
    exit();
}
?>