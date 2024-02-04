<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตะกร้า</title>
</head>
<body>
    <?php
    
        include 'nav.php';
    
    ?>

    <div class="container">
        <div class="row justify-content-center my-5">
            <h1>ตะกร้า
                <a href="see_restaurant.php" class="btn btn-primary float-end">เลือกรายการอาหารเพิ่ม</a>
            </h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered text-center shadow">
                    <tr>
                        <th>รายการอาหาร</th>
                        <th>ราคาต่อชิ้น</th>
                        <th>จำนวน</th>
                        <th>ราคารวม</th>
                        <th>จัดการ</th>
                    </tr>

                    <?php
                        $sum_food = 0;
                        $all_food_price = 0;
                        $sum_price = 0;
                        foreach($_SESSION['cart_arr'] as $food_id => $food_qty){
                            $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '$food_id' AND `res_id` = '".$_SESSION['see_res']."' ");
                            while($row_food = mysqli_fetch_array($select_food)){
                    ?>
                        <tr valign="middle">
                            <td>
                                <center>
                                    <div class="rounded hover-img" style="width: 7rem; height: 7rem;">
                                        <img src="../upload/<?php echo $row_food['img'] ?>" class="img">
                                    </div>
                                    <p><?php echo $row_food['food_name'] ?></p>
                                </center>
                            </td>
                            <td>
                                <?php 
                                    if($row_food['discount'] != 0){ 
                                        $price = $row_food['new_price'];
                                ?>
                                    <s class="text-secondary">฿<?php echo $row_food['price'] ?></s>
                                    <span class="text-success">฿<?php echo $row_food['new_price'] ?></span>
                                    <span class="text-danger">(ลด <?php echo $row_food['discount'] ?>%)</span>
                                <?php } else {
                                    $price = $row_food['price'];
                                    echo '฿'.$price;
                                } ?>
                            </td>
                            <td><?php echo $food_qty ?></td>
                            <td>฿
                                <?php
                                    $sum_food = $price * $food_qty;
                                    echo $sum_food;
                                    $all_food_price += $sum_food;
                                    $sum_price += $sum_food;
                                ?>
                            </td>
                            <td>
                                <a href="add_cart_db.php?del=<?php echo $food_id ?>" class="btn btn-warning" onclick="return confirm('ต้องการนำออกจากตะกร้าหรือไม่?')">ลบ</a>
                            </td>
                        </tr>
                    <?php }} ?>
                </table>
            </div>
            <hr>
            
            <div class="col-md-6">
                <form action="add_cart_db.php" class="d-flex gap-2 mb-3" method="post">
                    <input type="text" class="form-control me-2" name="cpn_code" placeholder="กรอกโค้ดส่วนลด">
                    <input type="submit" class="btn btn-primary me-2" name="add_cpn" value="ยืนยัน">
                </form>

                <?php
                    if(isset($_GET['cpn_discount'])){
                        $cpn_disc = $_GET['cpn_discount'];
                        $sum_price = discount($all_food_price, $cpn_disc);
                ?>
                    <h5>ค่าอาหาร<span class="float-end">฿<?php echo $all_food_price ?></span></h5>
                    <h5 class="text-danger">ส่วนลด<span class="float-end">- <?php echo $cpn_disc ?>%</span></h5>
                <?php } else { $cpn_disc = 0; } ?>

                <h5 class="text-success">ทั้งหมด<span class="float-end">฿<?php echo $sum_price; ?></span></h5>
            </div>
            <hr>

            <div class="col-md-6">
                <form action="insert_order.php" class="card shadow p-4 mb-5" method="post">
                    <h2 class="text-center mb-4">ข้อมูลผู้สั่ง</h2>

                    <input type="hidden" name="all_food_price" value="<?php echo $all_food_price ?>">
                    <input type="hidden" name="cpn_discount" value="<?php echo $cpn_disc ?>">
                    <input type="hidden" name="sum_price" value="<?php echo $sum_price ?>">

                    <label for="">ชื่อ-สกุล</label>
                    <input type="text" class="form-control mb-3" name="username" value="<?php echo $row['firstname'].' '.$row['lastname'] ?>" >

                    <label for="">ที่อยู่</label>
                    <input type="text" class="form-control mb-3" name="address" value="<?php echo $row['address'] ?>" >

                    <label for="">เบอร์โทร</label>
                    <input type="tel" class="form-control mb-3" name="phone" value="<?php echo $row['phone'] ?>" >

                    <input type="submit" class="btn btn-success w-100" value="สั่งเลย" name="buy_order">
                </form>
            </div>
        </div>
    </div>
</body>
</html>