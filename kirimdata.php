<?php

    $konek = mysqli_connect("localhost", "root", "", "iot_gas");

    $mq136 = $_GET["mq136"];
    $mq135 = $_GET["mq135"];   
    $tinggiair = $_GET["tinggiair"];
    $status = $_GET["status"];

    mysqli_query($konek,"ALTER TABLE sensor AUTO_INCREMENT=1");
    mysqli_query($konek, "INSERT INTO sensor(ppm_mq136, ppm_mq135, tinggiair, status)VALUES('$mq136', '$mq135', '$tinggiair', '$status')");
    

?>