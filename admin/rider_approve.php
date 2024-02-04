<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>อนุมัติผู้ส่งอาหาร</title>
</head>
<body>
    <?php
    
        $page = 'rider';
        include 'nav.php';
    
    ?>

    <div class="container-fluid">
        <div class="row my-5">
            <h2>อนุมัติผู้ส่งอาหาร</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover text-center shadow">
                    <tr>
                        <th>ชื่อจริง</th>
                        <th>นามสกุล</th>
                        <th>รูปภาพ</th>
                        <th>ชื่อผู้ใช้</th>
                        <th>ที่อยู่</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>จัดการ</th>
                    </tr>

                    <?php
                        $select_rider = mysqli_query($conn, "SELECT * FROM `rider` ");
                        while($row_rider = mysqli_fetch_array($select_rider)){
                    ?>
                        <tr valign="middle" id="<?php echo $row_rider['rider_id'] ?>">
                            <td><?php echo $row_rider['firstname'] ?></td>
                            <td><?php echo $row_rider['lastname'] ?></td>
                            <td>
                                <center>
                                    <div class="rounded hover-img" style="width: 5rem; height: 5rem;">
                                        <img src="../upload/<?php echo $row_rider['img'] ?>" class="img">
                                    </div>
                                </center>
                            </td>
                            <td><?php echo $row_rider['username'] ?></td>
                            <td><?php echo $row_rider['address'] ?></td>
                            <td><?php echo $row_rider['phone'] ?></td>
                            <td>
                                <?php if($row_rider['status'] == 0){ ?>
                                    <a href="approve.php?rider_id=<?php echo $row_rider['rider_id'] ?>&status=0" class="btn btn-success">ยืนยัน</a>
                                <?php } else { ?>
                                    <a href="approve.php?rider_id=<?php echo $row_rider['rider_id'] ?>&status=1" class="btn btn-danger">ยกเลิก</a>
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