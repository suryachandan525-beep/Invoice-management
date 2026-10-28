<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../db.php";

if (isset($_POST['update'])) {

    $id = (int) $_POST['id'];
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $status = $_POST['status'];

    $stmt = $conn->prepare(
        "UPDATE products SET name=?, price=?, status=? WHERE id=?"
    );

    $stmt->bind_param("sdsi", $name, $price, $status, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    }

    echo "Error updating product.";

    $stmt->close();
}

$conn->close();
?>

