<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">

</head>

<body class="text-center">
    <form class="form-signin" method="post" action="{{route('employee.login')}}">
        <img class="mb-4 hinhlogo" src="./img/logo_moi_van_lang_Page_09.jpg" alt="" width="100%" height="110">
        <h1 class="h3 mb-3 font-weight-normal"></h1>
        <!-- <label for="inputEmail" class="sr-only">Tài khoản</label> -->
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Tài Khoản" required autofocus>
        <!-- <label for="inputPassword" class="sr-only">Mật Khẩu</label> -->
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mật Khẩu" required>
        <div class="checkbox mb-3" style="font-weight: 600">
            <label style="color:rgb(5, 126, 255);">
                <input type="checkbox" value="remember-me" name="remember"> Remember me
            </label>
            <label for="">
                <a class="quenmatkhau" href="#" style="color:rgb(5, 126, 255);">Bạn quên mật khẩu ?</a>
            </label>
        </div>
        <button class="btn btn-lg  btn-block" style="background-color: rgb(0,123,255);color:white;" type="submit">Đăng Nhập</button>
        <!-- <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p> -->
    </form>



    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
        crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>

</html>
