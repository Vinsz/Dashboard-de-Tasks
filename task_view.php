<!DOCTYPE html>
<head>

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

</head>
<html>
<body>

<?php

include 'db/connect.php';

$sql = "SELECT * FROM tasks WHERE id = '".$_GET["id"]."'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	if ($row["state"] == '0')
    		$status = "<font color='red'>Undone</font>";
    	else
    		$status = "<font color='green'>Done</font>";


		echo '<div class="container">
				<h2> ' . $row["name"] . '</h2>'; 

		echo '<a href="db/delete.php?id=' . $row["id"] . '"> <span class="glyphicon glyphicon-remove"></span> </a>
		<a href="edit.php?id=' . $row["id"] . '"> <span class="glyphicon glyphicon-edit"></span> </a>';

		echo '<br><label for="exampleFormControlTextarea1">Descrição: </label> ' . $row["description"] . 
				'<br><label class="form-check-label" > Prioridade: </label> ' . $row["priority"] . 
				'<br><label class="form-check-label" > Status: </label> ' . $status . 
				'<br><label class="form-check-label" > Criada Por: </label> ' . $row["user"] . 
				'<br><label class="form-check-label" > Número de Anexos: </label> ' . $row["attach"] ;
	}					    
} else {
	echo "0 results";
}

$sql = "SELECT * FROM attachments WHERE id_task = '".$_GET["id"]."'";

$result = $conn->query($sql);

	echo '<br><label class="control-label">Arquivos Anexados:</label> ';
if ($result->num_rows > 0) {
    while($row= $result->fetch_assoc()) {
		echo '<br><a href="download.php?name=' . $row["name"] .'">'. $row["name"] .' </a>';
	}
} else {
	echo "<br>0 results";
}
$conn->close();
?> 
 <br><br><a href="tasks.php"> <button class="btn btn-primary">Voltar</button></a>
</body>
</html>