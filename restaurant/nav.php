<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../style/style.css">
<script src="../bootstrap/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background: #40513B;">
    <div class="container-fluid">
        <?php
            include_once 'session.php';
            $select_web = mysqli_query($conn, "SELECT `web_name` FROM `admin` WHERE `admin_id` = 1 ");
            $row_web = mysqli_fetch_array($select_web);

            $select = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '".$_SESSION['res_id']."' ");
            $row = mysqli_fetch_array($select);
        ?>
        <a href="profile.php" class="pro-brand">
            <img src="../upload/<?php echo $row['img'] ?>" class="img">
        </a>
        <a href="" class="navbar-brand"><?php echo $row_web['web_name'] ?></a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#hamburger">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="hamburger">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <hr class="text-light">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php echo ($page == 'index' ? 'active' : '') ?>">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a href="order.php" class="nav-link <?php echo ($page == 'order' ? 'active' : '') ?>">รับรายการอาหาร</a>
                </li>
                <li class="nav-item">
                    <a href="report.php" class="nav-link <?php echo ($page == 'report' ? 'active' : '') ?>">รายงานสรุปยอดขาย</a>
                </li>
            </ul>
            <hr class="text-light">
            <a href="logout.php" class="btn btn-danger" onclick="return confirm('ต้องการออกจากระบบหรือไม่?')">ออกจากระบบ</a>
        </div>
    </div>
</nav>