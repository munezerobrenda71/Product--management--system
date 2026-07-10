<?php

require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$id = isset($_POST["id"])
    ? (int) $_POST["id"]
    : 0;

$productName = isset($_POST["product_name"])
    ? trim($_POST["product_name"])
    : "";

$price = isset($_POST["price"])
    ? (float) $_POST["price"]
    : 0;

$quantity = isset($_POST["quantity"])
    ? (int) $_POST["quantity"]
    : 0;

$category = isset($_POST["category"])
    ? trim($_POST["category"])
    : "";

if ($id <= 0) {
    die("Invalid product ID.");
}

if ($productName === "") {
    die("Product name is required.");
}

if ($price <= 0) {
    die("Price must be greater than zero.");
}

if ($quantity < 0) {
    die("Quantity cannot be negative.");
}

if ($category === "") {
    die("Category is required.");
}

$stmt = mysqli_prepare(
    $conn,
    "UPDATE products
     SET product_name = ?,
         price = ?,
         quantity = ?,
         category = ?
     WHERE id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "sdisi",
    $productName,
    $price,
    $quantity,
    $category,
    $id
);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
    exit;
}

die("Failed to update product: " . mysqli_error($conn));