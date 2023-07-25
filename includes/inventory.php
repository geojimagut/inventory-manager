<div id="invent-item">
<div class="invent-form">
        <form action="">
        <select name="" id="">
                <option value=""selected="false"disabled>Product</option>
                <option value="">Supplier 1</option>
                <option value="">Supplier 2</option>
            </select>
            <select name="supplier" id=""required>
                <option value=""selected="false"disabled>Supplier</option>
                <?php
                    $result=$conn->query("select * from supplier order by id desc");
                    while($row=mysqli_fetch_assoc($result)){?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['supplier'];?></option>
                    <?php }
                ?>
            </select>
            <select name="category" id=""required>
            <option value=""selected="false"disabled>Category</option>
            <?php
                    $result=$conn->query("select * from category where status='1' order by id desc");
                    while($row=mysqli_fetch_assoc($result)){?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['cat_name'];?></option>
                    <?php }
                ?>
            </select>
            <input type="number"placeholder="Quantity">
            <input type="number"placeholder="Total Buying Price">
            <input type="number"placeholder="Individual Selling Price">
            <!-- <span>Total Selling Price</span>
            <input type="text"readonly> -->
        </form>
</div>
<div class="invent-bottom">
    <button>SAVE</button>
    <span class="btn-cancel">CANCEL</span>
</div>
</div>

<!-- end -->
<p class="page-title">Home > Inventory</p>
<div class="page-panel">
    <div class="btn-panel">
    <button class="btn-add"id="btn-add-item"><i class="fa fa-plus"></i> ADD ITEM</button>
    </div>
    
<div class="home-page inventory">
    <div class="table-side">
        <table id="tbl"cellspacing="0">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kitchen Appliances</td>
                    <td>Active</td>
                    <td>Something</td>
                    <td>Something</td>
                    <td>
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--div class="add-side">
        <span class="page-title">ADD CATEGORY</span>
        <form action="">
            <input type="text"placeholder="Item Name">
            <input type="number"placeholder="Quantity">
            <input type="number"placeholder="Total Price">
            <input type="file">
            <select name="" id="">
                <option value=""selected="false"disabled>Supplier</option>
                <option value="">Supplier 1</option>
                <option value="">Supplier 2</option>
            </select>
            <select name="" id="">
                <option value=""selected="false"disabled>Category</option>
                <option value="">Category 1</option>
                <option value="">Category 2</option>
            </select>
            <button>SAVE</button>
        </form>
    </div-->
</div>
</div>
<?php include('footer.php');?>
<script>
    $('#btn-add-item').on('click', function(){
        document.getElementById('invent-item').style.display='block'
        document.getElementById('darkness').style.display='block'
    })
    $('.btn-cancel').on('click', function(){
        document.getElementById('invent-item').style.display='none'
        document.getElementById('darkness').style.display='none'
    })
</script>