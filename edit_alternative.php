<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: index.php");
    exit();
}
include 'db_connection.php';

$alt_id = isset($_GET['alt_id']) ? intval($_GET['alt_id']) : 0;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alt_name = trim($_POST['alt_name']);
    $alt_company = trim($_POST['alt_company']);
    $product_id = intval($_POST['product_id']);

    $stmt = $conn->prepare("UPDATE alternatives SET alt_name = ?, alt_company = ?, product_id = ? WHERE alt_id = ?");
    $stmt->bind_param("ssii", $alt_name, $alt_company, $product_id, $alt_id);
    $stmt->execute();

    if ($stmt->affected_rows >= 0) {
        echo "<script>alert('Alternative updated successfully.'); window.location='view_alternatives.php';</script>";
    } else {
        echo "<script>alert('Update failed.');</script>";
    }

    $stmt->close();
    exit();
}

// Fetch current alternative data
$alt_query = $conn->query("SELECT * FROM alternatives WHERE alt_id = $alt_id");
$alternative = $alt_query->fetch_assoc();

// Fetch products for dropdown
$product_query = $conn->query("SELECT product_id, product_name FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Alternative</title>
    <style>
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
        select,
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
        <h2>Edit Alternative</h2>
        <form method="POST">
            <label for="alt_name">Alternative Name:</label>
            <input type="text" name="alt_name" id="alt_name" value="<?= htmlspecialchars($alternative['alt_name']) ?>" required>

            <label for="alt_company">Company:</label>
            <input type="text" name="alt_company" id="alt_company" value="<?= htmlspecialchars($alternative['alt_company']) ?>" required>

            <label for="product_id">Original Product:</label>
            <select name="product_id" id="product_id" required>
                <?php while ($product = $product_query->fetch_assoc()): ?>
                    <option value="<?= $product['product_id'] ?>" <?= ($product['product_id'] == $alternative['product_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($product['product_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Update Alternative">
        </form>
        <a class="back-link" href="view_alternatives.php">← Back to Alternatives</a>
    </div>
</body>
</html>
