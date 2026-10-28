<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../db.php";

if (isset($_POST['save'])) {

    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $status = $_POST['status'];

    $stmt = $conn->prepare(
        "INSERT INTO products (name, price, status) VALUES (?, ?, ?)"
    );

    $stmt->bind_param("sds", $name, $price, $status);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>

