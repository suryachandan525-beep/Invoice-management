<?php
require_once "../db.php";

$id = $_GET['id'];
$sql = "SELECT * FROM customers WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$customer = mysqli_fetch_assoc($result);

if (!$customer) {
    die("Customer not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
</head>
<body>
    <h2>Edit Customer</h2>

    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">

        <label>Customer Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($customer['name']); ?>" required>
        <br><br>

        <label>Age:</label>
        <input type="number" name="age" value="<?php echo $customer['age']; ?>" required>
        <br><br>

        <label>Mobile Number:</label>
        <input type="text" name="mobno" value="<?php echo htmlspecialchars($customer['mobno']); ?>" required>
        <br><br>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="Male" <?php if ($customer['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($customer['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if ($customer['gender'] == 'Other') echo 'selected'; ?>>Other</option>
        </select>
        <br><br>

        <button type="submit" name="update">Update Customer</button>
        <a href="index.php">Back to Customer List</a>
    </form>
</body>
</html>

<?php mysqli_stmt_close($stmt); ?>

