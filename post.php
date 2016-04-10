<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>瓢城Web俱乐部(YC60.COM)</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="styles/1/basic.css" />
<link rel="stylesheet" type="text/css" href="styles/1/post.css" /><script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/post.js"></script>
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
<div id="post">
	<h2>发表帖子</h2>
	<form method="post" name="post" action="?action=post">
		<dl>
			<dt>请认真填写一下内容</dt>
			<dd>
				类　　型：
				<label for="type1"><input type="radio" id="type1" name="type" value="1" checked="checked" />  <img src="images/icon1.gif" alt="类型" /></label><label for="type2"><input type="radio" id="type2" name="type" value="2" />  <img src="images/icon2.gif" alt="类型" /></label><label for="type3"><input type="radio" id="type3" name="type" value="3" />  <img src="images/icon3.gif" alt="类型" /></label><label for="type4"><input type="radio" id="type4" name="type" value="4" />  <img src="images/icon4.gif" alt="类型" /></label><label for="type5"><input type="radio" id="type5" name="type" value="5" />  <img src="images/icon5.gif" alt="类型" /></label><label for="type6"><input type="radio" id="type6" name="type" value="6" />  <img src="images/icon6.gif" alt="类型" /></label><label for="type7"><input type="radio" id="type7" name="type" value="7" />  <img src="images/icon7.gif" alt="类型" /></label><label for="type8"><input type="radio" id="type8" name="type" value="8" />  <img src="images/icon8.gif" alt="类型" /></label><br />　　　 　　<label for="type9"><input type="radio" id="type9" name="type" value="9" />  <img src="images/icon9.gif" alt="类型" /></label><label for="type10"><input type="radio" id="type10" name="type" value="10" />  <img src="images/icon10.gif" alt="类型" /></label><label for="type11"><input type="radio" id="type11" name="type" value="11" />  <img src="images/icon11.gif" alt="类型" /></label><label for="type12"><input type="radio" id="type12" name="type" value="12" />  <img src="images/icon12.gif" alt="类型" /></label><label for="type13"><input type="radio" id="type13" name="type" value="13" />  <img src="images/icon13.gif" alt="类型" /></label><label for="type14"><input type="radio" id="type14" name="type" value="14" />  <img src="images/icon14.gif" alt="类型" /></label><label for="type15"><input type="radio" id="type15" name="type" value="15" />  <img src="images/icon15.gif" alt="类型" /></label><label for="type16"><input type="radio" id="type16" name="type" value="16" />  <img src="images/icon16.gif" alt="类型" /></label>			</dd>
			<dd>标　　题：<input type="text" name="title" class="text" /> (*必填，2-40位)</dd>
			<dd id="q">贴　　图：　<a href="javascript:;">Q图系列[1]</a>　 <a href="javascript:;">Q图系列[2]</a>　 <a href="javascript:;">Q图系列[3]</a></dd>
			<dd>
								<div id="ubb">
					<img src="images/fontsize.gif" title="字体大小" alt="字体大小" />
					<img src="images/space.gif" title="线条" alt="线条" />
					<img src="images/bold.gif" title="粗体" />
					<img src="images/italic.gif" title="斜体" />
					<img src="images/underline.gif" title="下划线" />
					<img src="images/strikethrough.gif" title="删除线" />
					<img src="images/space.gif" />
					<img src="images/color.gif" title="颜色" />
					<img src="images/url.gif" title="超链接" />
					<img src="images/email.gif" title="邮件" />
					<img src="images/image.gif" title="图片" />
					<img src="images/swf.gif" title="flash" />
					<img src="images/movie.gif" title="影片" />
					<img src="images/space.gif" />
					<img src="images/left.gif" title="左区域" />
					<img src="images/center.gif" title="中区域" />
					<img src="images/right.gif" title="右区域" />
					<img src="images/space.gif" />
					<img src="images/increase.gif" title="扩大输入区" />
					<img src="images/decrease.gif" title="缩小输入区" />
					<img src="images/help.gif" />
				</div>
				<div id="font">
					<strong onclick="font(10)">10px</strong>
					<strong onclick="font(12)">12px</strong>
					<strong onclick="font(14)">14px</strong>
					<strong onclick="font(16)">16px</strong>
					<strong onclick="font(18)">18px</strong>
					<strong onclick="font(20)">20px</strong>
					<strong onclick="font(22)">22px</strong>
					<strong onclick="font(24)">24px</strong>
				</div>
				<div id="color">
					<strong title="黑色" style="background:#000" onclick="showcolor('#000')"></strong>
					<strong title="褐色" style="background:#930" onclick="showcolor('#930')"></strong>
					<strong title="橄榄树" style="background:#330" onclick="showcolor('#330')"></strong>
					<strong title="深绿" style="background:#030" onclick="showcolor('#030')"></strong>
					<strong title="深青" style="background:#036" onclick="showcolor('#036')"></strong>
					<strong title="深蓝" style="background:#000080" onclick="showcolor('#000080')"></strong>
					<strong title="靓蓝" style="background:#339" onclick="showcolor('#339')"></strong>
					<strong title="灰色-80%" style="background:#333" onclick="showcolor('#333')"></strong>
					<strong title="深红" style="background:#800000" onclick="showcolor('#800000')"></strong>
					<strong title="橙红" style="background:#f60" onclick="showcolor('#f60')"></strong>
					<strong title="深黄" style="background:#808000" onclick="showcolor('#000')"></strong>
					<strong title="深绿" style="background:#008000" onclick="showcolor('#808000')"></strong>
					<strong title="绿色" style="background:#008080" onclick="showcolor('#008080')"></strong>
					<strong title="蓝色" style="background:#00f" onclick="showcolor('#00f')"></strong>
					<strong title="蓝灰" style="background:#669" onclick="showcolor('#669')"></strong>
					<strong title="灰色-50%" style="background:#808080" onclick="showcolor('#808080')"></strong>
					<strong title="红色" style="background:#f00" onclick="showcolor('#f00')"></strong>
					<strong title="浅橙" style="background:#f90" onclick="showcolor('#f90')"></strong>
					<strong title="酸橙" style="background:#9c0" onclick="showcolor('#9c0')"></strong>
					<strong title="海绿" style="background:#396" onclick="showcolor('#396')"></strong>
					<strong title="水绿色" style="background:#3cc" onclick="showcolor('#3cc')"></strong>
					<strong title="浅蓝" style="background:#36f" onclick="showcolor('#36f')"></strong>
					<strong title="紫罗兰" style="background:#800080" onclick="showcolor('#800080')"></strong>
					<strong title="灰色-40%" style="background:#999" onclick="showcolor('#999')"></strong>
					<strong title="粉红" style="background:#f0f" onclick="showcolor('#f0f')"></strong>
					<strong title="金色" style="background:#fc0" onclick="showcolor('#fc0')"></strong>
					<strong title="黄色" style="background:#ff0" onclick="showcolor('#ff0')"></strong>
					<strong title="鲜绿" style="background:#0f0" onclick="showcolor('#0f0')"></strong>
					<strong title="青绿" style="background:#0ff" onclick="showcolor('#0ff')"></strong>
					<strong title="天蓝" style="background:#0cf" onclick="showcolor('#0cf')"></strong>
					<strong title="梅红" style="background:#936" onclick="showcolor('#936')"></strong>
					<strong title="灰度-20%" style="background:#c0c0c0" onclick="showcolor('#c0c0c0')"></strong>
					<strong title="玫瑰红" style="background:#f90" onclick="showcolor('#f90')"></strong>
					<strong title="茶色" style="background:#fc9" onclick="showcolor('#fc9')"></strong>
					<strong title="浅黄" style="background:#ff9" onclick="showcolor('#ff9')"></strong>
					<strong title="浅绿" style="background:#cfc" onclick="showcolor('#cfc')"></strong>
					<strong title="浅青绿" style="background:#cff" onclick="showcolor('#cff')"></strong>
					<strong title="浅蓝" style="background:#9cf" onclick="showcolor('#9cf')"></strong>
					<strong title="淡紫" style="background:#c9f" onclick="showcolor('#c9f')"></strong>
					<strong title="白色" style="background:#fff" ></strong>
					<em><input type="text" name="t" value="#" /></em>
				</div>				<textarea name="content" rows="9"></textarea>
			</dd>
			<dd>验 证 码：<input type="text" name="code" class="text yzm"  /> <img src="code.php" id="code" onclick="javascript:this.src='code.php?tm='+Math.random();" /> <input type="submit" class="submit" value="发表帖子" /></dd>
		</dl>
	</form>
</div>

<div id="footer">
	<p>本程序执行耗时为: 0.0099秒</p>
	<p>版权所有 翻版必究</p>
	<p>本程序由<span>瓢城Web俱乐部</span>提供 源代码可以任意修改或发布 (c) yc60.com</p>
</div></body>
</html>