<?php

// Include the database connection file.
// This gives us access to the $conn variable.
require "db.php";


// Check whether an 'id' has been passed in the URL.
//
// Example:
// delete_product.php?id=5
//
// Also ensure that the value is numeric.
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("Invalid product ID.");
}


// Convert the received ID into an integer.
//
// Example:
// "5" becomes 5
$id = (int) $_GET["id"];


// Prevent invalid IDs such as 0 or negative numbers.
if ($id <= 0) {
    die("Invalid product ID.");
}


// Prepare the SQL statement.
//
// The question mark (?) is called a placeholder.
// The actual ID will be supplied later.
//
// This technique helps protect the application
// against SQL Injection attacks.
$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM products WHERE id = ?"
);


// Check whether the SQL statement was prepared successfully.
if (!$stmt) {
    die("Failed to prepare delete query: " . mysqli_error($conn));
}


// Bind the product ID to the placeholder (?).
//
// "i" means the value being supplied is an Integer.
mysqli_stmt_bind_param($stmt, "i", $id);


// Execute the SQL statement.
//
// This sends the DELETE command to MySQL.
if (!mysqli_stmt_execute($stmt)) {
    die("Failed to delete product: " . mysqli_stmt_error($stmt));
}


// Close the prepared statement.
//
// This frees resources used by MySQL.
mysqli_stmt_close($stmt);


// Redirect the user back to the product list.
//
// After deleting a record, we don't want the user
// to remain on delete_product.php.
header("Location: index.php");


// Stop the script immediately after redirecting.
exit;