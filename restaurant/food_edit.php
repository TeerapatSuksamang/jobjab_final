<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขรายการอาหาร</title>

    <link rel="stylesheet" href="../style/form.css">

</head>
<body>
    <?php
    
        include 'nav.php';
    
    ?>

    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <form action="food_manage.php" class="card shadow p-4" method="post" enctype="multipart/form-data">
                    <h1 class="text-center mb-5">แก้ไขรายการอาหาร</h1>
                    <?php
                        $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '".$_GET['food_id']."' ");
                        $row_food = mysqli_fetch_array($select_food);
                    ?>

                    <input type="hidden" name="food_id" value="<?php echo $row_food['food_id'] ?>">
                    <input type="hidden" name="discount" value="<?php echo $row_food['discount'] ?>">

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="food_name" value="<?php echo $row_food['food_name'] ?>" required>
                        <label for="" class="form-label">รายการอาหาร</label>
                    </div>

                    <label for="" class="form-label">รูปภาพ</label>
                    <center><img src="../upload/<?php echo $row_food['img'] ?>" class="hover-img rounded mb-2" style="width: ; height: 5rem;"></center>
                    <input type="file" class="form-control mb-4" name="img">

                    <div class="form-floating mb-4">
                        <input type="number" class="form-control" id="" placeholder="" name="price" value="<?php echo $row_food['price'] ?>" required>
                        <label for="" class="form-label">ราคา</label>
                    </div>

                    <label for="">หมวดหมู่อาหาร</label>
                    <select name="food_type" class="form-select mb-4" type="text">
                        <option value="<?php echo $row_food['food_type'] ?>"><?php echo $row_food['food_type'] ?></option>
                        <?php
                            $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `food_type` != '".$row_food['food_type']."' AND `res_id` = '".$_SESSION['res_id']."' ");
                            while($row_type = mysqli_fetch_array($select_type)){
                        ?>
                            <option value="<?php echo $row_type['food_type'] ?>"><?php echo $row_type['food_type'] ?></option>
                        <?php } ?>
                    </select>

                    <div class="d-flex gap-3">
                        <input type="submit" class="btn btn-success w-100" value="ยืนยัน" name="food_edit">
                        <a href="index.php" class="btn btn-danger w-100">ย้อนกลับ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>