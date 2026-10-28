<?php
session_start();
require_once "../db.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['save'])) {
    header("Location: add.php");
    exit;
}

$name = trim($_POST['name'] ?? '');
$age = $_POST['age'] ?? '';
$mobno = trim($_POST['mobno'] ?? '');
$gender = $_POST['gender'] ?? '';

$errors = [];

// Name validation
if ($name == '')
    $errors[] = "Name required!";
elseif (!preg_match("/^[a-zA-Z ]+$/", $name))
    $errors[] = "Name mein sirf letters aur spaces allowed hain!";
elseif (strlen($name) < 3)
    $errors[] = "Name minimum 3 characters ka hona chahiye!";

// Age validation
if ($age === '' || filter_var($age, FILTER_VALIDATE_INT) === false || $age < 1 || $age > 120)
    $errors[] = "Age 1-120 honi chahiye!";

// Mobile validation
if (!preg_match("/^[0-9]{10}$/", $mobno))
    $errors[] = "Mobile exactly 10 digits ka hona chahiye!";

// Gender validation
if (!in_array($gender, ['Male', 'Female', 'Other'], true))
    $errors[] = "Valid gender select karein!";

// Save old data and errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = [
        'name' => $name,
        'age' => $age,
        'mobno' => $mobno,
        'gender' => $gender
    ];

    header("Location: add.php");
    exit;
}

// Insert customer
$sql = "INSERT INTO customers (name, age, mobno, gender) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Query preparation failed!");
}

$age = (int)$age;
mysqli_stmt_bind_param($stmt, "siss", $name, $age, $mobno, $gender);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    unset($_SESSION['old'], $_SESSION['errors']);
    header("Location: index.php");
    exit;
}

mysqli_stmt_close($stmt);
die("Customer save nahi ho paya!");
?>

