<?php
session_start();
$sec=$_SESSION['sec'];
include('includes/header.php');
?>
<body>
    <?php
    if(!empty($sec)){
        include('includes/home.php');
    }else{
        include('includes/login.php');
    }
    ?>
</body>
<?php include('includes/footer.php');?>