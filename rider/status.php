<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะการส่งอาหาร</title>
</head>
<body>
    <?php
    
        $page = 'status';
        include 'nav.php';
    
    ?>

    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">สถานะการส่งอาหาร</h1>
            <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE (`status` BETWEEN 1 AND 4) AND `rider_id` = '".$_SESSION['rider_id']."' ");
                if($select_order -> num_rows > 0){
                while($row_order = mysqli_fetch_array($select_order)){
                    $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '".$row_order['res_id']."' ");
                    $row_res = mysqli_fetch_array($select_res);
            ?>
                <div class="col-md-10 rounded border shadow p-3 mb-5 bg-light">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>คำสั่งซื้อร้าน : <?php echo $row_res['res_name'] ?></h3>
                            <p><?php echo $row_res['address'] ?> | <?php echo $row_res['phone'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-3 shadow-sm">
                                <h4>สถานะคำสั่งซื้อ
                                    <?php if($row_order['status'] == 3){ ?>
                                        <a href="update_status.php?order_code=<?php echo $row_order['order_code'] ?>&status=3" class="btn btn-outline-success float-end">ยืนยันการจัดส่ง และชำระเงินเสร็จสิ้น</a>
                                    <?php } ?>
                                </h4>
                                <progress class="progress w-100" value="<?php echo $row_order['status'] ?>" max="4"></progress>
                                <p>
                                    <?php
                                        if($row_order['status'] == 1){
                                            echo 'กำลังรอร้านค้ายืนยันออร์เดอร์';
                                        } else if($row_order['status'] == 2){
                                            echo 'ร้านค้ากำลังทำอาหาร';
                                        } else if($row_order['status'] == 3){
                                            echo 'ร้านค้าทำอาหารเสร็จแล้ว จัดส่งเลย';
                                        } else if($row_order['status'] == 4){
                                            echo 'จัดส่งและชำระเงินเสร็จสิ้น กำลังรอความคิดเห็นจากลูกค้า';
                                        } 
                                    ?>
                                </p>
                            </div>
                        </div>
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
                </div>
            <?php }} else { ?>
                    <p class="text-center blockquote-footer">ยังไม่มีออร์เดอร์ <a href="index.php">ค้นหาร้านค้าแล้วรับออร์เดอร์เลย</a></p>
            <?php } ?>
        </div>
    </div>
</body>
</html>