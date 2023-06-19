
<head>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
 <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
   
</head>
<?php
include_once 'px_db_connection.php';


		if(isset($_POST['delete']))
{
 

    
$con=mysqli_connect("localhost","root","","stock_managment");
$check="SELECT * FROM user WHERE mobile = '$_POST[mobile1]'";
$drs = mysqli_query($con,$check);
$ddata = mysqli_fetch_array($drs, MYSQLI_NUM);
if($ddata > 1) { 
    
     $mobile1 = $_POST['mobile'];
     $mobile2 = $_POST['mobile1'];
        
     $dsql =  "DELETE FROM user where mobile=$mobile2" ;
     if (mysqli_query($conn, $dsql)) {
        echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('User Deleted Successfully...','','success');
        },1); 
        window.setTimeout(function(){ 
            window.location.replace('pxlogin.php');
        } ,3000); 
        </script>
        ";
         
         
     } else {
		 $message1="Try again";
        echo "<script type='text/javascript'>alert('$message1');</script>";
		
     }
	
	
     mysqli_close($conn);
    
	
}
	}


if(isset($_POST['submit']))
{    
$con=mysqli_connect("localhost","root","","portx");
$check="SELECT * FROM user WHERE mobile = '$_POST[mobile1]'";
$rs = mysqli_query($con,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data > 1) { 
    
      $name1 = $_POST['name'];
     $email1 = $_POST['email'];
     $mobile1 = $_POST['mobile'];
     $mobile2 = $_POST['mobile1'];
    
     $password = $_POST['password'];
        
     $sql =  "UPDATE user SET name='$name1',email='$email1',mobile='$mobile1',password='$password' WHERE mobile=$mobile2";
     if (mysqli_query($conn, $sql)) {
          echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('User Updated Successfully...','','success');
        },1); 
        window.setTimeout(function(){ 
            window.location.replace('acc.php');
        } ,3000); 
        </script>
        ";
         

         
         
     } else {
		 $message1="Try again";
        echo "<script type='text/javascript'>alert('$message1');</script>";
		
     }
	
	
     mysqli_close($conn);
    
	
}
	}
?>