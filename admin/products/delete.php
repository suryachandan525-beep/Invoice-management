<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../db.php";

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        header("Location: index.php");
        exit;
    }

    echo "Error deleting product.";
    $stmt->close();
}

$conn->close();
?>

