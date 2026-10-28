<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../db.php";

$customer_id = (int) $_POST['customer_id'];
$product_id = (int) $_POST['product_id'];
$quantity = (int) $_POST['quantity'];

$stmt = $conn->prepare(
    "SELECT name, price FROM products WHERE id=? AND status='active'"
);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$product || $customer_id <= 0 || $quantity <= 0) {
    die("Invalid data.");
}

$name = $product['name'];
$price = (float) $product['price'];
$total = $price * $quantity;
$discount = 0;
$number = "INV-" . time();
$date = date("Y-m-d");

$stmt = $conn->prepare(
    "INSERT INTO invoices
    (invoice_number, customer_id, invoice_date, subtotal, discount)
    VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param("sisdd", $number, $customer_id, $date, $total, $discount);
$stmt->execute();

$invoice_id = $conn->insert_id;
$stmt->close();

$stmt = $conn->prepare(
    "INSERT INTO invoice_items
    (invoice_id, product_id, product_name, price, quantity, total)
    VALUES (?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param("iisdid", $invoice_id, $product_id, $name, $price, $quantity, $total);
$stmt->execute();

$stmt->close();
$conn->close();

echo "Invoice created successfully!";
?>

