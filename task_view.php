<!DOCTYPE html>
<head>
</head>
<html>
<body>

<?php

include 'connect.php';

$sql = "SELECT * FROM tasks WHERE id = '".$_GET["id"]."'";

$result = $conn->query($sql);

	echo 	'<h1> Task: </h1>';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	if ($row["state"] == '0')
    		$status = "<font color='red'>Undone</font>";
    	else
    		$status = "<font color='green'>Done</font>";
		echo 	'Nome: ' . $row["name"] . 
				'<br>Descrição: ' . $row["description"] . 
				'<br>Prioridade: ' . $row["priority"] . 
				'<br>Status: ' . $status . 
				'<br>Criada por: ' . $row["user"] . 
				'<br>Número de Anexos: ' . $row["attach"] . 
				'<br><a href="delete.php?id=' . $row["id"] . '"> Excluir </a>
				 <br><a href="edit.php?id=' . $row["id"] . '"> Editar </a>';
	}					    
} else {
	echo "0 results";
}

$sql = "SELECT * FROM attachments WHERE id_task = '".$_GET["id"]."'";

$result = $conn->query($sql);

	echo '<br>Anexo(s): ';
if ($result->num_rows > 0) {
    while($row= $result->fetch_assoc()) {
		echo '<br><a href="download.php?name=' . $row["name"] .'">'. $row["name"] .' </a>';
	}
} else {
	echo "<br>0 results";
}

$conn->close();
?> 
<br><br><br><a href="tasks.php">Voltar para o Dashboard!</a>
</body>
</html>

