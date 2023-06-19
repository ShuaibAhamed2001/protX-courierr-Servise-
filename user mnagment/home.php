
<!-------------------------------------------database connection------------------------------->
<?php
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
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


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
   <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
   <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

    
   <link rel="stylesheet" href="pxs1.css">

</head>
<body>
  
<!--    -----------------------------------navigation bar---------------------------------->
<header class="header">
    <a href="#" class="logo1"> 
		<img src="img/blogo.png" alt="">
		
	</a>

    <div class="navbar1" id="mynav">
    <a href="#" class="home" id="active" >Home</a>
    <a href="pxproducts.php">Products  </a>
    <a href="cart.php">Cart  </a>
    <a href="acc.php"  >My Account</a>
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
      <a href="pxlogin.php?logout=<?php echo $user_id; ?>" onclick="return confirm('are you sure you want to logout?');" class="delete-btn">logout</a>
   </div>
   </div>
</header>

<!-- -----------------------------------------home image & shop button--------------------------------->
<div class="home-cont" >
    <div class="im">
    <img src="img/bg11.jpg">
        </div>
    <div class="shbtn" onclick="pxproducts.php" >
    <a href="pxproducts.php">Shop now >></a>
    </div>
    <div class="home-map" >
        <p>Our Hubs</p><p1> All Over Sri lanka</p1>
    <img src="img/sl2.png">
    
    
    
    </div>
    
    </div>
   
    
<!--    -----------------------------------------------------footer---------------------------------------------------->
   <section class="footer">
   <div class="box-container">
   <div class="lbox">
            <h3>quick links</h3>
            <p2><ion-icon name="home"></ion-icon>
            <a href="#">Home</a>
            </p2>
            
             <p2><ion-icon name="bag-handle"></ion-icon>
            <a href="#">Products</a>
            </p2>
            
             <p2><ion-icon name="cart"></ion-icon>
            <a href="#">Cart</a>
            </p2>
            
             <p2><ion-icon name="log-out"></ion-icon>
            <a href="#">logut</a>
            </p2>
            
    </div>

    <div class="box">
            <h3>Help</h3>
            <p> Payments  </p>
            <p> Shipping  </p>
            <p> Cancellation & Returns  </p>
            <p> FAQ   </p>
            <p> Report Infringement </p>
    </div>
    <div class="box">
            <h3>Contact us</h3>
            <p> <i class="fas fa-phone"></i> +9476-642-7788 </p>
            <p> <i class="fas fa-phone"></i> +9470-606-9966 </p>
            <p> <i class="fas fa-envelope"></i> jathua2001@gmail.com </p>
            <p> <i class="fas fa-map"></i> Malpura, Colombo </p>
    <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-linkedin"></a>
                <a href="#" class="fab fa-pinterest"></a>
     </div>
     </div>
     </div>
     </section>

</body>
</html>