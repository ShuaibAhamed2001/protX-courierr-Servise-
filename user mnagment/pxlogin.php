
<!-----------------------------------------------database connection------------------------------------>
<?php

include 'px_db_connection.php';
session_start();

if(isset($_POST['submit'])){

   $email =  $_POST['email'];
   $pass = $_POST['password'];
   $select = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass'") or die('query failed');
           if(mysqli_num_rows($select) > 0){
                 $row = mysqli_fetch_assoc($select);
                 $_SESSION['user_id'] = $row['id'];
              echo "
                     <script type='text/javascript'>
                     setTimeout(function () { 
                     swal('User login successfully....','','success');
                    },1); 
                     window.setTimeout(function(){ 
                     window.location.replace('home.php');
                      } ,1000); 
                     </script>
                      ";
           }else{
              echo "
                    <script type='text/javascript'>
                    setTimeout(function () { 
                    swal('Wrong email or Password...','','error');
                     },1); 
                    window.setTimeout(function(){ 
                    window.location.replace('pxlogin.php');
                  } ,1000); 
                   </script>
                    ";
 }}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

    <link rel="stylesheet" href="pxs1.css">
    <style>
		body {
                      background-image: url('img/bg.jpeg');
                      background-repeat: no-repeat;
                      background-attachment: fixed;
                      background-size: cover;
                    }
</style>         
     
</head>
<body>
    <div class="container1">
    <div class="container">
    <div class="box">
		
    <div class="close" >
		<a href="pxlogin.php" >
        <ion-icon name="close-circle-outline"></ion-icon></a>
    </div>
          
    <div class="login">
        <img src="img/blogo.png">
        <h3 class="title">User Login</h3>
			
    <form action="" method="post">
    
    <div class="text-input">
			<i class="user-fill"></i>
			<input type="email"   name="email"  placeholder="email" required>
    </div>
			
    <div class="text-input">
			<i class="user-fill"></i>
			<input type="password"   name="password" placeholder="Password" id="password" required>
    </div>
	<input type="submit" name="submit" class="loginbtn" value="login now">

    </form>
               <p>don't have an account? <a href="pxreg.php">register now</a></p>
   
    </div>
	</div>			
    </div>
    </div>

    
   
	

</body>
</html>





