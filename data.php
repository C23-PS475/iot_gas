<?php

$konek = mysqli_connect("localhost", "root", "", "iot_gas");

$sql_ID = mysqli_query($konek, "SELECT MAX(ID) FROM sensor");

$data_ID = mysqli_fetch_array($sql_ID);

$ID_akhir = $data_ID['MAX(ID)'];
$ID_awal =  $ID_akhir - 6 ;

$tanggal = mysqli_query($konek, "SELECT DATE_FORMAT(tanggal, '%H:%i:%s') AS waktu from sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC");

$supply_mq4 = mysqli_query($konek, "SELECT ppm_mq4 from sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC");
$supply_mq7 = mysqli_query($konek, "SELECT ppm_mq7 from sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC");
$supply_mq131 = mysqli_query($konek, "SELECT ppm_mq136 from sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC");
$supply_mq135 = mysqli_query($konek, "SELECT ppm_mq135 from sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC");

?>

<div class="card-body">
    <canvas id="mychart1"></canvas>
    <script type="text/javascript">
        var canvas1 = document.getElementById('mychart1');
        var data1 = {
            labels : [
                <?php
                    while($data_tanggal = mysqli_fetch_array($tanggal)) {
                        echo '"'.$data_tanggal['waktu'].'",';
                    }
                ?>
            ],
            datasets : [
                {
                    label : "mq4", 
                    fill : true,
                    backgroundColor : "rgba(52, 231, 43, 0.2)", // Warna hijau muda untuk mq4
                    borderColor : "rgba(52, 231, 43, 1)", // Warna hijau untuk mq4
                    lineTension : 0.5,
                    pointRadius : 5,
                    data : [
                        <?php
                            while($data_supply = mysqli_fetch_array($supply_mq4)) {
                                echo $data_supply['ppm_mq4'].',' ;
                            }
                        ?>
                    ]
                },
                {
                    label : "mq7", 
                    fill : true,
                    backgroundColor: "rgba(255, 0, 0, 0.2)", // Warna merah muda untuk mq7
                    borderColor: "rgba(255, 0, 0, 1)", // Warna merah untuk mq7
                    lineTension : 0.5,
                    pointRadius : 5,
                    data : [
                        <?php
                            mysqli_data_seek($supply_mq7, 0); // Mengembalikan pointer ke awal $supply_mq7
                            while($data_mq7 = mysqli_fetch_array($supply_mq7)) {
                                echo $data_mq7['ppm_mq7'].',' ;
                            }
                        ?>
                    ]
                },
                {
                    label : "mq131", 
                    fill : true,
                    backgroundColor: "rgba(0, 0, 255, 0.2)", // Warna biru muda untuk mq131
                    borderColor: "rgba(0, 0, 255, 1)", // Warna biru untuk mq131
                    lineTension : 0.5,
                    pointRadius : 5,
                    data : [
                        <?php
                            mysqli_data_seek($supply_mq131, 0); // Mengembalikan pointer ke awal $supply_mq131
                            while($data_mq131 = mysqli_fetch_array($supply_mq131)) {
                                echo $data_mq131['ppm_mq136'].',' ;
                            }
                        ?>
                    ]
                },
                {
                    label : "mq135", 
                    fill : true,
                    backgroundColor: "rgba(255, 165, 0, 0.2)", // Warna oranye muda untuk mq135
                    borderColor: "rgba(255, 165, 0, 1)",
                    lineTension : 0.5,
                    pointRadius : 5,
                    data : [
                        <?php
                            mysqli_data_seek($supply_mq135, 0); // Mengembalikan pointer ke awal $supply_mq135
                            while($data_mq135 = mysqli_fetch_array($supply_mq135)) {
                                echo $data_mq135['ppm_mq135'].',' ;
                            }
                        ?>
                    ]
                }
            ] 
        };

        var options1 = {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Waktu' // Label untuk sumbu x
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Nilai' // Label untuk sumbu y
                    }
                }
            },
            showLines: true,
            animation: { duration: 5 }
        };

        var myLineChart1 = new Chart(canvas1, {
            type: 'line',
            data: data1,
            options: options1
        });
    </script>
</div>
