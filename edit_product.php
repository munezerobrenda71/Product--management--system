<?php

require "db.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("Invalid product ID.");
}

$id = (int) $_GET["id"];

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, product_name, price, quantity, category
     FROM products
     WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    die("Product not found.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Product</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <h1>Edit Product</h1>

        <form action="update_product.php" method="POST">

            <!-- Hidden field carries the product ID -->
            <input
                type="hidden"
                name="id"
                value="<?= $product["id"] ?>">

            <label for="product_name">Product Name</label>

            <input
                type="text"
                id="product_name"
                name="product_name"
                value="<?= htmlspecialchars($product["product_name"]) ?>"
                required>

            <label for="price">Price</label>

            <input
                type="number"
                id="price"
                name="price"
                value="<?= htmlspecialchars($product["price"]) ?>"
                min="0.01"
                step="0.01"
                required>

            <label for="quantity">Quantity</label>

            <input
                type="number"
                id="quantity"
                name="quantity"
                value="<?= htmlspecialchars($product["quantity"]) ?>"
                min="0"
                required>

            <label for="category">Category</label>

            <input
                type="text"
                id="category"
                name="category"
                value="<?= htmlspecialchars($product["category"]) ?>"
                required>

            <button type="submit">
                Update Product
            </button>

        </form>

        <br>

        <a href="index.php">
            Back to Products
        </a>

    </div>

</body>

</html>