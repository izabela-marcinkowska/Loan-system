<?php

require_once __DIR__ . "/db.php";
require_once __DIR__ . "/templater.php";

// Connect to the database.
$db = new DB();
// Create a new instance of the Templater class and pass the path to the templates folder.
$templater = new Templater(__DIR__ . "/templates/");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
  <title>Lånesystem</title>

  <style>
    .content-wrapper {
      width: 880px;
      margin: 0 auto;
    }
  </style>
</head>

<body>
  <div class="content-wrapper">
    <div class="header">
      <h1>Lånesystem</h1>
    </div>
    <div class="pure-g">
      <?php
      // Query to get all item types from itemtypes and items tables
      $itemTypesQuery = "SELECT itemtypes.id AS tid, itemtypes.name, items.description
      FROM itemtypes
      LEFT JOIN items ON items.type = itemtypes.id
      ORDER BY itemtypes.name ASC";
      // Run the query and store the results as array in $items
      $result = $db->runQuery($itemTypesQuery);
      $items = $result->fetch_all(MYSQLI_ASSOC);
      // Render the template and pass the $items array 
      $templater->render("add-loan-type.tpl.php", ['items' => $items]);
      ?>
    </div>
    <div class="pure-g">
      <?php
      // Query to get all loan items
      $loanItemsQuery = "SELECT items.id, itemtypes.name, loan.active
      FROM items
      LEFT JOIN loan ON loan.item = items.id
      LEFT JOIN itemtypes ON itemtypes.id = items.type";
      // Run the query and store the results in $loanItems
      $loanItemsResult = $db->runQuery($loanItemsQuery);
      $loanItems = $loanItemsResult->fetch_all(MYSQLI_ASSOC);
      // Query to get all users
      $usersQuery = "SELECT id, username FROM user ORDER BY username ASC";
      // Run the query and store the results in $users
      $usersResult = $db->runQuery($usersQuery);
      $users = $usersResult->fetch_all(MYSQLI_ASSOC);
      // Render the template and pass the $loanItems and $users arrays to it
      $templater->render("register-loan.tpl.php", ['items' => $loanItems, 'users' => $users]);
      ?>
    </div>
    <div class="pure-g">
      <?php
      // Query to get all loans
      $loansQuery = $query = "SELECT loan.id AS lid, active, item, loandate, returndate, description, name AS itemtype, loan.user AS loaner, user.username AS username
      FROM loan
      LEFT JOIN items ON items.id = loan.item
      LEFT JOIN itemtypes ON itemtypes.id = items.type
      LEFT JOIN user ON user.id = loan.user
      ORDER BY loandate DESC";
      // Run the query and store the results in $listLoans
      $listLoansResult = $db->runQuery($loansQuery);
      $listLoans = $listLoansResult->fetch_all(MYSQLI_ASSOC);
      // Render the template and pass the $listLoans array to it
      $templater->render("list-loans.tpl.php", ['loans' => $listLoans]);
      ?>
    </div>
  </div>
</body>

</html>
