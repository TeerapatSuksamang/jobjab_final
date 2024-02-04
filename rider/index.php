<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
</head>
<body>
    <?php
    
        $page = 'index';
        include 'nav.php';
    
    ?>

    <div class="container my-5">
        <div class="row my-4">
            <div class="col-md-6">
                <h2>ร้านอาหาร</h2>
            </div>
            <div class="col-md-6">
                <form action="index.php#res" class="d-flex gap-3 float-end" method="post">
                    <input type="search" class="form-control" name="text" placeholder="ค้นหาร้านอาหาร" value="<?php echo (isset($_POST['text']) ? $_POST['text'] : '') ?>">
                    <input type="submit" class="btn btn-primary" value="ค้นหา" name="search">
                </form>
            </div>

            <div class="row">
                <?php
                    if(isset($_POST['text'])){
                        $text = $_POST['text'];
                        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `status` = 1 AND `res_name` LIKE '%$text%' ");
                    } else {
                        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `status` = 1 ");
                    }   
                    if($select_res -> num_rows > 0){
                        while($row_res = mysqli_fetch_array($select_res)){
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-1">
                        <a href="see_restaurant.php?rider_see_res=<?php echo $row_res['res_id'] ?>" class="text-dark">
                            <div class="card shadow mb-3">
                                <div class="card-img-top hover-img" style="height: 200px;">
                                    <img src="../upload/<?php echo $row_res['img'] ?>" class="img">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row_res['res_name'] ?></h5>
                                    <h6><?php echo $row_res['res_type'] ?> | ⭐<?php echo ($row_res['star'] > 0) ? ($row_res['star'].' ('.$row_res['qty_sale'].')') : 'ยังไม่มีคะแนน'; ?></h6>
                                    <p><?php echo $row_res['address'] ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php }} else { ?>
                    <p class="text-center blockquote-footer mt-4">ไม่พบร้านอาหาร</p>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>