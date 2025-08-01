<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// ភ្ជាប់ទៅ DB
$servername = "localhost";
$username = "root"; // ប្រើ username DB របស់អ្នក
$password = "";     // ប្រើ password DB របស់អ្នក
$dbname = "chheng_shop"; // ឈ្មោះ database

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("ការភ្ជាប់បរាជ័យ: " . $conn->connect_error);
}

// ទទួលតម្លៃពី Form
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$description = $_POST['description'];

// បញ្ចូលទៅ DB
$sql = "INSERT INTO products (product_name, price, description)
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sds", $product_name, $price, $description);

if ($stmt->execute()) {
    header("Location: menu.php"); // បញ្ចូលរួចទៅ menu
    exit;
} else {
    echo "បញ្ចូលមិនបាន: " . $conn->error;
}

$conn->close();
