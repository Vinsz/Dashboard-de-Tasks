<?php
  include 'connect.php';

  $sql = "DELETE FROM tasks WHERE id = '".$_GET["id"]."'";

  if ($conn->query($sql) === TRUE) {
      echo "Record Deleted";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
?>
<br>
<a href="tasks.php">Voltar</a>