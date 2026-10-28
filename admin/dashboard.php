<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>


<h1>Admin Dashboard</h1>

<h3>
    Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!
</h3>

<hr>

<h2>Manage Your Invoice System</h2>

<ul>
    <li>
        <a href="../customers/index.php">Customer Management</a>
    </li>

    <li>
        <a href="products/index.php">Product Management</a>
    </li>

    <li>
        <a href="invoices/index.php">Invoice Management</a>
    </li>

   
</ul>

<br>

<a href="logout.php">Logout</a>


</body>
</html>
