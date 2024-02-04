<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>อนุมัติร้านอาหาร</title>
</head>
<body>
    <?php
    
        $page = 'res';
        include 'nav.php';
    
    ?>

    <div class="container-fluid">
        <div class="row mt-5">
            <h1 class="text-center mb-3">ประเภทร้านอาหาร</h1>
            <?php
                $select_type = mysqli_query($conn, "SELECT * FROM `restaurant_type` ");
                while($row_type = mysqli_fetch_array($select_type)){
            ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 p-1">
                    <div class="card mb-3">
                        <div class="card-img-top hover-img" style="height: 200px;">
                            <img src="../upload/<?php echo $row_type['img'] ?>" class="img">
                        </div>
                        <div class="card-body text-center">
                            <h3 class="card-title"><?php echo $row_type['res_type'] ?></h3>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="col-md-12 my-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_res_type">เพิ่มประเภทร้านอาหาร</button>
            </div>

            <div class="modal fade" id="add_res_type" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">เพิ่มประเภทร้านอาหาร</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="approve.php" method="post" enctype="multipart/form-data">
                                <label for="">ประเภทร้านอาหาร</label>
                                <input type="text" class="form-control mb-3" name="res_type" required>

                                <label for="">รูปภาพ</label>
                                <input type="file" class="form-control mb-3" name="img" required>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                <input type="submit" class="btn btn-success" value="บันทึก" name="add_res_type">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <h2>อนุมัติร้านอาหาร</h2>
            <div class="table-responsive mb-5">
                <table class="table table-striped table-hover table-bordered text-center shadow">
                    <tr>
                        <th>ชื่อร้านอาหาร</th>
                        <th>ชื่อจริง</th>
                        <th>นามสกุล</th>
                        <th>รูปภาพ</th>
                        <th>ชื่อผู้ใช้</th>
                        <th>ที่อยู่</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>ประเภทร้านอาหาร</th>
                        <th>จัดการ</th>
                    </tr>

                    <?php
                        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` ");
                        while($row_res = mysqli_fetch_array($select_res)){
                    ?>
                        <tr valign="middle" id="<?php echo $row_res['res_id'] ?>">
                            <td><?php echo $row_res['res_name'] ?></td>
                            <td><?php echo $row_res['firstname'] ?></td>
                            <td><?php echo $row_res['lastname'] ?></td>
                            <td>
                                <center>
                                    <div class="rounded hover-img" style="width: 5rem; height: 5rem;">
                                        <img src="../upload/<?php echo $row_res['img'] ?>" class="img">
                                    </div>
                                </center>
                            </td>
                            <td><?php echo $row_res['username'] ?></td>
                            <td><?php echo $row_res['address'] ?></td>
                            <td><?php echo $row_res['phone'] ?></td>
                            <td><?php echo $row_res['res_type'] ?></td>
                            <td>
                                <?php if($row_res['status'] == 0){ ?>
                                    <a href="approve.php?res_id=<?php echo $row_res['res_id'] ?>&status=0" class="btn btn-success">ยืนยัน</a>
                                <?php } else { ?>
                                    <a href="approve.php?res_id=<?php echo $row_res['res_id'] ?>&status=1" class="btn btn-danger">ยกเลิก</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>