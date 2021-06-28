<html lang="en">

<head>

    <?php include_once("../Secret/connect.php");
    include_once("../Secret/include/header.php");
    include_once("../Secret/include/footer.php");
    ?>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Secret/css/l_form.css">
    <link rel="stylesheet" href="../css/header.css">
    <link href="../Secret/src/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


    <link href="dist/libs/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <link href="dist/libs/selectize/dist/css/selectize.css" rel="stylesheet" />
    <link href="dist/libs/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link href="dist/libs/nouislider/distribute/nouislider.min.css" rel="stylesheet" />
    <link href="dist/css/tabler.min.css" rel="stylesheet" />
    <link href="dist/css/demo.min.css" rel="stylesheet" />


    <title>ยื่นวันลา</title>
    <script type="text/javascript">
        window.onload = function() {
            document.getElementById('time-leave').style.display = 'none';
        }

        function timehidden() {
            if (document.getElementById('HALF_DAY').checked) {
                document.getElementById('time-leave').style.display = '';
            } else {
                document.getElementById('time-leave').style.display = 'none';
            }
        }
    </script>
</head>

<body>
    <?php

    $log_id = "";
    $proc = $_GET["proc"];
    $uid = $_SESSION["sys_data"][0];
    // query การลา
    $val = 1; //ข้อมูลของการประเภทการลา default เป็น 1
    $chk_2 = "";
    $chk_1 = "checked";
    $type_day = "TYPE_DAY";
    $head_app_1 = "";
    $head_app_2 = "";
    $head_app_3 = "";
    if ($proc != 'add') {
        $log_id = $_GET["log_id"];
        @$query = mysqli_query($con, "SELECT * FROM  leave_log WHERE Leave_Log_ID = '" . $log_id . "' ");
        @$row = mysqli_fetch_array($query);
        @$s_date = $row["Leave_Start_Date"];
        @$e_date = $row["Leave_End_Date"];
        @$s_time = $row["Leave_Start_Time"];
        @$e_time = $row["Leave_End_Time"];
        @$note = $row["Leave_Log_Reason"];
        @$type_days = $row["Leave_Type_DATE"];
        @$head_app_1 = $row["Leave_Head_1_ID"];
        @$head_app_2 = $row["Leave_Head_2_ID"];
        @$head_app_3 = $row["Leave_Head_3_ID"];
        @$val = $row["Leave_Type_ID"];
        if (@$type_days == 1) {
            $chk_2 = "";
            $chk_1 = "checked";
        } else if (@$type_days == 0) {
            $chk_1 = "";
            $chk_2 = "checked";
        }
    }

    //if( u want to know){};

    // เท่ากับ 1 ตัว คือการค่าทับเข้าไปที่ตัวแปล
    // เท่ากับ 2 ตัว คือการเช็คค่า
    // เท่ากับ 3 ตัว คือการเช็คค่าที่เหมือนกันทั้งหมด (ค่า, ประเภทตัวแปล) # proc === "1" ค่าที่ส่งมาต้องเป็นประเภทเดียกวัน (string = string, int = int)
    $btn = "";
    if ($_GET["proc"] == "view") {
        $btn = "disabled";
    }
    ?>

    <!-- start navbar -->
    <!-- end navbar -->

    <div id="titlehead">
        <h3> ยื่นวันลา </h3>
    </div>

    <!-- detail -->

    <div class="container">

        <?php
        // query ข้อมูลพนักงาน
        $q = mysqli_query($con, "SELECT * FROM employee_info a 
        inner join job_type b ON a.Job_Type_ID = b.Job_Type_ID 
        WHERE a.Em_ID = '" . $uid . "' ");
        $r = mysqli_fetch_array($q);
        $fname = $r["Em_Fname"];
        $lname = $r["Em_Lname"];
        $job = $r["Job_Type_Name"];

        ?>


        <div class="card">
            <div class="card-block">
                <form id="form_super_leave" action="../Secret/src/increase_leave_save.php" method="get">
                    <input type="hidden" id="proc" name="proc" value="<?php echo $proc; ?>">
                    <input type="hidden" id="log_id" name="log_id" value="<?php echo $log_id; ?>">
                    <input type="hidden" id="uid" name="uid" value="<?php echo $uid; ?>">
                    <div id="detail-container">
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                                ชื่อ-นามสกุล :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <input type="text" id="fullname" name="fullname" class="form-control" maxlength="100" readonly="readonly" value="<?php echo $fname . " " . $lname; ?>">
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                                ตำแหน่งงาน :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <input type="text" id="job" name="job" class="form-control" maxlength="100" readonly="readonly" value="<?php echo $job; ?>">
                            </div>
                        </div>
                    </div>



                    <div id="Leave_form">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-xs-12 col-md-3">
                                <input type="radio" id="FULL_DAY" name="<?php echo $type_day; ?>" value="1" onclick="javascript:timehidden();" <?php echo $chk_1 ?>>
                                <label for="1">ลาเต็มวัน</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="HALF_DAY" name="<?php echo $type_day; ?>" value="0" onclick="javascript:timehidden();" <?php echo $chk_2 ?>>
                                <label for="0">ลาครึ่งวัน</label>
                            </div>
                        </div>
                        <br>

                        <!-- if TYPE_DAY == 0 -->

                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right;">
                                วันที่ลา :
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <input id="start_date" name="start_date" type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="วัน เดือน ปี" readonly />
                            </div>
                            <div class="col-xs-12 col-md-2"></div>
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right;">
                                จนถึงวันที่ :
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <input id="end_date" name="end_date" type="date" value="<?php echo @$e_date; ?>" class="form-control" placeholder="วัน เดือน ปี" readonly />
                            </div>
                        </div>



                        <br>
                        <!-- ถ้าเกิดเลือก เต็มวัน ปิดการมองเห็นส่วนนี้ -->
                        <div class="row" id="time-leave">
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right;">
                                ตั้งแต่เวลา :
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <input id="start_time" name="start_time" type="date" value="<?php echo $s_time; ?>" class="form-control" readonly />
                            </div>
                            <div class="col-xs-12 col-md-2"></div>
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right;">
                                ถึงเวลา :
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <input id="end_time" name="end_time" type="date" value="<?php echo $e_time; ?>" class="form-control" readonly />
                            </div>
                        </div>


                        <br>
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <?php //query การลา
                            $q_leave = mysqli_query($con, "SELECT * FROM leave_type where Active_STATUS = 1");
                            while ($r_leave = mysqli_fetch_array($q_leave)) {
                                $type_id = $r_leave["Leave_Type_ID"];
                                $type_name = $r_leave["Leave_Type_Name"];
                                $chk_leave = "";
                                if ($type_id == $val) {
                                    $chk_leave = "checked";
                                }
                            ?>
                                <div class="col-xs-8 col-md-2">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="personal-leave_<?php echo $type_id; ?>" name="leaveRadio" class="custom-control-input" value="<?php echo $type_id; ?>" <?php echo $chk_leave; ?>>
                                        <label class="custom-control-label" for="personal-leave_<?php echo $type_id; ?>"><?php echo $type_name; ?></label>
                                    </div>
                                </div>
                            <?php } ?>


                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right;">
                                เหตุผลในการลา :
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <input type="text" id="reason" name="reason" class="form-control" maxlength="100" value="<?php echo @$note; ?>" placeholder="">
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="row" id="head-role-1">
                            <div class="col-xs-12 col-md-2" id="title-head-role-1" style="white-space: nowrap; text-align:right;">
                                * ลำดับที่ 1 :
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <select class="form-control" id="select-head-role-1" name="select-head-role-1">
                                        <option value="null"> --- กรุณาเลือกหัวหน้าอนุมัติ ---</option>
                                        <?php
                                        $q_head_1 = mysqli_query($con, "SELECT * FROM employee_info a INNER JOIN job_type b ON a.Job_Type_ID = b.Job_Type_ID where a.Job_Type_ID = 1 or a.Job_Type_ID = 2 or a.Job_Type_ID = 3");
                                        while ($r_head_1 = mysqli_fetch_array($q_head_1)) {
                                            $head_fname_1 = $r_head_1['Em_Fname'];
                                            $head_flame_1 = $r_head_1['Em_Lname'];
                                            $head_job_1 = $r_head_1['Job_Type_Name'];
                                            $head_id_1 = $r_head_1['Em_ID'];
                                            $all_head_1 = $head_fname_1 . " " . $head_lname_1 . " ตำแหน่ง : " . $head_job_1;
                                            $chk_select_1 = "";
                                            if ($head_id_1 == $head_app_1) {
                                                $chk_select_1 = "selected";
                                            }
                                        ?>
                                            <option value="<?php echo $head_id_1; ?>" <?php echo $chk_select_1 ?>><?php echo $all_head_1; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row" id="head-role-2">
                            <div class="col-xs-12 col-md-2" id="title-head-role-2" style="white-space: nowrap; text-align:right;">
                                ลำดับที่ 2 :
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <select class="form-control" id="select-head-role-2" name="select-head-role-2" disabled>
                                        <option value="null"> --- กรุณาเลือกหัวหน้าอนุมัติ ---</option>
                                        <?php
                                        $q_head_2 = mysqli_query($con, "SELECT * FROM employee_info a INNER JOIN job_type b ON a.Job_Type_ID = b.Job_Type_ID where a.Job_Type_ID = 1 or a.Job_Type_ID = 2 or a.Job_Type_ID = 3");
                                        while ($r_head_2 = mysqli_fetch_array($q_head_2)) {
                                            $head_fname_2 = $r_head_2['Em_Fname'];
                                            $head_flame_2 = $r_head_2['Em_Lname'];
                                            $head_job_2 = $r_head_2['Job_Type_Name'];
                                            $head_id_2 = $r_head_2['Em_ID'];
                                            $all_head_2 = $head_fname_2 . " " . $head_lname_2 . " ตำแหน่ง : " . $head_job_2;
                                            $chk_select_2 = "";
                                            if ($head_id_2 == $head_app_2) {
                                                $chk_select_2 = "selected";
                                            }
                                        ?>
                                            <option value="<?php echo $head_id_2; ?>" <?php echo $chk_select_2 ?>><?php echo $all_head_2; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row" id="head-role-3">
                            <div class="col-xs-12 col-md-2" id="title-head-role-3" style="white-space: nowrap; text-align:right;">
                                ลำดับที่ 3 :
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <select class="form-control" id="select-head-role-3" name="select-head-role-3" disabled>
                                        <option value="null"> --- กรุณาเลือกหัวหน้าอนุมัติ ---</option>
                                        <?php
                                        $q_head_3 = mysqli_query($con, "SELECT * FROM employee_info a INNER JOIN job_type b ON a.Job_Type_ID = b.Job_Type_ID where a.Job_Type_ID = 1 or a.Job_Type_ID = 2 or a.Job_Type_ID = 3");
                                        while ($r_head_3 = mysqli_fetch_array($q_head_3)) {
                                            $head_fname_3 = $r_head_3['Em_Fname'];
                                            $head_flame_3 = $r_head_3['Em_Lname'];
                                            $head_job_3 = $r_head_3['Job_Type_Name'];
                                            $head_id_3 = $r_head_3['Em_ID'];
                                            $all_head_3 = $head_fname_3 . " " . $head_lname_3 . " ตำแหน่ง : " . $head_job_3;
                                            $chk_select_3 = "";
                                            if ($head_id_3 == $head_app_3) {
                                                $chk_select_3 = "selected";
                                            }
                                        ?>
                                            <option value="<?php echo $head_id_3; ?>" <?php echo $chk_select_3 ?>><?php echo $all_head_3 ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-4"></div>
                            <div class="col-xs-12 col-md-2">
                                <button type="button" name="btn_submit" class="btn btn-info" <?php echo $btn ?> onclick="chkbtn();">ยืนยัน</button>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <a href="../Secret/increase_leave_disp.php" type="button" name="btn_return" class="btn btn-danger">ยกเลิก</a>
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
<script src="../Secret/src/flatpickr/dist/flatpickr.min.js"></script>
<script src="../Secret/src/flatpickr/dist/plugins/rangePlugin.js"></script>


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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    /* function add_frm() {
        $.ajax({
            type: "POST",
            url: "../secret/ajax/add_form_ajax.php",
            data: {
                proc: 'add_form'
            },
            success: function(data) {
                $('#input_frm').append(data);
            }
        });
    } */
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(document.getElementById('start_add_date'), {
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(document.getElementById('start_date'), {
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(document.getElementById('end_date'), {
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(document.getElementById('start_time'), {

            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            //defaultDate: "09:00"

        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(document.getElementById('end_time'), {

            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            //defaultDate: "18:00"

        });
    });

    $(document).ready(function() {
        $("select#select-head-role-1").change(function() {
            var selecthead1 = $(this).children("option:selected").val();
            if (selecthead1 !== "null") {
                $('#select-head-role-2').removeAttr("disabled");
            } else {
                $('#select-head-role-2').attr('disabled', 'disabled');
                $('#select-head-role-3').attr('disabled', 'disabled');
                $('#select-head-role-2').val('null');
                $('#select-head-role-3').val('null');
            }
        });
    });
    $(document).ready(function() {
        $("select#select-head-role-2").change(function() {
            var selecthead1 = $(this).children("option:selected").val();
            if (selecthead1 !== "null") {
                $('#select-head-role-3').removeAttr("disabled");
            } else {
                $('#select-head-role-3').attr('disabled', 'disabled');
                $('#select-head-role-3').val('null');
            }
        });
    });

    function chkbtn() {
        var dateend = document.forms["form_super_leave"]["end_date"].value;
        var type = $('input[name=TYPE_DAY]:checked').val();
        var leavenote = document.forms["form_super_leave"]["reason"].value;
        var stime = document.forms["form_super_leave"]["start_time"].value;
        var etime = document.forms["form_super_leave"]["end_time"].value;
        const head1 = document.getElementById('select-head-role-1').value;

        /* alert(type); */
        // กรณีลาเต็มวัน
        if (type == 1) {
            if (dateend == "") {
                alert("กรุณากรอกวันที่ในการลา");
                return false;
            }
            if (leavenote == "") {
                alert("กรุณากรอกเหตุผลในการลา");
                return false;
            }
            if (head1 == "null") {
                alert("กรุณาเลือกหัวหน้าอนุมัติ");
                return false;
            }
        }
        //กรณีลาครึ่งวัน
        if (type == 0) {
            if (dateend == "") {
                alert("กรุณากรอกวันที่ในการลา");
                return false;
            }
            if (stime == "") {
                alert("กรุณาเลือกเวลาให้ครบ");
                return false;
            }
            if (etime == "") {
                alert("กรุณาเลือกเวลาให้ครบ");
                return false;
            }
            if (leavenote == "") {
                alert("กรุณากรอกเหตุผลในการลา");
                return false;
            }
            if (head1 == "null") {
                alert("กรุณาเลือกหัวหน้าอนุมัติ");
                return false;
            }
        }
        $('#form_super_leave').submit();
    }


    /* function jsDateDiff() {
        var s_date = $("#start_date").val();
        var e_date = $("#end_date").val();
        $.ajax({
            url: '../Secret/ajax/process_count_date.php',
            dataType: "json",
            type: "POST",
            data: {
                S_DATE: s_date,
                E_DATE: e_date
            }, //name:value
            success: function(data) {
                console.log(data);
            }
        })
    } */
</script>

</html>