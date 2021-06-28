<html lang="en">

<head>

    <?php
    include_once("../Secret/connect.php");
    include_once("../Secret/include/header.php");
    include_once("../Secret/include/footer.php");
    ?>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../secret/css/new_type.css">
    <link href="../secret/src/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


    <link href="dist/libs/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <link href="dist/libs/selectize/dist/css/selectize.css" rel="stylesheet" />
    <link href="dist/libs/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link href="dist/libs/nouislider/distribute/nouislider.min.css" rel="stylesheet" />
    <link href="dist/css/tabler.min.css" rel="stylesheet" />
    <link href="dist/css/demo.min.css" rel="stylesheet" />


    <title>เพิ่มประเภทในการลา</title>
    <script type="text/javascript">
        /* window.onload = function() {
            document.getElementById('ACTIVE_STATUS_1').checked = false;
            document.getElementById('ACTIVE_STATUS_0').checked = false;
        } */
    </script>
</head>

<body>

    <?php
    $type_id = $_GET["type_id"];
    $proc = $_GET["proc"];
    $chk_2 = "";
    $chk_1 = "checked";


    if ($proc != 'add') {
        @$query = mysqli_query($con, "SELECT * FROM leave_type where Leave_Type_ID = '" . $type_id . "' ");
        // $num = mysqli_num_rows($query);\
        @$row = mysqli_fetch_array($query);
        @$type_id = $row["Leave_Type_ID"];;
        @$type_name = $row["Leave_Type_Name"];
        @$c_date = $row["Leave_Type_Count"];
        if (@$row["Active_STATUS"] == 1) {
            $chk_1 = "checked";
            $chk_2 = "";
        } else if (@$row["Active_STATUS"] == 0) {
            $chk_1 = "";
            $chk_2 = "checked";
        } else {
            $chk_1 = "checked";
            $chk_2 = "";
        }
    }
    // = เท่ากับ 1 ตัว คือการค่าทับเข้าไปที่ตัวแปล
    // == เท่ากับ 2 ตัว คือการเช็คค่า
    // === เท่ากับ 3 ตัว คือการเช็คค่าที่เหมือนกันทั้งหมด (ค่า, ประเภทตัวแปล) # proc === "1" ค่าที่ส่งมาต้องเป็นประเภทเดียกวัน (string = string, int = int)
    $btn = "";
    if ($_GET["proc"] == "view") {
        $btn = "disabled";
    }
    //print_r($_GET);

    ?>



    <!-- start navbar -->
    <!-- end navbar -->


    <div id="titlehead">
        <h3> เพิ่มประเภทในการลา </h3>
    </div>

    <div class="container">

        <div class="card">
            <div class="card-block">
                <div id="in_type">
                    <form id="Form" action="../Secret/src/setup_type_save.php" method="get">

                        <input type="hidden" id="proc" name="proc" value="<?php echo $proc; ?>">
                        <input type="hidden" id="type_id" name="type_id" value="<?php echo $type_id; ?>">
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right">
                                * ประเภทในการลา :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <input type="text" id="new_type_name" name="new_type_name" class="form-control" placeholder="กรุณากรอกข้อมูล" value="<?php echo @$type_name; ?>" maxlength="100">
                            </div>
                            <div class="col-xs-12 col-md-1"></div>
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right">
                                * จำนวนในการลา :
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <input type="number" id="new_type_count" name="new_type_count" class="form-control" placeholder="กรุณากรอกข้อมูล" maxlength="2" value="<?php echo $c_date; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-2" style="white-space: nowrap; text-align:right">
                                * ประเภทในการใช้งาน :
                            </div>
                            <!--<div class="col-md-1"></div>-->
                            <div class="col-xs-12 col-md-3">
                                <input type="radio" id="ACTIVE_STATUS_1" name="ACTIVE_STATUS" value="1" <?php echo $chk_1; ?>>
                                <label for="1">ใช้งาน</label>
                                &nbsp;&nbsp;
                                <input type="radio" id="ACTIVE_STATUS_0" name="ACTIVE_STATUS" value="0" <?php echo $chk_2; ?>>
                                <label for="0">ไม่ใช้งาน</label>
                            </div>

                        </div>

                        <!-- ปุ่ม submit  -->
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-md-4"></div>
                            <div class="col-xs-12 col-md-2">
                                <button type="button" class="btn btn-info" <?php echo $btn; ?> onclick="chkbtn();">ยืนยัน</button>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <a href="../Secret/setup_type_disp.php" type="button" name="btn_return" class="btn btn-danger">ยกเลิก</a>
                            </div>
                        </div>
                        <!-- end submit -->
                    </form>
                </div>
            </div>
        </div>

    </div>


</body>

<scrip src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></scrip>
<scrip src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></scrip>
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
    function chkbtn() {
        var typename = document.forms["Form"]["new_type_name"].value;
        var typecount = document.forms["Form"]["new_type_count"].value;
        /* var typestatus = document.forms["Form"]['ACTIVE_STATUS'].checked; */
        // var typeradio = $("input[name='ACTIVE_STATUS']:checked").val();
        // alert(typeradio);
        // return false;  
        /* if ($('#new_type_name').val() == null) {
            alert("testestsetset");
            return false;
        }
        if ($('#new_type_count').val() == null) {
            alert("testestsetset");
            return false;
        } */
        if (typename == "") { // new type name == null
            alert("กรุณากรอกชื่อประเภท");
            return false;
        }
        if (typecount == "") { //new type count == null
            alert("กรุณากรอกจำนวนวัน");
            return false;
        }
        /* if (typeradio == 'undefined') {
            alert("เลือกด้วยนะครับไอสัส")
            return false;
        } */
        /* if (typeradio == "") { //active status == null
            alert("เลือกด้วยไอสัส")
            return false;
        } */
        $('#Form').submit();
    }
    //เพิ่มกรณี
</script>


</html>