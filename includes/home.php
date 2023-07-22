<div id="jibu"><i class='fa fa-close'style="color:red"></i> <span id="la-jibu"></div>
<?php
include('navbar.php');?>
<!-- home page -->
<div class="home-panel">
<?php include('topbar.php');
if($_GET['link']=='logout'){
    session_destroy();?>
    <script>location.href="index.php"</script>
    <?php
}else if($_GET['link']=='home'){
    include('dashboard.php');
}else if($_GET['link']=='inventory'){
    include('inventory.php');
}else if($_GET['link']=='category'){
    include('category.php');
}else if($_GET['link']=='supplier'){
    include('supplier.php');
}
?>
</div>