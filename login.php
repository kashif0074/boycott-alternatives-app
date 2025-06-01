<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $user_type = $_POST["user_type"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND user_type = ?");
    $stmt->bind_param("sss", $username, $password, $user_type);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $_SESSION["username"] = $username;
        $_SESSION["user_type"] = $user_type;

        // Redirect based on user type
        if ($user_type === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        echo "<script>alert('Invalid credentials.'); window.history.back();</script>";
    }

    $stmt->close();
}
$conn->close();
?>
