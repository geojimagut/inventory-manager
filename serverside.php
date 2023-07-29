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
    $id=$_POST['txt-id'];
    if(empty($id)){
    $qry="select * from category where cat_name=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$qry)){
        echo "Failed Statements";
    }else{
        mysqli_stmt_bind_param($stmt, 's',$name);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $rowcount=mysqli_num_rows($result);
        if($rowcount > 0){
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
}else{
    $instqry="update category set cat_name=?, status=? where id=?";
            $inststmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($inststmt,$instqry)){
                echo "Failed Statements";
            }else{
                mysqli_stmt_bind_param($inststmt,'sss',$name,$status,$id);
                mysqli_stmt_execute($inststmt);
                echo "Updated";?>
                <script>
                    setTimeout(() => {
                        location.reload()
                    }, 2000);
                </script>
            <?php }
}
}else if($action=="btn-del-cat"){
    if($conn->query("delete from category where id=".$_POST['data'])){
        echo "Deleted";?>
            <script>
                setTimeout(() => {
                    location.reload()
                }, 1000);
            </script>
    <?php }else{
        echo "Failed";
    }

}else if($action=='btn-del-sup'){
    if($conn->query("delete from supplier where id=".$_POST['data'])){
        echo "Deleted";?>
            <script>
                setTimeout(() => {
                    location.reload()
                }, 1000);
            </script>
    <?php }else{
        echo "Failed";
    }
}else if($action=="btn-sup"){
    $name=$_POST['name'];
    $id=$_POST['txt-id'];
    if(empty($id)){
    $qry="select * from supplier where supplier=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$qry)){
        echo "Failed Statements";
    }else{
        mysqli_stmt_bind_param($stmt, 's',$name);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $rowcount=mysqli_num_rows($result);
        if($rowcount > 0){
            echo "Supplier exists";
        }else{
            $instqry="insert into supplier(supplier) values(?)";
            $inststmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($inststmt,$instqry)){
                echo "Failed Statements";
            }else{
                mysqli_stmt_bind_param($inststmt,'s',$name);
                mysqli_stmt_execute($inststmt);
                echo "Supplier Added";?>
                <script>
                    setTimeout(() => {
                        location.reload()
                    }, 2000);
                </script>
            <?php }
        }
    }
}else{
    $instqry="update supplier set supplier=? where id=?";
    $inststmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($inststmt,$instqry)){
        echo "Failed Statements";
    }else{
        mysqli_stmt_bind_param($inststmt,'ss',$name, $id);
        mysqli_stmt_execute($inststmt);
        echo "Updated";?>
        <script>
            setTimeout(() => {
                location.reload()
            }, 2000);
        </script>
<?php }
    }
}else if($action=="btn-pro"){
    $name=$_POST['name'];
    $id=$_POST['txt-id'];
    $category=$_POST['category'];
    $targetDir = "products/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    if(empty($id)){
    $qry="select * from products where name=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$qry)){
        echo "Failed Statements";
    }else{
        mysqli_stmt_bind_param($stmt, 's',$name);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $rowcount=mysqli_num_rows($result);
        if($rowcount > 0){
            echo "Product exists";
        }else{
              if(!empty($_FILES["file"]["name"])){
                // Allow certain file formats
                $allowTypes = array('jpg','png','jpeg');
                if(in_array($fileType, $allowTypes)){
                    // Upload file to server
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                        // Insert image file name into database
            
                        $instqry="insert into products(name, photo, category) values(?,?,?)";
                        $inststmt=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($inststmt,$instqry)){
                            echo "Failed Statements";
                        }else{
                            mysqli_stmt_bind_param($inststmt,'sss',$name,$fileName,$category);
                            mysqli_stmt_execute($inststmt);
                            echo "Product Added";
                            ?>
                            <script>
                                setTimeout(() => {
                                    location.reload()
                                }, 2000);
                            </script>
                        <?php }
                    }else{
                        echo "Sorry, there was an error uploading your file.";
                    }
                }else{
                    echo 'Sorry, only JPG, JPEG and PNG files are allowed to upload.';
                }
            }else{
                echo 'Please select a file to upload.';
            }
        }
        }
    }else if(!empty($fileName)){
        // update
        if(!empty($_FILES["file"]["name"])){
            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg');
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    // Insert image file name into database
                    // delete previous image
                    $query ="SELECT * FROM products where id='$id' ";
                    $gotton=$conn->query($query);
                    while($row = mysqli_fetch_assoc($gotton)){
                            $imageURL = 'products/'.$row["photo"];
                    //check if image exists
                        
                    if(file_exists($imageURL)){
                    
                        //delete the image
                        unlink($imageURL);
                    }
                    $instqry="update products set name=?, photo=?, category=? where id=?";
                    $inststmt=mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($inststmt,$instqry)){
                        echo "Failed Statements";
                    }else{
                        mysqli_stmt_bind_param($inststmt,'ssss',$name,$fileName,$category,$id);
                        mysqli_stmt_execute($inststmt);

                        
                        echo "Updated";
                    }
                    }
                }else{
                    echo "Sorry, there was an error uploading your file.";
                }
            }else{
                echo 'Sorry, only JPG, JPEG and PNG files are allowed to upload.';
            }
        }else{
            echo 'Please select a file to upload.';
        }?>
            <script>
                setTimeout(() => {
                    location.reload()
                }, 2000);
            </script>
    <?php }else{
        $instqry="update products set name=? where id=?";
        $inststmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($inststmt,$instqry)){
            echo "Failed Statements";
        }else{
            mysqli_stmt_bind_param($inststmt,'ss',$name,$id);
            mysqli_stmt_execute($inststmt);
            echo "Updated";
        }?>
        <script>
            setTimeout(() => {
                location.reload()
            }, 2000);
        </script>
    <?php }
    }else if($action=="btn-del-pro"){
        $packageId=$_POST['data'];
        $query ="SELECT * FROM products where id='$packageId' ";
        $gotton=$conn->query($query);
        while($row = mysqli_fetch_assoc($gotton)){
                $imageURL = 'products/'.$row["photo"];
          //check if image exists
            
          if(file_exists($imageURL)){
        
            //delete the image
            unlink($imageURL);
          }
            //after deleting image you can delete the record
            if($conn->query("delete from products where id='$packageId'")){
                echo "Deleted";
                ?><script>
                setTimeout(() => {
                    location.reload()
                }, 1000);
            </script><?php
            }else{
                echo "Failed";
            }
          }
}else if($action=='btn-inventory'){
    $product=$_POST['product'];
    $supplier=$_POST['supplier'];
    $quantity=$_POST['quantity'];
    $unit=$_POST['unit'];
    $total=$_POST['buying-price'];
    $final="0";
    $qry="select * from inventory where product_id=? and previous_quantity >?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$qry)){
        echo "Failed Statements";
    }else{
        mysqli_stmt_bind_param($stmt, 'ss',$product,$final);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $rowcount=mysqli_num_rows($result);
        if($rowcount > 0){
            ?>
            <script>
                var status=confirm('Product already exists in the inventory, do you want to update?')
                if(status=="true"){
                       <?php
                        $instqry="update inventory set product_id =? , supplier_id =?, previous_quantity =? , new_quantity =? , measurement_unit =? , total_bp =? where product_id=? and previous_quantity > ?";
                        $inststmt=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($inststmt,$instqry)){
                            // echo "Failed Statements";
                        }else{
                            mysqli_stmt_bind_param($inststmt,'ssssssss',$product,$supplier,$quantity,$quantity,$unit,$total,$product, $final);
                            mysqli_stmt_execute($inststmt);
                            // echo "Inventory updated";
                         } ?>
                $('#la-jibu').html("Inventory updated");  
                document.getElementById('jibu').style.display='flex'
                setTimeout(() => {
                    location.reload()
                }, 2000);
                    
                }else{
                    // do nothing
                }
            </script>
            <?php
        }else{
            $instqry="insert into inventory(product_id, supplier_id, previous_quantity, new_quantity, measurement_unit, total_bp) values(?,?,?,?,?,?)";
            $inststmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($inststmt,$instqry)){
                echo "Failed Statements";
            }else{
                mysqli_stmt_bind_param($inststmt,'ssssss',$product,$supplier,$quantity,$quantity,$unit,$total);
                mysqli_stmt_execute($inststmt);
                echo "Item Added to Inventory";?>
                 <script>
                    setTimeout(() => {
                        location.reload()
                    }, 2000);
                 </script>
            <?php }
        }
    
    }
}








/*end*/
?>