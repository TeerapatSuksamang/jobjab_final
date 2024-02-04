<?php

    if($permis == 'user'){
        if(isset($_GET['see_res'])){
            $_SESSION['see_res'] = $_GET['see_res'];
        }
        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '".$_SESSION['see_res']."' ");
    }
    if($permis == 'rider'){
        if(isset($_GET['rider_see_res'])){
            $_SESSION['rider_see_res'] = $_GET['rider_see_res'];
        }
        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '".$_SESSION['rider_see_res']."' ");
    }
    $row_res = mysqli_fetch_array($select_res);

?>
<div class="banner">
    <img src="../upload/<?php echo $row_res['img'] ?>" class="img">
</div>

<div class="container my-4">
    <div class="mx-4">
        <h3>ร้านอาหาร : <?php echo $row_res['res_name'] ?></h3>
        <h5>ที่อยู่ : <?php echo $row_res['address'] ?> | ติดต่อ : <?php echo $row_res['phone'] ?> </h5>
        <p>
            <?php
                if($row_res['star'] != 0){
                    for($i=1; $i<=$row_res['star']; $i++){
                        echo '⭐';
                    }
                    echo $row_res['star'].' ('.$row_res['qty_sale'].' เรตติ้ง)';
                } else {
                    echo '⭐ยังไม่มีคะแนน';
                }
            ?>
        </p>
    </div>
</div>