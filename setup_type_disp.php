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
    <link rel="stylesheet" href="../Secret/css/home.css">
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
</head>

<body>


    <?php
    $query = mysqli_query($con, "SELECT * FROM leave_type where Delete_STATUS = 0");
    $a = 0;

    $uid = $_SESSION["sys_data"][0];


    ?>

    <!-- start navbar -->
    <!-- end navbar -->


    <div id="titlehead">
        <h3> ตั้งค่าประเภทการลา </h3>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-block">
                <div id="leave-type">
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" style="font-size: 16px;">ลำดับ</th>
                                    <th scope="col" style="font-size: 16px;">ประเภทในการลา</th>
                                    <th scope="col" style="font-size: 16px;">จำนวนวันที่ลา</th>
                                    <th scope="col" style="font-size: 16px;">สถานะ</th>
                                    <th scope="col" style="font-size: 16px;">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($query)) {
                                    //echo '<pre>',print_r($row),'</pre>';
                                    $id = $row['Leave_Type_ID'];
                                    $name = $row['Leave_Type_Name'];
                                    $count = $row['Leave_Type_Count'];
                                    $status = $row['Active_STATUS'];
                                    $a++;
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $a ?></th>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $arr[$status] ?></td>
                                        <td><a href="../Secret/setup_type_form.php?proc=view&type_id=<?php echo $id ?>" class="btn btn-outline-success" id="all_proc"> ดู </a>&nbsp;
                                            <a href="../Secret/setup_type_form.php?proc=edit&type_id=<?php echo $id ?>" class="btn btn-outline-warning" id="all_proc"> แก้ไข </a>&nbsp;
                                            <a href="../Secret/src/setup_type_save.php?proc=del&type_id=<?php echo $id ?> " class="btn btn-outline-danger" id="all_proc"> ปิดการใช้งาน </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12" id="add_btn">
                            <a href="../Secret/setup_type_form.php?proc=add
                            " class="btn btn-success">เพิ่มประเภทในการลา</a>
                        </div>
                    </div>
                </div>
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


</html>