<!-- Collects the information required for a new entry into the database -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
<?php require 'db_connect.php'; // Include database connection ?>
</header>

    <div class="container">
        <h1>Add new product</h1>
        <br>
        <form action="add_product.php" method="POST">
            <input type="text" name="product" placeholder="Product" required><br>
            <br>
            <input type="float" name="price" placeholder="Price" required><br>
            <br>
            <button type="submit">Add Product</button>
        </form>
        <br>
        <a href="admin_panel.php">Return</a>
        <br>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $product = mysqli_real_escape_string($conn, $_POST['product']);
        $price = $_POST['price'];

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO products (product, price) VALUES (?, ?)");
        $stmt->bind_param("sd", $product, $price);

        if ($stmt->execute()) {
            echo "New product record created successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }

    ?>
    </div>
</body>
</html>