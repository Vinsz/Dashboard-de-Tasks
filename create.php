<?php
	include 'connect.php';

	$sql = "INSERT INTO tasks (name, description, priority, state) VALUES ('".$_POST["name"]."','".$_POST["description"]."','".$_POST["priority"]."','".$_POST["status"]."')";

	if ($conn->query($sql) === TRUE) {
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>
<br>
<a href="tasks.php">Voltar</a>