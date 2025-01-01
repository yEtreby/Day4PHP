<?php
$conn = mysqli_connect("localhost", "root", "", "Day4db");
if (!$conn) {
    echo mysqli_connect_error();
    exit;
}

$id=filter_input(INPUT_GET,'id');

$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f9;
        }
        .container {
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Details</h1>
        <?php if ($row): ?>
            <p><strong>ID:</strong> <?= $row['id'] ?></p>
            <p><strong>Name:</strong> <?= $row['name'] ?></p>
            <p><strong>Email:</strong> <?= $row['email'] ?></p>
            <p><strong>Gender:</strong> <?= $row['gender'] ?></p>
        <?php else: ?>
            <p>No user found with the specified ID.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
