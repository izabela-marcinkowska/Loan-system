<?php
// Connect to database
require_once __DIR__ . "/db.php";

// Create a new DB object
$db = new DB();

// Check if the addType form was submitted
$isAddType = isset($_POST['addType']);
// Check if the addItem form was submitted
$isAddItem = isset($_POST['addItem']);
// Check if the delType form was submitted
$isDelType = isset($_GET['delType']);

// If the addType form was submitted, add a new itemtype
if ($isAddType) {
  // Build the query
  $query = "INSERT INTO itemtypes(name) VALUES (?)";
  // Get the form data and sanitize it
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
  // Run the query and replace ? with string $name
  $sth = $db->runQuery($query, 's', $name);

  // Show success message
  echo "<h4>Itemtype added</h4>";
}

// If the describe form was submitted, add a new 
if ($isAddItem) {
  // Build the query
  $query = "INSERT INTO items(type, description) VALUES (?, ?)";
  // Get the form data and sanitize it
  $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT);
  $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_SPECIAL_CHARS);
  // Run the query and replace ? with int type and string desc
  $sth = $db->runQuery($query, 'is', $type, $desc);

  // Show success message
  echo "<h4>Item added</h4>";
}

// If the delType form was submitted, delete an itemtype or item
if ($isDelType) {
  // Get the form data and sanitize it
  $id = filter_input(INPUT_GET, 'delType', FILTER_SANITIZE_NUMBER_INT);
  // Build the query
  $query = "DELETE FROM itemtypes WHERE id = ?";
  // Run the query  and replace ? with int id
  $sth = $db->runQuery($query, 'i', $id);

  // Show success message
  echo "<h4>Item with id: $id deleted";
}
