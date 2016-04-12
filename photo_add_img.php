
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>通天塔</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="styles/1/basic.css" />
<link rel="stylesheet" type="text/css" href="styles/1/photo_add_img.css" /><script type="text/javascript" src="js/photo_add_img.js"></script>
</head>
<body>
<script type="text/javascript" src="js/skin.js"></script>
<div id="header">
	<h1><a href="index.php">瓢城Web俱乐部多用户留言系统</a></h1>
	<ul>
		<li><a href="index.php">首页</a></li>
		<li><a href="member.php">admin·个人中心</a> <strong class="noread"><a href="member_message.php">(0)</a></strong></li>
		<li><a href="blog.php">博友</a></li>
		<li><a href="photo.php">相册</a></li>
		<li class="skin" onmouseover='inskin()' onmouseout='outskin()'>
			<a href="javascript:;">风格</a>
			<dl id="skin">
				<dd><a href="skin.php?id=1">1.一号皮肤</a></dd>
				<dd><a href="skin.php?id=2">2.二号皮肤</a></dd>
				<dd><a href="skin.php?id=3">3.三号皮肤</a></dd>
			</dl>
		</li>
		
		<li><a href="manage.php" class="manage">管理</a></li> <li><a href="logout.php">退出</a></li>	</ul>
</div>
<div id="photo">
	<h2>上传图片</h2>
	<form method="post" name="up" action="?action=addimg">
	<input type="hidden" name="sid" value="4" />
	<dl>
		<dd>图片名称：<input type="text" name="name" class="text" /></dd>
		<dd>图片地址：<input type="text" name="url" id="url" readonly="readonly" class="text" /> <a href="javascript:;" title="photo/1286182238" id="up">上传</a></dd>
		<dd>图片描述：<textarea name="content"></textarea></dd>
		<dd><input type="submit" class="submit" value="添加图片" /></dd>
	</dl>
	</form>
</div>

<div id="footer">
	<p>本程序执行耗时为: 0.015秒</p>
	<p>版权所有 翻版必究</p>
	<p>本程序由<span>瓢城Web俱乐部</span>提供 源代码可以任意修改或发布 (c) yc60.com</p>
</div></body>
</html>
