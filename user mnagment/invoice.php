
<!-------------------------------------------------------database connection --------------------------------------->

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
   <title>order invoice</title>

    
<style>
    body {
                      background-repeat: no-repeat;
                      background-attachment: fixed;
                      background-size: cover;
                    }
    
  
    
	
	
	.chk-btn{
        margin-bottom: 20px;
        height: 20px;
        display: flex;
         background-color: #00DBFF;
       width: 80px;
		margin-top: 50px;
        margin-left: 940px;
        border-radius: 3px;
	}
    .chk-btn ion-icon{
        margin-right: -10px;
        margin-top: 1px;
        color: white;
        
    }
    .chk-btn a{
        
         color: white;
        width: 35px;
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
        color: #000;
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
        width: 1000px;
        border-radius: 3px;
    }
    .shopping-cart tr, th{
        width: 180px;
	padding: 20px;
	text-align: center;
	cursor: pointer;
        font-size: 15px;
        

}
    .shopping-cart th{
        border: solid lightgrey;
    }
       .shopping-cart td img{
border-radius: 5px;
           margin-top: 5px;
           box-shadow: 0 0 5px 0 black;

}
           .shopping-cart td {
font-size: 15px;
               height: 60px;
               border-top: none; 
               border-right: solid lightgrey; 
               border-left: solid lightgrey;

}
              .total td{
               border-top: solid lightgrey; 
               border-bottom: solid lightgrey;

}
            .gtotal td{
               border-bottom: solid grey;

}
    
     
    .shopping-cart table{
        border-collapse: collapse;
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
        color: #000;
        font-size: 25px;
    }
    
    .back p{
        font-size: 17px;
        color: #00DBFF;
        margin-top: 0px;
        margin-left: 5px;
    }
    


	</style>
</head>
<body>
   
    

   




    
    
    
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
    
    
<!--    ----------------------------------------------------------------invoice section------------------------------------------>
    
     <h1 class="scheading">Invoice</h1>

<div class="cart_container">

    
<!--    --------------------------------------------------------------go back button---------------------------------------------->
    
    
<div class="back" onclick="window.location.href='cart.php'">
    
    <ion-icon name="arrow-back-circle-outline"></ion-icon>

   
    </div>


<div class="shopping-cart">
 <p>Invoice No : #1034</p>
    <div class="user-profile">Bill To : <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>

   <p>  <span><?php echo $fetch_user['name']; ?></span> </p>
  

</div>
  
   <table>
      <thead>
         <th>Order ID</th>
          <th>name</th>
         <th>price/unit</th>
         <th>quantity</th>
         <th>weight/unit</th>
         <th>charge/unit</th>
         <th>total price</th>
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
            <td><?php echo $fetch_cart['id']; ?></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>Rs.<?php echo $fetch_cart['price']; ?>/-</td>
            <td><?php echo $fetch_cart['quantity']; ?>pcs</td>
            
            <td><?php echo $tweight= ($fetch_cart['weight'] * $fetch_cart['quantity']); ?>g</td>
             
            <td><?php echo $tcharge= ($fetch_cart['charge'] * $fetch_cart['quantity']); ?>/-</td>
             
            <td>Rs.<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
            
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
         
    
          <tr class="total" style="height:50px">
         <td colspan="6">grand weight :</td>
         <td><?php echo $gweight; ?>g</td>
          </tr>
          <tr class="gtotal" style="height:50px">
          <td colspan="6">shipping charge :</td>
         <td><?php echo $tscharge; ?>/-</td>
        
      </tr>
           <tr class="total"  style="height:50px">
         <td colspan="6">grand total :</td>
         <td>Rs.<?php echo $grand_total; ?>/-</td>
           
          </tr>
   </tbody>
   </table>

  
</div>
    
<!--    -----------------------------------------------------print button -------------------------------------------------->
    
    
 <div class="chk-btn">  
      <a onclick="window.print();"  class="dbtn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Print</a><ion-icon name="chevron-forward"></ion-icon><ion-icon name="chevron-forward"></ion-icon>
    </div>
</div>
 


</body>
</html>