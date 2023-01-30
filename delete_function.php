<?php

function deleteOrder($orderId) {
  // Connect to the MySQL database
  $conn = mysqli_connect("host", "username", "password", "database");

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare a DELETE statement
  $stmt = mysqli_prepare($conn, "DELETE FROM orders WHERE order_id = ? AND status = 'pending'");

  // Bind the values to the placeholders
  mysqli_stmt_bind_param($stmt, "i", $orderId);

  // Execute the prepared statement
  mysqli_stmt_execute($stmt);

  // Close the prepared statement and the MySQL connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
?>