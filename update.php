<?php
  include 'connect.php';

  $sql = "UPDATE tasks SET name = '".$_POST["name"] . "',  description = '".$_POST["description"] . "', priority = '".$_POST["priority"] . "', state = '".$_POST["status"] . "' WHERE id = '".$_POST["id"]."'";

  if ($conn->query($sql) === TRUE) {
      echo "Record Updated";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
?>
<br>
<a href="tasks.php">Voltar</a>