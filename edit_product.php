<!-- Page uses collected data from display page and provides the ability for the user to edit the data -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <?php
            require 'db_connect.php'; // Include database connection

            if (isset($_GET['id'])) {
                $id = (int)$_GET['id'];
                $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
                $products = mysqli_fetch_assoc($result);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $product = mysqli_real_escape_string($conn, $_POST['product']);
                $price = mysqli_real_escape_string($conn, $_POST['price']);
        
                $stmt = $conn->prepare("UPDATE products SET product = ?, price = ? WHERE id = ?");
                $stmt->bind_param("sdi", $product, $price, $id);
        
                if ($stmt->execute()) {
                    echo "Updated successfully.";
                    header("Location: admin_panel.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
        
                $stmt->close();
            }
    ?>
</header>
    <div class="container">
        <h1>Update Product Information</h1>
        <br>
        <form action="edit_product.php?id=<?php echo $products['id']; ?>" method="POST">
            <label for="id">ID: <?php echo htmlspecialchars($products['id']); ?></label> <br> <br>
            <br>
            <label for="product">Product</label> <br> <br>
            <input type="text" name="product" value="<?php echo htmlspecialchars($products['product']); ?>" required>
            <br> <br>
            <label for="price">Price</label> <br> <br>
            <input type="float" name="price" value="<?php echo htmlspecialchars($products['price']); ?>" required>
            <br> <br>
            <button type="sumbit">Update</button>
        </form>
    </div>
</body>
</html>