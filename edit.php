<!DOCTYPE HTML>  
<html>
<head>
  <style>
  .error {color: #FF0000;}
  </style>

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
<body>  

<?php

include 'connect.php';

$sql = "SELECT * FROM tasks WHERE id = '".$_GET["id"]."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		$name = $row["name"];
		$description = $row["description"];
		$priority = $row["priority"];
		$status = $row["state"];
	}
}

?>

<div class="container">
    <h2>Editar Task</h2>

    <p><span class="error">* required field.</span></p>
    <form method="post" action="update.php" enctype="multipart/form-data" >
      <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
        <label for="exampleFormControlInput1">Nome</label> <span class="error">*</span>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" required="true" value="<?php echo $name; ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Descrição</label>
        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"> <?php echo $description; ?> </textarea>
      </div>

      <div class="form-check form-check-inline">
        <label class="form-check-label" > Prioridade 
          <span class="error">*</span> <br>
          <input class="form-check-input" type="radio" name="priority" id="inlineRadio1" value="1" <?php echo "checked"; ?> required> 1
          <input class="form-check-input" type="radio" name="priority" id="inlineRadio2" value="2" <?php echo "checked"; ?> required> 2
          <input class="form-check-input" type="radio" name="priority" id="inlineRadio2" value="3" <?php echo "checked"; ?> required> 3
          <input class="form-check-input" type="radio" name="priority" id="inlineRadio2" value="4" <?php echo "checked"; ?> required> 4
          <input class="form-check-input" type="radio" name="priority" id="inlineRadio2" value="5" <?php echo "checked"; ?> required> 5
        </label>
      </div>

      <div class="form-check form-check-inline">
        <label class="form-check-label"> Status 
          <span class="error">* </span> <br>
          <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" <?php echo "checked"; ?> required> Undone
          <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="1" <?php echo "checked"; ?> required> Done
        </label>
      </div>
      <label class="control-label">Arquivos Anexados:</label>
      <?php
        $sql = "SELECT * FROM attachments WHERE id_task = '".$_GET["id"]."'";

        $result = $conn->query($sql);

          echo '<br>Anexo(s): ';
        if ($result->num_rows > 0) {
            while($row= $result->fetch_assoc()) {
            echo '<br><a href="download.php?name=' .$row["name"].'">'.$row["name"].' </a>
                  <a href="delete_file.php?name='.$row["name"].'&id='.$row["id"].'&id_task='.$row["id_task"].'"><button type="button" class="close">&times;</button> </a>';
          }
        } else {
          echo "<br>Sem arquivos anexos.";
        }

        $conn->close();
      ?>

      <br><br><label class="control-label">Selecione os arquivos desejados:</label>
        <input id="arquivos" name="arquivos[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true">
        <br><input class="btn btn-primary" type="submit" name="submit" value="Submit">  

    </form> 

    <br><a href="tasks.php"> <button class="btn btn-primary">Voltar</button></a>

  </div>

</body>
</html>