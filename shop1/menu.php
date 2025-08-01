<?php
// Start session (if needed for admin features)
session_start();

// ✅ Include DB configuration
include(__DIR__ . '/includes/config.php');

// ✅ Fetch all products
$sql = "SELECT name, price, description, image FROM products ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>បញ្ជីផលិតផល</title>
    <style>
        body {
            font-family: 'Noto Sans Khmer', sans-serif;
            background: #f0f8ff;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #151616ff;
            margin-bottom: 20px;
        }

        .back-btn {
            display: block;
            width: fit-content;
            margin: 0 auto 30px auto;
            padding: 10px 20px;
            background-color: #418cd3ff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color: #195b7eff;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            padding: 10px;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 6px;
        }

        .product-card h3 {
            margin: 10px 0 5px;
            color: #333;
        }

        .product-card p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .price {
            font-weight: bold;
            color: #464346ff;
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
      color: #4e4a4dff;
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

<h2>បញ្ជីផលិតផល</h2>

<!-- ✅ Back to Home Button -->
<a href="index.php" class="back-btn">⬅ ត្រឡប់ទៅគេហទំព័រ</a>

<div class="product-list">
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="product-card">
                <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="រូបភាពផលិតផល">
                <h3><?= htmlspecialchars($row['name']) ?></h3>
                <p class="price">$<?= number_format($row['price'], 2) ?></p>
                <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align: center;">គ្មានផលិតផល!</p>
    <?php endif; ?>
</div>
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