<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "db.php";

// $result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$sql = "SELECT * FROM products order by id ASC";
$result = mysqli_query($conn, $sql);
if(!$result){
    die("SQL Error: ". mysqli_error($conn));     
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management System</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
     <link rel="stylesheet" href="style.css">
    
</head>

<body>

    <div class="container">
        <h1>Product Management System</h1>

        <form action="save_product.php" method="POST" id="productForm">
            <input
                type="text"
                name="product_name"
                id="product_name"
                placeholder="Product name"
                required>

            <input
                type="number"
                name="price"
                id="price"
                placeholder="Price"
                min="0"
                step="0.01"
                required>

            <input
                type="number"
                name="quantity"
                id="quantity"
                placeholder="Quantity"
                min="0"
                required>

            <input
                type="text"
                name="category"
                id="category"
                placeholder="Category"
                required>

            <button type="submit">Add Product</button>
        </form>

        <p id="message"></p>

        <h2>Available Products</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($product = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $product["id"] ?></td>
                        <td><?= htmlspecialchars($product["product_name"]) ?></td>
                        <td><?= number_format($product["price"], 2) ?></td>
                        <td><?= $product["quantity"] ?></td>
                        <td><?= htmlspecialchars($product["category"]) ?></td>
                        <td>
                            <a href="edit_product.php?id=<?= $product["id"] ?>">
                                Edit
                            </a>

                            <a
                                href="delete_product.php?id=<?= $product["id"] ?>"
                                onclick="return confirm('Are you sure you want to delete this product?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="script.js"></script>
</body>

</html>