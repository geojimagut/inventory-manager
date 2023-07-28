<p class="page-title">Home > Products</p>
<div class="page-panel">
<div class="home-page">
    <div class="table-side">
        <table id="tbl"cellspacing="0">
            <thead>
                <tr>
                    <th hidden>id</th>
                    <th style="width:30%">Photo</th>
                    <th style="width:40%">Product Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $result=$conn->query("select * from (select products.id as proid, name, photo, category from products) products  inner join category on category.id=products.category order by proid desc");
                    while($rows=mysqli_fetch_assoc($result)):?>


                <tr>
                    <td hidden><?php echo $rows['proid'];?></td>
                    <td style="width:30%"><img src="products/<?php echo $rows['photo']; ?>" alt="Oops"></td>
                    
                    <td style="width:40%">
                        <span>Name: <?php echo "<span class='tbl-detail pro-name'>".$rows['name']."</span>";?></span><br>
                        <span>Category: <?php echo "<span class='tbl-detail pro-name'>".$rows['cat_name']."</span>";?></span>
                    </td>
                    <td>
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash"></i>
                    </td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </div>
    <div class="add-side">
        <span class="page-title">ADD CATEGORY</span>
        <form action=""id="frm-pro">
            <input type="hidden"id="txt-id"name="txt-id">
            <input type="text"placeholder="Item Name"name="name"id="txt-name"required>
            <select name="category" id="txt-cat"required>
            <option value=""selected="false"disabled>Category</option>
            <?php
                    $result=$conn->query("select * from category where status='1' order by id desc");
                    while($row=mysqli_fetch_assoc($result)){?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['cat_name'];?></option>
                    <?php }
                ?>
            </select>
            <input type="file"name="file">
           
            <button>SAVE</button>
        </form>
        <div class="reponse"id="response">
        <i class='fa fa-close'></i> <span id="resp"></span>
        </div>
    </div>
</div>
</div>
<?php include('footer.php');?>
<script>
    $('#frm-pro').on('submit', function(e){
        e.preventDefault()
        $.ajax({
    url: "serverside.php?action=btn-pro",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    // $("#preview").fadeOut();
    // $("#err").fadeOut();
   },
   success: function(resp)
      {
        $('#resp').html(resp);
        document.getElementById('response').style.display='flex'
      },
     error: function(e) 
      {
        $('#resp').html(resp);
        document.getElementById('response').style.display='flex'
      }          
    });

    })
    $('.fa-close').on('click', function(){
        document.getElementById('response').style.display='none'
        document.getElementById('jibu').style.display='none'
    })
    $('.fa-trash').on('click', function(){
        data=$(this).closest('tr').find('td:eq(0)').text().trim()
        var status=confirm('Delete this product?');
        if(status==true){
            $.ajax({
            url:'serverside.php?action=btn-del-pro',
            method:'POST',
            data:{data:data},
            success:function(resp){
                $('#la-jibu').html(resp);
                document.getElementById('darkness').style.display='block'
                document.getElementById('jibu').style.display='flex'
            }
        }) 
        }
    })
    $('.fa-edit').on('click', function(){
        document.getElementById('txt-id').value=$(this).closest('tr').find('td:eq(0)').text().trim()
        document.getElementById('txt-name').value=$(this).closest('tr').find('.pro-name').text().trim()
        
    })
</script>