<?php
include 'db.php';
if(isset($_POST['u_id']) && !empty($_POST['u_id'])) {
    $u_id = $_POST['u_id'];
    $check = $conn->query("SELECT * FROM users WHERE id = '$u_id'");
    if($check->num_rows > 0) {
        $conn->query("INSERT INTO attendance (user_id) VALUES ('$u_id')");
        echo "<span style='color:green;'>Logged successfully!</span>";
    } else {
        echo "<span style='color:red;'>User ID not found.</span>";
    }
}
?>