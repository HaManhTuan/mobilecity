
<!DOCTYPE html>
<html lang="en">
<head>
  <base href="{{ asset('') }}">
  <title>Login V1</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="backend/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="backend/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="backend/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="backend/login/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="backend/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="backend/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="backend/login/css/util.css">
  <link rel="stylesheet" type="text/css" href="backend/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="backend/login/images/img-01.png" alt="IMG">
        </div>

        <form class="login100-form validate-form" method="POST" id="frm-login" onsubmit="return false;">
          @csrf
          <span class="login100-form-title">
           ĐĂNG NHẬP QUẢN TRỊ
          </span>

          <div class="wrap-input100 validate-input" data-validate = "Email phải đúng định dạng xyz@abc">
            <input class="input100" type="text" name="email" placeholder="Email">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Mật khẩu không được để trống">
            <input class="input100" type="password" name="pass" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>
          
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" id="btn-login">
              Đăng nhập
            </button>
          </div>

          <div class="text-center p-t-12">
            <span class="txt1">
              Quên
            </span>
            <a class="txt2" href="#">
              Tài khoản / Mật khẩu?
            </a>
          </div>

{{--           <div class="text-center p-t-136">
            <a class="txt2" href="{{ route('admin.register') }}">
              Tạo tài khoản
              <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
          </div> --}}
        </form>
      </div>
    </div>
  </div>
  
  

  
<!--===============================================================================================-->  
  <script src="backend/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="backend/login/js/notify.min.js"></script>
<!--===============================================================================================-->
  <script src="backend/login/vendor/bootstrap/js/popper.js"></script>
  <script src="backend/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="backend/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="backend/login/vendor/tilt/tilt.jquery.min.js"></script>
  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
    $('#btn-login').click(function(){
     $.ajax({
       url: "{{ route('admin.loginpost') }}",
       type: 'POST',
       dataType: 'JSON',
       data: $("#frm-login").serialize(),
       success: function(data){
        if (data.status == "_success") {
          $("#btn-login").notify(data.msg, 'success');
          setTimeout(function(){ window.location.href="{{ route('admin.dashboard.index')}}"; }, 2000);
        }
        else {
          $("#btn-login").notify(data.msg, 'error');
        }
       },
       error: function(err){
        console.log(err);
       }
     });
    })
  </script>
<!--===============================================================================================-->
  <script src="backend/login/js/main.js"></script>

</body>
</html>