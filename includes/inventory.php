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
                    <th hidden>#</th>
                    <th style="width:20%">Item Name</th>
                    <th style="width:20%">Category</th>
                    <th style="width:20%">Supplier</th>
                    <th style="width:15%">Quantity</th>
                    <th style="">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $result=$conn->query("select * from (select inventory.id as proid, product_id, supplier_id, previous_quantity, new_quantity, measurement_unit,total_bp from inventory) inventory  inner join products on product_id=products.id inner join supplier on supplier_id = supplier.id inner join category on products.category=category.id order by proid desc");
                    while($rows=mysqli_fetch_assoc($result)):?>
                    <tr>
                    <th hidden><?php echo $rows['proid'];?></th>
                    <td style="width:20%"><?php echo $rows['name'];?></td>
                    <td style="width:20%"><?php echo $rows['cat_name'];?></td>
                    <td style="width:20%"><?php echo $rows['supplier'];?></td>
                    <td style="width:15%"><?php echo $rows['new_quantity']." ".$rows['measurement_unit'];?></td>
                    <td style="w">
                        <i class="fa fa-eye"></i>
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash"></i>
                    </td>
                    </tr>
                <?php endwhile;?>
                
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