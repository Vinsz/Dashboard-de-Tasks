<?php
	session_start();

	$session = $_SESSION['userData'] ;
	$session["email"];

	include 'connect.php';

	if (!file_exists('../uploads')) {
		mkdir('../uploads', 0777, true);
	}

	//verifica quantos arquivos estão sendo recebidos na superglobal $)FILES
	$total_arquivos = count($_FILES['arquivos']['name']);
	
	if (basename($_FILES['arquivos']['name']['0']) == ""){
		$total_arquivos = 0;
	}

	//diretório de upload
	$diretorio_upload = '../uploads/';

	if ($_POST["status"]=="1") {
		$sql = "INSERT INTO tasks (name, description, priority, state, attach, user, done) VALUES ('".$_POST["name"]."','".$_POST["description"]."','".$_POST["priority"]."','".$_POST["status"]."', '".$total_arquivos."', '".$session["email"]."', '".$session["email"]."');";
	} else {
		$sql = "INSERT INTO tasks (name, description, priority, state, attach, user) VALUES ('".$_POST["name"]."','".$_POST["description"]."','".$_POST["priority"]."','".$_POST["status"]."', '".$total_arquivos."', '".$session["email"]."');";
	}	

	$sql .= "SET @last = last_insert_id();";

	//percorre cada arquivo
	for ($i=0; $i < $total_arquivos; $i++) {
		//move o arquivo temporario para o destino
		$arquivo_upload = $diretorio_upload . basename($_FILES['arquivos']['name'][$i]);
		if (move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], $arquivo_upload)) {
			$sql .= "INSERT INTO attachments (id_task, name) VALUES (@last, '".basename($_FILES['arquivos']['name'][$i])."');";
			
		} else {
			echo "Erro<br />";
		}
	}

	if ($conn->multi_query($sql) === TRUE) {
    	
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

	header("Refresh:0; url=../tasks.php");
?>
