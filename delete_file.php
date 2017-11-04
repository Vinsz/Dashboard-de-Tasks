<?php

	$filename_with_extension = $_GET["name"];
	unlink( "uploads/".$filename_with_extension );

	include 'connect.php';


	$sql = "UPDATE tasks SET attach = attach-1 WHERE id = '".$_GET["id_task"]."';";

	$sql .= "DELETE FROM attachments WHERE id='".$_GET["id"]."';";

	if ($conn->multi_query($sql) === TRUE) {
	    
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

	header('Location: ' . $_SERVER["HTTP_REFERER"] );
	exit;
?>