<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../db.php";

$id = (int) ($_GET['id'] ?? 0);

$stmt = $conn->prepare(
    "SELECT invoices.*, customers.name
     FROM invoices
     JOIN customers ON invoices.customer_id = customers.id
     WHERE invoices.id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$invoice = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$invoice) {
    die("Invoice not found.");
}

$stmt = $conn->prepare(
    "SELECT * FROM invoice_items WHERE invoice_id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$items = $stmt->get_result();
?>

<h2>Invoice Details</h2>

<p>Invoice No: <?= htmlspecialchars($invoice['Invoice_number']) ?></p>
<p>Customer: <?= htmlspecialchars($invoice['name']) ?></p>
<p>Date: <?= htmlspecialchars($invoice['invoice_date']) ?></p>

<table border="1" cellpadding="8">
<tr>
    <th>Product</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
</tr>

<?php while ($item = $items->fetch_assoc()) { ?>
<tr>
    <td><?= htmlspecialchars($item['product_name']) ?></td>
    <td>₹<?= number_format($item['price'], 2) ?></td>
    <td><?= (int) $item['quantity'] ?></td>
    <td>₹<?= number_format($item['total'], 2) ?></td>
</tr>
<?php } ?>
</table>

<p>Subtotal: ₹<?= number_format($invoice['subtotal'], 2) ?></p>
<p>Discount: ₹<?= number_format($invoice['discount'], 2) ?></p>

<a href="index.php">Back to Invoices</a>

<?php
$stmt->close();
$conn->close();
?>

