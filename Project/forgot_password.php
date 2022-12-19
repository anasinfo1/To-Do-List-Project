<?php

@include 'config.php';


session_start();

if(isset($_POST['submit'])){


   $username = mysqli_real_escape_string($conne, $_POST['username']);


   $select = " SELECT * FROM users WHERE username = '$username' ";

   $result = mysqli_query($conne, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

         $_SESSION['user_forgot']=$row['username'];
         header('location:change_password.php');

   }else{
      $error[] = 'incorrect username!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>forgot password</title>

   <!-- css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Recover your account</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="username" name="username" required placeholder="enter your username">
      <input type="submit" name="submit" value="recover now" class="form-btn">
      
   </form>

</div>

</body>
</html>