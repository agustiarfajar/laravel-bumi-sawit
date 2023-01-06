<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Bumi Sawit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Karla' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
}
body{
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background: #f7f7f7;
}
.wrapper{
    background: #fff;
    width: 450px;
    box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
                0 32px 64px -48px rgba(0,0,0,0.5);
    border-radius: 30px;
}

/* Signup Form CSS Code */
.form{
    padding: 25px 30px;
    border-radius: 20px;
}
.form header{
    font-size: 25px;
    font-weight: 600;
    padding-bottom: 10px;
    border-bottom: 1px solid #e6e6e6;
    text-align: center;
}
.form header img {
    width: 200px;
}
.form form{
    margin: 20px 0;
}
.form form .error-txt{
    color: #721c24;
    background: #f8d7da;
    padding: 8px 10px;
    text-align: center;
    border-radius: 5px;
    margin-bottom: 10px;
    border: 1px solid #f5c6cb;
}

.form form .name-details{
    display: flex;
}
.form form .name-details .field:first-child{
    margin-right: 10px;
}
.form form .name-details .field:last-child{
    margin-left: 10px;
}
.form form .field{
    position: relative;
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
}
.form form .field label{
    margin-bottom: 2px;
}
.form form .field input{
    outline: none;
}
.form form .input input{
    height: 40px;
    width: 100%;
    font-size: 16px;
    padding: 0 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.form form .image input{
    font-size: 17px;
}
.form form .button input{
    margin-top: 13px;
    height: 45px;
    border: none;
    font-size: 17px;
    font-weight: 500;
    background: #333;
    color: #fff;
    border-radius: 40px;
    cursor: pointer;
}
.form form .field i{
    position: absolute;
    right: 15px;
    color: #ccc;
    top: 70%;
    transform: translateY(-50%);
    cursor: pointer;
}
.form .link{
    text-align: center;
    margin: 10px 0;
    font-size: 17px;
}
.form .link a{
    color: #333;
    text-decoration: none;
}
.form .link a:hover{
    text-decoration: underline;
}
.form .remember{
    margin-bottom: 10px;
}
.form .remember label{
    margin-left: 5px;
}
</style>
</head>
<body>
<!-- ALERT -->
<?php 
function showError($error)
{   
    ?>
    <div class="toast position-fixed top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <span class="text-danger"><i class="bi bi-square-fill"></i></span>
            <strong class="me-auto">&nbsp;Alert</strong>
            
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php echo $error ?>
        </div>
    </div>
    
<?php
}
function showSuccess($success)
{   
    ?>
    <div class="toast position-fixed top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <span class="text-success"><i class="bi bi-square-fill"></i></span>
            <strong class="me-auto">&nbsp;Alert</strong>
            
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php echo $success ?>
        </div>
    </div>
    
<?php
}
?>
<!-- END OF ALERT -->
<div class="wrapper">
    <section class="form signup">
        <header>
            <img src="{{asset('assets/images/2.png')}}" alt="">
            <p class="text-muted mt-3 mb-1" style="font-size:12px">Log in as Administrator</p>
        </header>
        <form action="{{url('doLoginAdmin')}}" method="post"> 
            @if(session()->has('error'))
            <p><?php echo showError(Session::get('error')); ?></p>
            @elseif(session()->has('success'))
            <p><?php echo showSuccess(Session::get('success')); ?></p>
            @endif 
            @csrf         
            <div class="field input">
            @error('email')
            <p>{{ showError($message) }}</p>
            @enderror
                <label>Email Address</label>
                <input type="text" name="email" value="{{ (Cookie::get('remember_admin') == 'remembered') ? Cookie::get('email_admin') : '' }}" placeholder="Enter your email">
            </div>
            <div class="field input">
            @error('password')
            <p>{{ showError($message) }}</p>
            @enderror
                <label>Password</label>
                <input type="password" id="pass_log_id" name="password" value="{{ (Cookie::get('remember_admin') == 'remembered') ? Cookie::get('password_admin') : '' }}" placeholder="Enter your password">
                <i class="fas fa-eye toggle-password"></i>
            </div>
            <div class="remember">
                <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1" {{ (Cookie::get('remember_admin') == 'remembered') ? 'checked' : '' }}>
                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>
            <div class="field button">
                <input type="submit" value="Login">
            </div>
        </form>
        <!-- <div class="link">Belum punya akun? <a href="register">Register</a></div> -->
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script>
	$(document).ready(function(){
        $('.toast').toast('show');

        $("body").on('click', '.toggle-password', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#pass_log_id");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    })
</script>
</body>
</html>