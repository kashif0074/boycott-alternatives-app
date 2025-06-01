<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Boycott & Alternatives App</title>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      margin: 0;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: #116466; /* Changed background color */
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow-x: hidden;
      position: relative;
    }

    .container {
      text-align: center;
      padding: 40px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
      border: 1px solid rgba(0, 0, 0, 0.05);
      max-width: 500px;
      position: relative;
      z-index: 1;
    }

    h1 {
      color: #116466;
      font-size: 2.4rem;
      margin-bottom: 40px;
      font-weight: 700;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 15px auto;
      padding: 16px 30px;
      font-size: 1.1rem;
      color: #ffffff;
      background: linear-gradient(45deg, #116466, #ff6f61);
      border: none;
      border-radius: 10px;
      cursor: pointer;
      width: 260px;
      text-decoration: none;
      transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .btn i {
      margin-right: 10px;
      font-size: 1.2rem;
      transition: transform 0.3s ease;
    }

    .btn:hover {
      background: linear-gradient(45deg, #0e5354, #e65b50);
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(255, 111, 97, 0.3);
    }

    .btn:hover i {
      transform: scale(1.2);
    }

    .btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .btn:hover::before {
      left: 100%;
    }

    .modal {
      display: none;
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background: rgba(0, 0, 0, 0.55);
      z-index: 1000;
    }

    .modal-content {
      background: rgba(255, 255, 255, 0.95);
      margin: 10% auto;
      padding: 35px 30px;
      border-radius: 16px;
      width: 90%;
      max-width: 440px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      animation: slideIn 0.4s ease-in-out;
      text-align: center;
      position: relative;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .modal-content h2 {
      color: #116466;
      font-size: 1.9rem;
      margin-bottom: 25px;
      font-weight: 600;
      text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .close {
      position: absolute;
      top: 15px;
      right: 20px;
      color: #6b7280;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
      transition: color 0.3s ease, transform 0.3s ease;
    }

    .close:hover {
      color: #ff6f61;
      transform: rotate(90deg);
    }

    .modal-content input {
      width: 90%;
      padding: 14px 18px;
      margin: 12px 0;
      border: 1px solid #d1d5db;
      border-radius: 10px;
      font-size: 1rem;
      background: #f9fafb;
      color: #1f2937;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .modal-content input::placeholder {
      color: #9ca3af;
    }

    .modal-content input:focus {
      outline: none;
      border-color: #ff6f61;
      box-shadow: 0 0 10px rgba(255, 111, 97, 0.3);
    }

    .login-submit {
      background: linear-gradient(45deg, #116466, #ff6f61);
      color: #ffffff;
      border: none;
      padding: 14px 25px;
      margin-top: 15px;
      border-radius: 10px;
      cursor: pointer;
      width: 95%;
      font-size: 1rem;
      transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .login-submit:hover {
      background: linear-gradient(45deg, #0e5354, #e65b50);
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(255, 111, 97, 0.3);
    }

    .login-submit::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .login-submit:hover::before {
      left: 100%;
    }

    @keyframes slideIn {
      from { opacity: 0; transform: translateY(-25px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 500px) {
      .container {
        padding: 25px;
      }

      h1 {
        font-size: 2rem;
      }

      .btn {
        width: 220px;
        font-size: 1rem;
      }

      .modal-content {
        width: 85%;
        padding: 25px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Boycott & Alternatives App</h1>
    <button class="btn" onclick="openModal('userModal')"><i class="fas fa-user"></i> LOGIN AS USER</button>
    <button class="btn" onclick="openModal('adminModal')"><i class="fas fa-lock"></i> LOGIN AS ADMIN</button>
  </div>

  <!-- User Modal -->
  <div id="userModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('userModal')">×</span>
      <h2>User Login</h2>
      <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="hidden" name="user_type" value="user" />
        <button type="submit" class="login-submit">Login</button>
      </form>
    </div>
  </div>

  <!-- Admin Modal -->
  <div id="adminModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('adminModal')">×</span>
      <h2>Admin Login</h2>
      <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="hidden" name="user_type" value="admin" />
        <button type="submit" class="login-submit">Login</button>
      </form>
    </div>
  </div>

  <script>
    function openModal(modalId) {
      document.getElementById(modalId).style.display = "block";
    }

    function closeModal(modalId) {
      document.getElementById(modalId).style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target.id === "userModal") closeModal('userModal');
      if (event.target.id === "adminModal") closeModal('adminModal');
    }
  </script>
</body>
</html>
