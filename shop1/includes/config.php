<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "chheng_shop";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("ការភ្ជាប់បរាជ័យ: " . $conn->connect_error);
}
?>
