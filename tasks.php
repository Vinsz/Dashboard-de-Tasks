<!DOCTYPE html>
<head>
	<meta charset="utf-8" />

	<style>
		table, th, td {
		    border: 1px solid black;
		    border-collapse: collapse;
		}
		.color {
			color: green;
		}
	</style>

<script type="text/javascript">

	function Color($status) {
	    if ($status == "0")
	        return 'green';
	    else
	        return = 'red';

	}
</script>

</head>
<html>
<body>

<?php

include 'connect.php';

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

	echo 	'<h1> Tasks: </h1>
			<table style="width:100%">
					  <tr>
					    <th>Nome</th>
					    <th>Descrição</th> 
					    <th>Prioridade</th>
					    <th>Status</th>
					    <th>Criado Por:</th>
					    <th></th>
					    <th></th>
					  </tr>';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	if ($row["state"] == '0')
    		$status = "<font color='red'>Undone</font>";
    	else
    		$status = "<font color='green'>Done</font>";
		echo 	'<tr>
					    <td>' . $row["name"] . '</td>
					    <td>' . $row["description"] . '</td>
					    <td>' . $row["priority"] . '</td>
					    <td color:>' . $status . '</td>
					    <td>' . $row["user"] . '</td>
					    <td><a href="delete.php?id=' . $row["id"] . '"> excluir </a></td>
					    <td><a href="edit.php?id=' . $row["id"] . '"> editar </a></td>
				</tr>';
	}					    
} else {
	echo "0 results";
}

echo '</table>';

$conn->close();
?> 

<br>
<a href="new_task.php"> <input type="submit" name="submit" value="Criar Task"> </a>

</body>
</html>

