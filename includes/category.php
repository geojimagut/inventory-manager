<p class="page-title">Home > Categories</p>
<div class="page-panel">
<div class="home-page">
    <div class="table-side">
        <table id="tbl"cellspacing="0">
            <thead>
                <tr>
                    <th hidden></th>
                    <th>Category Name</th>
                    <th>Stauts</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $result=$conn->query("select * from category order by id desc");
                    while($rows=mysqli_fetch_assoc($result)):?>
                        <tr>
                            <td hidden><?php echo $rows['id'];?></td>
                            <td><?php echo $rows['cat_name'];?></td>
                            <td>
                                <?php
                                if($rows['status']=="1"){
                                    echo "<span class='active-cat'>Active</span>";
                                }else{
                                    echo "<span class='inactive-cat'>Inactive</span>";
                                }
                                ?>
                        </td>
                            <td>
                            <i class="fa fa-edit"></i>
                        <i class="fa fa-trash"></i>
                            </td>
                        </tr>
                        <?php endwhile;
                ?>
            </tbody>
        </table>
    </div>
    <div class="add-side">
        <span class="page-title">ADD CATEGORY</span>
        <form action=""id="frm-cat">
            <input type="hidden"name="txt-id"id="txt-id">
            <input type="text"placeholder="Category Name"name="name"required autocomplete="off" id="txt-cat"><br>
            <span class="page-title">Actve</span><input type="checkbox"value="1"name="status"><br>
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
    $('#frm-cat').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            url:'serverside.php?action=btn-cat',
            method:'POST',
            data:$('#frm-cat').serialize(),
            success:function(resp){
                $('#resp').html(resp);
                document.getElementById('response').style.display='flex'
            }
        })
    })
    $('.fa-close').on('click', function(){
        document.getElementById('response').style.display='none'
        document.getElementById('jibu').style.display='none'
    })
    $('.fa-trash').on('click', function(){
        data=$(this).closest('tr').find('td:eq(0)').text().trim()
        var status=confirm('Delete this category?');
        if(status==true){
            $.ajax({
            url:'serverside.php?action=btn-del-cat',
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
        document.getElementById('txt-cat').value=$(this).closest('tr').find('td:eq(1)').text().trim()
        
    })
</script>