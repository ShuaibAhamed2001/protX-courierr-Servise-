<!--------------------------------------------------------database connection------------------------------------------------>
<?php
include 'px_db_connection.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:pxlogin.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:pxlogin.php');
};

$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id = $user_id"));

?>



<!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <meta charset="UTF-8">
    <title> My account </title>
    <link rel="stylesheet" href="acc_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
        <style>
      

.header {
  position: fixed;
  top: 0;
  left: 1%;
  right: 0;
    width: 80%;
  display: flex;
          align-items: center;
          justify-content: space-between;
  padding: 0 9%;
  z-index: 10000;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
  background: #fff;
    
        box-shadow: 0px 0px 15px 1px #97F0FF;
}



    
.logo img {
height: 10rem;
margin-right: -20px;
margin-top: -42px;
margin-bottom: -45px;
}
          
.acccontainer{
  max-width: 950px;
      position: relative;
    top: 100px;
  width: 100%;
    height: 600px;
  background: #fff;
  margin: 0 20px;
  border-radius: 3px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
   
}
.acccontainer .topic{
    position: relative;
    top: 90px;
  font-size: 30px;
  font-weight: 500;
    margin-left: 20px;
  margin-bottom: 20px;
    
}
            .acccontainer .topic img{
    position: absolute;
    top: -120px;
                margin-left: -150px;
                width: 180px;
 
    
}
.acccontent{
  
  display: flex;
  align-items: center;
    margin-top: -60px;
}
.acccontent .list{
  display: flex;
  flex-direction: column;
  width: 20%;
    margin-top: -20px;
    margin-left: 10px;
  margin-right: 50px;
  position: relative;
}
.acccontent .list label{
    
  height: 60px;
    width: 200px;
  font-size: 16px;
  font-weight: 500;
  line-height: 60px;
  cursor: pointer;
  padding-left: 25px;
  transition: all 0.5s ease;
  color: #333;
  z-index: 12;
}
 a{
      color: #333;
 text-decoration: none;
}

#home:checked ~ .list label.home,
#blog:checked ~ .list label.blog,
#help:checked ~ .list label.help,
#code:checked ~ .list label.code,
#about:checked ~ .list label.about{
  color: #fff;
}
.acccontent .list label:hover{
  color: #00DBFF;
}
.acccontent .slider{
  position: absolute;
  left: 0;
  top: 0;
  height: 60px;
  width: 100%;
  border-radius: 12px;
  background: #00DBFF;
  transition: all 0.4s ease;
    
}
#home:checked ~ .list .slider{
  top: 0;
}

.acccontent .text-content{
  width: 80%;
  height: 100%;
    margin-top: 100px;
}
.acccontent .text{
  display: none;
}
.acccontent .text .title{
    position: relative;
  font-size: 35px;
    color: #00DBFF;
    margin-left: 20px;
    margin-top: -20px;
  margin-bottom: 10px;
  font-weight: 500;
}
.acccontent .text p{
  text-align: justify;
}
.acccontent .text-content .home{
  display: block;
   
}
#home:checked ~ .text-content .home,
{
  display: block;
}

.text-inputm input{
	background: none;
	border: none;
	outline: none;
	width: 100%;
	height: 100%;
	margin-left: 10px;

}

            ::placeholder{
                color: black;
            }


      
.flex{
    position: absolute;
    top: -40px;
    left: 55px;
  
}



body{
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
background-image: url('img/bg1.jpeg');
}
::selection{
  background: #00DBFF;
  color: #fff;
}


input[type=radio]{
    display: none;
}
      
            
            .btn-chn{
                background-color: blue; 
                color: white;
                width: 70px;
                height: 35px;
                border: solid white;
                border-radius: 4px;
                cursor: pointer;
                margin-top: 30px;
            }
             .btn-del{
                background-color: white; 
                color: blue;
                width: 67px;
                height: 33px;
                border: solid blue;
                border-radius: 4px;
                 cursor: pointer;
                 margin-top: 30px;
            }
            
.text-input{
		background:rgb(0,0,0,0.1);
	height: 40px;
	display: flex;
	width: 230px;
	align-items: center;
	border-radius: 10px;
	padding: 0 10px;
	margin: 5px 0;
}
.text-input input{
	background: none;
	border: none;
	outline: none;
	width: 100%;
	height: 100%;
	margin-left: 10px;

}
                        
.text-input2{
                visibility: hidden;
            }
.text-input{
                margin-top: 15px;
                width: 200px;
                background-color: white;
                border: solid grey;
            }
            
.details{
                display: inline-block;
                 width: 100%;
                 border: none;
                 margin-top: 50px;
                 position: relative;
                 display: block;
            }
.border-text{
                color: grey;
                 text-align: right;
                font-size: 10px;
                margin-top: 0px;
                background-color: white;
                
            }
        
.border-text p1{
                margin-left: 3px;
                margin-right: 3px;
            }
          
 .choosebtn{
                visibility: hidden;
            }
      
            .img-circle  {
                position: absolute;
                top:40px;
                left: 600px;
                
	height: 160px;
	width: 200px;
}
.img-circle img {
	height: 200px;
	width: 200px;
	border-radius: 3%;
	border: 5px solid #fff;
  box-shadow: 0 0 17px 10px rgb(0 0 0 / 20%);
    margin-left: 20px;
}
.cor {
                position: absolute;
                top: 123px;
                margin-left: 235px;
                width:710px;
                height: 50px;
                border-top: solid lightgrey;
            }
            
.update1{
                width: 300px;
            }
.btn-chn{
                margin-left: 40px;
                color: white;
                background-color: #00DBFF;
            }
.btn-del{
                color: #00DBFF;
                background-color: white;
                border: none;
                
            }
.btn-chn:hover{
                background-color: lightgrey;
            }
.btn-del:hover{
                
                background-color: lightgrey;
                color: white;
                text-decoration: underline;
            }
                
.navbar {
    position: absolute;
    margin-left: 550px;
    height: 60px;
display: flex;
  background-color: white;
}


.navbar a {
	width: 90px;
float: right;
	border-radius: 3px;
  color: black; 
	text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
	display: inline-block;
    line-height: 30px;
	margin-top: 0px;
	margin-bottom: 5px;
}



.navbar a:hover {
background-color:#E5FBFF;
  color: black;
}


#active {
  background-color:#00DBFF;
  color: black;
}
      </style>
</head>
<body>
    
<!--   ------------------------------------------------------------------navigation bar----------------------------------------------- -->
<header class="header">

    <a href="#" class="logo"> 
		<img src="img/blogo.png" alt="">
		
	</a>

	<div class="navbar" id="mynav">

    <a href="home.php" class="home"  >Home</a>
    <a href="pxproducts.php" class="products"  >Products</a>
              <a class="ts" href="cart.php" >Cart  </a>
             <a class="bn" href="#"  id="active">My Account</a>
	</div>
	
<div class="user-profile">
 
   <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>

   <p> Hi , <span><?php echo $fetch_user['name']; ?></span> </p>
   <div class="flex">
      <a href="cart.php?logout=<?php echo $user_id; ?>" onclick="return confirm('are your sure you want to logout?');" class="delete-btn">logout</a>
   </div>

</div>
</header>
    
<!--   -------------------------------------------------------my account box------------------------------------------------------------>
  <div class="acccontainer">
       <div class="cor"></div>
    <div class="topic">My Account
        <img src="img/blogo.png">
			</div> 
      
   
   
      
      
    <div class="acccontent">
        
      <input type="radio" name="slider" checked id="home">
        
      <div class="list">
          
        <label for="home" class="home">
        <ion-icon name="file-tray-full-outline"></ion-icon>
        <span class="title">Account</span>
      </label>
    
          <label>
              
        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
          <a href="pxlogin.php?logout" onclick="return confirm('are your sure you want to logout?');" class="delete-btn">Logout</a>

              
          </label>
          
<!-----------------------------------------------------user data edit--------------------------------------------------------->
      <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
      <div class="upload">
        <?php
        $id = $user["id"];
        $name = $user["name"];
          $mobile=$user["mobile"];
          $email=$user["email"];
          $password=$user["password"];
        ?>
          
     
      </div>
    </form>


    	
      <div class="slider"></div>
    </div>
     <div class="text-content">
     <div class="home text">
     <div class="title">User Profile </div>     
     <div class="recentOrders">
     <div class="cardHeader">     
                    </div>
          
	 <div class="update1">
			
     <div class="row">
     <div class="col-md-12">
     <hr>
     <?php 
                                    $con = mysqli_connect("localhost","root","","portx");


                                        $query = "SELECT * FROM user WHERE mobile='$mobile' ";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
      ?>
                                
<!--          ---------------------------------------------------------------updated data insertion------------------------------------                      -->
    <form action="px_chn_connection.php" method="post">             	
		  <div class="details"> 	    
			<div class="text-input">
			<i class="user-fill"></i>
			<input type="text"  name="name" placeholder="Username" value="<?= $row['name']; ?>" >
			  <div class="border-text">
                     <p1>username</p1>
                </div>
                </div>
			 <div class="text-input">
			<i class="user-fill"></i>
			<input type="text"   name="email"  placeholder="E-mail" value="<?= $row['email']; ?>" >
			 <div class="border-text">
                     <p1>email</p1>
                </div>
               </div>  
                 <div class="text-input">
			<i class="user-fill"></i>
			<input type="text"   name="mobile"  placeholder="Mobile No." value="<?= $row['mobile']; ?>" >
			
                <div class="border-text">
                     <p1>mobile</p1>
                </div>
                        </div>  
			<div class="text-input">
			<i class="user-fill"></i>
			<input type="password"   name="password" placeholder="Password" id="password" value="<?= $row['password']; ?>">
			
                <div class="border-text">
                     <p1>password</p1>
                </div>
                        </div> 
			<div class="text-input">
			<i class="user-fill"></i>
			<input type="password" placeholder="Re enter Password" id="confirm_password" value="<?= $row['password']; ?>">
			
                <div class="border-text">
                     <p1>confirm password</p1>
                </div>
                        </div> 
			</div>  
				
        
        
<!--        --------------------------------------------------------matching confirm password------------------------------------------>
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
			
		   
		    <input type="submit" class="btn-chn" name="submit" value="Change"> 
             <input type="submit" class="btn-del" name="delete" value="Delete"> 
             <div class="text-input2">
			 <input type="text-input2"   name="mobile1"  placeholder="Mobile No." value="<?= $row['mobile']; ?>" >
			 </div>
             </form>
                   
              <?php
                             
            } }
                                      
             ?>
            </div>
            </div>	
		    </div>
	    	</div>
            </div>
            </div>
            </div>
            </div>
</body>
</html>