<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "stock_managment";

$connection = new mysqli($host, $user, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$SellerID = "";
$Sellername ="";
$Phone_no ="";
$email ="";
$ownerNIC ="";
$Businessregistration_no ="";
$warehouse_address="";
$New_Password="";
$ShopLink="";


$errorMessage ="";
$successMessage ="";




if( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $SellerID =$_POST["SellerID"];
    $Sellername =$_POST["Sellername"];
    $Phone_no =$_POST["Phone_no"];
    $email =$_POST["email"];
    $ownerNIC =$_POST["ownerNIC"];
    $Businessregistration_no =$_POST["Businessregistration_no"];
    $warehouse_address=$_POST["warehouse_address"];
    $New_Password=$_POST["New_Password"];
    $ShopLink=$_POST["ShopLink"];
    

    do {
        if(empty($Sellername)|| empty($Phone_no)|| empty($email)|| empty($ownerNIC)|| empty($Businessregistration_no)  || empty($warehouse_address)|| empty($New_Password)|| empty($ShopLink)) {
            $errorMessage = "All the fields are required";
            break;
        }
        //add new client to database
        $sql = "INSERT INTO seller (SellerID, Sellername, Phone_no, email, ownerNIC, Businessregistration_no, warehouse_address, New_Password, ShopLink,reg_date) " .
        "VALUES ('$SellerID', '$Sellername', '$Phone_no', '$email', '$ownerNIC', '$Businessregistration_no', '$warehouse_address', '$New_Password', '$ShopLink',CURDATE())";
        $result = $connection->query($sql);
 
        if (!$result) {
     $errorMessage = "Invalid query: " . $connection->error;
 
    } else {
     $SellerID = "";
     $Sellername = "";
     $Phone_no = "";
     $email = "";
     $ownerNIC = "";
     $Businessregistration_no = "";
     $warehouse_address = "";
     $New_Password = "";
     $ShopLink = "";
     $reg_date="";
 $successMessage = "Client added correctly";
 header("Location:home.php");
     exit;
 }
    }while(false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seller managment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./style2.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
        height: 40px; /* Adjust the height as desired */
    }

    li {
        float: left;
        border-right: 1px solid #bbb;
        height: 40px; /* Adjust the height as desired */
    }

    li:last-child {
        border-right: none;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 10px 16px;
        text-decoration: none;
        height: 40px; /* Adjust the height as desired */
    }

    li a:hover:not(.active) {
        background-color: #00ffff;
    }

    .active {
        background-color: #00ffff;
    }
</style>

</head>
<body>
    <ul>
        <li><a  href="http://localhost/PortX/MainUI.html"><h7>Home Page</h7></a></li>
        <li><a class="active" href="create.php"><h7>New seller Page</h7></a></li>
        <li><a href="update.php"><h7>Update seller Page</h7></a></li>
        <li><a href="index.php"><h7>View sellers</h7></a></li>
        <li><a href="report.php"><h7>Report Page</h7></a></li>
        <li style="float:right" ><a href="home.php"><h7>Logout</h7></a></li>
    </ul>


       <div class="container my-5">
        <h2>New seller</h2>
<?php
        if (!empty($errorMessage)){
          echo "
           <div class='alert alert-warning alert-dismissible fade show' role='alert'>
             <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          ";
        }
        ?>
        <form method="post">
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">SellerID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="SellerID" value="<?php echo $SellerID;?>">
           </div>
        </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Sellername</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Sellername" value="<?php echo $Sellername;?>">
            </div>
         </div>  
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone_no</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Phone_no" value="<?php echo $Phone_no;?>">
                 </div>
              </div>  
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>  
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ownerNIC</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ownerNIC" value="<?php echo $ownerNIC;?>">
                 </div>
            </div>  
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Businessregistration_no</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Businessregistration_no" value ="<?php echo  $Businessregistration_no;?>">
                 </div>
           </div>  
           <div class="row mb-3">
                <label class="col-sm-3 col-form-label">warehouse_address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="warehouse_address" value="<?php echo $warehouse_address;?>">
                 </div>
             </div>  
             <div class="row mb-3">
                <label class="col-sm-3 col-form-label">New_Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="New_Password" value="<?php echo $New_Password;?>">
                 </div>
           </div>  
           <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ShopLink</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ShopLink" value="<?php echo $ShopLink;?>">
                 </div>
             </div> 
             <?php
             if(!empty($successMessage)){
                echo"
                  <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                     <div class ='alert alert-success alert-dismissible fade show' role='alert'>
                      <strong>$successMessage</strong>
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>
                    </div>
                    </div>
                    ";
             }
             ?>
             <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                  <button type="submit" class="btn btn-primary" >Submit</button>   
                 </div>
                 <div class="col-sm-3 d-grid">
                    <a class="btn btn-primary" href="home.php" role="button">Cancel</a>
        </div>
     </div>
   </form>
  </div>
  



 </body>           
</html>