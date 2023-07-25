<p class="page-title">Home > Supplier</p>
<div class="page-panel">
<div class="home-page">
    <div class="table-side">
        <table id="tbl"cellspacing="0">
            <thead>
                <tr>
                    <th hidden>ID</th>
                    <th>Supplier's Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $result=$conn->query("select * from supplier");
                    while($rows=mysqli_fetch_assoc($result)){?>
                        <tr>
                            <td hidden><?php echo $rows['id'];?></td>
                            <td><?php echo $rows['supplier'];?></td>
                            <td>
                            <i class="fa fa-edit"></i>
                        <i class="fa fa-trash"></i>
                            </td>
                        </tr>
                        <?php }
                ?>
            </tbody>
        </table>
    </div>
    <div class="add-side">
        <span class="page-title">ADD SUPPLIER</span>
        <form action=""id="frm-sup">
            <input type="hidden"name="txt-id"id="txt-id">
            <input type="text" autocomplete="off" placeholder="Supplier's Name"name="name" id="txt-sup"required>
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
    $('#frm-sup').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            url:'serverside.php?action=btn-sup',
            method:'POST',
            data:$('#frm-sup').serialize(),
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
    $('.fa-edit').on('click', function(){
        document.getElementById('txt-id').value=$(this).closest('tr').find('td:eq(0)').text().trim()
        document.getElementById('txt-sup').value=$(this).closest('tr').find('td:eq(1)').text().trim()
        
    })
    $('.fa-trash').on('click', function(){
        data=$(this).closest('tr').find('td:eq(0)').text().trim()
        var status=confirm('Delete this category?');
        if(status==true){
            $.ajax({
            url:'serverside.php?action=btn-del-sup',
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
</script>