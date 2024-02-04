<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-5">
            <form action="profile_edit_db.php" class="bg-light p-3 border rounded shadow" method="post" enctype="multipart/form-data">
                <a href="profile.php" class="btn" onclick="return confirm('ยังไม่ได้บันทึกข้อมูลต้องการย้อนกลับหรือไม่?')"><h3 class="d-inline">&#11148;</h3></a>
                <h3 class="d-inline">แก้ไขข้อมูลส่วนตัว
                    <input type="submit" class="btn text-primary float-end" value="บันทึก" name="submit">
                </h3>

                <center>
                    <div class="rounded-circle hover-img mb-2" style="width: 7rem; height: 7rem;">
                        <img src="../upload/<?php echo $row['img'] ?>" class="img">
                    </div>
                    <input type="file" class="btn btn-secondary" name="img" id="upload" hidden>
                    <label for="upload" class="btn btn-outline-primary mb-3">เปลี่ยนโปรไฟล์</label>
                </center>
                
                <?php if($page == 'edit_res'){ ?>
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="edit" placeholder="" name="res_name" value="<?php echo $row['res_name'] ?>" required>
                        <label for="" class="form-label">ชื่อร้านอาหาร</label>
                    </div>
                <?php } ?>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="edit" placeholder="" name="username" value="<?php echo $row['username'] ?>" required>
                    <label for="" class="form-label">ชื่อผู้ใช้</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="firstname" value="<?php echo $row['firstname'] ?>" required>
                    <label for="" class="form-label">ชื่อจริง</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="lastname" value="<?php echo $row['lastname'] ?>" required>
                    <label for="" class="form-label">นามสกุล</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="address" value="<?php echo $row['address'] ?>" required>
                    <label for="" class="form-label">ที่อยู่</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="phone" value="<?php echo $row['phone'] ?>" required>
                    <label for="" class="form-label">เบอร์โทรศัพท์</label>
                </div>

                <?php if($page == 'edit_res'){ ?>
                    <label for="">ประเภทร้านอาหาร</label>
                    <select name="res_type" class="form-select mb-4" type="text">
                        <option value="<?php echo $row['res_type'] ?>"><?php echo $row['res_type'] ?></option>
                        <?php
                            $select_type = mysqli_query($conn, "SELECT * FROM `restaurant_type` WHERE `res_type` != '".$row['res_type']."' ");
                            while($row_type = mysqli_fetch_array($select_type)){
                        ?>
                            <option value="<?php echo $row_type['res_type'] ?>"><?php echo $row_type['res_type'] ?></option>
                        <?php } ?>
                    </select>
                <?php } ?>
            </form>
        </div>
    </div>
</div>