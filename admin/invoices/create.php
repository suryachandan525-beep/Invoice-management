<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../db.php";

$customers = $conn->query("SELECT * FROM customers");
$products = $conn->query(
    "SELECT * FROM products WHERE status = 'active'"
);
?>

<h2>Create Invoice</h2>

<form action="store.php" method="POST">

    <label>Customer:</label>
    <select name="customer_id" required>
        <option value="">Select Customer</option>

        <?php while ($row = $customers->fetch_assoc()) { ?>
            <option value="<?= $row['id'] ?>">
                <?= htmlspecialchars($row['name']) ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <label>Product:</label>
    <select name="product_id" required>
        <option value="">Select Product</option>

        <?php while ($row = $products->fetch_assoc()) { ?>
            <option value="<?= $row['id'] ?>">
                <?= htmlspecialchars($row['name']) ?>
                - ₹<?= $row['price'] ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <label>Quantity:</label>
    <input type="number" name="quantity" min="1" value="1" required>

    <br><br>

    <button type="submit" name="create">Create Invoice</button>

</form>

