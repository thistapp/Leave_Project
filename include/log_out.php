<?php
session_start();
session_destroy();
echo "<script>
self.location.href='../index.php';
</script>";
