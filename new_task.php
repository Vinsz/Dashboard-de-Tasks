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
    
<script type="text/javascript">
  $(document).ready( function() {
      
  // initialize with defaults
  $("#arquivos").fileinput();

  // with plugin options
   $("#arquivos").fileinput({'showUpload':false, 'previewFileType':'any'});
        
  });
</script>

</head>
<body>  

<?php

// define variables and set to empty values
$nameErr = $priorityErr = $statusErr = "";
$name = $priority = $description = $status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }

  if (empty($_POST["description"])) {
    $description = "";
  } else {
    $description = test_input($_POST["description"]);
  }

  if (empty($_POST["priority"])) {
    $priorityErr = "priority is required";
  } else {
    $priority = test_input($_POST["priority"]);
  }

   if (empty($_POST["status"])) {
    $statusErr = "status is required";
  } else {
    $status = test_input($_POST["status"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<div class="container">
<h2>Nova Task</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="create.php" enctype="multipart/form-data" >  
  Nome: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Descrição: <textarea name="description" rows="5" cols="40"><?php echo $description;?></textarea>
  <br><br>
  Prioridade:
  <input type="radio" name="priority" <?php if (isset($priority) && $priority=="1") ?> value="1">1
  <input type="radio" name="priority" <?php if (isset($priority) && $priority=="2") ?> value="2">2
  <input type="radio" name="priority" <?php if (isset($priority) && $priority=="3") ?> value="3">3
  <input type="radio" name="priority" <?php if (isset($priority) && $priority=="4") ?> value="4">4
  <input type="radio" name="priority" <?php if (isset($priority) && $priority=="5") ?> value="5">5
  <span class="error">* <?php echo $priorityErr;?></span>
  <br><br>
  Status:
  <input type="radio" name= "status" <?php if (isset($status) && $status==0) ;?> value="0"> Undone
  <input type="radio" name= "status" <?php if (isset($status) && $status==1) ;?> value="1"> Done
  <span class="error">* <!-- <?php //echo $statusErr;?>--> </span> 
  <br><br> 
   <label class="control-label">Selecione os arquivos desejados:</label>
        <input id="arquivos" name="arquivos[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true">
  <input type="submit" name="submit" value="Submit">  
</form> 
<br>
       
    </div>

</body>
</html>