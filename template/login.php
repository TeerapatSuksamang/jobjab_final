<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ<?php echo $permis; ?></title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/form.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <form action="login_db.php" class="card shadow p-4" method="post">
                    <h1 class="text-center mb-5">เข้าสู่ระบบ<?php echo $permis; ?></h1>

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="username" required>
                        <label for="" class="form-label">ชื่อผู้ใช้</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="" placeholder="" name="password" required>
                        <label for="" class="form-label">รหัสผ่าน</label>
                    </div>

                    <div class="d-flex gap-3">
                        <input type="submit" class="btn btn-success w-100" value="ยืนยัน" name="submit">
                        <a href="../index.html" class="btn btn-danger w-100">ย้อนกลับ</a>
                    </div>

                    <?php if($permis != 'ผู้ดูแลระบบ'){ ?>
                        <p class="text-center mt-4">ยังไม่มีบัญชีใช่หรือไม่<a href="register.php">สมัครเลย!!</a></p>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>