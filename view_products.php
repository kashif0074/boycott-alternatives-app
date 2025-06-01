<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: index.php");
    exit();
}
include 'db_connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    // Delete related alternatives first (if any)
    $conn->query("DELETE FROM alternatives WHERE product_id = $delete_id");
    $sql = "DELETE FROM products WHERE product_id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: view_products.php");
        exit();
    } else {
        echo "<script>alert('Error deleting product: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View Products</title>
    <style>
        :root {
            --primary: #116466;
            --secondary: #ff6f61;
            --light: #f9fafb;
            --dark: #1f2937;
            --medium-gray: #6b7280;
            --light-gray: #e5e7eb;
            --gradient: linear-gradient(45deg, #116466, #ff6f61);
            --card-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #116466;
            margin: 0;
            padding: 40px 20px;
            color: var(--light);
        }

        h2 {
            text-align: center;
            color: var(--light);
            font-size: 2.2rem;
            margin-bottom: 30px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        thead th {
            background: var(--gradient);
            color: #fff;
            padding: 16px;
            text-align: left;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tbody td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--light-gray);
            color: var(--dark);
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        .action {
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            margin-right: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: inline-block;
        }

        .edit {
            background: var(--primary);
            color: #fff;
        }

        .edit:hover {
            background: #0e504d;
        }

        .delete {
            background: var(--secondary);
            color: #fff;
        }

        .delete:hover {
            background: #cc4a48;
        }

        .btn-back {
            margin-top: 30px;
            text-align: center;
        }

        .btn-back a {
            background: var(--gradient);
            color: #fff;
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: var(--card-shadow);
            transition: background 0.3s ease;
            display: inline-block;
        }

        .btn-back a:hover {
            background: #0e504d;
        }

        /* Responsive */

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tbody tr {
                margin-bottom: 15px;
                box-shadow: var(--card-shadow);
                border-radius: 10px;
                background: white;
                overflow: hidden;
            }

            tbody td {
                padding: 12px 20px;
                border-bottom: 1px solid var(--light-gray);
                display: flex;
                justify-content: space-between;
                font-size: 0.95rem;
                color: var(--dark);
            }

            tbody td:last-child {
                border-bottom: none;
            }

            tbody td::before {
                content: attr(data-label);
                font-weight: bold;
                text-transform: uppercase;
                color: var(--medium-gray);
                flex-basis: 40%;
            }
        }
    </style>
</head>
<body>
    <h2>Boycotted Products</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Company</th>
                <th>Reason</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM products");
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td data-label='ID'>{$row['product_id']}</td>
                        <td data-label='Name'>" . htmlspecialchars($row['product_name']) . "</td>
                        <td data-label='Company'>" . htmlspecialchars($row['company']) . "</td>
                        <td data-label='Reason'>" . htmlspecialchars($row['reason']) . "</td>
                        <td data-label='Actions'>
                            <a class='action edit' href='edit_product.php?id={$row['product_id']}'>Edit</a>
                            <a class='action delete' href='view_products.php?delete_id={$row['product_id']}' onclick=\"return confirm('Delete this product?');\">Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center; padding:20px;'>No products found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="btn-back">
        <a href="admin_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
