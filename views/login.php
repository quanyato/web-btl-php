<!DOCTYPE html>
<html data-bs-theme="light" lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/Nunito.css">
    <link rel="stylesheet" href="public/fonts/fontawesome-all.min.css">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;public/img/login.webp&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Chào mừng Admin!</h4>
                                    </div>
                                    <form class="user" action="login" method="post">
                                        <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleInputUserName" placeholder="Tên đăng nhập" name="username"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Mật khẩu" name="password"></div>
                                        <?php if (isset($loginError)) echo "<p class='text-danger text-center'>$loginError</p>"; ?>
                                        <button class="btn btn-primary d-block btn-user w-100" type="submit">Đăng nhập</button>
                                        <hr>
                                        <a class="btn btn-primary d-block btn-google btn-user w-100 mb-2" role="button"><i class="fab fa-google"></i>&nbsp; Đăng nhập với Google</a>
                                        <a class="btn btn-primary d-block btn-facebook btn-user w-100" role="button"><i class="fab fa-facebook-f"></i>&nbsp; Đăng nhập với Facebook</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="public/bootstrap/js/bootstrap.min.js"></script>
    <script src="public/js/bs-init.js"></script>
    <script src="public/js/theme.js"></script>
</body>

</html>