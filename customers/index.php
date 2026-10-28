<?php
require_once"../db.php";
$sql="SELECT*FROM customers";
$result=mysqli_query($conn,$sql);
?>

<h2>Customer List</h2>

<a href="add.php">+ Add Customer</a>
<br><br>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Mobile</th>
        <th>Gender</th>
        <th>Action</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo htmlspecialchars($row['mobno']); ?></td>
            <td><?php echo htmlspecialchars($row['gender']); ?></td>
            <td><a href="edit.php?id=<?php echo $row['id'];?>">Edit |</a>
            <a href="delete.php?id=<?php echo $row['id']; ?>"
                onclick="return confirm('Are you sure you want to delete this customer?')">Delete</a></td>
        </tr>

    <?php } ?>

</table>