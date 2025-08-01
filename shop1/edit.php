<?php
include(__DIR__ . '/includes/config.php');

$id = $_GET['id'] ?? 0;
$id = intval($id);
$product = null;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT name, price, description FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';

    $stmt = $conn->prepare("UPDATE products SET name=?, price=?, description=? WHERE id=?");
    $stmt->bind_param("sdsi", $name, $price, $description, $id);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>កែប្រែផលិតផល</title>
    <style>
        body {
            font-family: 'Noto Sans Khmer', sans-serif;
            background-color: #b1d8eeff;
            padding: 40px;
            max-width: 600px;
            margin: 40px auto;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            position: relative;
        }

        h2 {
            text-align: center;
            color: #0f0f0fff;
            margin-bottom: 30px;
        }

        form {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
            color: #0f0f0fff;
            display: block;
            margin-top: 15px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-top: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #418cd3ff;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #7db8f0ff;
        }

        a {
            display: inline-block;
            margin-left: 15px;
            color: #555;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .flower {
            position: absolute;
            top: -25px;
            right: -25px;
            font-size: 40px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @media (max-width: 600px) {
            body {
                padding: 20px;
            }

            .flower {
                font-size: 30px;
                top: -15px;
                right: -15px;
            }
        }
    </style>
</head>
<body>
    <div class="flower">🌸</div>
    <h2>កែប្រែផលិតផល</h2>

    <?php if ($product): ?>
    <form method="POST">
        <label>ឈ្មោះផលិតផល:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

        <label>តម្លៃ ($):</label>
        <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required>

        <!-- <label>ពិពណ៌នា:</label>
        <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea> -->

        <button type="submit">💾 រក្សាទុក</button>
        <a href="admin.php">⬅ ត្រឡប់</a>
    </form>
    <?php else: ?>
        <p>មិនមានទិន្នន័យផលិតផល!</p>
    <?php endif; ?>
</body>
</html>
