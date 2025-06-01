<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: index.php");
    exit();
}
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = intval($_POST["product_id"]);
    $alt_name = trim($_POST["alt_name"]);
    $alt_company = trim($_POST["alt_company"]);

    $stmt = $conn->prepare("INSERT INTO alternatives (product_id, alt_name, alt_company) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $product_id, $alt_name, $alt_company);
    $stmt->execute();
    $stmt->close();

    header("Location: view_alternatives.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Alternative</title>
    <style>
        /* Background and container styles */
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
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 480px;
            box-sizing: border-box;
            text-align: left;
        }

        h2 {
            margin-top: 0;
            font-size: 2rem;
            color: #116466;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        label {
            font-weight: 600;
            color: #374151;
            display: block;
            margin-top: 20px;
            margin-bottom: 6px;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 1rem;
            background: #f9fafb;
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        select:focus, input[type="text"]:focus {
            outline: none;
            border-color: #ff6f61;
            box-shadow: 0 0 10px rgba(255, 111, 97, 0.3);
        }

        input[type="submit"] {
            margin-top: 30px;
            width: 100%;
            background: linear-gradient(45deg, #116466, #ff6f61);
            color: white;
            border: none;
            padding: 14px;
            font-weight: bold;
            font-size: 1rem;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        input[type="submit"]:hover {
            background: linear-gradient(45deg, #0e5354, #e65b50);
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(255, 111, 97, 0.3);
        }

        input[type="submit"]::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        input[type="submit"]:hover::before {
            left: 100%;
        }

        .back-link {
            display: block;
            margin: 20px auto 0;
            width: max-content;
            text-decoration: none;
            font-weight: 600;
            background: linear-gradient(45deg, #116466, #ff6f61);
            color: white;
            padding: 10px 20px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .back-link:hover {
            background: linear-gradient(45deg, #0e5354, #e65b50);
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(255, 111, 97, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Alternative Product</h2>
        <form method="POST" novalidate>
            <label for="product_id">Product:</label>
            <select name="product_id" id="product_id" required>
                <option value="">Select Product</option>
                <?php
                $res = $conn->query("SELECT * FROM products");
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='" . intval($row['product_id']) . "'>" . 
                        htmlspecialchars($row['product_name']) . " (" . 
                        htmlspecialchars($row['company']) . ")</option>";
                }
                ?>
            </select>

            <label for="alt_name">Alternative Name:</label>
            <input type="text" name="alt_name" id="alt_name" required>

            <label for="alt_company">Alternative Company:</label>
            <input type="text" name="alt_company" id="alt_company" required>

            <input type="submit" value="Add Alternative">
        </form>
        <a href="admin_dashboard.php" class="back-link">← Back to Dashboard</a>
    </div>
</body>
</html>
