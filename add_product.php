<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: index.php");
    exit();
}
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = trim($_POST["product_name"]);
    $company = trim($_POST["company"]);
    $reason = trim($_POST["reason"]);

    $stmt = $conn->prepare("INSERT INTO products (product_name, company, reason) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $product_name, $company, $reason);
    $stmt->execute();
    $stmt->close();
    header("Location: view_products.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product</title>
    <style>
        /* Background & container styles from index.html */
        body {
            margin: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #116466;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            position: relative;
            color: #1f2937;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(0, 0, 0, 0.05);
            max-width: 480px;
            width: 100%;
            padding: 30px 40px;
            box-sizing: border-box;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        h2 {
            margin-top: 0;
            font-size: 2rem;
            color: #116466;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 25px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Your original form styles inside the container */
        form {
            text-align: left;
        }

        label {
            font-weight: 600;
            color: #374151;
            display: block;
            margin-top: 20px;
            margin-bottom: 6px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            background: #f9f9f9;
            resize: vertical;
            box-sizing: border-box;
        }

        input[type="submit"] {
            margin-top: 25px;
            width: 100%;
            background: linear-gradient(45deg, #116466, #ff6f61);
            color: white;
            border: none;
            padding: 14px;
            font-weight: bold;
            font-size: 1rem;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #0f504d;
        }

        .back-link {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            font-weight: 600;
            background: linear-gradient(45deg, #116466, #ff6f61);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            transition: background 0.3s ease;
        }

        .back-link:hover {
            background: #0f504d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Boycotted Product</h2>
        <form method="POST" novalidate>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required placeholder="Enter product name" />

            <label for="company">Company:</label>
            <input type="text" id="company" name="company" required placeholder="Enter company name" />

            <label for="reason">Reason:</label>
            <textarea id="reason" name="reason" rows="4" required placeholder="Reason for boycotting"></textarea>

            <input type="submit" value="Add Product" />
        </form>
        <a href="admin_dashboard.php" class="back-link">← Back to Dashboard</a>
    </div>
</body>
</html>
