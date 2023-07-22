<div class="container-wrapper">
    <div class="login-form">
        <form id="frm-login">
            <input type="text"placeholder="Username"name="username"required><br>
            <input type="password"placeholder="Password"name="password"required><br>
            <button>LOGIN</button>
        </form>
        <a href="">Forgot password?</a>
        <div class="reponse"id="response">
        <i class='fa fa-close'></i> <span id="resp"></span>
        </div>
    </div>
</div>
<?php include('footer.php');?>
<script>
    $('#frm-login').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            url:'serverside.php?action=btn-login',
            method:'POST',
            data:$('#frm-login').serialize(),
            success:function(resp){
                $('#resp').html(resp);
                document.getElementById('response').style.display='flex'
            }
        })
    })
    $('.fa-close').on('click', function(){
        document.getElementById('response').style.display='none'
    })
</script>