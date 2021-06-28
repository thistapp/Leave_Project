<html>

<head>
    <style>
        html {
            overflow-y: hidden;
        }
    </style>
    <?php

    //header('Content-type: text/html; charset=utf-8');
    include_once("../Secret/connect.php");

    /* 
$sql = "SELECT * FROM PER_TRAINHIS WHERE PER_ID = '".$PER_ID."'";
$query = $db->query($sql);
$nums = $db->db_num_rows($query);
if($nums > 0){
จะผ่านเข้าสู่ระบบ
}else{
จะตีกลับไปหน้า login
}
 */ ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../Secret/css/login.css">
    <link href="dist/libs/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <link href="dist/libs/selectize/dist/css/selectize.css" rel="stylesheet" />
    <link href="dist/libs/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link href="dist/libs/nouislider/distribute/nouislider.min.css" rel="stylesheet" />
    <link href="dist/css/tabler.min.css" rel="stylesheet" />
    <link href="dist/css/demo.min.css" rel="stylesheet" />
    <title>Login</title>
</head>

<?php

$username = @$_POST["username"];
$password = trim(@$_POST["password"]);
if ($username != "" & $password != "") {
    $query = mysqli_query($con, "SELECT * FROM employee_info a
    LEFT JOIN job_type d ON a.Job_Type_ID = d.Job_Type_ID
    WHERE a.Em_Login_ID = '" . $username . "' AND a.Em_Login_PASSWORD = '" . $password . "' ");
    $nums = mysqli_num_rows($query);
    //$row = mysqli_fetch_array($query);
    if ($nums > 0) {
        $_SESSION["sys_login"] = "login";
        $rec = mysqli_fetch_array($query);
        $_SESSION["sys_data"] = $rec;
        echo "<script>
            self.location.href='../Secret/increase_leave_disp.php';
        </script>";
    } else {
        session_destroy();
        echo "<script>
            alert(\"ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง\");
            self.location.href='index.php';
    </script>";
    }
}
?>

<body style="background-image: url('../Secret/img/pic_1.png'); height: 100%">


    <!-- Start Form Login -->
    <div id="login">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <h2 style="color: black; text-align: center;">ระบบลา</h2>
                        <form id="login_form" action="" method="post">
                            <div class="form-group">
                                <label for="username">Username</label><br>
                                <input type="text" name="username" id="username" class="form-control" placeholder="กรุณากรอกข้อมูล">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label><br>
                                <input type="password" name="password" id="password" class="form-control" placeholder="กรุณากรอกข้อมูล">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn_submit" class="btn btn-info" style="margin-left:215px;">ยินยัน</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Form Login -->
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