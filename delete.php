<?php

if(!$conn){
    echo 'Connection error' . mysqli_connect_error(); 
}
else{
    if(isset($_POST['are-you-sure'])){
        $id = test_input($_POST['id']);
        $del_image =  test_input($_POST['image']);
        unlink($del_image);
        $sql3 = "DELETE FROM books WHERE id=$id";
        if(mysqli_query($conn, $sql3)){
          echo 'DELETED' ;
          echo "<meta http-equiv='refresh' content='0'>";
          // success
        } else {
          echo 'query error: '. mysqli_error($conn);
        }
    
    }  
}

?>