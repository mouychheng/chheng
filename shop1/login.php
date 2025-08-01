<?php
session_start();

$correctUsername = 'chheng';
$correctPassword = '12345';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $correctUsername && $password === $correctPassword) {
        $_SESSION['admin_logged_in'] = true; // ✅ use this in all protected pages
        header("Location: admin.php");       // ✅ go to dashboard
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Admin Panel</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #7db8f0ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            width: 300px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #418cd3ff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .back-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      background-color: white;
      color: #171718ff;
      padding: 8px 16px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      box-shadow: 0 0 5px rgba(214,51,108,0.3);
      transition: 0.3s;
    }

    .back-btn:hover {
      background-color: #7db8f0ff;
      color: white;
      box-shadow: 0 0 8px rgba(214,51,108,0.7);
    }
    </style>
</head>
<body>
    <a href="index.php" class="back-btn">ត្រឡប់ទៅទំព័រដើម</a>
<div class="login-box">
    <h2>Admin Login</h2>
    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
