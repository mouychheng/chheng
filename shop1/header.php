<!DOCTYPE html>
<html lang="km">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chheng Shop</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts (optional cute Khmer) -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Noto Sans Khmer', 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #fff0f5;
    }

    .header {
      background-color: #7db8f0ff;
      padding: 10px 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-brand img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid white;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    .navbar {
      padding: 0;
    }

    .navbar-nav .nav-link {
      color: #242525ff;
      font-weight: bold;
      padding: 10px 15px;
      transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #418cd3ff;
    }

    .login-btn {
      background-color: #418cd3ff;
      border: none;
      color: white;
      padding: 8px 14px;
      border-radius: 20px;
      font-weight: 500;
      transition: background-color 0.3s ease;
      text-decoration: none;
    }

    .login-btn:hover {
      background-color: #418cd3ff;
    }

    @media (max-width: 576px) {
      .navbar-brand img {
        width: 50px;
        height: 50px;
      }
    }
  </style>
</head>
<body>

<!-- ✅ Cute Responsive Header -->
<nav class="navbar navbar-expand-lg header">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="../img/img1.jpg" alt="Chheng Shop Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" style="filter: brightness(0.4);"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">ទំព័រដើម</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu.php">មុខទំនិញ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="oder.php">បញ្ជាទិញ</a>
        </li>
      </ul>

      <div class="d-flex">
        <a href="login.php" class="login-btn">Login Admin</a>
      </div>
    </div>
  </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
