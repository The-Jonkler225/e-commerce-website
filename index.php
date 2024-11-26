<!-- Page displays all data currently inside of database and provides navigation options for adding new data and ammending current data--> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
    

    <h1>Products on sale</h1>
        <form action="index.php" method="GET">
            <input type="text" name="search" placeholder="Search by name or age">
            <button type="submit">Search</button>
        </form>

        <br>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['product']); ?></td>
                <td>£<?php echo htmlspecialchars($row['price']); ?></td>
                <td><a href="add_basket.php?id=<?php echo $row['id'];?>">Add to basket</a></td>
            </tr>

            <?php endwhile; ?>
        </table>
    
    <?php mysqli_close($conn); ?>
    
    <br>
    <a href="admin_panel.php">Admin Panel</a>
    <br>
    <a href="basket.php">Go to basket</a>
</div>
</body>
</html>