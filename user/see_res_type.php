<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประเภทร้านอาหารทั้งหมด</title>
</head>
<body>
    <?php
    
        include 'nav.php';
    
    ?>

    <div class="container">
        <div class="row my-5">
            <h3><a href="index.php" class="btn"><h3>&#11148;</h3></a>
                <?php echo $_GET['see_res_type'] ?>
            </h3>
            <?php
                $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_type` = '".$_GET['see_res_type']."' ");;
                while($row_res = mysqli_fetch_array($select_res)){
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-1">
                        <a href="see_restaurant.php?see_res=<?php echo $row_res['res_id'] ?>" class="text-dark">
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
            <?php } ?>
        </div>
    </div>
</body>
</html>