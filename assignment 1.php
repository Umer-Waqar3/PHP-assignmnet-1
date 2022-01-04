<!DOCTYPE HTML>  
<html>
<head>
    
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
  
<script>
$(document).ready(function(){
  $('button[name="edit"]').click(function(){
    $('input[name="name1"]').val($(this).prev().prev().prev().prev().val()); 
    $('input[name="publisher1"]').val($(this).prev().prev().prev().val()); 
    $('input[name="isbn1"]').val($(this).prev().prev().val()); 
    $('input[name="id"]').val($(this).prev().val()); 
    $( '#form1' ).css( "display","none" );
    $( '#form2' ).css( "display","block" );
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  });
});
function edit(){
  $( '#form2' ).css( "display","none" );
    $( '#form1' ).css( "display","block" );
  };


</script> 
</head>
<body>  

<?php
// define variables and set to empty values
$name = $publisher = $img = $isbn = $file = $image_name = $id = $sql5 = "";
$nameErr = $publisherErr = $isbnErr = $imgErr = $searchErr = "";
$nameErr1 = $publisherErr1 = $isbnErr1 = $imgErr1 = "";
$conn = mysqli_connect('localhost','umer','test1234','assignment1');
$sql = "SELECT * FROM books";
$result = mysqli_query($conn,$sql );
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);
$count = count($books);
$pages = ceil($count/10);
$page = "";
if(isset($_GET["page"])){
  $page = $_GET["page"];
}

if($page=="" || $page=="1"){
  $page1 = 0;
}
else{
  $page1 = ($page*9)-9;
}

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
      $img_file = $_FILES["image"]["name"];
      $folderName = "picture/";
      // Generate a unique name for the image 
      // to prevent overwriting the existing image
      $filePath = $folderName. rand(10000, 990000). '_'. time().'.'.$img_file;
      if ( move_uploaded_file( $_FILES["image"]["tmp_name"], $filePath)){
         $file = $filePath; 
      }
      else{
        $imgErr = 'unable to upload file'; 
      }
     
    }else{ 
        $imgErr = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
    } 
}
else{ 
    $imgErr = 'Please select an image file to upload.'; 
} 




if (empty($_POST["id"])) {
     
} else {
  if (!preg_match("/^[0-9]*$/",$_POST["id"])) {
   
  }
  else{
    $id=test_input($_POST["id"]);
}
 
}

if (empty($_POST["name1"])) {
  $nameErr1 = "Name is required";
} else {
  if (!preg_match("/^[a-zA-Z-.' ]*$/",$_POST["name1"])) {
    $nameErr1 = "Only letters and white space allowed";
  }
  else{
    $name = test_input($_POST["name1"]);
  }
  
}

if (empty($_POST["publisher1"])) {
  $publisherErr1 = "publisher is required";
} else {
  if (!preg_match("/^[a-zA-Z-.' ]*$/",$_POST["publisher1"])) {
    $publsherErr1 = "Only letters and white space allowed";
  }
  else{
    $publisher = test_input($_POST["publisher1"]);
}
  }
  

if (empty($_POST["isbn1"])) {
  $isbnErr = "isbn is required";
} else {
  if (!preg_match("/^[0-9]*$/",$_POST["isbn1"])) {
    $isbnErr1 = "Only numbers allowed";
  }
  else{
    $isbn = test_input($_POST["isbn1"]);
}
 
}

if(!empty($_FILES["image1"]["name"])) { 
  // Get file info 
  $fileName = basename($_FILES["image1"]["name"]); 
  $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
   
  // Allow certain file formats 
  $allowTypes = array('jpg','png','jpeg','gif'); 
  if(in_array($fileType, $allowTypes)){ 
    
    $img_file = $_FILES["image1"]["name"];
    $folderName = "picture/";
    // Generate a unique name for the image 
    // to prevent overwriting the existing image
    $filePath = $folderName. rand(10000, 990000). '_'. time().'.'.$img_file;
    if ( move_uploaded_file( $_FILES["image1"]["tmp_name"], $filePath)){
       $file = $filePath; 
       $sql5 = "UPDATE books SET name='$name',publisher='$publisher',isbn=$isbn,image='$file' WHERE id=$id"; 
    }
    else{
      $imgErr1 = 'unable to upload file'; 
    }
   
  }else{ 
      $imgErr1 = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
  } 
}else{ 
$sql5 = "UPDATE books SET name='$name',publisher='$publisher',isbn=$isbn WHERE id=$id"; 
}

}

if(!$conn){
  echo 'Connection error' . mysqli_connect_error(); 
}
else{
  $sql = "SELECT * FROM books ORDER BY id LIMIT $page1 ,9";
  $result = mysqli_query($conn,$sql);

  $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);

  if($name!=""&&$publisher!=""&&$isbn!=""&&$file!=""&&$id==""){
    $sql2 = "INSERT INTO books(name,publisher,isbn,image) VALUES('$name','$publisher', '$isbn', '$file')";
    if(mysqli_query($conn, $sql2)){
      echo 'INSERTED' ;
      echo "<meta http-equiv='refresh' content='0'>";
      $image_name = $_FILES["image"]["name"];
      // success
    } else {
      echo 'query error insert: '. mysqli_error($conn);
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

  }  
    

   
  if($name!=""&&$publisher!=""&&$isbn!=""&&$id!=""){
  if(mysqli_query($conn, $sql5)){
    echo 'edited' ;
    echo '<script type="text/javascript">',
    'edit();',
    '</script>'
  ;
    echo "<meta http-equiv='refresh' content='0'>";
    // success
  } else {
    echo $sql5;
    echo 'query error edit: '. mysqli_error($conn);
   
  }
  
}


  
  if(!empty($_POST["quary"])){
    $name = $publisher = $img = $isbn = $file = $image_name = $id = $sql5 = "";
    $nameErr = $publisherErr = $isbnErr = $imgErr = $searchErr = "";
    $nameErr1 = $publisherErr1 = $isbnErr1 = $imgErr1 = "";
     $quary =  test_input($_POST['quary']);
     $sql6 = "SELECT * FROM books WHERE name LIKE '%$quary%' ORDER BY id LIMIT $page1,10";
     $sql7 = "SELECT * FROM books WHERE publisher LIKE '%$quary%' ORDER BY id LIMIT $page1,10";
     $sql8 = "SELECT * FROM books WHERE isbn LIKE '%$quary%' ORDER BY id LIMIT $page1,10";

     

     if(mysqli_num_rows(mysqli_query($conn, $sql6))!=0){
      $result = mysqli_query($conn,$sql6);

      $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
      mysqli_free_result($result);
     }
     elseif(mysqli_num_rows(mysqli_query($conn, $sql7))!=0){
      $result = mysqli_query($conn,$sql7);

      $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
      mysqli_free_result($result);
     }
     elseif(mysqli_num_rows(mysqli_query($conn, $sql8))!=0){
      $result = mysqli_query($conn,$sql8);

      $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
      mysqli_free_result($result);
     }
     else{
      $searchErr = 'No result found';
     }

     $pages = count($books);
  }
 


  mysqli_close($conn);


}



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Form to create a book</h2>
<form id="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">  
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
  <br>
  <span class="error">* <?php echo $imgErr;?></span>
  <br><br>
  <input class="button1" type="submit" name="submit" value="Submit">  
  
</form>

<form id="form2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">  
  Name: <input type="text" name="name1" >
  <span class="error">* <?php echo $nameErr1;?></span>
  <br><br>
  Publisher: <input type="text" name="publisher1" >
  <span class="error">* <?php echo $publisherErr1;?></span>
  <br><br>
  ISBN: <input type="number" name="isbn1" >
  <span class="error">* <?php echo $isbnErr1;?></span>
  <br><br>
  Cover image: <input type="file" name="image1" >
  <span class="error">* <?php echo $imgErr1;?></span>
  <br><br>
  <input type="hidden" name="id">
  <input class="button1" type="submit" id="edit" name="edit" value="edit">
  
</form>
<h2 class="center">Search</h2>
<span class="error"><?php echo $searchErr;?></span>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <input type="text" name="quary">
  <input class="button1" type="submit" name="search" value="search">
</form>
<h2 class="center">Books!</h2>

<div class="container">
  <div class="row">

    <?php foreach($books as $book){ ?>

      <div class="col s4">
        <div class="card z-depth-0">
          <div class="card-content center">
            <?php  echo '<img src="'.$book['image'].'">'; 
            ?>
            <h5><?php echo htmlspecialchars($book['name']); ?></h5>
            <h6><?php echo htmlspecialchars($book['publisher']); ?></h6>
            <div><?php echo htmlspecialchars($book['isbn']); ?></div>
          </div>
          <div class="card-action" style="display: flex; flex-direction:row; justify-content:space-between; width:100%; ">
              <div class="left-align">
                
                  <input type="hidden" value="<?php echo htmlspecialchars($book['name']); ?>">
                  <input type="hidden" value="<?php echo htmlspecialchars($book['publisher']); ?>">
                  <input type="hidden" value="<?php echo htmlspecialchars($book['isbn']); ?>">
                  <input type="hidden" value="<?php echo htmlspecialchars($book['id']); ?>">
                  <button class="button1" name="edit" href="#">edit</button>
              </div>
              <div class=" right-align">
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>">
                  <button class="button1" type="submit" name="delete" >delete</button>
                </form>
              </div>
          </div>
        </div>
      </div>

    <?php } ?>

  </div>
</div>
<div style="padding-bottom: 100px;"> Pages:
<?php for($b=1;$b<=$pages;$b++){
  ?> <a href="assignment 1.php?page=<?php echo $b; ?>" ><?php echo $b; ?></a><?php
} ?> </div>
<div></div>
</body>


</html>