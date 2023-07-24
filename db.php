<?php
// Create a new class DB that extends the class mysqli
class DB extends mysqli
{
  // Define a constructor function that calls the parent constructor
  // and sets the charset to utf8
  public function __construct($dbhost = "mariadb", $user = "root", $password = "changepassword", $dbname = "dblabb")
  {
    parent::__construct($dbhost, $user, $password, $dbname);
    if ($this->connect_error) {
      die("Connection failed: " . $this->connect_error);
    }
    $this->set_charset("utf8");
  }

  // Define a function runQuery that takes a query string and an array
  // of parameters as arguments
  public function runQuery($query, ...$params)
  {
    // Prepare the query string
    $stmt = $this->prepare($query);
    if (!$stmt) {
      return "Query preparation failed: " . $this->error;
    }

    // Bind the parameters if any
    if (!empty($params)) {
      $stmt->bind_param(...$params);
    }

    // Execute the query
    if (!$stmt->execute()) {
      return "Query execution failed: " . $stmt->error;
    }

    // Return the result
    return $stmt->get_result();
  }

  // Define a destructor function that closes the connection
  public function __destruct()
  {
    $this->close();
  }
}
