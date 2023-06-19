
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "stock_managment";

$connection = new mysqli($servername, $username, $password, $database);



$SellerID = "";
$Sellername = "";
$Phone_no = "";
$email = "";
$ownerNIC = "";
$Businessregistration_no = "";
$warehouse_address = "";
$New_Password = "";
$ShopLink = "";

$errorMessage = "";
$successMessage = "";



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // GET method: Show the data of the seller
    if (!isset($_GET["SellerID"])) {
        header("location:update.php");
        exit;
    }
    $SellerID = $_GET["SellerID"];
    // Read the row of the selected seller from the database table

    $sql = "SELECT * FROM seller WHERE id = '$SellerID'";
    $result = $connection->query($sql);

    if (!$result) {
        // Query execution failed
        $errorMessage = "Error: " . $connection->error;
        header("location:update.php?error=$errorMessage");
        exit;
    }

    $row = $result->fetch_assoc();
    $result->free(); // Free the result set

    if (!$row) {
        header("location:update.php");
        exit;
    }

    $Sellername = $row["Sellername"];
    $Phone_no = $row["Phone_no"];
    $email = $row["Email"];
    $ownerNIC = $row["ownerNIC"];
    $Businessregistration_no = $row["Businessregistration_no"];
    $warehouse_address = $row["warehouse_address"];
    $New_Password = $row["New_Password"];
    $ShopLink = $row["ShopLink"];
} else {
    // POST method: Update the data of the seller
    $SellerID = $_POST["SellerID"];
    $Sellername = $_POST["Sellername"];
    $Phone_no = $_POST["Phone_no"];
    $email = $_POST["email"];
    $ownerNIC = $_POST["ownerNIC"];
    $Businessregistration_no = $_POST["Businessregistration_no"];
    $warehouse_address = $_POST["warehouse_address"];
    $New_Password = $_POST["New_Password"];
    $ShopLink = $_POST["ShopLink"];

 do { 
    if(empty($SellerID) || empty($Sellername) || empty($Phone_no) || empty($email) || empty($ownerNIC) || empty($Businessregistration_no) || empty($warehouse_address) || empty($New_Password) || empty($ShopLink)) {
        $errorMessage = "All the fields are required";
        break;
    } 
        $sql = "UPDATE seller " . 
                "SET Sellername = '$Sellername', Phone_no = '$Phone_no', Email = '$email', ownerNIC = '$ownerNIC', Businessregistration_no = '$Businessregistration_no', warehouse_address = '$warehouse_address', New_Password = '$New_Password', ShopLink = '$ShopLink' WHERE id = '$SellerID'";
        $result = $connection->query($sql);
        if (!$result) {
            $errorMessage = "Invalid query: ".$connection->error;
            break;
        } 
            $successMessage = "Seller updated correctly";
            header("location:update.php");
            exit;
        }
 while (false);

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
</head>
<body>
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
        <input type="hidden" name="SellerID" value="<?php echo $SellerID; ?>">    
        
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
                  <button type="submit" class="btn btn-primary">Submit</button>   
                 </div>
                 <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
        </div>
     </div>
   </form>
  </div>
 </body>           
</html>