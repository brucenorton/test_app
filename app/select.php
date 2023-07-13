<?php
  //connect to the database
  require_once "db_connect.php";

  //create & execute the query as a prepared statement
  $stmt = mysqli_prepare($db_connect, "SELECT full_name, favourite_colour, timestamp FROM test ORDER BY timestamp DESC");
  mysqli_stmt_execute($stmt);

  //get the results
  $result = mysqli_stmt_get_result($stmt);
  //loop through the results, creating an array of arrays
  while($row = mysqli_fetch_assoc($result)) {
    $results[] = $row;
  }
  //encode the array in json format
  echo json_encode($results);

  //close connection
  mysqli_close($db_connect);

?>