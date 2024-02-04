<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการเว็บไซต์</title>
</head>
<body>
    <?php
    
        $page = 'w_mng';
        include 'nav.php';
    
    ?>

    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">จัดการเว็บไซต์</h1>
            <div class="col-md-6 rounded shadow border p-4 bg-light mb-5">
                <div class="row">
                    <div class="col-md-12">
                        <h3>ชื่อเว็บไซต์</h3>
                        <form action="web_manage_db.php" class="d-flex gap-2" method="post">
                            <input type="text" class="form-control me-1" name="web_name" value="<?php echo $row['web_name'] ?>">
                            <input type="submit" class="btn btn-secondary" value="🖊" name="edit_web_name">
                        </form>
                        <hr>

                        <h3>เพิ่มโค้ดส่วนลด</h3>
                        <form action="web_manage_db.php" class="d-flex gap-2 mb-2" method="post">
                            <input type="text" class="form-control me-1" name="cpn_code" placeholder="เพิ่มโค้ดส่วนลด">
                            <input type="text" class="form-control me-1" name="cpn_discount" placeholder="ส่วนลด(%)">
                            <input type="submit" class="btn btn-primary" value="บันทึก" name="add_cpn">
                        </form>
                        <hr>

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>โค้ดส่วนลด</th>
                                        <th>ส่วนลด(%)</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $select_cpn = mysqli_query($conn, "SELECT * FROM `coupon` ");
                                        while($row_cpn = mysqli_fetch_array($select_cpn)){
                                    ?>
                                        <tr valign="middle">
                                            <td><?php echo $row_cpn['cpn_code'] ?></td>
                                            <td><?php echo $row_cpn['cpn_discount'] ?></td>
                                            <td>
                                                <a href="web_manage_db.php?del_cpn=<?php echo $row_cpn['cpn_id'] ?>" class="btn text-danger fw-bold" onclick="return confirm('ต้องการลบโค้ดนี้หรือไม่?')">ลบ</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>