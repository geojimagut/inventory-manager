<?php
include('navbar.php');?>
<div id="jibu"> <span id="la-jibu"></span> <i class='fa fa-close'style="color:red"></i></div>
<div id="darkness"></div>
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
}else if($_GET['link']=='product'){
    include('product.php');
}else if($_GET['link']=='expenses'){
    include('expense.php');
}else if($_GET['link']=='report'){
    include('report.php');
}else if($_GET['link']=='sales'){
    include('sales.php');
}
?>
</div>