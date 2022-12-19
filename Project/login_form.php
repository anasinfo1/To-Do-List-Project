<?php

@include 'config.php';


session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conne, $_POST['name']);
   $username = mysqli_real_escape_string($conne, $_POST['username']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM users WHERE username = '$username' && password = '$pass' ";

   $result = mysqli_query($conne, $select);

   if(mysqli_num_rows($result) > 0){

          $row = mysqli_fetch_array($result);

        $_SESSION['user_name'] = $row['fullname'];
        $_SESSION['iduser'] = $row['id'];
         header('location:main.php');

     
   }else{
      $error[] = 'incorrect username or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="username" name="username" required placeholder="enter your username">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <div id="forgot-pass">
      <h5>Forget your password ? <a href="forgot_password.php">Recover now</a></h5>
      </div>
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>
</html>