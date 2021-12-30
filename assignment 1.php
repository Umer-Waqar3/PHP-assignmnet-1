<!DOCTYPE HTML>  
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
<style>

.button1:hover{
  border: 1px solid goldenrod;
  border-radius: 10px;
  box-shadow: 2px 2px 5px goldenrod;
}
</style>   
<script>
  function edit(this){
    alert("sdfsd");
    this.css({"border":"10px solid black"});
  }
</script> 
</head>
<body>  

<?php
// define variables and set to empty values
$name = $publisher = $img = $isbn = $file = $image_name ="";
$nameErr = $publisherErr = $isbnErr = $imgErr = "";
$conn = mysqli_connect('localhost','umer','test1234','assignment1');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    if (!preg_match("/^[a-zA-Z-.' ]*$/",$_POST["name"])) {
      $nameErr = "Only letters and white space allowed";
    }
    else{
      $name = test_input($_POST["name"]);
    }
    
  }

  if (empty($_POST["publisher"])) {
    $publisherErr = "publisher is required";
  } else {
    if (!preg_match("/^[a-zA-Z-.' ]*$/",$_POST["publisher"])) {
      $publsherErr = "Only letters and white space allowed";
    }
    else{
      $publisher = test_input($_POST["publisher"]);
  }
    }
    

  if (empty($_POST["isbn"])) {
    $isbnErr = "isbn is required";
  } else {
    if (!preg_match("/^[0-9]*$/",$_POST["isbn"])) {
      $isbnErr = "Only numbers allowed";
    }
    else{
      $isbn = test_input($_POST["isbn"]);
  }
   
  }
 
  

  if(!empty($_FILES["image"]["name"])) { 
    // Get file info 
    $fileName = basename($_FILES["image"]["name"]); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
     
    // Allow certain file formats 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    if(in_array($fileType, $allowTypes)){ 
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
    }else{ 
        $imgErr = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
    } 
}else{ 
    $imgErr = 'Please select an image file to upload.'; 
} 



}

if(!$conn){
  echo 'Connection error' . mysqli_connect_error(); 
}
else{
  $sql = 'SELECT * FROM books ORDER BY id';

  $result = mysqli_query($conn,$sql);

  $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);

  if($name!=""&&$publisher!=""&&$isbn!=""&&$file!=""){
    $sql2 = "INSERT INTO books(name,publisher,isbn,image) VALUES('$name','$publisher', '$isbn', '$file')";

    if(mysqli_query($conn, $sql2)){
      echo 'INSERTED' ;
      echo "<meta http-equiv='refresh' content='0'>";
      $image_name = $_FILES["image"]["name"];
      // success
    } else {
      echo 'query error: '. mysqli_error($conn);
    }


  }
  if(isset($_POST['delete'])){
    $id = test_input($_POST['id']);
    $sql3 = "DELETE FROM books WHERE id=$id";
    echo $sql3;
    if(mysqli_query($conn, $sql3)){
      echo 'DELETED' ;
      echo "<meta http-equiv='refresh' content='0'>";
      // success
    } else {
      echo 'query error: '. mysqli_error($conn);
    }

  mysqli_close($conn);


}




}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Form to create a book</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">  
  Name: <input type="text" name="name" >
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Publisher: <input type="text" name="publisher" >
  <span class="error">* <?php echo $publisherErr;?></span>
  <br><br>
  ISBN: <input type="number" name="isbn" >
  <span class="error">* <?php echo $isbnErr;?></span>
  <br><br>
  Cover image: <input type="file" id="image" name="image" >
  <span class="error">* <?php echo $imgErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>




<h2 class="center grey-text">Books!</h2>

<div class="container">
  <div class="row">

    <?php foreach($books as $book){ ?>

      <div class="col s6 md3">
        <div class="card z-depth-0">
          <div class="card-content center">
            <?php  echo '<img src="data:image;base64,'.base64_encode( $book['image'] ).'" style="height:300px; width:300px;"/>'; 
            ?>
            <h4><?php echo htmlspecialchars($book['name']); ?></h4>
            <h5><?php echo htmlspecialchars($book['publisher']); ?></h5>
            <div><?php echo htmlspecialchars($book['isbn']); ?></div>
          </div>
          <div class="card-action" style="display: flex; flex-direction:row; justify-content:space-between; width:100%; ">
              <div class="left-align">
                
                  <input type="hidden" id="name" value="<?php echo htmlspecialchars($book['name']); ?>">
                  <input type="hidden" id="publisher" value="<?php echo htmlspecialchars($book['publisher']); ?>">
                  <input type="hidden" id="id" value="<?php echo htmlspecialchars($book['id']); ?>">
                  <button class="button1" id="edit" name="edit" onclick="edit(this)">edit</button>
              </div>
              <div class=" right-align">
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>">
                  <button class="button1" type="submit" id="delete" name="delete" value="delete" >delete</button>
                </form>
              </div>
          </div>
        </div>
      </div>

    <?php } ?>

  </div>
</div>
</body>


</html>