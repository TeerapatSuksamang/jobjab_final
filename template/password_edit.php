<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-6">
            <form action="password_edit_db.php" class="card shadow p-4" method="post">
                <h1 class="text-center mb-5">เปลี่ยนรหัสผ่าน</h1>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="" placeholder="" name="old_password" required>
                    <label for="" class="form-label">รหัสผ่านเก่า</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="" placeholder="" name="new_password" required>
                    <label for="" class="form-label">รหัสผ่านใหม่</label>
                </div>

                <div class="d-flex gap-3">
                    <input type="submit" class="btn btn-success w-100" value="ยืนยัน" name="submit">
                    <a href="profile.php" class="btn btn-danger w-100">ย้อนกลับ</a>
                </div>
            </form>
        </div>
    </div>
</div>