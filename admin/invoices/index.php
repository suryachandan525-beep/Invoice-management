<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../db.php";

$sql = "SELECT invoices.*, customers.name
        FROM invoices
        JOIN customers ON invoices.customer_id = customers.id
        ORDER BY invoices.id DESC";

$result = $conn->query($sql);
?>

<h2>Invoice List</h2>

<a href="create.php">Create Invoice</a>

<br><br>

<table border="1" cellpadding="8">
<tr>
    <th>Invoice No.</th>
    <th>Customer</th>
    <th>Date</th>
    <th>Subtotal</th>
    <th>Action</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= htmlspecialchars($row['Invoice_number']) ?></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['invoice_date']) ?></td>
    <td>₹<?= number_format($row['subtotal'], 2) ?></td>
    <td> <a href="view.php?id=<?= $row['id'] ?>">View</a> </td>
</tr>
<?php } ?>

</table>

