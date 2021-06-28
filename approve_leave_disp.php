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
    <link rel="stylesheet" href="../css/header.css">
    <link href="../Secret/src/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


    <link href="dist/libs/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <link href="dist/libs/selectize/dist/css/selectize.css" rel="stylesheet" />
    <link href="dist/libs/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link href="dist/libs/nouislider/distribute/nouislider.min.css" rel="stylesheet" />
    <link href="dist/css/tabler.min.css" rel="stylesheet" />
    <link href="dist/css/demo.min.css" rel="stylesheet" />


    <title>อนุมัติในการลา</title>
</head>

<?php
$uid = $_SESSION["sys_data"][0];
$filter = "";

$sql_chk = mysqli_query($con, "SELECT * FROM `leave_log` WHERE Leave_Head_1_ID = '" . $uid . "' OR Leave_Head_2_ID = '" . $uid . "' OR Leave_Head_3_ID = '" . $uid . "'");
while ($row = mysqli_fetch_array($sql_chk)) {
    if ($uid == $row['Leave_Head_1_ID']) {
        if ($row['Leave_Head_1_STATUS'] == "") {
            $LogId[] = $row['Leave_Log_ID'];
        }
    }
    if ($uid == $row['Leave_Head_2_ID']) {
        if ($row['Leave_Head_1_STATUS'] == '1' && $row['Leave_Head_2_STATUS'] == "") {
            $LogId[] = $row['Leave_Log_ID'];
        }
    }
    if ($uid == $row['Leave_Head_3_ID']) {
        if ($row['Leave_Head_1_STATUS'] == "1" && $row['Leave_Head_2_STATUS'] == "1" && $row['Leave_Head_3_STATUS'] == "") {
            $LogId[] = $row['Leave_Log_ID'];
        }
    }
}

if (count($LogId) > 0) {
    $LogId = implode(",", $LogId);
    $filter = " AND Leave_Log_ID IN($LogId)";
}
// query พวกข้อมูลการลา
$query = mysqli_query($con, "SELECT *  FROM leave_log a 
INNER JOIN leave_type b ON a.Leave_Type_ID = b.Leave_Type_ID 
INNER JOIN employee_info c ON a.Em_ID = c.Em_ID
where a.Leave_Log_STATUS = 2 {$filter}");
$a = 0;

//print_r($_SESSION);
?>

<body>

    <!-- end navbar -->
    <div id="titlehead">
        <h3> อนุมัติการลา </h3>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-block">
                <div id="leave-type">
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
                    <br>
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" style="font-size: 16px;">ลำดับ</th>
                                    <th scope="col" style="font-size: 16px;">ชื่อ - นามสกุล</th>
                                    <th scope="col" style="font-size: 16px;">วันที่ลา - จนถึงวันที่</th>
                                    <th scope="col" style="font-size: 16px;">เวลา</th>
                                    <th scope="col" style="font-size: 16px;">ประเภทในการลา</th>
                                    <th scope="col" style="font-size: 16px;">สถานะ</th>
                                    <th scope="col" style="font-size: 16px;">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($query)) {
                                    $id = $row['Leave_Log_ID'];
                                    $fname = $row['Em_Fname'];
                                    $lname = $row['Em_Lname'];
                                    $sdate = conv_date($row['Leave_Start_Date'], "th", "short");
                                    $edate = conv_date($row['Leave_End_Date'], "th", "short");
                                    $stime = date_create($row['Leave_Start_Time']);
                                    $etime = date_create($row['Leave_End_Time']);
                                    $time_leave = date_format($stime, 'H:i') . " - " . date_format($etime, 'H:i');
                                    $type_leave = $row['Leave_Type_Name'];
                                    $status = $row['Leave_Log_STATUS'];
                                    $hid = "";

                                    //$a++;
                                    if ($uid == $row['Em_ID']) {
                                        if ($row['Leave_Head_1_STATUS'] != "" || $row['Leave_Head_2_STATUS'] != "" || $row['Leave_Head_2_STATUS'] != "" || $row['Leave_Log_STATUS'] != "") {
                                            $hid = "y";
                                        }
                                    }
                                    /* if ($uid == $row['Leave_Head_1_ID']) {
                                        if ($row['Leave_Head_1_STATUS'] != "") {
                                            $hid = "y";
                                        }
                                    }
                                    if ($uid == $row['Leave_Head_2_ID']) {
                                        if ($row['Leave_Head_1_STATUS'] != "" && $row['Leave_Head_2_STATUS'] != "") {
                                            $hid = "y";
                                        }
                                    }
                                    if ($uid == $row['Leave_Head_3_ID']) {
                                        if ($row['Leave_Head_1_STATUS'] != "" && $row['Leave_Head_2_STATUS'] != "" && $row['Leave_Head_3_STATUS'] != "") {
                                            $hid = "y";
                                        }
                                    } */
                                    if ($hid != "y") {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo ++$a; ?></th>
                                            <td><?php echo $fname . " " . $lname; ?></td>
                                            <td><?php echo $sdate . " - " . $edate; ?></td>
                                            <td><?php
                                                if ($time_leave == "00:00 - 00:00") {
                                                    echo $arr_type[date_format($stime, 'H:i') . " - " . date_format($etime, 'H:i')];
                                                } else {
                                                    echo $time_leave;
                                                }
                                                ?></td>
                                            <td><?php echo $type_leave; ?></td>
                                            <td><?php echo $arr[$status]; ?></td>
                                            <td><a href="../Secret/approve_leave_form.php?proc=app&log_id=<?php echo $id ?>" class="btn btn-outline-warning" id="all_proc"> อนุมัติ </a>&nbsp;
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="row">
                        <div class="col-xs-12 col-md-12" id="add_btn">
                            <a href="../Secret/increase_leave_form.php?proc=add
                            " class="btn btn-success">ยื่นวันลา</a>
                        </div>
                    </div> -->
                </div>
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
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(document.getElementById('search_day'), {
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
        });
    });
</script>

</html>