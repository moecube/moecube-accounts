<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="shortcut icon" href="ico/favicon.png">-->

    <title><?php echo ($app["name"]); ?> - 用户登录</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- 这段只需要在有验证码的页面有 但是在模板架构下不知道如何实现-->
    <link href="captcha/captcha.css" rel="stylesheet" type="text/css" />
    <!-- /这段只需要在有验证码的页面有 但是在模板架构下不知道如何实现 -->

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Wrap all page content here -->
<div id="wrap">

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>-->
                <a class="navbar-brand" href="#"><?php echo ($app["name"]); ?></a>
            </div>
            <!--<div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
            </div>--><!--/.nav-collapse -->
        </div>
    </div>

    <!-- Begin page content -->
    <div class="container">
        <div class="page-header">
    <h1>创建您的账户</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8" style="text-align: center">
            <p class="lead" style="margin-bottom: 5px;">呜喵</p>
            <p>呜喵呜喵呜喵呜喵</p>
            <img style="width:36px;height:36px" src="../../img/iduel.png">
            <img style="width:36px;height:36px" src="../../img/mycard.png">
        </div>
        <div class="col-md-4" style="background: #f1f1f1;padding: 25px;">
            <form role="form">
                <div class="form-group">
                    <label for="name">用户名</label>
                    <input type="text" class="form-control" id="name" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" class="form-control" id="password" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password-confirm">密码确认</label>
                    <input type="password" class="form-control" id="password-confirm" placeholder="">
                </div>
                <div class="form-group">
                    <label for="email">电子邮件</label>
                    <input type="email" class="form-control" id="email" placeholder="">
                </div>
                <div class="ajax-fc-container">You must enable javascript to see captcha here!</div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> 我同意接受 MoeID <a href="#">服务条款</a> 。
                    </label>
                </div>
                <button type="submit" class="btn btn-primary pull-right">提交</button>
            </form>
        </div>
    </div>
</div>

    </div>
</div>

<div id="footer">
    <div class="container">
        <ul id="footer-list" class="list-inline pull-left">
            <li><span dir="ltr" class="text-muted">© 2013 <?php echo ($app["name"]); ?></span></li>
            <li><a href="https://accounts.google.com/TOS?hl=zh-CN">服务条款</a></li>
            <li><a href="http://www.google.com/intl/zh-CN/privacy/">隐私权政策</a></li>
            <li><a href="http://www.google.com/support/accounts?hl=zh-CN">帮助</a></li>
        </ul>
  <span id="lang-chooser-wrap" class="lang-chooser-wrap pull-right" style="">
  <img src="//ssl.gstatic.com/images/icons/ui/common/universal_language_settings-21.png">
  <select id="lang-chooser" class="lang-chooser">
      <option value="zh-CN" selected="selected">
          ‪简体中文‬
      </option>
  </select>
  </span>

    </div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-2.0.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- 这段只需要在有验证码的页面有 但是在模板架构下不知道如何实现-->
<script src="js/jquery-ui.min.js"></script>
<script src="captcha/jquery.captcha.js"></script>
<script>
    $(".ajax-fc-container").captcha({
        text: "验证码<br />请把 <span>Loading</span> 拖进右侧圆圈.",
        items: Array("青眼白龙", "黑魔导少女", "星尘龙", "死者苏生", "神之宣告"),
        borderColor: "silver",
        url: "/?s=users/captcha"
    });
</script>
<!-- /这段只需要在有验证码的页面有 但是在模板架构下不知道如何实现 -->

</body>
</html>