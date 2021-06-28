<html lang="en">

<head>

    <?php
    include_once("../Secret/connect.php");
    include_once("../Secret/src/function.php");
    include_once("../Secret/include/header.php");
    //include_once("../Secret/src/func.php")
    ?>

    <style>

    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../secret/css/home.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="dist/libs/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <link href="dist/libs/selectize/dist/css/selectize.css" rel="stylesheet" />
    <link href="dist/libs/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link href="dist/libs/nouislider/distribute/nouislider.min.css" rel="stylesheet" />
    <link href="dist/css/tabler.min.css" rel="stylesheet" />
    <link href="dist/css/demo.min.css" rel="stylesheet" />
    <title>หน้าหลัก</title>
</head>

<body>



    <?php
    /* echo "<pre>";
    print_r($_SESSION);
    echo "</pre>"; */

    //echo '<pre>', print_r($_SESSION), '</pre>';



    $uid = $_SESSION["sys_data"][0];


    $query = mysqli_query($con, "SELECT a.Leave_Log_STATUS AS LEAVE_STATUS , a.* ,b.* FROM leave_log a
    INNER JOIN leave_type b ON a.Leave_Type_ID = b.Leave_Type_ID
    WHERE a.Em_ID = '" . $uid . "' ");


    /* $arr = array(0 => "ไม่อนุมัติ", 1 => "อนุมัติ"); */

    $a = 0;

    ?>

    <!-- start navbar -->
    <!-- end navbar -->



    <!-- detail -->

    <div id="titlehead">
    </div>

    <div class="container">
        <div class="card">
            <div class="card-block">
                <div id="detail-container">
                    <div class="row">
                        <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                            ชื่อ-นามสกุล :
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <input type="text" id="fullname" name="fullname" class="form-control" maxlength="100" readonly value="<?php echo $_SESSION["sys_data"][1] . "  " . $_SESSION["sys_data"][2] ?>" style="outline:none;">
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                            ตำแหน่งงาน :
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <input type="text" id="job" name="job" class="form-control" maxlength="100" readonly value="<?php echo $_SESSION["sys_data"][17] ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                            E-mail :
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <input type="text" job="mail" name="mail" class="form-control" maxlength="100" readonly value="<?php echo $_SESSION["sys_data"][4] ?>">
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-xs-12 col-md-2" style="white-space:nowrap; text-align:right;">
                            เบอร์โทรศัพท์ :
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <input type="text" name="tel" id="tel" class="form-control" maxlength="100" readonly value="<?php echo $_SESSION["sys_data"][5] ?>">
                        </div>
                    </div>
                    <br>

                    <div id="title_date">
                        <h3>จำนวนวันลา</h3>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-md-1" style="white-space: nowrap; text-align:right; ">
                            ลากิจ :
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <input type="text" name="p_leave_count" id="p_leave_count" class="form-control" maxlength="100" readonly value="<?php echo $_SESSION["sys_data"][12] ?>">
                        </div>
                        <div class="col-xs-12 col-md-1" style="white-space: nowrap; text-align:right; ">
                            ลาป่วย :
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <input type="text" name="s_leave_count" id="s_leave_count" class="form-control" maxlength="100" readonly value="<?php echo $_SESSION["sys_data"][10] ?>">
                        </div>
                        <div class="col-xs-12 col-md-1" style="white-space: nowrap; text-align:right;">
                            ลาพักร้อน :
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <input type="text" name="w_leave_count" id="w_leave_count" class="form-control" maxlength="100" readonly value="<?php echo $_SESSION["sys_data"][11] ?>">
                        </div>
                    </div>
                </div>




                <!-- log -->
                <br>
                <div class="row justify-content-center">
                    <div class="col-xs-12 col-md-auto">
                        <input id="search_day" class="form-control" type="date" placeholder="กรุณาเลือกวันที่" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-auto">
                        <div class="form-group">
                            <select class="form-control" id="search_type" name="search_type">
                                <option value="null"> -- กรุณาเลือกประเภท -- </option>
                                <?php
                                $q_type = mysqli_query($con, "SELECT * FROM leave_type WHERE Active_STATUS = 1");
                                while ($r_type = mysqli_fetch_array($q_type)) {
                                    $type_id = $r_type["Leave_Type_ID"];
                                    $type_name = $r_type["Leave_Type_Name"];
                                ?>
                                    <option value="<?php echo $type_id; ?>"><?php echo $type_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                    <div class="col-xs-12 col-md-auto">
                        <div class="form-group">
                            <select class="form-control" name="search_status" id="search_status">
                                <option value="null"> -- กรุณาเลือกสถานะ -- </option>
                                <option value="1">อนุมัติ</option>
                                <option value="2">รออนุมัติ</option>
                                <option value="3">ไม่อนุมัติ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md" id="add_btn">
                        <a href="../Secret/increase_leave_form.php?proc=add" name="add_form" class="btn btn-success">ยื่นวันลา</a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="font-size: 16px;">ลำดับ</th>
                                <th scope="col" style="font-size: 16px;">วันที่ลา</th>
                                <th scope="col" style="font-size: 16px;">ตั้งแต่วันที่</th>
                                <th scope="col" style="font-size: 16px;">จนถึงวันที่</th>
                                <th scope="col" style="font-size: 16px;">ประเภทการลา</th>
                                <th scope="col" style="font-size: 16px;">สถานะ</th>
                                <th scope="col" style="font-size: 16px;">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($query)) {
                                $id = $row['Leave_Log_ID'];
                                $datetime = $row['Leave_DATETIMES'];
                                $sdate = $row['Leave_Start_Date'];
                                $edate = $row['Leave_End_Date'];
                                $stime = date_create($row['Leave_Start_Time']);
                                $etime = date_create($row['Leave_End_Time']);
                                $name_leave = $row['Leave_Type_Name'];
                                $status = $row['LEAVE_STATUS'];
                                $a++;
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $a ?></th>
                                    <td><?php echo conv_date($datetime, "th", "long") ?></td>
                                    <td><?php echo conv_date($sdate, "th", "long") ?></td>
                                    <td><?php echo conv_date($edate, "th", "long") ?></td>
                                    <td><?php echo $name_leave; ?></td>
                                    <td><?php echo $arr[$status]; ?></td>
                                    <?php if ($status == 1) { ?>
                                        <td>
                                            <a href="../Secret/increase_leave_form.php?proc=view&log_id=<?php echo $id ?>" class="btn btn-outline-success" id="all_proc"> ดู </a>
                                        </td>
                                    <?php } else if ($status == 3) { ?>
                                        <td>
                                            <a href="../Secret/increase_leave_form.php?proc=view&log_id=<?php echo $id ?>" class="btn btn-outline-success" id="all_proc"> ดู </a>&nbsp;
                                            <a href="../Secret/increase_leave_form.php?proc=edit&log_id=<?php echo $id ?>" class="btn btn-outline-warning" id="all_proc"> แก้ไข </a>
                                        </td>
                                    <?php } else { ?>
                                        <td><a href="../Secret/increase_leave_form.php?proc=view&log_id=<?php echo $id ?>" class="btn btn-outline-success" id="all_proc"> ดู </a>&nbsp;
                                            <a href="../Secret/increase_leave_form.php?proc=edit&log_id=<?php echo $id ?>" class="btn btn-outline-warning" id="all_proc"> แก้ไข </a>&nbsp;
                                            <a href="../Secret/src/increase_leave_save.php?proc=del&log_id=<?php echo $id ?> " class="btn btn-outline-danger" id="all_proc"> ปิดการใช้งาน </a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(document.getElementById('search_day'), {
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
        });
    });
</script>

<?php
include_once("../Secret/include/footer.php"); ?>

</html>