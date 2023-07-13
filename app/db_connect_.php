<?php

  /* You should enable error reporting for mysqli before attempting to make a connection */
  //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 
  //  Connection Information
  $host = "localhost:3306";  // always this value
  $db = "[your db name]";        // the database name you are using
  $user = "[your user name]";      // usename for the database
  $pass = "** your pass word **";      // password for the database

  //create an empty array for responses
  $db_response = [];
  $db_response['success'] = 'not set';
  //  Establish connection: host, user, password, database
  //  The connection variable is called $db_connect
  $db_connect = mysqli_connect($host,$user,$pass,$db);
  if (!$db_connect) {
    $db_response['success'] = false;
  }else{
    $db_response['success'] = true;
  }
   
  //comment out once working.
 // echo json_encode($db_response);

?>