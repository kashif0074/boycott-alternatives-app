<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Alternative Products</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    :root {
      --primary: #116466;
      --secondary: #ff6f61;
      --light-gray: #e5e7eb;
      --card-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      background: linear-gradient(135deg, #116466 0%, #38a3a5 50%, #81ecec 100%);
      color: #333;
    }
    .navbar {
      background: linear-gradient(45deg, var(--primary), var(--secondary));
      color: white;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .navbar h2 {
      margin: 0;
      font-weight: 600;
    }
    .back-btn {
      background-color: rgba(255, 255, 255, 0.2);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 8px;
      cursor: pointer;
      text-decoration: none;
      font-size: 14px;
      transition: background-color 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .back-btn:hover {
      background-color: rgba(255, 255, 255, 0.3);
    }
    .container {
      max-width: 900px;
      margin: 30px auto;
      padding: 30px 20px;
      background: white;
      border-radius: 12px;
      box-shadow: var(--card-shadow);
      border: 1px solid var(--light-gray);
    }
    h1 {
      color: var(--primary);
      margin-bottom: 20px;
      text-align: center;
    }
    ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    li {
      background: white;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      border: 1px solid var(--light-gray);
      transition: box-shadow 0.3s ease;
    }
    li:hover {
      box-shadow: 0 8px 30px rgba(17, 100, 102, 0.2);
    }
    li strong {
      font-size: 18px;
      color: var(--primary);
    }
    li p {
      margin: 8px 0 0;
      color: #555;
      white-space: pre-line;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <h2>Alternative Products</h2>
    <a href="dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
  </div>

  <div class="container">
    <h1>Alternative Products List</h1>
    <ul>
      <?php
      $sql = "
        SELECT a.alt_name, a.alt_company, p.product_name 
        FROM alternatives a
        JOIN products p ON a.product_id = p.product_id
      ";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<li>";
              echo "<strong>" . htmlspecialchars($row['alt_name']) . "</strong> by " . htmlspecialchars($row['alt_company']);
              echo "<p>Alternative to: <em>" . htmlspecialchars($row['product_name']) . "</em></p>";
              echo "</li>";
          }
      } else {
          echo "<p>No alternative products found.</p>";
      }
      ?>
    </ul>
  </div>

</body>
</html>
