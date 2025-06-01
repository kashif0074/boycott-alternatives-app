<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: index.php");
    exit();
}
include 'db_connection.php';

if (isset($_GET['delete_id'])) {
    $conn->query("DELETE FROM alternatives WHERE alt_id = " . intval($_GET['delete_id']));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Alternatives</title>
    <style>
        :root {
            --primary: #116466;
            --secondary: #ff6f61;
            --light: #f9fafb;
            --dark: #1f2937;
            --light-gray: #e5e7eb;
            --medium-gray: #9ca3af;
            --border: #d1d5db;
            --card-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            --gradient: linear-gradient(45deg, #116466, #ff6f61);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #116466;  /* Changed background color here */
            margin: 0;
            padding: 0 20px 40px;
            color: var(--dark);
        }

        h2 {
            text-align: center;
            margin: 30px 0 20px;
            color: var(--primary);
            font-weight: 700;
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: var(--card-shadow);
            border-radius: 12px;
            overflow: hidden;
            font-size: 1rem;
            margin-bottom: 30px;
        }

        th, td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid var(--light-gray);
        }

        th {
            background: var(--gradient);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        tr:hover {
            background-color: #f9f9f9;
            transition: background-color 0.3s ease;
        }

        .action {
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            margin-right: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: inline-block;
        }

        .edit-btn {
            background: var(--primary);
            color: white;
        }

        .edit-btn:hover {
            background: #0f504d;
        }

        .delete-btn {
            background: var(--secondary);
            color: white;
        }

        .delete-btn:hover {
            background: #e65551;
        }

        .btn-back {
            text-align: center;
            margin-top: 10px;
        }

        .btn-back a {
            background: var(--gradient);
            color: white;
            padding: 10px 28px;
            font-weight: 600;
            border-radius: 12px;
            text-decoration: none;
            font-size: 1rem;
            box-shadow: var(--card-shadow);
            transition: background 0.3s ease;
            display: inline-block;
        }

        .btn-back a:hover {
            background: #0f504d;
        }
    </style>
</head>
<body>
    <h2>Approved Alternatives</h2>
    <table>
        <thead>
            <tr>
                <th>Alternative</th>
                <th>Company</th>
                <th>Original Product</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "
                SELECT a.alt_id, a.alt_name, a.alt_company, p.product_name 
                FROM alternatives a
                JOIN products p ON a.product_id = p.product_id
            ";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['alt_name']) . "</td>
                        <td>" . htmlspecialchars($row['alt_company']) . "</td>
                        <td>" . htmlspecialchars($row['product_name']) . "</td>
                        <td>
                            <a class='action edit-btn' href='edit_alternative.php?alt_id={$row['alt_id']}'>Edit</a>
                            <a class='action delete-btn' href='view_alternatives.php?delete_id={$row['alt_id']}' onclick=\"return confirm('Delete this alternative?');\">Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='text-align:center; padding:20px;'>No alternatives found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="btn-back">
        <a href="admin_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
