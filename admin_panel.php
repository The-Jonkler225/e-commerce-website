<!-- Page displays all data currently inside of database and provides navigation options for adding new data and ammending current data--> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
<?php
        require 'db_connect.php'; // Include database connection

        $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search'])  : '';
        $query = "SELECT * FROM products WHERE product LIKE '%$search%'";
        $result = mysqli_query($conn, $query);
?>
</header>

<div class="container">
    

    <h1>Products</h1>
        <form action="admin_panel.php" method="GET">
            <input type="text" name="search" placeholder="Search by name or age">
            <button type="submit">Search</button>
        </form>
        <br>
        <a href="add_product.php">Add New Product<a> <br>
        <br>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['product']; ?></td>
                <td>£<?php echo $row['price']; ?></td>
                <td><a href="edit_product.php?id=<?php echo $row['id'];?>">Edit</a></td>
                <td><a href="delete_product.php?id=<?php echo $row['id'];?>">Delete</a></td>
            </tr>

            <?php endwhile; ?>
        </table>
    
    <?php mysqli_close($conn); ?>
    
    <br>
    <a href=index.php>Return Home</a>
</div>
</body>
</html>