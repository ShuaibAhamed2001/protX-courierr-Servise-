<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
    <div>
<header class="header">
    <div class="rcontainer1">
	<div class="rcontainer">
	 
    <div class="close" >
		<a href="pxlogin.php" >
        <ion-icon name="close-circle-outline"></ion-icon></a>
    </div>
    <div class="register">
          <img src="img/blogo.png">
          <h3 class="title">User Register</h3>
			
    <?php
    include 'px_db_connection.php';
        
//        ------------------------------------------------insert into the database ----------------------------------------------------------
        
    if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $select = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass'") or die('query failed');
    $data = mysqli_fetch_array($select, MYSQLI_NUM);
    
    if($data > 1) { 
	    echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('User already registered...','','error');
        },1); 
        window.setTimeout(function(){ 
            window.location.replace('pxreg.php');
        } ,1000); 
        </script>
        ";
    
    
    }else{
      mysqli_query($conn, "INSERT INTO `user`(name, mobile,email, password) VALUES('$name','$mobile', '$email', '$pass')") or die('query failed');
       echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('Registered successfully..','','success');
        },1); 
        window.setTimeout(function(){ 
            window.location.replace('pxlogin.php');
        } ,1000); 
        </script>
        ";
   }

   }
   
   ?>
            
   <form action="" method="post">
     
   <div class="text-input1">
			<i class="user-fill"></i>
            <input type="text" name="name" required placeholder="enter username" class="box">
   </div>
			
   <div class="text-input">
			<i class="user-fill"></i>
			 <input type="mobile" name="mobile" required placeholder="enter mobile no." class="box">
   </div>
			
   <div class="text-input">
			<i class="user-fill"></i>
			 <input type="email" name="email" required placeholder="enter email" class="box">
   </div>
			
   <div class="text-input">
			<i class="user-fill"></i>
			  <input type="password" name="password" required placeholder="enter password" id="password"class="box">
   </div>
			
   <div class="text-input">
			<i class="user-fill"></i>
			<input type="password" placeholder="Re enter Password" id="confirm_password" required>
   </div>
			
				
				
   <a2><input type="checkbox" id="terms" name="terms" value="terms" required>
				<p3>I agree to the terms and conditions</p3></a2>
		
            
   <input type="submit" name="submit" class="regbtn" value="register now">
    
   </form>
   <div class="re">
              <p1>already have an account? <a href="pxlogin.php">login now</a></p1>
   </div>
   </div>
   </div></div>
	
</header>

<!-----------------------------------------------confirm password checking------------------------------------------------------------>
<script>
	var password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
    if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
    confirm_password.setCustomValidity('');
    }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
    </div>
</body>
</html>