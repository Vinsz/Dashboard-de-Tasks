<?php
  include 'connect.php';

	//verifica quantos arquivos estão sendo recebidos na superglobal $)FILES
	$total_arquivos = count($_FILES['arquivos']['name']);
	
	//diretório de upload
	$diretorio_upload = '../uploads/';


	$sql = "UPDATE tasks SET name = '".$_POST["name"] . "',  description = '".$_POST["description"] . "', priority = '".$_POST["priority"] . "' , attach = attach+'".$total_arquivos."' WHERE id = '".$_POST["id"]."';";

	//percorre cada arquivo
	for ($i=0; $i < $total_arquivos; $i++) {
		//move o arquivo temporario para o destino
		$arquivo_upload = $diretorio_upload . basename($_FILES['arquivos']['name'][$i]);
		if (move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], $arquivo_upload)) {
			$sql .= "INSERT INTO attachments (id_task, name) VALUES ('".$_POST["id"]."', '".basename($_FILES['arquivos']['name'][$i])."');";
			
		} else {
			echo "Erro<br />";
		}
	}


	if ($conn->multi_query($sql) === TRUE) {
      
	} else {
		
	}

	$conn->close();

	header("Refresh:0; url=../tasks.php");
?>
