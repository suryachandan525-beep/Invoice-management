<?php
require_once "../db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM customers WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
    }
} else {
    echo "Customer ID missing!";
}
?>

