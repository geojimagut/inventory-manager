<?php
session_start();
include('includes/dbconfig.php');
$action=$_GET['action'];
if($action=='btn-login'){
    $pass=md5($_POST['password']);
    $username=$_POST['username'];

    $qry="select * from users where username=? and password=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$qry)){
        echo "Statements Failed";
    }else{
        mysqli_stmt_bind_param($stmt, 'ss', $username, $pass);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $count=mysqli_num_rows($result);
        if($count >= 1){
            $row=mysqli_fetch_assoc($result);
            $_SESSION['sec']=$row['id'];
            echo "Loading...";
            ?><script>
                setTimeout(() => {
                    location.href="index.php?link=home";
                }, 1000);
            
            </script><?php
        }else{
            echo "Incorrect Username or Password";
        }
    }
}else if($action=="btn-cat"){
    $name=$_POST['name'];
    $status=$_POST['status'];
    $qry="select * from category where cat_name=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$qry)){
        echo "Failed Statements";
    }else{
        mysqli_stmt_bind_param($stmt, 's',$name);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $rowcount=mysqli_num_rows($result);
        if($rowcount > 1){
            echo "Category exists";
        }else{
            $instqry="insert into category(cat_name, status) values(?,?)";
            $inststmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($inststmt,$instqry)){
                echo "Failed Statements";
            }else{
                mysqli_stmt_bind_param($inststmt,'ss',$name,$status);
                mysqli_stmt_execute($inststmt);
                echo "Category Added";?>
                <script>
                    setTimeout(() => {
                        location.reload()
                    }, 2000);
                </script>
            <?php }
        }
}
}else if($action=="btn-del-cat"){
    if($conn->query("delete * from category where id=".$_POST['data'])){
        echo "Deleted";
    }else{
        echo "Failed";
    }

}


/*end*/
?>