<?php
	session_start();

	$session = $_SESSION['userData'] ;
	$session["email"];

	include 'connect.php';

	//verifica quantos arquivos estão sendo recebidos na superglobal $)FILES
	$total_arquivos = count($_FILES['arquivos']['name']);
	
	//diretório de upload
	$diretorio_upload = 'uploads/';

	$sql = "INSERT INTO tasks (name, description, priority, state, attach, user) VALUES ('".$_POST["name"]."','".$_POST["description"]."','".$_POST["priority"]."','".$_POST["status"]."', '".$total_arquivos."', '".$session["email"]."');";

	$sql .= "SET @last = last_insert_id();";

	//percorre cada arquivo
	for ($i=0; $i < $total_arquivos; $i++) {
		//move o arquivo temporario para o destino
		$arquivo_upload = $diretorio_upload . basename($_FILES['arquivos']['name'][$i]);
		if (move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], $arquivo_upload)) {
			$sql .= "INSERT INTO attachments (id_task, name) VALUES (@last, '".basename($_FILES['arquivos']['name'][$i])."');";
			echo "Sucesso<br />";
		} else {
			echo "Erro<br />";
		}
	}

	if ($conn->multi_query($sql) === TRUE) {
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

	header("Refresh:0; url=tasks.php");
?>