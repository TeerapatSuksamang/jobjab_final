<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กำหนดส่วนลด(%)</title>

    <link rel="stylesheet" href="../style/form.css">

</head>
<body>
    <?php
    
        include 'nav.php';
    
    ?>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <form action="food_manage.php" class="card shadow p-4" method="post">
                    <h1 class="text-center mb-5">กำหนดส่วนลด(%)</h1>
                    <?php
                        $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '".$_GET['food_id']."' ");
                        $row_food = mysqli_fetch_array($select_food);
                    ?>

                    <input type="hidden" name="food_id" value="<?php echo $row_food['food_id'] ?>">

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="food_name" value="<?php echo $row_food['food_name'] ?>" readonly>
                        <label for="" class="form-label">รายการอาหาร</label>
                    </div>
                    
                    <label for="" class="form-label">รูปภาพ</label>
                    <center><img src="../upload/<?php echo $row_food['img'] ?>" class="hover-img rounded mb-2" style="height: 5rem;"></center>

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="price" value="<?php echo $row_food['price'] ?>" readonly>
                        <label for="" class="form-label">ราคา</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="number" min="0" max="99" class="form-control" id="" placeholder="" name="discount" value="<?php echo ($row_food['discount'] != 0 ? $row_food['discount'] : '' ); ?>" required>
                        <label for="" class="form-label">ส่วนลด(%)</label>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <input type="submit" class="btn btn-success w-100" value="ยืนยัน" name="food_discount">
                        <a href="index.php" class="btn btn-danger w-100">ย้อนกลับ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>