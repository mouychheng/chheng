<?php
include 'includes/config.php';  // Correct include path based on your folder structure

$message = '';

if (isset($_POST['submit'])) {
    $customer = $_POST['customer_name'];
    $product = $_POST['product_name'];
    $qty = $_POST['quantity'];
    $total = $_POST['total_price'];
    $date = $_POST['order_date'];

    $sql = "INSERT INTO orders (customer_name, product_name, quantity, total_price, order_date)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        $message = "❌ សំណួរត្រៀមមិនត្រឹមត្រូវ: " . htmlspecialchars($conn->error);
    } else {
        $stmt->bind_param("ssids", $customer, $product, $qty, $total, $date);

        if ($stmt->execute()) {
            $message = "✅ បានបញ្ចូលការកុម្មង់ដោយជោគជ័យ!";
        } else {
            $message = "❌ បញ្ហាក្នុងការបញ្ចូល: " . htmlspecialchars($stmt->error);
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="km">
<head>
  <meta charset="UTF-8">
  <title>បញ្ចូលការកុម្មង់</title>
  <style>
    body {
      font-family: 'Noto Sans Khmer', 'Khmer OS', sans-serif;
      background: linear-gradient(to bottom, #7db8f0ff, #fef3f8);
      padding: 40px;
    }

    form {
      max-width: 600px;
      margin: auto;
      background: #7db8f0ff;
      padding: 60px;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(255, 182, 193, 0.6);
      border: 2px solid #ffc0cb;
      position: relative;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #1c1c1dff;
      font-size: 28px;
      text-shadow: 1px 1px 3px #ffb6c1;
    }

    label {
      display: block;
      margin-top: 14px;
      font-weight: 600;
      color: #161516ff;
    }

    input, select {
      width: 100%;
      padding: 10px 15px;
      margin-top: 6px;
      border-radius: 12px;
      border: 1px solid #f5c6d0;
      box-shadow: inset 0 1px 5px rgba(255,182,193,0.3);
      transition: all 0.3s ease;
      font-size: 15px;
      background-color: #fff0f6;
    }

    input:focus, select:focus {
      border-color: #418cd3ff;
      box-shadow: 0 0 0 4px #ffd1dc;
      outline: none;
      background-color: #fff1f7;
    }

    button {
      width: 100%;
      margin-top: 25px;
      padding: 14px;
      background: linear-gradient(135deg, #418cd3ff, #ff65a3);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 17px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(86, 175, 248, 0.6);
    }

    button:hover {
      background: linear-gradient(135deg, #418cd3ff, #7db8f0ff);
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(211,60,110,0.8);
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

    .message {
      max-width: 600px;
      margin: 15px auto;
      text-align: center;
      font-weight: bold;
      color: #418cd3ff;
      text-shadow: 0 0 5px #ffc0cb;
    }

    .message.error {
      color: #418cd3ff;
      text-shadow: none;
    }

    @media (max-width: 768px) {
      body {
        padding: 20px;
      }
      form {
        padding: 30px;
      }
      h2 {
        font-size: 24px;
      }
      button {
        font-size: 16px;
        padding: 12px;
      }
      .back-btn {
        position: static;
        display: block;
        width: fit-content;
        margin: 10px auto;
      }
    }

     .cute-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 110%;
      height: 110%;
      background: url('imag/13.jpg') no-repeat center center;
      background-size: cover;
      opacity: 0.1;
      z-index: -1;
      animation: moveBackground 30s linear infinite;
    }

    @keyframes moveBackground {
      0%   { transform: translate(0, 0); }
      50%  { transform: translate(-10px, -10px); }
      100% { transform: translate(0, 0); }
    }

    .gallery-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 30px;
      gap: 20px;
      position: relative;
      z-index: 1;
    }

    .flower-box {
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      overflow: hidden;
      text-align: center;
      width: 300px;
      opacity: 0;
      transform: translateY(50px);
      animation: fadeInUp 1s ease forwards, floatCute 3s ease-in-out infinite;
      animation-delay: var(--delay);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .flower-box:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }

    .flower-box img {
      width: 100%;
      height: auto;
      display: block;
      cursor: pointer;
    }

    .price-tag {
      background-color: #ffccf9;
      color: #418cd3ff;
      padding: 10px;
      font-size: 18px;
      font-weight: bold;
      border-top: 1px solid #ffd6fa;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes floatCute {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px);
      }
    }

    @media screen and (max-width: 600px) {
      .flower-box {
        width: 100%;
        max-width: 90%;
      }
    }

      .falling {
      position: absolute;
      top: -50px;
      pointer-events: none;
      user-select: none;
      animation: fall linear forwards;
    }

    @keyframes fall {
      to {
        transform: translateY(100vh) rotate(360deg);
        opacity: 0;
      }
    }

    
  </style>
</head>
<body>
<a href="index.php" class="back-btn">ត្រឡប់ទៅទំព័រដើម</a>

<?php if (!empty($message)): ?>
  <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="POST" action="">
  <h2>បញ្ចូលមុខទំនិញ</h2>

  <label>ឈ្មោះអតិថិជន:</label>
  <input type="text" name="customer_name" required>

  <label>ទំនិញ:</label>
  <input type="text" name="product_name" required>

  <label>ចំនួន:</label>
  <input type="number" name="quantity" required min="1">

  <label>តម្លៃសរុប ($):</label>
  <input type="number" name="total_price" step="0.01" required min="0">

  <label>ថ្ងៃបញ្ជាទិញ:</label>
  <input type="date" name="order_date" required>

  <button type="submit" name="submit">បញ្ជូន</button>
</form>
<script>
    const icons = ['🐷', '🐼', '🌸', '🐹', '🦝', '🐯'];

  function createFallingIcon() {
    const el = document.createElement('div');
    el.className = 'falling';
    el.textContent = icons[Math.floor(Math.random() * icons.length)];

    // Style it randomly
    el.style.left = Math.random() * 100 + 'vw';
    el.style.fontSize = (24 + Math.random() * 20) + 'px';
    el.style.animationDuration = (3 + Math.random() * 5) + 's';

    document.body.appendChild(el);

    // Remove after animation
    setTimeout(() => {
      el.remove();
    }, 8000);
  }

  // Create a new icon every 250ms
  setInterval(createFallingIcon, 250);
</script>
</body>
</html>
