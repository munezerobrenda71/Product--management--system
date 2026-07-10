<?php

// The try block contains code that may produce an error.
// If an error occurs while connecting to the database,
// execution jumps to the catch block.
try {

    // mysqli_connect() establishes a connection to the MySQL database.
    // It takes four main parameters:
    // 1. Database server (hostname)
    // 2. Database username
    // 3. Database user's password
    // 4. Database name
    $conn = mysqli_connect(
        "localhost",      // MySQL server
        "root",   // MySQL username
        "",       // MySQL password
        "product_system"  // Database to connect to
    );

} catch (mysqli_sql_exception $error) {

    // If the connection fails, a mysqli_sql_exception is thrown.
    // $error->getMessage() returns the actual error message.
    // die() displays the message and immediately stops the script.
    die("Database connection failed: " . $error->getMessage());
}