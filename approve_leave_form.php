<html lang="en">

<head>

    <?php
    include_once("../Secret/connect.php");
    include_once("../Secret/src/function.php");
    include_once("../Secret/include/header.php");
    include_once("../Secret/include/footer.php");
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Secret/css/new_type.css">
    <link rel="stylesheet" href="../Secret/css/home.css">
    <link href="../Secret/src/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


    <link href="dist/libs/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <link href="dist/libs/selectize/dist/css/selectize.css" rel="stylesheet" />
    <link href="dist/libs/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link href="dist/libs/nouislider/distribute/nouislider.min.css" rel="stylesheet" />
    <link href="dist/css/tabler.min.css" rel="stylesheet" />
    <link href="dist/css/demo.min.css" rel="stylesheet" />


    <title>อนุมัติในการลา</title>
</head>

<body>
    <?php
    $proc = $_GET["proc"];
    $uid = $_SESSION["sys_data"][0];
    $role_head = "";
    $head_next = "";
    if ($proc == 'app') {
        $log_id = $_GET["log_id"];
        $query = mysqli_query($con, "SELECT * FROM leave_log a inner join leave_type b on a.Leave_Type_ID = b.Leave_Type_ID WHERE a.Leave_Log_ID = '" . $log_id . "' ");
        $row = mysqli_fetch_array($query);
        $datetime = conv_date($row['Leave_DATETIMES'], "th", "long");
        $sdate = conv_date($row['Leave_Start_Date'], "th", "short");
        $edate = conv_date($row['Leave_End_Date'], "th", "short");
        $stime = date_create($row['Leave_Start_Time']);
        $etime = date_create($row['Leave_End_Time']);
        $time_leave = date_format($stime, 'H:i') . " - " . date_format($etime, 'H:i');
        $note_leave = $row['Leave_Log_Reason'];
        $type_leave = $row['Leave_Type_Name'];
        $status = $row['Leave_Log_STATUS'];
        $head_id_1 = $row['Leave_Head_1_ID'];
        $head_status_1 = $row['Leave_Head_1_STATUS'];
        $head_id_2 = $row['Leave_Head_2_ID'];
        $head_status_2 = $row['Leave_Head_2_STATUS'];
        $head_id_3 = $row['Leave_Head_3_ID'];
        $head_status_3 = $row['Leave_Head_3_STATUS'];
        if ($_SESSION["sys_data"][0] == $head_id_1) {
            $role_head = 1;
            $head_next = $head_id_2;
        } else if ($_SESSION["sys_data"][0] == $head_id_2) {
            $role_head = 2;
            $head_next = $head_id_3;
        } else if ($_SESSION["sys_data"][0] == $head_id_3) {
            $role_head = 3;
            $head_next = "";
        }
    }
    ?>

    <!-- end navbar -->

    <div id="titlehead">
        <h3> อนุมัติการลา </h3>
    </div>

    <!-- detail -->

    <div class="container">

        <?php
        // query ข้อมูลพนักงาน
        $q = mysqli_query($con, "SELECT * FROM employee_info a inner join job_type b ON a.Job_Type_ID = b.Job_Type_ID WHERE a.Em_ID = '" . $uid . "' ");
        $r = mysqli_fetch_array($q);
        $fname = $r["Em_Fname"];
        $lname = $r["Em_Lname"];
        $job = $r["Job_Type_Name"];
        ?>


        <div class="card">
            <div class="card-block">
                <form id="approve_leave" action="../Secret/src/approve_leave_save.php">
                    <input type="hidden" id="proc" name="proc" value="<?php echo $proc; ?>" />
                    <input type="hidden" id="uid" name="uid" value="<?php echo $uid; ?>" />
                    <input type="hidden" id="log_id" name="log_id" value="<?php echo $log_id; ?>" />
                    <input type="hidden" name="role_head" id="role_head" value="<?php echo $role_head; ?>">
                    <input type="hidden" name="head_next" id="head_next" value="<?php echo $head_next; ?>">
                    <div id=" detial-container">
                        <div class="row">
                            <div class="col-md-2">
                                <h2 style="padding-left:35px;">อนุมัติการลา</h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                                ชื่อ - นามสกุล :
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <?php echo $fname . " " . $lname; ?>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                                ตำแหน่งงาน :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <?php echo $job; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                                วันที่ยื่นวันลา :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <?php echo $datetime; ?>
                            </div>
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                                ประเภทในการลา :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <?php echo $type_leave; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right;">
                                วันที่ลา - จนถึงวันที่ :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <?php echo $sdate . " - " . $edate;  ?>
                            </div>
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                                เวลาในการลา :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <?php
                                if ($time_leave == "00:00 - 00:00") {
                                    echo $arr_type[date_format($stime, 'H:i') . " - " . date_format($etime, 'H:i')];
                                } else {
                                    echo $time_leave;
                                } ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                                เหตุผลในการลา :
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <?php echo $note_leave ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>

                    <section id="head-approve-1" name="head-approve-1" style="display: none;">
                        <!-- head app num 1 -->
                        <div class="row">
                            <div class="col-md-2">
                                <h2 style="padding-left:35px;"> ลำดับที่ 1 </h2>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right;">
                                สถานะ :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <input type="radio" id="head_app_true_1" name="head_app_num_1" value="1" onclick="javascript:chk_app_1();">
                                <label for="1"> อนุมัติ </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="head_app_false_1" name="head_app_num_1" value="0" onclick="javascript:chk_app_1();">
                                <label for="3"> ไม่อนุมัติ </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right;">
                                เหตุผล :
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <input type="text" id="head_app_reason_1" name="head_app_reason_1" class="form-control" disabled>
                            </div>
                        </div>
                    </section>

                    <section id="head-approve-2" name="head-approve-2" style="display: none;">
                        <!-- head app num 2 -->
                        <div class="row">
                            <div class="col-md-2">
                                <h2 style="padding-left:35px;"> ลำดับที่ 2 </h2>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right;">
                                สถานะ :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <input type="radio" id="head_app_true_2" name="head_app_num_2" value="1" onclick="javascript:chk_app_2();">
                                <label for="1"> อนุมัติ </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="head_app_false_2" name="head_app_num_2" value="0" onclick="javascript:chk_app_2();">
                                <label for="3"> ไม่อนุมัติ </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right;">
                                เหตุผล :
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <input type="text" id="head_app_reason_2" name="head_app_reason_2" class="form-control" disabled>
                            </div>
                        </div>
                        <br>
                    </section>


                    <section id="head-approve-3" name="head-approve-3" style="display: none;">
                        <!-- head app num 3 -->
                        <div class="row">
                            <div class="col-md-2">
                                <h2 style="padding-left:35px;"> ลำดับที่ 3 </h2>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right;">
                                สถานะ :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <input type="radio" id="head_app_true_3" name="head_app_num_3" value="1" onclick="javascript:chk_app_3();">
                                <label for="1"> อนุมัติ </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="head_app_false_3" name="head_app_num_3" value="0" onclick="javascript:chk_app_3();">
                                <label for="3"> ไม่อนุมัติ </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right;">
                                เหตุผล :
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <input type="text" id="head_app_reason_3" name="head_app_reason_3" class="form-control" disabled>
                            </div>
                        </div>
                        <br>
                    </section>

                    <br>
                    <div id="submit-form">
                        <div class="row">
                            <div class="col-xs-12 col-md-4"></div>
                            <div class="col-xs-12 col-md-2">
                                <button type="button" id="btn_submit" name="btn_submit" class="btn btn-info" onclick="chkbtn();" disabled>ยืนยัน</button>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <a href="../Secret/approve_leave_disp.php" type="button" name="btn_return" class="btn btn-danger">ยกเลิก</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="../secret/src/flatpickr/dist/flatpickr.min.js"></script>
<script src="../secret/src/flatpickr/dist/plugins/rangePlugin.js"></script>


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

<script>
    const uid = '<?php echo $uid ?>';
    const id_head_1 = '<?php echo $head_id_1; ?>';
    const id_head_2 = '<?php echo $head_id_2; ?>';
    const id_head_3 = '<?php echo $head_id_3; ?>';
    const head_status_1 = '<?php echo $head_status_1; ?>';
    const head_status_2 = '<?php echo $head_status_2; ?>';
    const head_status_3 = '<?php echo $head_status_3; ?>';

    if (uid == id_head_1) {
        $("#head-approve-1").css("display", "block");
        $("#head-approve-2").css("display", "none");
        $("#head-approve-3").css("display", "none");
        $("#btn_submit").removeAttr('disabled');
    }
    if (uid == id_head_2 && head_status_1 == 1) {
        $("#head-approve-1").css("display", "none");
        $("#head-approve-2").css("display", "block");
        $("#head-approve-3").css("display", "none");
        $("#btn_submit").removeAttr('disabled');
    }
    if (uid == id_head_3 && head_status_2 == 1) {
        $("#head-approve-1").css("display", "none");
        $("#head-approve-2").css("display", "none");
        $("#head-approve-3").css("display", "block");
        $("#btn_submit").removeAttr('disabled');
    }



    function chk_app_1() {
        if (document.getElementById('head_app_false_1').checked) {
            $('#head_app_reason_1').removeAttr("disabled");

        } else {
            $('#head_app_reason_1').attr('disabled', 'disabled');
        }
    }

    function chk_app_2() {
        if (document.getElementById('head_app_false_2').checked) {
            $('#head_app_reason_2').removeAttr("disabled");
        } else {
            $('#head_app_reason_2').attr('disabled', 'disabled');
        }
    }

    function chk_app_3() {
        if (document.getElementById('head_app_false_3').checked) {
            $('#head_app_reason_3').removeAttr("disabled");
        } else {
            $('#head_app_reason_3').attr('disabled', 'disabled');
        }
    }

    function chkbtn() {

        const head_reason_1 = document.forms["approve_leave"]["head_app_reason_1"].value;
        const head_reason_2 = document.forms["approve_leave"]["head_app_reason_2"].value;
        const head_reason_3 = document.forms["approve_leave"]["head_app_reason_3"].value;
        if (head_reason_1 == "" && document.getElementById('head_app_false_1').checked) {
            alert("** กรุณากรอกเหตุผล 1 **");
            return false;
        };
        if (head_reason_2 == "" && document.getElementById('head_app_false_2').checked) {
            alert("** กรุณากรอกเหตุผล 2 **");
            return false;
        };
        if (head_reason_3 == "" && document.getElementById('head_app_false_3').checked) {
            alert("** กรุณากรอกเหตุผล 3 **");
            return false;
        };
        $('#approve_leave').submit();
    }
</script>

</html>