<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานสรุปยอดขาย</title>
</head>
<body>
    <?php
    
        $page = 'report';
        include 'nav.php';
    
    ?>

    <div class="container">
        <div class="row mt-5">
            <h1 class="text-center mb-3">รายงานสรุปยอดขาย วัน/เดือน/ปี</h1>
            <form action="report.php" class="d-flex gap-3" method="post">
                <input type="date" class="form-control" name="date1">
                <input type="date" class="form-control" name="date2">
                <input type="submit" class="btn btn-primary" value="ค้นหา" name="submit">
            </form>
            <?php
                if(isset($_POST['date1']) and isset($_POST['date2'])){
                    $date1 = $_POST['date1'];
                    $date2 = $_POST['date2'];
                    if(!empty($date1) and !empty($date2)){
                        echo "<p>ค้นหาจากวันที่ $date1 ถึงวันที่ $date2 </p>";
                        $select1 = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE (`date` BETWEEN '$date1' AND '$date2') AND `status` = 5 AND `res_id` = '".$_SESSION['res_id']."' ");
                        $select2 = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE (`date` BETWEEN '$date1' AND '$date2') AND `status` = 5 AND `res_id` = '".$_SESSION['res_id']."' ");
                    } else {
                        $select1 = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 5 AND `res_id` = '".$_SESSION['res_id']."' ");
                        $select2 = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 5 AND `res_id` = '".$_SESSION['res_id']."' ");
                    }
                } else {
                    $select1 = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 5 AND `res_id` = '".$_SESSION['res_id']."' ");
                    $select2 = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 5 AND `res_id` = '".$_SESSION['res_id']."' ");
                }
                $sum_price = 0;
                while($row_1 = mysqli_fetch_array($select1)){
                    $sum_price += $row_1['sum_price'];
                }
            ?>
            <p class="text-success my-3">รายได้รวมทั้งสิ้น <?php echo $sum_price ?> บาท</p>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center mt-2 mb-5">
            <?php
                while($row_order = mysqli_fetch_array($select2)){
            ?>
                <div class="col-md-10 rounded border shadow p-3 mb-5 bg-light">
                    <div class="card p-3 shadow-sm">
                        <h6>รีวิวรายการอาหาร
                            <span class="float-end"><?php echo $row_order['date'] ?> <?php echo $row_order['time'] ?></span>
                        </h6>
                        <h3 class="text-warning">
                        <?php
                            $x = 5 - $row_order['star'];
                            $x = ceil($x);
                            for($i=1; $i<=$row_order['star']; $i++){
                                echo '&#9733';
                            }
                            for($i=1; $i<=$x; $i++){
                                echo '&#9734';
                            }
                        ?>
                    </h3>
                        <input type="text" class="form-control" value="<?php echo $row_order['review'] ?>" name="" readonly>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>รูปภาพ</th>
                                            <th>รายการอาหาร</th>
                                            <th>จำนวน</th>
                                            <th>ราคารวม</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            $select_food = mysqli_query($conn, "SELECT * FROM `food_order` WHERE `order_code` = '".$row_order['order_code']."' ");
                                            while($row_food = mysqli_fetch_array($select_food)){
                                        ?>
                                            <tr valign="middle">
                                                <td>
                                                    <div class="rounded hover-img shadow-sm" style="width: 5rem; height: 5rem;">
                                                        <img src="../upload/<?php echo $row_food['food_img'] ?>" class="img">    
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo $row_food['food_name'] ?>
                                                    <br>
                                                    <?php if($row_food['new_price'] != 0){ ?>
                                                        <s class="text-secondary">฿<?php echo $row_food['price'] ?></s>
                                                        <b class="text-success">฿<?php echo $row_food['new_price'] ?></b>
                                                    <?php } else {
                                                        echo '฿'.$row_food['price'];
                                                    } ?>
                                                </td>
                                                <td><?php echo $row_food['qty'] ?></td>
                                                <td>฿<?php echo $row_food['total_price'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow-sm p-3 mb-3">
                                <h4 class="text-center mb-2">ข้อมูลผู้สั่ง</h4>
                                <h5>ชื่อผู้สั่ง : <?php echo $row_order['username'] ?></h5>
                                <h5>ที่อยู่ : <?php echo $row_order['address'] ?></h5>
                                <h5>เบอร์โทร : <?php echo $row_order['phone'] ?></h5>
                            </div>

                            <?php if($row_order['cpn_discount'] != 0){ ?>
                                <h5>ค่าอาหาร<span class="float-end">฿<?php echo $row_order['total_food_price'] ?></span></h5>
                                <h5 class="text-danger">ส่วนลด<span class="float-end">- <?php echo $row_order['cpn_discount'] ?>%</span></h5>
                            <?php } ?>
                            <h5 class="text-success">ทั้งหมด<span class="float-end">฿<?php echo $row_order['sum_price'] ?></span></h5>
                        </div>
                    </div>
                    <a href="report_pdf.php?order_code=<?php echo $row_order['order_code'] ?>" class="btn btn-outline-primary w-100">ดูใบเสร็จ</a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>