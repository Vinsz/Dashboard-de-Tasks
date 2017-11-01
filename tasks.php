<!DOCTYPE html>
<html>
<body>

<?php

include 'connect.php';

$sql = "SELECT * FROM task";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> id: ". $row["id"]. " - Name: ". $row["name"]. " " . $row["description"] . "" . $row["priority"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?> 

<br>
<a href="new_task.php"> <input type="submit" name="submit" value="Submit"> </a>

</body>
</html>

