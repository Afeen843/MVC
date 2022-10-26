<?php
include_once('config.php');
$customer = new customers('pdo', 'localhost', 'root', '');
$customer->createConnection();
$rows=$customer->chart();

$month=array();
$sales=array();
foreach ($rows as $row)
{
    $month[]=$row['month'];
    $sales[]=$row['sale'];

}


?>

<div class="section">
    <div class="dashboard">
        <div class="box">
            <h3> Customers Summary</h3>
            <div style="font-size:15px"><p>Total Numbers of Customers:<b><?php echo $customer->totalUser(); ?></b></p>
            </div>
            <div style="font-size:15px"><p>The Number of Active Customers:<b><?php echo $customer->activeUser(); ?></b>
                </p></div>
        </div>
        <div class="box">
            <h3>Products</h3>
            <div style="font-size:15px"><p>Total Numbers of Products:<b><?php echo $customer->totalUser(); ?></b></p>
            </div>
            <div style="font-size:15px"><p>products Sold:<b><?php echo $customer->totalUser(); ?></b></p>
            </div>
        </div>
        <div class="box">
            <h3>Sales</h3>
            <div style="font-size:15px"><p>Total sales:<b><?php echo $customer->totalUser(); ?>00$</b></p>
            </div>
            <div style="font-size:15px"><p>Total sales this month:<b><?php echo $customer->totalUser(); ?>0$</b></p>
            </div>
        </div>
<!--        <div class="box">categories</div>-->
<!--        <div class="box">config</div>-->
<!--        <div class="box"></div>-->
        <div>
            <canvas id="myChart"></canvas>
        </div>


    </div>

</div>

<script>

    const labels = <?php echo  json_encode($month)?>;
    const data = {
        labels: labels,
        datasets: [{
            label: 'SALES OF MONTHS',
            data: <?php echo json_encode($sales)?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

</script>
