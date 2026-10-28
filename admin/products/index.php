<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../db.php";

$sql = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
</head>
<body>

    <h1>Product Management</h1>

    <p>
        Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!
    </p>

    <a href="add.php">Add New Product</a>
    |
    <a href="../dashboard.php">Back to Dashboard</a>

    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>

                <?php while ($product = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo (int) $product['id']; ?></td>

                        <td>
                            <?php echo htmlspecialchars($product['name']); ?>
                        </td>

                        <td>
                            ₹<?php echo number_format((float) $product['price'], 2); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($product['status']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($product['created_at'] ?? ''); ?>
                        </td>

                        <td>
                            <a href="edit.php?id=<?php echo (int) $product['id']; ?>">Edit</a>
                            |
                            <a href="delete.php?id=<?php echo (int) $product['id']; ?>"
                               onclick="return confirm('Are you sure you want to delete this product?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>

            <?php else: ?>

                <tr>
                    <td colspan="6">No products found.</td>
                </tr>

            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>

