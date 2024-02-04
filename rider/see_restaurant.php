<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านอาหาร</title>
</head>
<body>
    <?php
    
        include 'nav.php';
        $permis = 'rider';
        include '../template/banner.php';

    ?>

    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">รับออร์เดอร์</h1>
            <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE (`status` = 0) AND `res_id` = '".$_SESSION['rider_see_res']."' ");
                if($select_order -> num_rows > 0){
                    while($row_order = mysqli_fetch_array($select_order)){
            ?>
                <div class="col-md-10 rounded border shadow bg-light p-3 mb-5">
                    <h3>สถานะคำสั่งซื้อ
                        <a href="update_status.php?order_code=<?php echo $row_order['order_code']; ?>&status=0" class="btn btn-outline-success float-end mb-2">รับออร์เดอร์</a>
                    </h3>
                    <progress class="progress w-100" value="" max="4"></progress>
                    <p>รอไรเดอร์รับออร์เดอร์</p>
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
                                <h5>ชื่อผู้สั่ง : <?php echo $row_order['user_name'] ?></h5>
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
                <p class="text-center blockquote-footer">ยังไม่มีออร์เดอร์ในขณะนี้</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>