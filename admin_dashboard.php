<?php
// admin_dashboard.php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
    }
    
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      /* New background gradient */
      background: linear-gradient(135deg, #116466 0%, #38a3a5 50%, #81ecec 100%);
      min-height: 100vh;
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
    
    .logout-btn {
      background-color: rgba(255, 255, 255, 0.2);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    
    .logout-btn:hover {
      background-color: rgba(255, 255, 255, 0.3);
    }
    
    .container {
      max-width: 900px;
      margin: 30px auto;
      padding: 20px;
      background: white;
      border-radius: 12px;
      box-shadow: var(--card-shadow);
      border: 1px solid var(--light-gray);
    }
    
    h1 {
      color: var(--primary);
      margin-bottom: 30px;
      text-align: center;
    }
    
    .section {
      background: white;
      border-radius: 12px;
      padding: 25px;
      margin-bottom: 25px;
      box-shadow: var(--card-shadow);
      border: 1px solid var(--light-gray);
    }
    
    .section h3 {
      color: var(--primary);
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 2px solid var(--light-gray);
      font-size: 1.3rem;
    }
    
    .btn-group {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 15px;
    }
    
    .btn-group a {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 16px;
      background: linear-gradient(45deg, var(--primary), var(--secondary));
      color: white;
      text-decoration: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 500;
      transition: transform 0.2s ease, box-shadow 0.3s ease;
      text-align: center;
    }
    
    .btn-group a:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(255, 111, 97, 0.3);
    }
    
    .btn-group a i {
      margin-right: 10px;
      font-size: 1.2rem;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <h2>Admin Dashboard</h2>
    <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
  </div>

  <div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h1>
    
    <div class="section">
      <h3>Manage Products</h3>
      <div class="btn-group">
        <a href="add_product.php"><i class="fas fa-plus-circle"></i> Add Product</a>
        <a href="view_products.php"><i class="fas fa-list"></i> View/Edit/Delete Products</a>
      </div>
    </div>
    
    <div class="section">
      <h3>Manage Alternative Products</h3>
      <div class="btn-group">
        <a href="add_alternative.php"><i class="fas fa-plus-circle"></i> Add Alternative</a>
        <a href="view_alternatives.php"><i class="fas fa-list"></i> View/Edit/Delete Alternatives</a>
      </div>
    </div>
  </div>
</body>
</html>
