<!------------------------------------------------------database connection-------------------------------------------------->
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


//--------------------------------------------------------------add to cart php--------------------------------------
if(isset($_POST['add_to_cart'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $s_charge = $_POST['s_charge'];
   $product_weight = $_POST['product_weight'];
   $product_quantity = $_POST['product_quantity'];
   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('Products already added ..','','info');
        },1); 
        window.setTimeout(function(){ 
            window.location.replace('pxproducts.php');
        } ,1000); 
        </script>
        ";
         
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity,weight,charge) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity','$product_weight','$s_charge')") or die('query failed');
        echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('product added to cart..','','success');
        },1); 
        window.setTimeout(function(){ 
            window.location.replace('pxproducts.php');
        } ,1000); 
        </script>
        ";
   }

};



//-------------------------------------------------------------------cart upadation php-------------------------------------------
if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
     echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('cart quantity updated successfully..','','success');
        },1); 
        window.setTimeout(function(){ 
            window.location.replace('pxproducts.php');
        } ,1000); 
        </script>
        ";
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:pxproducts.php');
    
     echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('item removed successfully..','','success');
        },1); 
        window.setTimeout(function(){ 
            window.location.replace('pxproducts.php');
        } ,1000); 
        </script>
        ";
    
}


//----------------------------------------------------------delete all button php---------------------------------------------
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('all items removed successfully..','','success');
        },1); 
        window.setTimeout(function(){ 
            window.location.replace('pxproducts.php');
        } ,1000); 
        </script>
        ";
}

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
   <title>shopping cart</title>

    
   <link rel="stylesheet" href="pxs1.css">

</head>
<body>
   
    
<!--    ----------------------------------------------------------navigation bar---------------------------------------------------->
    
<header class="header">
    <a href="#" class="logo"> 
		<img src="img/blogo.png" alt="">
		
	</a>

    <div class="navbar" id="mynav">
    <a href="home.php" class="home"  >Home</a>
    <a href="#" class="products" id="active" >Products</a>
    <a href="cart.php">Cart  </a>
    <a href="acc.php"  >My Account</a>
	</div>
    
<!--    -----------------------------------------------------display user name php------------------------------------------------->
	
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

   <?php
   if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }}
   ?>

<!--    ------------------------------------------------products section------------------------------------------------------->
    
    
   <div class="cart_container">
   <div class="products">
   <h1 class="cheading">All products</h1>
   <div class="cbox-container">

   <form method="post" class="pbox" action="">
         <img src="img/m2.jpg" alt="">
         <div class="name">feature phone</div>
         <div class="weight">170g</div>
         <div class="price">Rs.4500/-</div>
         <input type="number" min="1" name="product_quantity" class="quan"  value="1">
         <input type="hidden" name="product_image" value="m2.jpg">
         <input type="hidden" name="product_name" value="X7 feature phone">
         <input type="hidden" name="product_weight" value="170">
         <input type="hidden" name="s_charge" value="550">
         <input type="hidden" name="product_price" value="4500">
         <input type="submit" value="add to cart" name="add_to_cart" class="pbtn">
    </form>
       
    <form method="post" class="pbox" action="">
         <img src="img/e3.jpeg" alt="">
         <div class="name">earpod x2</div>
         <div class="weight">80g</div>
         <div class="price">Rs.3800/-</div>
         <input type="number" min="1" name="product_quantity" class="quan" value="1">
         <input type="hidden" name="product_image" value="e3.jpeg">
         <input type="hidden" name="product_name" value="earpod x2">
         <input type="hidden" name="product_weight" value="80">
         <input type="hidden" name="s_charge" value="350">
         <input type="hidden" name="product_price" value="3800">
         <input type="submit" value="add to cart" name="add_to_cart" class="pbtn">
    </form>
       
       
     <form method="post" class="pbox" action="">
         <img src="img/m1.jpg" alt="">
         <div class="name">Camon 19</div>
         <div class="weight">345g</div>
         <div class="price">Rs.43000/-</div>
         <input type="number" min="1" name="product_quantity" class="quan" value="1">
         <input type="hidden" name="product_image" value="m1.jpg">
         <input type="hidden" name="product_name" value="Camon 19">
         <input type="hidden" name="product_weight" value="345">
         <input type="hidden" name="s_charge" value="900">
         <input type="hidden" name="product_price" value="43000">
         <input type="submit" value="add to cart" name="add_to_cart" class="pbtn">
    </form>
       
    <form method="post" class="pbox" action="">
         <img src="img/e1.jpg" alt="">
         <div class="name">sony s-bass</div>
         <div class="weight">30g</div>
         <div class="price">Rs.1900/-</div>
         <input type="number" min="1" name="product_quantity" class="quan" value="1">
         <input type="hidden" name="product_image" value="e1.jpg">
         <input type="hidden" name="product_name" value="sony s-bass">
         <input type="hidden" name="product_weight" value="30">
         <input type="hidden" name="s_charge" value="250">
         <input type="hidden" name="product_price" value="1900">
         <input type="submit" value="add to cart" name="add_to_cart" class="pbtn">
    </form>
       
    <form method="post" class="pbox" action="">
         <img src="img/w1.jpg" alt="">
         <div class="name">smart watch</div>
         <div class="weight">190g</div>
         <div class="price">Rs.7900/-</div>
         <input type="number" min="1" name="product_quantity" class="quan"  value="1">
         <input type="hidden" name="product_image" value="w1.jpg">
         <input type="hidden" name="product_name" value="smart watch">
         <input type="hidden" name="product_weight" value="190">
         <input type="hidden" name="s_charge" value="500">
         <input type="hidden" name="product_price" value="7900">
         <input type="submit" value="add to cart" name="add_to_cart" class="pbtn">
    </form>
       
    <form method="post" class="pbox" action="">
         <img src="img/e4.jpg" alt="">
         <div class="name">ptron n3</div>
         <div class="weight">140g</div>
         <div class="price">Rs.8400/-</div>
         <input type="number" min="1" name="product_quantity" class="quan" value="1">
         <input type="hidden" name="product_image" value="e4.jpg">
         <input type="hidden" name="product_name" value="ptron n3">
         <input type="hidden" name="product_weight" value="140">
         <input type="hidden" name="s_charge" value="720">
         <input type="hidden" name="product_price" value="8400">
         <input type="submit" value="add to cart" name="add_to_cart" class="pbtn">
    </form>
       
    <form method="post" class="pbox" action="">
         <img src="img/e2.jfif" alt="">
         <div class="name">inpod 3</div>
         <div class="weight">1450g</div>
         <div class="price">Rs.3900/-</div>
         <input type="number" min="1" name="product_quantity" class="quan" value="1">
         <input type="hidden" name="product_image" value="e2.jfif">
         <input type="hidden" name="product_name" value="inpod 3">
         <input type="hidden" name="product_price" value="3900">
         <input type="hidden" name="s_charge" value="430">
         <input type="submit" value="add to cart" name="add_to_cart" class="pbtn">
     </form>
       
    <form method="post" class="pbox" action="">
         <img src="img/h1.jpg" alt="">
         <div class="name">Hx 4200</div>
         <div class="weight">290g</div>
         <div class="price">Rs.5800/-</div>
         <input type="number" min="1" name="product_quantity" class="quan" value="1">
         <input type="hidden" name="product_image" value="h1.jpg">
         <input type="hidden" name="product_name" value="Hx 4200">
         <input type="hidden" name="product_weight" value="290">
         <input type="hidden" name="product_price" value="5800">
         <input type="submit" value="add to cart" name="add_to_cart" class="pbtn">
    </form>
 
       
<!--       --------------------------------------------------go to cart button -------------------------------------------------->
       
       
   <div class="cart_red">
       <a href="cart.php">go to cart</a><ion-icon name="play-forward"></ion-icon>
   </div>
   </div>
   </div>
   </div>
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