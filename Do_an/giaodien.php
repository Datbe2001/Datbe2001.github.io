<?php 
        session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/giaodien.css">
    <link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="menu">
            <div class="menuleft">
                <ul>
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">Khóa học</a></li>
                    <li><a href="#">Hỏi đáp</a></li>
                    <li><a href="#">Bài viết</a></li>
                    <li><a href="#">Tài trợ</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </div>

            <div class="menuright">
                <ul>
                    <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                        <ul class="sub-menu">
                            <li><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i>Đặt câu hỏi</a></li>
                            <li><a href="#"><i class="fa fa-file" aria-hidden="true"></i>Viết bài</a></li>
                            <li><a href="#"><i class="fa fa-list" aria-hidden="true"></i>Tạo series</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i>Tài khoản<i
                                class="fa fa-sort-desc" aria-hidden="true"></i></a>
                        <ul class="sub-menu">
                            <li><button class="js-btn-login btn-submit" ><i class="fa fa-user" aria-hidden="true"></i></i>Đăng nhập</button></li>
                            <li><button class="js-btn-register btn-submit"><i class="fa fa-user-plus" aria-hidden="true"></i></i>Đăng ký</button></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div style="clear: both"></div>
        <div class="content">
            <div class="left">
                <h3 style="color: rgb(255, 106, 0);">KHÓA HỌC</h3>
                <h1>Thư viện khóa học lập trình từ cơ bản đến nâng cao</h1>
                <p>Python ? C++ ? C# hay Java <br>
                    Bạn lựa chọn ngôn ngữ nào để bắt đầu chặn đường trở thành lập trình viên của mình?
                </p>
                <a href="#"><button name="bthocngay" type="button" onclick="hello()">Học ngay</button></a>
                <script> function hello(){ alert("Vui lòng đăng nhập")  ; }</script>
            </div>
            <div class="right">
                <a href="#" class="hocngay"><img src="./font/img/hocngay.png" style="width: 140px;height:126px"></a>
                <a href="#" class="hoidap"><img src="./font/img/hoidap.png" style="width: 90px;height:90px"></a>
                <a href="#" class="kter"><img src="./font/img/kter.png" style="width: 100px;height:100px"></a>
                <a href="#" class="phanhoi"><img src="./font/img/phanhoi.png" style="width: 90px;height:90px;"></a>
                <a href="#" class="tailieu"><img src="./font/img/tailieu.png" style="width: 100px;height:100px"></a>
                <a href="#" class="taitro"><img src="./font/img/taitro.png" style="width: 110px;height:110px"></a>
                <div class="circle1"></div>
                <div class="circle2"></div>
                <div class="circle3"></div>
            </div>
        </div>
    </div>

    <div class="form-login js-form-login">
        <form class="login__container"  action="login_submit.php" method="POST" >
            <div class="login-close">
                <i class="fas fa-times"></i>
            </div>
            <header class="login-header">
                Đăng nhập
            </header>

            <div class="login-body">
                <label for="name"class="login-label">
                    Username
                </label>
                <input type="text" id="name" class="login-input" required  name="username" placeholder="Username">

                <label for="matkhau" class="login-label">
                    Mật khẩu
                </label>
                <input type="password" id="matkhau" class="login-input" required name="password" placeholder="Uassword">

                <button id="login-btn" name="submit_login">
                    Đăng nhập
                </button>
            </div>
            
            <footer class="login-footer">
                <p class="text-wning"><a href="">Quên mật khẩu?</a></p>
                
            </footer>
        </form>
    </div>
   
    <div class="form-register js-form-register">
        <form class="register__container" id="form_register" action="register_submit.php" method="POST">
            <div class="register-close">
                <i class="fas fa-times"></i>
            </div>
            <header class="register-header">
                Đăng ký
            </header>

            <div class="register-body">
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="name"class="register-label">
                        Username
                    </label>
                    <input type="text" id="name" name="username"  class="register-input" required placeholder="Username">
                    <span class="form-message"></span>
                </div>

                <div class="form-group " style="margin-bottom: 20px;">
                    <label for="email" class="register-label">
                        Email
                    </label>
                    <input type="text" id="email" name="email"  class="register-input" required placeholder="Email">
                    <span class="form-message"></span>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="password" class="register-label">
                        Mật khẩu
                    </label>
                    <input type="password" name="password"  id="password"  class="register-input" required placeholder="Password">
                    <span class="form-message"></span>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="repassword" class="register-label">
                        Nhập lại mật khẩu
                    </label>
                    <input type="password"  name="repassword"  id="repassword"  class="register-input" required  placeholder="Retype Password">
                    <span class="form-message"></span>
                </div>

                <p>
                    <?php
                    if( isset($_SESSION["thongbao"])){
                        echo $_SESSION["thongbao"];
                        session_unset("thongbao");
                    }
                    ?>
                </p>
                <button id="register-btn" name="submit">
                    Đăng ký
                </button>
            </div>
            
            <footer class="register-footer">
                <p class="text-wning">Nedd <a href="">help?</a></p>
                
            </footer>
        </form>
    </div>
    
    <script src="./validator.js"></script>
    <script>

        Validator({
            form: '#form_register',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequied("#name", 'Vui lòng nhập tên đẩy đủ của bạn'),
                Validator.isRequied("#email"),
                Validator.isEmail("#email"),
                Validator.minLenght("#password",6),
                Validator.isRequied("#repassword"),
                Validator.isConfirmed("#repassword", function(){
                    return document.querySelector('#form_register #password').value;
                }, 'Mật khẩu nhập lại không chính xác'),

            ],

            onsubmit: function(data){

            }

        });
    </script>

    <script>
        const LoginBtn = document.querySelector('.js-btn-login');
        const RegisterBtn = document.querySelector('.js-btn-register');
        const CloseLogin = document.querySelector('.login-close');
        const CloseRegister = document.querySelector('.register-close');
        const FormLogin = document.querySelector(".js-form-login");
        const FormRegister = document.querySelector(".js-form-register");
        const LoginContainer = document.querySelector('.login__container');
        const RegisterContainer = document.querySelector('.register__container');


        // Đăng ký
        LoginBtn.addEventListener('click',showFormLogin)
        CloseLogin.addEventListener('click',hideFormLogin);
        function showFormLogin(){
            FormLogin.classList.add('open');
        }
        function hideFormLogin(){
            FormLogin.classList.remove('open');
        }

        LoginContainer.addEventListener('click', function(event){
            event.stopPropagation()
        })


        
        // Đăng nhập
        RegisterBtn.addEventListener('click',showFormRegister)
        CloseRegister.addEventListener('click',hideFormRegister)
        function showFormRegister(){
            FormRegister.classList.add('open');
        }
        function hideFormRegister(){
            FormRegister.classList.remove('open');
        }
        RegisterContainer.addEventListener('click', function(e){
            e.stopPropagation()
        })

        
        
        
        FormLogin.addEventListener('click', hideFormLogin) //Click Khoảng không
        FormRegister.addEventListener('click', hideFormRegister) //Click Khoảng không


    </script>
</body>

</html>