<?php require_once("adminbar.php"); ?>

<br /><br />

<div class="row bg-white">
    <div id="myChart" class="chart--container col-md-5 column"></div>
    <div id="myChart2" class="chart--container col-md-7 column"></div>
</div>
<div class="row bg-white">
    <div id="myChart1" class="chart--container col column"></div>
</div>
<?php

$conn = new mysqli("localhost:3308", "root", "", "wds");

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$data = mysqli_query($conn, "SELECT sum(iprem) as Total, itype as Insurance_Type FROM ins group by itype order by itype;");
$data1 = mysqli_query($conn, "SELECT iprem, hinsid FROM ins order by hinsid;");
$data2 = mysqli_query($conn, "SELECT sum(iprem) as Total, b.cmail from ins a right join customer b on a.cmail=b.cmail group by b.cmail order by b.cmail;");
?>

<script>
    var myData = [<?php
                    while ($info = mysqli_fetch_array($data))
                        echo $info['Total'] . ',';
                    ?>];
    var myData1 = [<?php
                    while ($info = mysqli_fetch_array($data1))
                        echo $info['iprem'] . ',';
                    ?>];
    var myData2 = [<?php
                    while ($info = mysqli_fetch_array($data2))
                        echo $info['Total'] . ',';
                    ?>];
    
    <?php
    $data1 = mysqli_query($conn, "SELECT iprem, hinsid FROM ins order by hinsid;");
    $data2 = mysqli_query($conn, "SELECT sum(iprem) as Total, b.cmail from ins a right join customer b on a.cmail=b.cmail group by b.cmail order by b.cmail;");
    ?>

    var myLabels1 = [<?php
                        while ($info = mysqli_fetch_array($data1))
                            echo '"' . $info['hinsid'] . '",';
                        ?>];
    var myLabels2 = [<?php
                        while ($info = mysqli_fetch_array($data2))
                            echo '"' . $info['cmail'] . '",';
                        ?>];


    window.onload = function() {
        zingchart.render({
            id: "myChart",
            width: "99%",
            height: 300,
            data: {
                type: 'pie',
                legend: {

                },
                title: {
                    text: "Total Premium"
                },
                plotarea: {
                    marginLeft: 100,
                    marginRight: 100
                },
                series: [{
                        values: [myData[0]],
                        'legend-text': "Auto Insurance"
                    },
                    {
                        values: [myData[1]],
                        'legend-text': "Home Insurance"
                    }
                ]
            }
        });

        zingchart.render({
            id: "myChart1",
            width: "100%",
            height: 300,
            data: {
                type: 'line',
                title: {
                    text: "Premium per Insurance"
                },
                'scale-x': {
                    label: {
                        text: 'Insurance ID'
                    },
                    labels: myLabels1
                },
                'scale-y': {
                    label: {
                        text: 'USD'
                    },
                },
                plotarea: {
                    marginLeft: 100,
                    marginRight: 100
                },
                series: [{
                    values: myData1
                }]
            }
        });

        zingchart.render({
            id: "myChart2",
            width: "100%",
            height: 300,
            data: {
                type: 'pareto',
                title: {
                    text: "Premium per User"
                },
                'scale-x': {
                    label: {
                        text: 'User Email'
                    },
                    labels: myLabels2
                },
                'scale-y': {
                    label: {
                        text: 'USD'
                    },
                },
                plotarea: {
                    marginLeft: 100,
                    marginRight: 100
                },
                series: [{
                    values: myData2
                }]
            }
        });

    };
</script>

</div>
</div>
</body>

</html>