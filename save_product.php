<?php

require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productName = trim($_POST["product_name"]);
    $price = (float) $_POST["price"];
    $quantity = (int) $_POST["quantity"];
    $category = trim($_POST["category"]);

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO products
        (product_name, price, quantity, category)
        VALUES (?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sdis",
        $productName,
        $price,
        $quantity,
        $category
    );

    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

// <?php

// // Include the database connection file.
// //
// // This gives us access to the $conn variable,
// // which allows PHP to communicate with MySQL.
// require "db.php";


// // Check whether this page was accessed using the POST method.
// //
// // The form in index.php uses:
// //
// // <form method="POST">
// //
// // so this code only runs when the form is submitted.
// if ($_SERVER["REQUEST_METHOD"] === "POST") {

//     // Retrieve the values submitted from the HTML form.
//     //
//     // trim() removes unnecessary spaces from the beginning
//     // and end of the text.
//     $productName = trim($_POST["product_name"]);

//     // Convert the submitted price into a decimal number (float).
//     $price = (float) $_POST["price"];

//     // Convert the quantity into an integer.
//     $quantity = (int) $_POST["quantity"];

//     // Remove unnecessary spaces from the category.
//     $category = trim($_POST["category"]);


//     // Prepare the SQL INSERT statement.
//     //
//     // The question marks (?) are placeholders.
//     // The real values will be supplied later.
//     //
//     // Using prepared statements protects the application
//     // against SQL Injection attacks.
//     $stmt = mysqli_prepare(
//         $conn,
//         "INSERT INTO products
//         (product_name, price, quantity, category)
//         VALUES (?, ?, ?, ?)"
//     );


//     // Check whether the SQL statement was prepared successfully.
//     if (!$stmt) {
//         die("Failed to prepare query: " . mysqli_error($conn));
//     }


//     // Bind the PHP variables to the placeholders.
//     //
//     // "sdis" means:
//     //
//     // s = String  -> product_name
//     // d = Double  -> price
//     // i = Integer -> quantity
//     // s = String  -> category
//     mysqli_stmt_bind_param(
//         $stmt,
//         "sdis",
//         $productName,
//         $price,
//         $quantity,
//         $category
//     );


//     // Execute the SQL statement.
//     //
//     // This sends the INSERT command to MySQL
//     // and saves the new product into the database.
//     if (!mysqli_stmt_execute($stmt)) {
//         die("Failed to save product: " . mysqli_stmt_error($stmt));
//     }


//     // Close the prepared statement to free resources.
//     mysqli_stmt_close($stmt);


//     // Redirect the user back to the home page.
//     //
//     // The newly added product will now appear in the table.
//     header("Location: index.php");


//     // Stop the script immediately after redirecting.
//     exit;
// }