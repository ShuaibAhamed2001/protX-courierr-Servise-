<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "stock_managment";

$connection = new mysqli($host, $user, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update seller logic goes here...
}

// Fetch the count of sellers registered by month
$sql = "SELECT MONTHNAME(reg_date) AS month, COUNT(*) AS count FROM seller GROUP BY MONTH(reg_date)";
$result = $connection->query($sql);
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[$row['month']] = $row['count'];
}

$months = array(
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
);

$monthData = array();
foreach ($months as $month) {
    $count = isset($data[$month]) ? $data[$month] : 0;
    $monthData[] = $count;
}

$monthData = json_encode($monthData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="./style2.css">
    <style>
    body {
        margin: 0;
    }

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

    #chartContainer {
        width: 600px;
        height: 550px; /* Adjust the height as desired */
        margin: 0 auto;
        margin-top: 40px; /* Add margin-top to create space between the navigation bar and the chart */
    }
</style>

</head>
<body>
    <ul>
        <li><a  href="MainUI.html"><h7>Home Page</h7></a></li>
        <li><a href="create.php"><h7>New seller Page</h7></a></li>
        <li><a href="update.php"><h7>Update seller Page</h7></a></li>
        <li><a href="index.php"><h7>View sellers</h7></a></li>
        <li><a class="active" href="report.php"><h7>Report Page</h7></a></li>
        <li style="float:right" ><a href="home.php"><h7>Logout</h7></a></li>
    </ul>


    <div id="chartContainer">
        <canvas id="sellerChart"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('sellerChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Number of Sellers',
                    data: <?php echo $monthData; ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 90,
                            minRotation: 90,
                            
                            font: {
                                size: 17
                                
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 15
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Number of Sellers registerd',
                        font: {
                            size: 25
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
