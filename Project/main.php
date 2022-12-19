<?php

@include 'config.php';



session_start();


if (!isset($_SESSION['user_name'])) {
   header('location:login_form.php');
}else{

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
	<title>Dashboard</title>
</head>
<body>
	<nav>
		<h1>ToDo List Dashboard</h1>
		<div>
		<a href="user_page.php"><img src="images/profile.png"></a>
		</div>

	</nav>

	<section>
		
<!-- TODO -->


	<div class="main-section">
       <div class="add-section">
          <form action="app/add.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
              <input type="text" name="title" style="border-color: #ff6666" placeholder="This field is required" />
              <button type="submit">Add &nbsp; <span>&#9989;</span></button>

             <?php }else{ ?>
              <input type="text" name="title" placeholder="What's your planning for today ?" />
              <button type="submit">Add &nbsp; <span>&#9989;</span></button>
             <?php } ?>
          </form>
       </div>
       <?php 

        	$userid = $_SESSION['iduser'];
          $todos = $conn->query("SELECT * FROM todos WHERE id_user=$userid ORDER BY id DESC");
       
       ?>
       <div class="todo-section">
            <?php if($todos->rowCount() <= 0){ ?>

                <div class="todo-item">
                    <div class="empty">
                        <h3>Start Writing your goals...</h3>
                        <img src="images/loading.gif" width="200px">

                    </div>
                </div>
            <?php } ?>

            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do">x</span>
                    <?php if($todo['checked']){ ?> 
                        <input type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               checked />
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <?php }else { ?>
                        <input type="checkbox"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               class="check-box" />
                        <h2><?php echo $todo['title'] ?></h2>
                    <?php } ?>
                    <br>
                    <small>created: <?php echo $todo['date_time'] ?></small> 
                </div>
            <?php } ?>
       </div>
    </div>

	</section>

<script src="js/jquery-3.2.1.min.js"></script>


 <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("app/remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');
                
                $.post('app/check.php', 
                      {
                          id: id
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checked');
                              }else {
                                  h2.addClass('checked');
                              }
                          }
                      }
                );
            });
        });
    </script>




</body>
</html>



<?php 

   }

?>








