<?php
// dashboard.php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
$username = htmlspecialchars($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f0f2f5;
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
      border: none;
      color: white;
      padding: 8px 16px;
      font-size: 14px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    
    .logout-btn:hover {
      background-color: rgba(255, 255, 255, 0.3);
    }
    
    .dashboard {
      padding: 30px 20px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      max-width: 1000px;
      margin: 0 auto;
    }
    
    .card {
      background: white;
      border-radius: 15px;
      box-shadow: var(--card-shadow);
      padding: 25px;
      text-align: center;
      transition: transform 0.2s, box-shadow 0.3s;
      cursor: pointer;
      border: 1px solid var(--light-gray);
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    
    .card h3 {
      color: var(--primary);
      margin-bottom: 10px;
      font-size: 1.4rem;
    }
    
    .card p {
      color: var(--dark);
      font-size: 0.95rem;
    }
    
    .card i {
      font-size: 2.5rem;
      color: var(--primary);
      margin-bottom: 15px;
      display: block;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <h2>Welcome, <?php echo $username; ?></h2>
    <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
  </div>

  <div class="dashboard">
    <div class="card" onclick="window.location.href='boycotted_products.php'">
      <i class="fas fa-ban"></i>
      <h3>Boycotted Products</h3>
      <p>View all products currently under boycott.</p>
    </div>

    <div class="card" onclick="window.location.href='alternative_products.php'">
      <i class="fas fa-exchange-alt"></i>
      <h3>Alternative Products</h3>
      <p>Explore recommended alternatives to boycotted products.</p>
    </div>
  </div>
</body>
</html>