<?php
require_once "db.php";

$name = "Chandan";
$email = "admin123@gmail.com";
$password = password_hash("Admin@123", PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO admins (name, email, password) VALUES (?, ?, ?)"
);

$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo "Admin account created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

