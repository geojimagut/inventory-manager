<div id="invent-item">
<div class="invent-form">
        <form action=""id="frmInventory">
        <select name="product" id="">
        <option value=""selected="false"disabled>Product</option>
                <?php
                    $result=$conn->query("select * from products order by id desc");
                    while($row=mysqli_fetch_assoc($result)){?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                    <?php }
                ?>
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
            <div class="two-parts">
            <input type="number"placeholder="Quantity"name="quantity">
            <input type="text"placeholder="Measurement Unit"name="unit">
            </div>
            <input type="number"placeholder="Total Buying Price"name="buying-price">
</div>
<div class="invent-bottom">
    <button>SAVE</button>
    <span class="btn-cancel">CANCEL</span>
        </form>
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
</div>
</div>
<?php include('footer.php');?>
<script>
    $('#frmInventory').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            url:'serverside.php?action=btn-inventory',
            method:'POST',
            data:$('#frmInventory').serialize(),
            success:function(resp){
                $('#la-jibu').html(resp);
                document.getElementById('jibu').style.display='flex'
            }
        })
    })
    $('#btn-add-item').on('click', function(){
        document.getElementById('invent-item').style.display='block'
        document.getElementById('darkness').style.display='block'
    })
    $('.btn-cancel').on('click', function(){
        document.getElementById('invent-item').style.display='none'
        document.getElementById('darkness').style.display='none'
    })
</script>