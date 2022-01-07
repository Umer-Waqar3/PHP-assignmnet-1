<?php

// define variables and set to empty values
$name = $publisher = $img = $isbn = $file = $image_name = $id = $sql5 = "";
$nameErr = $publisherErr = $isbnErr = $imgErr = $searchErr = "";
$nameErr1 = $publisherErr1 = $isbnErr1 = $imgErr1 = "";
$conn = mysqli_connect('localhost','umer','test1234','assignment1');
$sql = "SELECT Count(*) AS count FROM books";
$result = mysqli_query($conn,$sql );
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach($books as $book){
  $count = (int)$book['count'];
}
$pages = ceil($count/2);
$page = "";
if(isset($_GET["page"])){
  $page = $_GET["page"];
}

if($page=="" || $page=="1"){
  $page1 = 0;
}
else{
  $page1 = ($page*2)-2;
}

if(!$conn){
  echo 'Connection error' . mysqli_connect_error(); 
}
else{
  $sql = "SELECT * FROM books ORDER BY id DESC LIMIT $page1 ,2";
  $result = mysqli_query($conn,$sql);

  $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);
}


?>