<!--------------------------------database connection--------------------------------------------->

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


//-----------------------------------------------------------add to cart button php----------------------------------
if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};

//-----------------------------------------------------------update cart button php----------------------------------

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
    
     echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('cart quantity updated successfully!','','success');
        },1); 
        window.setTimeout(function(){ 
            window.location.replace('cart.php');
        } ,1000); 
        </script>
        ";
}


//-----------------------------------------------------------remove button php----------------------------------

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');

    
     echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('item removed successfully!','','success');
        },1); 
        window.setTimeout(function(){ 
            window.location.replace('cart.php');
        } ,1000); 
        </script>
        ";
    
}


//-----------------------------------------------------------remove all button php----------------------------------
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   
    
     echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('all items removed successfully!','','success');
        },1); 
        window.setTimeout(function(){ 
            window.location.replace('cart.php');
        } ,1000); 
        </script>
        ";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
      <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

    
<style>
    body {
        background-repeat: no-repeat;
                      background-attachment: fixed;
                      background-size: cover;
                    }
    
        
    
.navbar {
    position: absolute;
    margin-left: 530px;
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

.header .logo {
  font-weight: bolder;
  color: #fff;
	
  font-size: 4rem;
}

.header .logo span {
  color: #F76833;
}

    
.logo img {
height: 10rem;
margin-right: -20px;
margin-top: -42px;
margin-bottom: -45px;
}
    
	
	
	.quan{
		width: 30px;
		border-radius: 3px;
        border: none;
		margin-left: 25%;
		height: 20px;
	}
    .cart_quantity{
       
		width: 30px;
		border-radius: 3px;
		height: 18px;
        border: none;
        background-color: lightgrey;
	
    }
	.price{
		margin-left: 40%;
		font-size: 13px;
        margin-bottom: 5px;
	}
	.name{
		margin-left: 40%;
		font-size: 18px;
        margin-bottom: 3px;
	}
	.pbtn{
        
		background-color: #00DBFF;
		border: none;
        border-radius: 3px;
		color: white;
		height: 20px;
		width: 80px;
        cursor: pointer;
	}
    .pbtn:hover{
		background-color:  rgba(0,0,0,0.6);
	}
	.dbtn{
        
		border-radius: 3px;
		color: #00DBFF;
		font-size: 15px;
		height: 20px;
		width: 80px;
        cursor: pointer;
		text-decoration: none;
	}
    .dbtn:hover{
		text-decoration: underline;
        color: rgba(0,0,0,0.6);
	}
   
	.ubtn{
		background-color: #00DBFF;
		border-radius: 3px;
		color: white;
       border: none;
		height: 18px;
		width: 60px;
        cursor: pointer;
	}
    .ubtn:hover{
		background-color: rgba(0,0,0,0.6);
	}
	.chk-btn{
        margin-bottom: 20px;
        height: 20px;
        display: flex;
         background-color: #00DBFF;
       width: 150px;
		margin-top: 50px;
        margin-left: 1020px;
        border-radius: 3px;
	}
    .chk-btn ion-icon{
        margin-right: -10px;
        margin-top: 1px;
        color: white;
        
    }
    .chk-btn a{
        
         color: white;
        width: 90px;
        margin-left: 25px;
	}
    .chk-btn:hover{
        background-color: grey;
       
	}
    .chk-btn a:hover{
        text-decoration: none;
        color: white;
	}
	.cheading{
        margin-left: 45%;
		top: 250px;
		margin-bottom: 20px;
	}
    .scheading{
        color: #00DBFF;
        margin-left: 40%;
		top: 250px;
		margin-bottom: 20px;
	}
    .cart_container{
        top: 50%;
        margin-top: 130px;
    }
    .shopping-cart{
        margin-left: 10px;
        background-color: rgba(0,0,255,0.04);
        width: 1200px;
        border-radius: 3px;
        border: solid lightgrey;
    }
    .shopping-cart tr, th{
        width: 180px;
	padding: 20px;
	border: 1px solid lightgray;
	border-collapse: collapse;
	text-align: center;
	cursor: pointer;
        font-size: 15px;

}
       .shopping-cart td img{
border-radius: 5px;
           margin-top: 5px;
           box-shadow: 0 0 5px 0 black;

}
      .shopping-cart td {
font-size: 15px;

}
 .flex a{
	font-size: 18px;
	color: #00DBFF;
	cursor: pointer;
	user-select:none;
	text-decoration: none;
    
}
    .flex{
         margin-top: -10px;
        margin-left: 8px;
    }

        
        a:hover{
            text-decoration: underline;
        } 
    .user-profile{
        margin-right: -90px;
        margin-top: -10px;
    }
    
    .img-box .alb img{
     height: 50px;
	width: 50px;
        margin-left: 770px;
	border-radius: 15%;
	border: 5px solid #fff;
  box-shadow: 0 0 7px 2px rgb(0 0 0 / 20%);
    
}
    
    
    .pbox{
		width: 200px;
		height: 235px;
		align-items: center;
		display: inline-block;
		margin-left: 85px;
		margin-top: 40px;
		justify-content: center;
		margin-bottom: 20px;
		background: rgba(0,0,0,0.1);
		border-radius: 5px;
		
	}
	.pbox img{
        
		margin-top: 12px;
		margin-left: 26px;
		height: 150px;
		width: 150px;
		border-radius: 15px;
	}
    .table-bottom{
        height: 130px;
        border: solid red;
    }
    .line{
        position: absolute;
        margin-top: 390px;
        width: 1200px;
        border-top: solid grey;
    }
    
    .back{
        display: inline-flex;
        margin-left: 20px;
        cursor: pointer;
    }
    .back:hover{
       text-decoration: underline;
    }
    
    .back ion-icon{
        color: #00DBFF;
        font-size: 25px;
    }
    
    .back p{
        font-size: 17px;
        color: #00DBFF;
        margin-top: 0px;
        margin-left: 5px;
    }
    
    
    .footer .box-container {
        margin-top: 50px;
       height: 340px;
        display: inline-flex;
        border-radius: 5px;
}
.footer .box-container .box {
    display: block;
    width: 412px;
    background-color: rgba(0,0,0,0.1);
}
    
.footer .box-container .box h3 {
  font-size: 1.5rem;
  color: #00DBFF;
  padding: 1rem 0;
    margin-left: 15px;
    margin-top: 0px;
    margin-bottom: -15px;
}
    .footer .box-container .lbox {
    display: block;
    width: 412px;
    background-color: rgba(0,0,0,0.1);
}
    
.footer .box-container .lbox h3 {
  font-size: 1.5rem;
  color: #00DBFF;
  padding: 1rem 0;
    margin-left: 15px;
    margin-top: 0px;
    margin-bottom: -15px;
}
    
    .footer .box-container .lbox p2 {
  font-size: 1.5rem;
  color: #00DBFF;
  padding: 1rem 0;
        display: flex;
    margin-left: 15px;
    margin-top: 0px;
    margin-bottom: -15px;
}

    .footer .box-container .lbox p2 :hover{
        color: #00DBFF;
        text-decoration: underline;
    }


    .footer .box-container .lbox p2 a{
  font-size: 15px;
      color: dimgrey;
  padding: 1rem 0;
        text-decoration: none;
    margin-left: 10px;
    margin-top: 0px;
    margin-bottom: -15px;
}
        .footer .box-container .lbox p2 ion-icon{
  font-size: 20px;
  color: dimgrey;
    margin-left: 15px;
    margin-top: 13px;
    margin-bottom: -15px;
}



.footer .box-container .box p {
  font-size: 1rem;
  color: dimgrey;
    text-decoration: none;
  padding: 8px 0;
    margin-left: 15px;
    cursor: pointer;
    
}
    .footer .box-container .box p:hover{
        text-decoration: underline;
        
    }

.footer .box-container .box p i {
  padding-right: .3rem;
  color: #00DBFF;
}

.footer .box-container .box .share {
  padding: 1rem 0;
}

.footer .box-container .box .share a {
  height: 4.5rem;
  width: 4.5rem;
  line-height: 4.5rem;
  font-size: 1rem;
  color: #00DBFF;
  background:  background-color: rgba(0,0,0,0.05);;
  border-radius: 50%;
  margin-right: .5rem;
  text-align: center;
}



.footer .box-container .box form .email {
  margin-bottom: 1rem;
  width: 100%;
  background: #111;
  padding: 1.2rem;
  font-size: 1.5rem;
  color: #fff;
  text-transform: none;
}


	</style>
</head>
<body>
   
<!--    ------------------------------------------------------------navigation bar------------------------------------------------->
<header class="header">

    <a href="#" class="logo"> 
		<img src="img/blogo.png" alt="">
		
	</a>

	<div class="navbar" id="mynav">

    <a href="home.php" class="home"  >Home</a>
              <a href="pxproducts.php" class="products"  >Products</a>
              <a class="ts" href="#" id="active">Cart  </a>
             <a class="bn" href="acc.php"  >My Account</a>
	</div>
	
    
<!--------------------------------------------------------------------user name display------------------------------------------------->
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

    
    
    
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

<!--    ---------------------------------------------------------------------go to cart button------------------------------------------------>
<div class="cart_container">

<div class="back" onclick="window.location.href='pxproducts.php'">
    
    <ion-icon name="arrow-back-circle-outline"></ion-icon>

    <p>go to products</p>
    </div>

 <h1 class="scheading">My Shopping cart</h1>

<div class="shopping-cart">

<!--  ------------------------------------------------------------shopping cart table -------------------------------------------->
   <table>
      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>weight</th>
         <th>total price</th>
         <th>action</th>
      </thead>
      <tbody>
      <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
           $gweight = 0;
          
           $tscharge = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
         <tr>
            <td><img src="img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>Rs.<?php echo $fetch_cart['price']; ?>/-</td>
            <td >
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" class="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="update" class="ubtn">
               </form>
            </td>
            <td><?php echo $tweight= ($fetch_cart['weight'] * $fetch_cart['quantity']); ?>g</td>
             
            <td><?php echo $tcharge= ($fetch_cart['charge'] * $fetch_cart['quantity']); ?>/-</td>
             
            <td>Rs.<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" class="dbtn" onclick="return confirm('remove item from cart?');">remove</a></td>
         </tr>
      <?php
             $gweight+=$tweight;
             $tscharge+=$tcharge;
         $grand_total += $sub_total;
         $grand_total += $tscharge;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
         
     
          <tr style="height:50px">
         <td colspan="6">grand weight :</td>
         <td><?php echo $gweight; ?>g</td>
          </tr>
          <tr style="height:50px">
          <td colspan="6">shipping charge :</td>
         <td><?php echo $tscharge; ?>/-</td>
        
      </tr>
           <tr style="height:50px">
         <td colspan="6">grand total :</td>
         <td>Rs.<?php echo $grand_total; ?>/-</td>
                <td><a href="cart.php?delete_all" onclick="return confirm('delete all from cart?');" class="dbtn <?php echo ($grand_total > 1)?'':'disabled'; ?>">delete all</a></td>
          </tr>
   </tbody>
   </table>

    
    
<!--    ------------------------------------------------------checkout button -------------------------------------------------->
   <div class="chk-btn">  
      <a href="invoice.php" class="dbtn <?php echo ($grand_total > 1)?'':'disabled'; ?>">view invoice</a><ion-icon name="chevron-forward"></ion-icon><ion-icon name="chevron-forward"></ion-icon>
   </div>

</div>

</div>
 
<!-- --------------------------------------------------------footer -------------------------------------------------------------->
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