<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: index.php");
    exit();
}
include 'db_connection.php';

$id = intval($_GET['id']);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $company = trim($_POST["company"]);
    $reason = trim($_POST["reason"]);
    $stmt = $conn->prepare("UPDATE products SET product_name=?, company=?, reason=? WHERE product_id=?");
    $stmt->bind_param("sssi", $name, $company, $reason, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: view_products.php");
    exit();
}

$result = $conn->query("SELECT * FROM products WHERE product_id = $id");
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Product</title>
    <style>
        /* Background & container styles like Add Product page */
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
            color: #111;
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
        <h2>Edit Product</h2>
        <form method="POST">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['product_name']) ?>" required>

            <label for="company">Company:</label>
            <input type="text" id="company" name="company" value="<?= htmlspecialchars($product['company']) ?>" required>

            <label for="reason">Reason:</label>
            <textarea id="reason" name="reason" rows="4" required><?= htmlspecialchars($product['reason']) ?></textarea>

            <input type="submit" value="Update">
        </form>
        <a href="view_products.php" class="back-link">← Back to Product List</a>
    </div>
</body>
</html>
