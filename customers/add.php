<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors'], $_SESSION['old']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
</head>
<body>

<h2>Add Customer</h2>

<?php
foreach ($errors as $error) {
    echo "<p style='color:red'>" . htmlspecialchars($error) . "</p>";
}
?>

<form action="store.php" method="POST">

    Name:
    <input type="text" name="name"
        minlength="3" pattern="[a-zA-Z ]+" required
        value="<?= htmlspecialchars($old['name'] ?? '') ?>">
    <br><br>

    Age:
    <input type="number" name="age" min="1" max="120"
        required value="<?= htmlspecialchars($old['age'] ?? '') ?>">
    <br><br>

    Mobile:
    <input type="text" name="mobno" pattern="[0-9]{10}"
        maxlength="10" inputmode="numeric" required
        value="<?= htmlspecialchars($old['mobno'] ?? '') ?>">
    <br><br>

    Gender:
    <select name="gender" required>
        <option value="">Select Gender</option>
        <option value="Male" <?= ($old['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= ($old['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
        <option value="Other" <?= ($old['gender'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
    </select>
    <br><br>

    <button type="submit" name="save">Save Customer</button>

</form>

<br>
<a href="index.php">Back to Customer List</a>

</body>
</html>

