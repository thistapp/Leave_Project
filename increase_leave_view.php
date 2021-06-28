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
    $val = 1; //ข้อมูลของการประเภทการลา default เป็น 1
    $type_day = "TYPE_DAY";
    $head_app_1 = "";
    $head_app_2 = "";
    $head_app_3 = "";
    if ($proc != 'add') {
        $log_id = $_GET["log_id"];
        $query = mysqli_query($con, "SELECT * FROM  leave_log a inner join leave_type b on a.Leave_Type_ID = b.Leave_Type_ID WHERE a.Leave_Log_ID = '" . $log_id . "' ");
        $row = mysqli_fetch_array($query);
        $s_date = conv_date($row["Leave_Start_Date"], "th", "short");
        $e_date = conv_date($row["Leave_End_Date"], "th", "short");
        $s_time = date_create($row["Leave_Start_Time"]);
        $e_time = date_create($row["Leave_End_Time"]);
        $note = $row["Leave_Log_Reason"];
        $type_name = $row["Leave_Type_Name"];
        $type_days = $row["Leave_Type_DATE"];
        $head_app_1 = $row["Leave_Head_1_ID"];
        $head_app_2 = $row["Leave_Head_2_ID"];
        $head_app_3 = $row["Leave_Head_3_ID"];
        $time_leave = date_format($s_time, 'H:i') . " - " . date_format($e_time, 'H:i');
        $val = $row["Leave_Type_ID"];
        $super_status = $row["Leave_Log_STATUS"];
    }

    ?>


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
                    <div id="detail_form">
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                                ชื่อ - นามสกุล :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <?php echo $fname . " " . $lname;  ?>
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
                                วันที่ลา - จนถึงวันที่ :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <?php echo $s_date . " - " . $e_date; ?>
                            </div>
                            <div class="col-xs-12 col-md-1"></div>
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                                ประเภทในการลา :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <?php echo $type_name ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right">
                                เวลาในการลา :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <?php if ($time_leave == "00:00 - 00:00") {
                                    echo $arr_type[date_format($s_time, 'H:i') . " - " . date_format($e_time, 'H:i')];
                                } else {
                                    echo $time_leave;
                                } ?></td>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                                เหตุผลในการลา :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <?php echo $note; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                                สถานะ :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <?php echo $arr[$super_status]; ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="container">
                        <div class="row" id="head-role-1">
                            <?php $query_1 = mysqli_query($con, "SELECT * FROM employee_info a inner join leave_log b on a.Em_ID = Leave_Head_1_ID WHERE b.Leave_Log_ID = '" . $log_id . "' ");
                            $row_1 = mysqli_fetch_array($query_1);
                            $fname_1 = $row_1["Em_Fname"];
                            $lname_1 = $row_1["Em_Lname"];
                            $head_1_status = $row_1["Leave_Head_1_STATUS"];
                            $head_1_note = $row_1["Leave_Head_1_Reason"];
                            ?>
                            <div class="col-xs-12 col-md-2" id="title-head-role-1" style="white-space: nowrap; text-align:right;">
                                ลำดับที่ 1 :
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <?php echo $fname_1 . " " . $lname_1; ?>
                            </div>
                            <div class="col-xs-12 col-md-1" style="white-space: nowrap; text-align:right;">
                                สถานะ :
                            </div>
                            <div class="col-xs-12 col-md-1">
                                <?php echo $arr[$head_1_status]; ?>
                            </div>
                            <div class="col-xs-12 col-md-1" style="white-space: nowrap; text-align:right;">
                                หมายเหตุ :
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <?php if ($head_1_note == "") {
                                    echo "-";
                                } else {
                                    echo $head_1_note;
                                } ?>
                            </div>
                        </div>
                        <br>

                        <div class="row" id="head-role-2" style="display: none;">
                            <?php $query_2 = mysqli_query($con, "SELECT * FROM employee_info a inner join leave_log b on a.Em_ID = Leave_Head_2_ID WHERE b.Leave_Log_ID = '" . $log_id . "' ");
                            $row_2 = mysqli_fetch_array($query_2);
                            $head_app_2 = $row_2["Leave_Head_2_ID"];
                            $fname_2 = $row_2["Em_Fname"];
                            $lname_2 = $row_2["Em_Lname"];
                            $head_2_status = $row_2["Leave_Head_2_STATUS"];
                            $head_2_note = $row_2["Leave_Head_2_Reason"];
                            if ($head_app_2 != 0) {
                            ?>
                                <input type="hidden" name="head_app_2" id="head_app_2" value="<?php echo $head_app_2; ?>">
                                <div class="col-xs-12 col-md-2" id="title-head-role-2" style="white-space: nowrap; text-align:right;">
                                    ลำดับที่ 2 :
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <?php echo $fname_2 . " " . $lname_2; ?>
                                </div>
                                <div class="col-xs-12 col-md-1" style="white-space: nowrap; text-align:right;">
                                    สถานะ :
                                </div>
                                <div class="col-xs-12 col-md-1">
                                    <?php echo $arr[$head_2_status]; ?>
                                </div>
                                <div class="col-xs-12 col-md-1" style="white-space: nowrap; text-align:right;">
                                    หมายเหตุ :
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <?php if ($head_2_note == "") {
                                        echo "-";
                                    } else {
                                        echo $head_2_note;
                                    } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <br>


                        <div class="row" id="head-role-3" style="display: none;">
                            <?php $query_3 = mysqli_query($con, "SELECT * FROM employee_info a inner join leave_log b on a.Em_ID = Leave_Head_3_ID WHERE b.Leave_Log_ID = '" . $log_id . "' ");
                            $row_3 = mysqli_fetch_array($query_3);
                            $head_app_3 = $row_3["Leave_Head_3_ID"];
                            $fname_3 = $row_3["Em_Fname"];
                            $lname_3 = $row_3["Em_Lname"];
                            $head_3_status = $row_3["Leave_Head_3_STATUS"];
                            $head_3_note = $row_3["Leave_Head_3_Reason"];
                            if ($head_app_3 != 0) {
                            ?>
                                <input type="hidden" name="head_app_3" id="head_app_3" value="<?php echo $head_app_3; ?>">
                                <div class="col-xs-12 col-md-2" id="title-head-role-3" style="white-space: nowrap; text-align:right;">
                                    ลำดับที่ 3 :
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <?php echo $fname_3 . " " . $lname_3; ?>
                                </div>
                                <div class="col-xs-12 col-md-1" style="white-space: nowrap; text-align:right;">
                                    สถานะ :
                                </div>
                                <div class="col-xs-12 col-md-1">
                                    <?php echo $arr[$head_3_status]; ?>
                                </div>
                                <div class="col-xs-12 col-md-1" style="white-space: nowrap; text-align:right;">
                                    หมายเหตุ :
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <?php if ($head_3_note == "") {
                                        echo "-";
                                    } else {
                                        echo $head_3_note;
                                    } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-5"></div>

                            <div class="col-xs-12 col-md-3">
                                <a href="../Secret/increase_leave_disp.php" type="button" name="btn_return" class="btn btn-danger">ย้อนกลับ</a>
                            </div>
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
    const head_app_2 = document.getElementById('head_app_2').value;
    const head_app_3 = document.getElementById('head_app_3').value;

    $(document).ready(function() {
        if (head_app_2 != 0) {
            $('#head-role-2').css('display', '');
        } else {
            $('#head-role-2').css('display', 'none');
        }
    });

    $(document).ready(function() {
        if (head_app_3 != 0) {
            $('#head-role-3').css('display', '');
        } else {
            $('#head-role-3').css('display', 'none');
        }
    });

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