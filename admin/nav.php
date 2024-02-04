<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../style/style.css">
<script src="../bootstrap/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background: #27374D;">
    <div class="container-fluid">
        <?php
             include_once 'session.php';
             $select = mysqli_query($conn, "SELECT * FROM `admin` WHERE `admin_id` = '".$_SESSION['admin_id']."' ");
             $row = mysqli_fetch_array($select);
        ?>
        <a href="profile.php" class="pro-brand">
            <img src="../upload/<?php echo $row['img'] ?>" class="img">
        </a>
        <a href="" class="navbar-brand"><?php echo $row['web_name'] ?></a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#hamburger">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="hamburger">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <hr class="text-light">
                <li class="nav-item">
                    <a href="web_manage.php" class="nav-link <?php echo ($page == 'w_mng' ? 'active' : '') ?>">จัดการเว็บไซต์</a>
                </li>
                <li class="nav-item">
                    <a href="res_approve.php" class="nav-link <?php echo ($page == 'res' ? 'active' : '') ?>">อนุมัติร้านอาหาร</a>
                </li>
                <li class="nav-item">
                    <a href="rider_approve.php" class="nav-link <?php echo ($page == 'rider' ? 'active' : '') ?>">อนุมัติผู้ส่งอาหาร</a>
                </li>
                <li class="nav-item">
                    <a href="user_approve.php" class="nav-link <?php echo ($page == 'user' ? 'active' : '') ?>">อนุมัติผู้ใช้งาน</a>
                </li>
            </ul>
            <hr class="text-light">
            <a href="logout.php" class="btn btn-danger" onclick="return confirm('ต้องการออกจากระบบหรือไม่?')">ออกจากระบบ</a>
        </div>
    </div>
</nav>