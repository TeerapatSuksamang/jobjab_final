<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-5">
            <form action="" class="bg-light p-3 border rounded shadow">
                <h3>แก้ไข
                    <a href="profile_edit.php#edit" class="btn text-primary float-end">แก้ไข</a>
                </h3>

                <center>
                    <div class="rounded-circle hover-img mb-2" style="width: 7rem; height: 7rem;">
                        <img src="../upload/<?php echo $row['img'] ?>" class="img">
                    </div>
                    <a href="password_edit.php" class="btn btn-warning mb-3">เปลี่ยนรหัสผ่าน</a>
                </center>
                
                <?php if($page == 'pro_res'){ ?>
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="res_name" value="<?php echo $row['res_name'] ?>" readonly>
                        <label for="" class="form-label">ชื่อร้านอาหาร</label>
                    </div>
                <?php } ?>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="edit" placeholder="" name="username" value="<?php echo $row['username'] ?>" readonly>
                    <label for="" class="form-label">ชื่อผู้ใช้</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="firstname" value="<?php echo $row['firstname'] ?>" readonly>
                    <label for="" class="form-label">ชื่อจริง</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="lastname" value="<?php echo $row['lastname'] ?>" readonly>
                    <label for="" class="form-label">นามสกุล</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="address" value="<?php echo $row['address'] ?>" readonly>
                    <label for="" class="form-label">ที่อยู่</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="phone" value="<?php echo $row['phone'] ?>" readonly>
                    <label for="" class="form-label">เบอร์โทรศัพท์</label>
                </div>

                <?php if($page == 'pro_res'){ ?>
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="res_type" value="<?php echo $row['res_type'] ?>" readonly>
                        <label for="" class="form-label">ประเภทร้านอาหาร</label>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>
</div>