<?php

	session_start();

	$session = $_SESSION['userData'] ;
	$session["email"];
  include 'connect.php';

  $sql = "UPDATE tasks SET state = 0, done = '' WHERE id = '".$_GET["id"]."'";

  if ($conn->query($sql) === TRUE) {
      
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

  header("Refresh:0; url=tasks.php");
?>
