<?php
  include 'connect.php';

  $sql = "UPDATE tasks SET name = '".$_POST["name"] . "',  description = '".$_POST["description"] . "', priority = '".$_POST["priority"] . "' WHERE id = '".$_POST["id"]."'";

  if ($conn->query($sql) === TRUE) {
      
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

  header("Refresh:0; url=tasks.php");
?>