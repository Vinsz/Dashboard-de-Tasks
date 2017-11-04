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
 

echo '<h1> Tasks: </h1>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Nome</th>
		      	<th scope="col">Descrição</th>
				<th scope="col">Prioridade</th>
			    <th scope="col">Status</th>
			    <th scope="col">Criada Por</th>
			    <th scope="col">Anexos</th>
			    <th scope="col">Finalizada Por</th>
			    <th scope="col">Excluir</th>
			    <th scope="col">Editar</th>
		    </tr>
		</thead>';

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if ($row["state"] == '0')
			$status = "<font color='red'>Undone </font><a href='update_task.php?id=".$row["id"]."'><span class='glyphicon glyphicon-ok'></span></a>";
		else
			$status = "<font color='green'>Done</font>";

echo '<tbody>
		<tr>
			<td><a href="task_view.php?id=' . $row["id"] . '">' . $row["name"] . ' <span class="glyphicon glyphicon-eye-open"></span></a></td>
			<td>' . $row["description"] . '</td>
		    <td>' . $row["priority"] . '</td>
		    <td color:>' . $status . '</td>
		    <td>' . $row["user"] . '</td>
			<td>' . $row["attach"] . '</td>
			<td>' . $row["done"] . '</td>
			<td><a href="delete.php?id=' . $row["id"] . '"> <span class="glyphicon glyphicon-remove"></span> </a></td>
			<td><a href="edit.php?id=' . $row["id"] . '"> <span class="glyphicon glyphicon-edit"></span> </a></td>
		</tr>
	  </tbody>';
	}
} else
	echo "Sem Tarefas";


echo '</table>';

$conn->close();

?> 

<br>
<a href="new_task.php"> <button class="btn btn-primary">Criar Task</button></a>

<br><br>
<a href="logout.php"> <button class="btn btn-primary">Desconectar</button></a>

</body>
</html>

