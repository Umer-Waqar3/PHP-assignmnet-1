<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
    if($name!=""&&$publisher!=""&&$isbn!=""&&$id!=""){
        if(mysqli_query($conn, $sql5)){
          $del_image =  test_input($_POST['image2']);;
          unlink($del_image);
          echo $del_image;
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
}
?>