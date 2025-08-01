<?php
session_start();
// Include your database config here
include(__DIR__ . '/includes/config.php');

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = $_FILES['image']['name'] ?? '';

    if (!empty($image)) {
        $targetDir = __DIR__ . "/uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // 👉 បង្កើតឈ្មោះឯកសារថ្មីមិនស្ទួន
        $imageExt = pathinfo($image, PATHINFO_EXTENSION);
        $uniqueImageName = uniqid('img_', true) . '.' . $imageExt;

        $targetFile = $targetDir . $uniqueImageName;

        // 👉 ផ្ទុករូបភាពទៅ folder
        $uploadOk = move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

        if ($uploadOk) {
            $sql = "INSERT INTO products (name, price, description, image) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdss", $name, $price, $description, $uniqueImageName);

            if ($stmt->execute()) {
                header("Location: admin.php"); // 👉 Refresh after insert
                exit();
            } else {
                $message = "❌ មានបញ្ហាក្នុងការបញ្ចូលទិន្នន័យ!";
            }

            $stmt->close();
        } else {
            $message = "❌ ការផ្ទុករូបភាពមានបញ្ហា!";
        }
    } else {
        $message = "❌ សូមជ្រើសរូបភាព!";
    }
}

// Handle delete action
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Get image filename to delete file
    $stmt = $conn->prepare("SELECT image FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imageToDelete);
    $stmt->fetch();
    $stmt->close();

    if ($imageToDelete) {
        $filePath = __DIR__ . "/uploads/" . $imageToDelete;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    $stmtDel = $conn->prepare("DELETE FROM products WHERE id=?");
    $stmtDel->bind_param("i", $id);
    $stmtDel->execute();
    $stmtDel->close();

    header("Location: admin.php");
    exit();
}

// Fetch all products for display
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8" />
    <title>បញ្ចូលផលិតផលថ្មី</title>
    <style>
        body {
            font-family: 'Noto Sans Khmer', sans-serif, Arial, sans-serif;
            background: #c8e3f3ff;
            padding: 30px;
            max-width: 900px;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            color: #1c1c1dff;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 4px;
            margin-bottom: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            background-color: #418cd3ff;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #7db8f0ff;
        }
        p.message {
            color: red;
            font-weight: bold;
        }
        .back-home {
            display: inline-block;
            background-color: #418cd3ff;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 20px;
        }
        /* Products table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }
        th {
            background-color: #418cd3ff;
            color: white;
        }
        tr:hover {
            background-color: #ffe6f0;
        }
        img.product-img {
            max-width: 100px;
            border-radius: 8px;
            object-fit: cover;
        }
        a.delete-btn {
            background-color: #ff4c61;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        a.delete-btn:hover {
            background-color: #ff1a38;
        }
    </style>
</head>
<body>

    <a href="index.php" class="back-home">🏠 Back to Home</a>

    <h2>បញ្ចូលផលិតផលថ្មី</h2>
    <?php if (!empty($message)): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form action="admin.php" method="POST" enctype="multipart/form-data">
        <label>ឈ្មោះផលិតផល:</label>
        <input type="text" name="name" required>

        <label>តម្លៃ ($):</label>
        <input type="number" name="price" step="0.01" required>

        <label>រូបភាពផលិតផល:</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit">បញ្ចូល</button>
    </form>

    <!-- Display existing products -->
    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>រូបភាព</th>
                    <th>ឈ្មោះ</th>
                    <th>តម្លៃ ($)</th>
                    <!-- <th>ពិពណ៌នា</th> -->
                    <th>សកម្មភាព</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="product-img"></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= number_format($row['price'], 2) ?></td>
                    
                    <td>
                        <!-- Edit link (you can create edit.php or handle inline editing) -->
                        <a href="edit.php?id=<?= $row['id'] ?>" style="margin-right:10px; color:#e75480; font-weight:bold; text-decoration:none;">✏️ Edit</a>
                        <!-- Delete link -->
                        <a href="admin.php?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('តើអ្នកពិតជាចង់លុបផលិតផលនេះ?');">🗑️ Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="margin-top:30px; font-weight:bold;">មិនមានផលិតផលនៅឡើយទេ។</p>
    <?php endif; ?>

</body>
<script>
    const icons = ['🐷', '🐼', '🌸', '🐹', '🦝', '🐯'];

    function createFallingIcon() {
        const el = document.createElement('div');
        el.className = 'falling';
        el.textContent = icons[Math.floor(Math.random() * icons.length)];

        el.style.position = 'fixed';
        el.style.left = Math.random() * 100 + 'vw';
        el.style.top = '-50px';
        el.style.fontSize = (24 + Math.random() * 20) + 'px';
        el.style.zIndex = 9999;
        el.style.animation = 'fall linear forwards';
        el.style.animationDuration = (3 + Math.random() * 5) + 's';

        document.body.appendChild(el);

        setTimeout(() => {
            el.remove();
        }, 8000);
    }

    setInterval(createFallingIcon, 250);
</script>

<style>
    @keyframes fall {
      to {
        transform: translateY(100vh) rotate(360deg);
        opacity: 0;
      }
    }
</style>
</html>
