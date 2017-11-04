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
  <div class="container">
    <h2>Nova Task</h2>

    <p><span class="error">* required field.</span></p>
    <form method="post" action="db/create.php" enctype="multipart/form-data" >
      <div class="form-group">
        <label for="exampleFormControlInput1">Nome</label> <span class="error">*</span>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" required="true">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Descrição</label>
        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>

      <div class="form-check form-check-inline">
        <label class="form-check-label" > Prioridade 
          <span class="error">*</span> <br>
          <input class="form-check-input" type="radio" name="priority" id="inlineRadio1" value="1" required> 1
          <input class="form-check-input" type="radio" name="priority" id="inlineRadio2" value="2" required> 2
          <input class="form-check-input" type="radio" name="priority" id="inlineRadio2" value="3" required> 3
          <input class="form-check-input" type="radio" name="priority" id="inlineRadio2" value="4" required> 4
          <input class="form-check-input" type="radio" name="priority" id="inlineRadio2" value="5" required> 5
        </label>
      </div>

      <div class="form-check form-check-inline">
        <label class="form-check-label"> Status 
          <span class="error">* </span> <br>
          <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" required> Undone
          <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="1" required> Done
        </label>
      </div>

      <label class="control-label">Selecione os arquivos desejados:</label>
        <input id="arquivos" name="arquivos[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true">
        <br><input class="btn btn-primary" type="submit" name="submit" value="Submit">  

    </form> 

    <br><a href="tasks.php"> <button class="btn btn-primary">Voltar</button></a>

  </div>

</body>
</html>