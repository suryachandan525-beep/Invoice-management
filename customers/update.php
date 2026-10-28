<?php
require_once "../db.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $age = $_POST['age'];
    $mobno = trim($_POST['mobno']);
    $gender = $_POST['gender'];

    $sql = "UPDATE customers SET name=?, age=?, mobno=?, gender=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sissi", $name, $age, $mobno, $gender, $id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
    }
} else {
    echo "Please submit the edit form.";
}
?>

