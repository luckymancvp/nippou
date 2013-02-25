<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>ONE OF THEM APVN - coming soon</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="css/style.css" rel="stylesheet">
  <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <script src="js/jquery.min.js"></script>
  <script src="js/notify.js"></script>

  <script>

    var nc = null;
    function getNotify(){
        $.ajax({
            "url" : "/notify_center/get",
            "success" : function(notify){
                if (!notify) return;
                nc.notify({
                    title   : notify.title ,
                    content : notify.content,
                    icon    : "/favicon.gif",
                    desktopNotification: true
                })
            }
        });
        window.setTimeout("getNotify()", 60000);
    };

    $(document).ready(function(){
        nc = notificationCenter();
        if ( window.webkitNotifications && (window.webkitNotifications.checkPermission() == 0))
            getNotify();
    });
  </script>

  <link rel="shortcut icon" href="/images/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="/images/apple-touch-icon-57-precomposed.png">
</head>
<body class="background-navy">
  <?php
  $startDate   = strtotime("2013-02-25");
  $endDate     = strtotime("2013-03-25");
  $currentDate = time();
  $percentage  =(int) (($currentDate - $startDate) / ($endDate - $startDate)*100);
  ?>
<header>
  <div class="logo"><a href="#"><img src="images/text-logo.png" class="logo" alt="" /></a></div>
  <div class="ribbon"><img src="images/ribbon.png" alt="" /></div>
</header>

<section>
  <div id="timer">
    <div id="d1"></div>
    <div id="d2"></div>
    <div id="h1"></div>
    <div id="h2"></div>
    <div id="m1"></div>
    <div id="m2"></div>
    <div id="s1"></div>
    <div id="s2"></div>
  </div>
  <div class="progress"><div class="bar" data-progress="<?php echo $percentage?>"></div><div class="tooltip"></div></div>
</section>


<footer>
  <div class="container">
    <ul class="social">
      <li><a href="http://facebook.com/luckymancvp"><img src="images/social-facebook.png" alt="" /></a></li>
      <li><a href="http://twitter.com/luckymancvp"><img src="images/social-twitter.png" alt="" /></a></li>
      <li><a href="http://plus.google.com/luckymancvp"><img src="images/social-google-plus.png" alt="" /></a></li>
    </ul>
    <form action="" method="post" class="notify">
      <input type="text" class="field" name="email" placeholder="Your e-mail" />
      <input type="submit" class="button" name="submit" value="" />
    </form>
  </div>
</footer>
<script src="js/timer.js"></script>
<script src="js/style.js"></script>
</body>
</html>