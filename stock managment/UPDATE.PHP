<?php
// $connection = mysqli_connect("localhost","root","");
// $db = mysqli_select_db($connection,"dbcrud");
include 'count.PHP';
include 'CONFIG.PHP';
$edit = $_GET['edit'];
$sql = "SELECT * FROM stock_tbl WHERE StockID ='$edit'";
$run = mysqli_query($conn, $sql);
$check_data = mysqli_num_rows($run) > 0;
if ($check_data) {
    while ($row = mysqli_fetch_array($run))
        $StockID = $row['StockID'];
    $OrderID = $row['orderid'];
    $Price = $row['txtprice'];
    $Qty = $row['txtqty'];
    $StockType = $row['txtstocktype'];
    $product_Description = $row['txtdescription'];
}
?>

<?php
//   $connection = mysqli_connect("localhost","root","");
//   $db = mysqli_select_db($connection,"dbcrud");
include 'CONFIG.PHP';
if (isset($_POST['submit'])) {
    $edit = $_GET['edit'];

    $StockID = $_POST['txtstockid'];
    $OrderID = $_POST['txtorderid'];
    $Price = $_POST['txtprice'];
    $Qty = $_POST['txtqty'];
    $StockType = $_POST['txtstocktype'];
    $product_Description = $_POST['txtdescription'];

    $sql = "UPDATE stock_tbl SET StockID = '$StockID', OrderID= '$OrderID', Price ='$Price' , Qty = '$Qty', StockType = '$StockType', product_Description = '$product_Description' WHERE id = '$edit'";

    if (mysqli_query($conn, $sql)) {
        echo '<script> window.alert("Successfully Updated..!!!")</script>';
        echo '<script> location.replace("ADD.php")</script>';
    } else {
        echo "Some thing Error" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .notification {
            text-decoration: none;
            padding: 10px 20px;
            position: relative;
            display: inline-block;
            border-radius: 2px;
        }

        .notification .badge {
            position: absolute;
            top: -10px;
            right: -3px;
            padding: 5px 10px;
            border-radius: 50%;
            background-color: red;
            color: white;
        }
    </style>
</head>

<body>
    <div class="topnav">
        <a class="active" href="#VIEW_STOCK">VIEW STOCK</a>
        <a href="#ADD_STCOK">ADD STOCK</a>
        <a href="#ORDERS">ORDERS</a>
        <a href="#STOCK_REPORT">STOCK REPORT</a>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h1 align="center"> Update Details</h1>
                        <h5 align="center">Ceylon Port X</h>
                    </div>
                    <div class="card-body">
                        <br><br><br>
                        <form action="add.php" method="post" align="center">
                            <div class="form-group">
                                <label>Stock ID : </label>
                                <input type="text" name="txtstockid" class="form-control" placeholder="Enter Stock ID" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Order ID : </label>
                                <input type="text" name="txtorderid" class="form-control" placeholder="Enter Order ID" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Price : </label>
                                <input type="text" name="txtprice" class="form-control" placeholder="Enter Price" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Qty : </label>
                                <input type="text" name="txtqty" class="form-control" placeholder="Enter Qty" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="fruit">Select Stock Type :</label>
                                <select name="txtstocktype" id="txtstocktype" placeholder="Select here.." required>
                                    <option value="Electronic">Electronic</option>
                                    <option value="Medicine">Medicine</option>
                                    <option value="Food">Food</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>product_Description : </label>
                                <input type="text" name="txtdescription" class="form-control" placeholder="Enter Product Description" required>
                            </div>
                            <br />
                            <input type="submit" class="btn btn-primary" name="submit" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
        <p class="w3-medium">Created by Team Ceylon Port X</p>
</body>

</html>