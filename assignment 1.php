<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>  

<?php
// define variables and set to empty values
$name = $publisher = $img = $isbn = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $publisher = test_input($_POST["publisher"]);
  $isbn = test_input($_POST["isbn"]);
  $img = test_input($_POST["img"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Form to create a book</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" required>
  <br><br>
  Publisher: <input type="text" name="publisher" required >
  <br><br>
  ISBN: <input type="number" name="isbn" required >
  <br><br>
  Cover image: <input type="file" id="img" name="img" accept="image/*" required >
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Book list:</h2>";
echo $name;
echo "<br>";
echo $publisher;
echo "<br>";
echo $isbn;
echo "<br>";
echo $img;
?>

<img src="<?php echo $img; ?>" alt="No image"/>
</body>
</html>