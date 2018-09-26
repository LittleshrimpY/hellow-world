
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理界面</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        ul,ol{
            list-style: none;
        }
        .header{
            width:100%;
            height: 120px;
            background: #bbb;
            line-height:120px;
            overflow: hidden;
        }
        .header h1{
           float:left;
           padding-left:10px;
        }
        .header p{
           float:right;
           padding-right:10px;
        }
        .wrap{
            position: relative;
            width:100%;
            height: 600px;
            overflow: hidden;
        }
        .wrap .menu{
            position: absolute;
            width:200px;
            height: 600px;
            background: #0ff;
        }
         .wrap .menu a:hover{
            color: red;
        }
        .wrap .right{
           position: absolute;
           width:100%;
           height: 600px;
           margin-left: 220px;
        }
        .menu h3{
            font-size:25px;
            padding: 4px 0 4px 8px; 
        }
        .menu ul{
            padding-left:20px; 
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>点资讯CMS管理系统V1.0</h1>
        <p>欢迎你 admin</p>
    </div>
    <div class="wrap">
        <div class="menu">
            <h3>新闻管理</h3>
            <ul>
                <li><a href="addnew.php" target="myframe">新闻添加</a></li>
                <li><a href="listnew.php" target="myframe">新闻列表</a></li>
                <li><a href="flagdel.php" target="myframe">回收站</a></li>
            </ul>
            <h3>分类管理</h3>
            <ul>
                <li><a href="#">分类添加</a></li>
                <li><a href="#">分类列表</a></li>
                <li><a href="#">回收站</a></li>
            </ul>
            <h3>广告位管理</h3>
            <ul>
                <li><a href="#">广告添加</a></li>
                <li><a href="#">广告列表</a></li>
                <li><a href="#">回收站</a></li>
            </ul>
            <h3>会员管理管理</h3>
            <ul>
                <li><a href="#">新闻列表</a></li>
                <li><a href="#">评论管理</a></li>
            </ul>
            <h3>管理员管理</h3>
            <ul>
                <li><a href="#">管理员列表</a></li>
            </ul>
        </div>
        <div class="right">
            <iframe width="100%" height="600" src="welcome.html" frameborder="no" name="myframe"></iframe>
        </div>
    </div>

</body>
</html>