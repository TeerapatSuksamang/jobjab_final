<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัคร<?php echo $permis; ?></title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/form.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <form action="register_db.php" class="card shadow p-4" method="post" enctype="multipart/form-data">
                    <h1 class="text-center mb-5">สมัคร<?php echo $permis; ?></h1>
                    
                    <?php if($permis == 'ร้านอาหาร'){ ?>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="" placeholder="" name="res_name" required>
                            <label for="" class="form-label">ชื่อร้านอาหาร</label>
                        </div>
                    <?php } ?>

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="firstname" required>
                        <label for="" class="form-label">ชื่อจริง</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="lastname" required>
                        <label for="" class="form-label">นามสกุล</label>
                    </div>

                    <label for="" class="form-label">รูปภาพ</label>
                    <input type="file" class="form-control mb-4" name="img">

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="username" required>
                        <label for="" class="form-label">ชื่อผู้ใช้</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="" placeholder="" name="password" required>
                        <label for="" class="form-label">รหัสผ่าน</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="address" required>
                        <label for="" class="form-label">ที่อยู่</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="tel" class="form-control" id="" placeholder="" name="phone" required>
                        <label for="" class="form-label">เบอร์โทรศัพท์</label>
                    </div>

                    <?php if($permis == 'ร้านอาหาร'){ ?>
                        <label for="">ประเภทร้านอาหาร</label>
                        <select name="res_type" class="form-select mb-4" type="text">
                            <?php
                                include_once '../config/db.php';
                                $select = mysqli_query($conn, "SELECT * FROM `restaurant_type` ");
                                while($row_type = mysqli_fetch_array($select)){
                            ?>
                                <option value="<?php echo $row_type['res_type'] ?>"><?php echo $row_type['res_type'] ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>

                    <div class="d-flex gap-3">
                        <input type="submit" class="btn btn-success w-100" value="ยืนยัน" name="submit">
                        <a href="login.php" class="btn btn-danger w-100">ย้อนกลับ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>