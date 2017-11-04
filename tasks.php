<!DOCTYPE html>
<head>
	<meta charset="utf-8" />

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="./js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="./js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="./js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="./js/fileinput.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="./themes/fa/theme.js"></script>
    <script src="./js/locales/<lang>.js"></script>

	<style>
		table, th, td {
		    border: 1px solid black;
		    border-collapse: collapse;
		}
	</style>


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
					    <th>Número de Anexos</th>
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
					    <td><a href="task_view.php?id=' . $row["id"] . '">' . $row["name"] . '</a></td>
					    <td>' . $row["description"] . '</td>
					    <td>' . $row["priority"] . '</td>
					    <td color:>' . $status . '</td>
					    <td>' . $row["user"] . '</td>
					    <td>' . $row["attach"] . '</td>
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
<a href="new_task.php"> <button class="btn btn-primary">Criar Task</button></a>

<br><br>
<a href="logout.php"> <button class="btn btn-primary">Desconectar</button></a>

</body>
</html>

