<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo !empty( $title_for_layout ) ? $title_for_layout . ' | ' : '' ?>Recipies</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le styles -->
        <link href="/css/bootstrap.css" rel="stylesheet">
        <link href="/css/core.css" rel="stylesheet">
        <style type="text/css">
          body {
            padding-top: 60px;
          }
        </style>
      <script src="/js/jquery.min.js"></script>
      <script src="/js/bootstrap-alerts.js"></script>
      <script src="/js/bootstrap.js"></script>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/apple-touch-icon-114x114.png">
  </head>

  <body>
    <div class="topbar">
        <div class="fill">
            <div class="container">
                <a class="brand" href="/">Recipies</a>
                <?php echo $this->element( 'sitewide/top_navigation' ); ?>
            </div>
        </div>
    </div>
    <div class="container">
        <?php echo $this->element('sitewide/messages'); ?>
        <?php echo $content_for_layout; ?>
        <footer>
            <p>&copy; Company 2011</p>
        </footer>
    </div> <!-- /container -->
  </body>
</html>