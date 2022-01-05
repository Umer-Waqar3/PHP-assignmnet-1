<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } 
  else {
    if (!preg_match("/^[a-zA-Z-.' ]*$/",$_POST["name"])) {
      $nameErr = "Only letters and white space allowed";
    }
    else{
      $name = test_input($_POST["name"]);
    }
    
  }

  if (empty($_POST["publisher"])) {
    $publisherErr = "publisher is required";
  } 
  else {
    if (!preg_match("/^[a-zA-Z-.' ]*$/",$_POST["publisher"])) {
      $publsherErr = "Only letters and white space allowed";
    }
    else{
      $publisher = test_input($_POST["publisher"]);
    }
  }
    

  if (empty($_POST["isbn"])) {
    $isbnErr = "isbn is required";
  } 
  else {
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
}

if(!$conn){
    echo 'Connection error' . mysqli_connect_error(); 
}
else{
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
}
?>