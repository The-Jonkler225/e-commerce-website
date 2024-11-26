<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        require 'db_connect.php'; // Include database connection
        $result = $_SESSION['cart']
    ?>

    <table>
        <tr>
            <th>Product</th>
            <th>Price</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result['cart'])): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['product']); ?></td>
            <td>£<?php echo htmlspecialchars($row['price']); ?></td>
        </tr>

        <?php endwhile; ?>
    </table>
</body>
</html>