<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<meta name="keywords" content="<?php bloginfo( 'name' ) ?>">
<meta name="description" content="页面没有找到，<?php bloginfo( 'name' ) ?>">
<title>
<?php 
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
?>
</title>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/style.css">
</head>

<body style="text-align:center">

<div style="left: 0px;" id="rocket"><span style="margin-left: -8px; left: 50px; bottom: 78px;" class="steam1"></span></div>

<hgroup>
    <h1>页面没有找到。。。</h1>
    <h2>内容可能被转移，非常感谢亲的来访，我们正在努力的升级修正，当下，您可以<a href="http://www.html580.com/"><b>返回首页</b></a>查看更多精彩内容。亲，记得

一定要回访哦。。</h2>
    <h2>如果亲有网站开发的需要，请联系站长哦！QQ:<a href="tencent://message/?uin=280160522&amp;Site=html580.com&amp;Menu=yes" 

target="_blank">280160522</a></h2>
</hgroup>

<script src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.js"></script>
<script type="text/ecmascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/error.js"></script>



</body>
</html>