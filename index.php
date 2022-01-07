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
    <script src="script.js"></script>
  
</head>
<body>  

<?php
include 'initiate.php';
include 'insert.php';
include 'edit.php';
include 'delete.php';
include 'search.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!-- Insert form -->
<h2>Form to create a book</h2>
<form id="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">  
  Name: <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Publisher: <input type="text" name="publisher" value="<?php echo isset($_POST['publisher']) ? $_POST['publisher'] : '' ?>">
  <span class="error">* <?php echo $publisherErr;?></span>
  <br><br>
  ISBN: <input type="number" name="isbn" value="<?php echo isset($_POST['isbn']) ? $_POST['isbn'] : '' ?>">
  <span class="error">* <?php echo $isbnErr;?></span>
  <br><br>
  Cover image: <input type="file" id="image" name="image" >
  <br>
  <span class="error">* <?php echo $imgErr;?></span>
  <br><br>
  <input class="button1" type="submit" name="submit" value="Submit">  
  
</form>

<!-- Edit form -->
<form id="form2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" >  
  Name: <input type="text" name="name1" value="<?php echo isset($_POST['name1']) ? $_POST['name1'] : '' ?>">
  <span class="error1"><?php echo $nameErr1;?></span>
  <br><br>
  Publisher: <input type="text" name="publisher1" value="<?php echo isset($_POST['publisher1']) ? $_POST['publisher1'] : '' ?>">
  <span class="error11"><?php echo $publisherErr1;?></span>
  <br><br>
  ISBN: <input type="number" name="isbn1" value="<?php echo isset($_POST['isbn1']) ? $_POST['isbn1'] : '' ?>">
  <span class="error12"><?php echo $isbnErr1;?></span>
  <br><br>
  Cover image: <input type="file" name="image1" >
  <br><br>
  <input type="hidden" name="id">
  <input type="hidden" name="image2">
  <input class="button1" type="submit" name="edit" value="edit" >
  <a class="button1" href="index.php">Cancel</a>
</form>

<!-- Search form -->  
</form>
<h2 class="center">Search</h2>
<span class="error"><?php echo $searchErr;?></span>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <input type="text" name="quary" value="<?php echo isset($_POST['quary']) ? $_POST['quary'] : '' ?>">
  <input class="button1" type="submit" name="search" value="search">
</form>
<h2 class="center">Books!</h2>


<!-- Books output from DB -->
<div class="container">
  <div class="row">

    <?php foreach($books as $book){ ?>

      <div class="col m4 s6 ">
        <div class="card z-depth-0">
          <div class="card-content center">
            <?php  echo '<img src="'.$book['image'].'">'; 
            ?>
            <div class="overflow"><?php echo htmlspecialchars($book['name']); ?></div>
            <div class="overflow1"><?php echo htmlspecialchars($book['publisher']); ?></div>
            <span><?php echo htmlspecialchars($book['isbn']); ?></span>
          </div>
          <div class="card-action" style="display: flex; flex-direction:row; justify-content:space-between; width:100%; ">
              <div class="left-align">
                  <input type="hidden" value="<?php echo htmlspecialchars($book['image']); ?>">
                  <input type="hidden" value="<?php echo htmlspecialchars($book['name']); ?>">
                  <input type="hidden" value="<?php echo htmlspecialchars($book['publisher']); ?>">
                  <input type="hidden" value="<?php echo htmlspecialchars($book['isbn']); ?>">
                  <input type="hidden" value="<?php echo htmlspecialchars($book['id']); ?>">
                  <button class="button1" name="edit" href="#">edit</button>
              </div>
              <div class=" right-align">
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>">
                  <input type="hidden" name="image" value="<?php echo htmlspecialchars($book['image']); ?>">
                  <div id="are-you-sure">
                  <button class="button1"  type="submit"  name="are-you-sure" >Are You Sure</button>
                  <input class="button1" type="button" id="cancel" name="cancel" value="cancel">
                  </div>
                  <input class="button1" type="button" name="delete" value="delete">
                </form>
              </div>
          </div>
        </div>
      </div>

    <?php } ?>

  </div>
</div>

<!-- pagination -->
<div style="padding-bottom: 100px;"> Pages:
<?php for($b=1;$b<=$pages;$b++){
  ?> <a href="index.php?page=<?php echo $b; ?>" ><?php echo $b; ?></a><?php
} ?> </div>
<div></div>
</body>


</html>