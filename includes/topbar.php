<div class="top-bar">
    <div class="ka-bar">
        <div class="text">
            <?php 
            include('dbconfig.php');
            $result=$conn->query("select * from users where id=".$_SESSION['sec']." limit 1");
            $row=mysqli_fetch_assoc($result);
            ?>
            <span onclick="showOption()"><?php echo $row['username'];?> <i class="fa fa-angle-down"></i></span>
        </div>
        <div id="dropped">
            <ul>
                <li><a href="">Profile <i class="fa fa-user"></i></a></li>
                <li><a href="index.php?link=<?php echo 'logout'?>">Logout <i class="fa fa-power-off"></i></a></li>
</ul>
        </div>
    </div>
</div>

<script>
    function showOption(){
        var x=document.getElementById('dropped');
        if(x.style.display==='none'){
            x.style.display='block'
        }else{
            x.style.display="none";
        }
    }
</script>