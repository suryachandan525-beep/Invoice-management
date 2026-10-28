<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>

    <h1>Add New Product</h1>

    <form action="store.php" method="POST">

        <label>Product Name:</label><br>
        <input type="text" name="name" required>
        <br><br>

        <label>Price (₹):</label><br>
        <input type="number" name="price" step="0.01" min="0.01" required>
        <br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        <br><br>

        <button type="submit" name="save">Save Product</button>

    </form>

    <br>

    <a href="index.php">Back to Products</a>

</body>
</html>
