<?php
if(isset($_GET["SellerID"])){
    $SellerID = $_GET["SellerID"];

    $servername ="localhost";
    $username = "root";
    $password = "";
    $database = "stock_managment";

    //Create connection
    $connection = new mysqli($servername,$username,$password,$database);

    $sql ="DELETE FROM seller WHERE SellerID=$SellerID";
    $connection->query($sql);
}

header("location:index.php");
exit;
?>
