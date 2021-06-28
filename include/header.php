<html lang="en">

<head>
    <?php
    include_once("../Secret/connect.php");
    include_once("../Secret/src/function.php");
    //include_once("../Secret/src/func.php")
    if (!isset($_SESSION["sys_data"])) {
        echo "<script>
                self.location.href='../Secret/index.php';
            </script>";
    };
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Secret/css/home.css">
    <link rel="stylesheet" href="../Secret/css/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="dist/libs/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <link href="dist/libs/selectize/dist/css/selectize.css" rel="stylesheet" />
    <link href="dist/libs/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link href="dist/libs/nouislider/distribute/nouislider.min.css" rel="stylesheet" />
    <link href="dist/css/tabler.min.css" rel="stylesheet" />
    <link href="dist/css/demo.min.css" rel="stylesheet" />
</head>

<body>

    <?php $uid = $_SESSION["sys_data"][0]; ?>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light justify-content-between" style="padding: 10px 360px 10px 360px;">
        <a class="navbar-brand" href="../Secret/Home.php"><img src="../Secret/img/home.png" id="img_icon" width="50px" height="50px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"> -->
        <!-- <li class="nav-item active">
                    <a class="nav-link" href="../Secret/Home.php">หน้าหลัก<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Secret/increase_leave_disp.php">ยื่นวันลา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Secret/setup_type_disp.php">ตั้งค่าประเภทการลา</a>
                </li> -->
        <!-- </ul> -->
        <ul class="navbar-nav p-2">
            <li class="nav-item dropdown active">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true">
                    <?php echo $_SESSION["sys_data"][1] . " " . $_SESSION["sys_data"][2]; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../Secret/info_employee_disp.php">ข้อมูลส่วนตัว</a>
                    <a class="dropdown-item" href="../Secret/increase_leave_disp.php">ยื่นวันลา</a>
                    <?php
                    if ($_SESSION["sys_data"][13] == "1" || $_SESSION["sys_data"][13] == "2" || $_SESSION["sys_data"][13] == "3") {
                    ?>
                        <a class="dropdown-item" href="../Secret/approve_leave_disp.php">อนุมัติ</a>
                    <?php }

                    if ($_SESSION["sys_data"][13] == "4") {

                    ?>
                        <a class="dropdown-item" href="#">เพิ่มข้อมูลพนักงาน</a>
                        <a class="dropdown-item" href="../Secret/setup_type_disp.php">ประเภทการลา</a>
                    <?php
                    }
                    ?>
                    <a class="dropdown-item" href="../Secret/include/log_out.php">ออกจากระบบ</a>
                </div>
            </li>
        </ul>
        <!-- </div> -->

    </nav>

    <br>
    <br>
    <br>
    <br>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

<script src="dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="dist/libs/jquery/dist/jquery.slim.min.js"></script>
<script src="dist/libs/autosize/dist/autosize.min.js"></script>
<script src="dist/libs/imask/dist/imask.min.js"></script>
<script src="dist/libs/selectize/dist/js/standalone/selectize.min.js"></script>
<script src="dist/libs/flatpickr/dist/flatpickr.min.js"></script>
<script src="dist/libs/flatpickr/dist/plugins/rangePlugin.js"></script>
<script src="dist/libs/nouislider/distribute/nouislider.min.js"></script>
<!-- Tabler Core -->
<script src="dist/js/tabler.min.js"></script>


</html>