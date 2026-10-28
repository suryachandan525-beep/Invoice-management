<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../db.php";

$id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$product = $result->fetch_assoc();

$stmt->close();
$conn->close();

if (!$product) {
    die("Product not found");
}
?>

<h2>Edit Product</h2>

<form action="update.php" method="POST">

    <input type="hidden" name="id"
           value="<?= $product['id'] ?>">

    Name:
    <input type="text" name="name"
           value="<?= htmlspecialchars($product['name']) ?>" required>
    <br><br>

    Price:
    <input type="number" name="price" step="0.01"
           value="<?= $product['price'] ?>" required>
    <br><br>

    Status:
    <select name="status">
        <option value="active"
            <?= $product['status'] == 'active' ? 'selected' : '' ?>>
            Active
        </option>

        <option value="inactive"
            <?= $product['status'] == 'inactive' ? 'selected' : '' ?>>
            Inactive
        </option>
    </select>
    <br><br>

    <button type="submit" name="update">Update</button>
</form>

