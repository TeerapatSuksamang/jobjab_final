<?php

    $conn = mysqli_connect("localhost", "ietdevco_krujune", "qwerty", "ietdevco_krujune");

    function alert($msg, $lo){
        echo "<script>alert('$msg'); window.location = '$lo';</script>";
    }

    function discount($price, $disc){
        $new_dis = ($price * $disc) / 100;
        $new_price = $price - $new_dis;
        return $new_price;
    }
?>