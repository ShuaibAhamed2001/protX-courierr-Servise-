<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Managment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./style2.css">
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
        <li><a href="create.php"><h7>New seller Page</h7></a></li>
        <li><a href="update.php"><h7>Update seller Page</h7></a></li>
        <li><a class="active" href="index.php"><h7>View sellers</h7></a></li>
        <li><a href="report.php"><h7>Report Page</h7></a></li>
        <li style="float:right" ><a href="home.php"><h7>Logout</h7></a></li>
    </ul>

<div class="container my-5">
        <h2>List of Sellers</h2>
        
        <a class="btn btn-primary" href="http://localhost/seller%20managment/create.php" role="button" >New Seller</a>
        
        <br> 
        <table class="table">
            <thead>
                <tr class = "heading">
                  
                    <th>SellerID</th>
                    <th>Sellername</th>
                    <th>Phone_no</th>
                    <th>email</th>
                    <th>ownerNIC</th>
                    <th>Businessregistration_no</th>
                    <th>warehouse_address</th>
                    <th>New_Password</th>
                    <th>ShopLink </th>
                    <th>Action</th>
         </tr>
             </thead>
             <tbody style="background-color: rgba(0, 0, 0, 0.1);">
                  <?php
                  $servername ="localhost";
                  $username = "root";
                  $password = "";
                  $database = "stock_managment";

                  // Create connection
                  $connection = new mysqli($servername,$username,$password,$database);

                  //Check  connection
                  if ($connection->connect_error){
                    die("Connection failed: ". $connection->connect_error);
                  }
                  // read all row from database table
                  $sql = "SELECT * FROM seller";
                  $result = $connection->query($sql);

                  if (!$result){
                    die("Invalid query: ". $connection->error);
                  }

                  if(mysqli_num_rows($result) > 0){
                    while ($row = $result->fetch_assoc()) {
              
                  //read data of each row
                 
                    echo"
                    <tr>
                       <td>$row[SellerID]</td>
                       <td>$row[Sellername]</td>
                       <td>$row[Phone_no]</td>
                       <td>$row[email]</td>
                       <td>$row[ownerNIC]</td>
                       <td>$row[Businessregistration_no]</td>
                       <td>$row[warehouse_address]</td>
                       <td>$row[New_Password]</td>
                       <td>$row[ShopLink]</td>
                       <td>
                         <a class='btn btn-primary btn-sm' href='edit.php?SellerID=".$row["SellerID"]."'>Edit</a>
                         <a class='btn btn-danger btn-sm' href='delete.php?SellerID=$row[SellerID]'>Delete</a>
                       </td>
                  </tr>
                     ";
                    }
                  }
                  ?>
                 
                
              </tbody>
             </table>
        </div>
        </div>
    </body>
</html>