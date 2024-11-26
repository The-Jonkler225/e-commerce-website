<!-- When called from the display page this code runs to delete an entry from the database -->

<?php
require 'db_connect.php'; // Include database connection

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement and check for sucesss
    if ($stmt->execute()) {
        // Redirect back to the display page after deletion
        header("Location: admin_panel.php?message=Record deleted successfully");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();

} else {
    echo "No ID specified for deletion.";
}

mysqli_close($conn);
?>