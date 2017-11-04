<?php
  include 'connect.php';

  $sql = "DELETE FROM tasks WHERE id = '".$_GET["id"]."'";

  if ($conn->query($sql) === TRUE) {
      
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  header("Refresh:0; url=../tasks.php");
?>
