<head>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
 <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
   
</head>

<?php
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "stock_managment";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }
?>