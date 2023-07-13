<?php
  //insert.php
  //i.e. https://nortonb.web582.com/test_app/app/insert.php?full_name=Jane&favourite_colour=red

  //connect to the database
  require_once "db_connect.php";
  $results = [];
  $insertedRows = 0;

  if($db_connect){
    $query = "INSERT INTO test (full_name, favourite_colour) VALUES (?, ?)";
    

    if($statement = mysqli_prepare($db_connect, $query)){
      mysqli_stmt_bind_param($statement, 'ss', $_REQUEST["full_name"], $_REQUEST["favourite_colour"]);
      mysqli_stmt_execute($statement);
      $insertedRows = mysqli_stmt_affected_rows($statement);
      mysqli_stmt_close($statement);

      if($insertedRows > 0){
        $results[] = [
          "insertedRows"=>$insertedRows,
          "id"=>$db_connect->insert_id,
          "full_name"=>$_REQUEST["full_name"],
          "favourite_colour"=>$_REQUEST["favourite_colour"],
        ];
      } else {
        $results[] = [
          "insertedRows"=>$insertedRows,
          "message"=>"insert failed",
        ];
      }
    } else {
      $results[] = [
        "message"=>"no statement ran",
      ];
    }
    echo json_encode($results);
  }
  //close connection
  mysqli_close($db_connect);
?>