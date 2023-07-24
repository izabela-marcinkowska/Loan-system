<?php

require_once __DIR__ . "/db.php";

$db = new DB();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize the input
  $return = filter_input(INPUT_POST, 'returndate', FILTER_SANITIZE_NUMBER_FLOAT);
  $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_NUMBER_INT);
  $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_NUMBER_INT);

  // Check if there is already an active loan for the item
  $query = "SELECT active FROM loan WHERE item = ? AND (active = 0 OR active = '')";
  $stmt = $db->prepare($query);
  $stmt->bind_param('i', $item);

  if ($stmt->execute()) {
    $stmt->store_result();
    if ($stmt->num_rows === 0) {
      // No active loan found, proceed to insert the new loan
      $query = "INSERT INTO loan(item, user, returndate) VALUES (?, ?, ?)";
      $stmt = $db->prepare($query);
      $stmt->bind_param('iis', $item, $user, $return);

      if ($stmt->execute()) {
        echo "Loan for item with id " . $item . " registered.";
      } else {
        echo "<h4>Error</h4>";
        echo "<pre>" . $stmt->error . "</pre>";
      }
    } else {
      // An active loan for the item already exists
      echo "A loan for item with id: " . $item . " is already active.";
    }
  } else {
    echo "<h4>Error</h4>";
    echo "<pre>" . $stmt->error . "</pre>";
  }
  $stmt->close();
}

// Check if the returnItem parameter is set
if (isset($_GET['returnItem']) && $_SERVER["REQUEST_METHOD"] == "GET") {
  // Sanitize the input
  $id = filter_input(INPUT_GET, 'returnItem', FILTER_SANITIZE_NUMBER_INT);

  // Update the active field to mark the item as returned
  $query = "UPDATE loan SET active='0' WHERE id = ?";
  $stmt = $db->prepare($query);
  $stmt->bind_param('i', $id);

  if ($stmt->execute()) {
    echo "<h4>Item type with id: " . $id . " returned.";
  } else {
    echo "<h4>Error</h4>";
    echo "<pre>" . $stmt->error . "</pre>";
  }
  $stmt->close();
}
