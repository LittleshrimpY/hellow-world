<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<form action="dologin.php?url=<?=$_SERVER['HTTP_REFERER']?>" method="post">
    <div class="page-wrap">
            <div class="w">
                <div class="user-con">
                    <div class="user-title">用户登录</div>
                    <div class="user-box">
                        <div class="error-item">
                            <i class="fa fa-minus-circle error-icon"></i>
                            <p class="err-msg">Error</p>
                        </div>
                        <div class="user-item">
                            <label class="user-label" for="">
                                <i class="fa fa-user"></i>
                            </label>
                            <input class="user-content" id="username" placeholder="请输入用户名" autocomplete="off" name="username">
                        </div>
                        <div class="user-item">
                            <label class="user-label" for="password">
                                <i class="fa fa-lock"></i>
                            </label>
                            <input type="password" class="user-content" id="password" placeholder="请输入密码" autocomplete="off" name="password">
                        </div>
                        <input type="submit" class="btn btn-submit" id="submit">
                        <div class="link-item">
                            <a class="link" href="./reset.html" target="_blank">忘记密码</a>
                            <a class="link" href="./register.html" target="_blank">免费注册</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>