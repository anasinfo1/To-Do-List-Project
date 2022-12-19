<?php

@include 'config.php';


session_start();

if (!isset($_SESSION['user_forgot'])) {
   header('location:forgot_password.php');
}else{

if(isset($_POST['submit'])){


   $newuser=$_SESSION['user_forgot'];
   $pass = md5($_POST['passwd']);
   $cpass = md5($_POST['cpasswd']);

   if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{


$sql2 = "UPDATE users SET password='$pass' WHERE username='$newuser'";

if ($conne->query($sql2) === TRUE) {
  echo "<script>alert('password updated successfully')</script>";
  session_unset();
  session_destroy();
  header('location:login_form.php');

} else {
  echo "Error updating record: " . $conne->error;
}



};
}
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
      <input type="password" name="passwd" required placeholder="enter new password">
      <input type="password" name="cpasswd" required placeholder="re-enter new password">
      <input type="submit" name="submit" value="recover now" class="form-btn">
      
   </form>

</div>

</body>
</html>

<?php 

};

 ?>