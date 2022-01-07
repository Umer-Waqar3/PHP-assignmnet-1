<?php

if(!$conn){
    echo 'Connection error' . mysqli_connect_error(); 
}
else{
    if(!empty($_POST["quary"])){
        $name = $publisher = $img = $isbn = $file = $image_name = $id = $sql5 = "";
        $nameErr = $publisherErr = $isbnErr = $imgErr = $searchErr = "";
        $nameErr1 = $publisherErr1 = $isbnErr1 = $imgErr1 = "";
         $quary =  test_input($_POST['quary']);
         $sql6 = "SELECT * FROM books WHERE name LIKE '%$quary%' OR publisher LIKE '%$quary%' OR isbn LIKE '%$quary%' ORDER BY id LIMIT $page1,10";
         $result = mysqli_query($conn,$sql6);
         
    
        if(mysqli_num_rows($result)!=0){
          $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
          mysqli_free_result($result);
        }
        else{
          $searchErr = '<h2>No result found</h2>';
          $books = array();
        }
        if($books!=null){
          $count = count($books);
          $pages = ceil($count/10);
        }
        else{
          $pages = 0;
        }
        
      }
     
    
    
      mysqli_close($conn); 
}

?>