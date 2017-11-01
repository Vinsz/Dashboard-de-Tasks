<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $priorityErr = "";
$name = $priority = $description = "";

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
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Nova Task</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Nome: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Descrição: <textarea name="description" rows="5" cols="40"><?php echo $description;?></textarea>
  <br><br>
  Prioridade:
  <input type="radio" name="priority" <?php if (isset($priority) && $priority=="1") echo "checked";?> value="1">1
  <input type="radio" name="priority" <?php if (isset($priority) && $priority=="2") echo "checked";?> value="2">2
  <input type="radio" name="priority" <?php if (isset($priority) && $priority=="3") echo "checked";?> value="3">3
  <input type="radio" name="priority" <?php if (isset($priority) && $priority=="4") echo "checked";?> value="4">4
  <input type="radio" name="priority" <?php if (isset($priority) && $priority=="5") echo "checked";?> value="5">5
  <span class="error">* <?php echo $priorityErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Nova Task:</h2>";
echo $name;
echo "<br>";
echo $description;
echo "<br>";
echo $priority;
?>

</body>
</html>