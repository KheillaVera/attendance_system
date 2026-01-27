<?php
// log.php
header('Content-Type: application/json'); // Tell browser we are sending JSON
include 'db.php';

$response = ['status' => 'error', 'message' => 'Something went wrong.'];

if (isset($_POST['u_id']) && !empty($_POST['u_id'])) {
    $u_id = $_POST['u_id'];

    // 1. Prepare statement to check if user exists (Security fix)
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->bind_param("i", $u_id); // "i" means integer
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();

        // 2. Prepare statement to insert attendance
        $insertStmt = $conn->prepare("INSERT INTO attendance (user_id) VALUES (?)");
        $insertStmt->bind_param("i", $u_id);
        
        if ($insertStmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Logged successfully!';
        } else {
            $response['message'] = 'Database error during logging.';
        }
        $insertStmt->close();
    } else {
        $response['message'] = 'User ID not found.';
    }
} else {
    $response['message'] = 'Please enter a User ID.';
}

echo json_encode($response);
?>