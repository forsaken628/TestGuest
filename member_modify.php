<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG', 'member_modify');
define('IN_JS', 'code');
//定义个常量，用来指定本页的内容
define('SCRIPT', 'member_modify');
$_id = 'id=' . $_GET['id'] . '&';
//引入公共文件
require dirname(__FILE__) . '/includes/common.inc.php';
//判断是否登录了
if (!isset($_COOKIE['username'])) {
	_alert_close('请先登录！');
}
_uniqid();

require 'title.php';
require 'header.php';
?>
	<script type="text/javascript" src="js/skin.js"></script>
	<div id="member">
		<?php require 'includes/member.inc.php' ?>
        <div id="member_main">
            <h2>会员管理中心</h2>
            <form method="post" action="?action=modify">
                <dl>
                    <dd>用 户 名：蜡笔小新</dd>
                    <dd>密　　码：<input type="password" class="text" name="password" /> (留空则不修改)</dd>
                    <dd>性　　别：<input type="radio" name="sex" value="男" checked="checked" /> 男 <input type="radio" name="sex" value="女" /> 女</dd>
                    <dd>头　　像：<select name="face"><option value="face/m01.gif">face/m01.gif</option><option value="face/m02.gif">face/m02.gif</option><option value="face/m03.gif">face/m03.gif</option><option value="face/m04.gif">face/m04.gif</option><option value="face/m05.gif">face/m05.gif</option><option value="face/m06.gif">face/m06.gif</option><option value="face/m07.gif">face/m07.gif</option><option value="face/m08.gif">face/m08.gif</option><option value="face/m09.gif">face/m09.gif</option><option value="face/m10.gif">face/m10.gif</option><option value="face/m11.gif">face/m11.gif</option><option value="face/m12.gif">face/m12.gif</option><option value="face/m13.gif">face/m13.gif</option><option value="face/m14.gif">face/m14.gif</option><option value="face/m15.gif">face/m15.gif</option><option value="face/m16.gif">face/m16.gif</option><option value="face/m17.gif">face/m17.gif</option><option value="face/m18.gif">face/m18.gif</option><option value="face/m19.gif">face/m19.gif</option><option value="face/m20.gif">face/m20.gif</option><option value="face/m21.gif">face/m21.gif</option><option value="face/m22.gif">face/m22.gif</option><option value="face/m23.gif">face/m23.gif</option><option value="face/m24.gif">face/m24.gif</option><option value="face/m25.gif">face/m25.gif</option><option value="face/m26.gif">face/m26.gif</option><option value="face/m27.gif">face/m27.gif</option><option value="face/m28.gif">face/m28.gif</option><option value="face/m29.gif" selected="selected">face/m29.gif</option><option value="face/m30.gif">face/m30.gif</option><option value="face/m31.gif">face/m31.gif</option><option value="face/m32.gif">face/m32.gif</option><option value="face/m33.gif">face/m33.gif</option><option value="face/m34.gif">face/m34.gif</option><option value="face/m35.gif">face/m35.gif</option><option value="face/m36.gif">face/m36.gif</option><option value="face/m37.gif">face/m37.gif</option><option value="face/m38.gif">face/m38.gif</option><option value="face/m39.gif">face/m39.gif</option><option value="face/m40.gif">face/m40.gif</option><option value="face/m41.gif">face/m41.gif</option><option value="face/m42.gif">face/m42.gif</option><option value="face/m43.gif">face/m43.gif</option><option value="face/m44.gif">face/m44.gif</option><option value="face/m45.gif">face/m45.gif</option><option value="face/m46.gif">face/m46.gif</option><option value="face/m47.gif">face/m47.gif</option><option value="face/m48.gif">face/m48.gif</option><option value="face/m49.gif">face/m49.gif</option><option value="face/m50.gif">face/m50.gif</option><option value="face/m51.gif">face/m51.gif</option><option value="face/m52.gif">face/m52.gif</option><option value="face/m53.gif">face/m53.gif</option><option value="face/m54.gif">face/m54.gif</option><option value="face/m55.gif">face/m55.gif</option><option value="face/m56.gif">face/m56.gif</option><option value="face/m57.gif">face/m57.gif</option><option value="face/m58.gif">face/m58.gif</option><option value="face/m59.gif">face/m59.gif</option><option value="face/m60.gif">face/m60.gif</option><option value="face/m61.gif">face/m61.gif</option><option value="face/m62.gif">face/m62.gif</option><option value="face/m63.gif">face/m63.gif</option><option value="face/m64.gif">face/m64.gif</option></select></dd>
                    <dd>电子邮件：<input type="text" class="text" name="email" value="labixiaoxin@163.com" /></dd>
                    <dd>主　　页：<input type="text" class="text" name="url" value="http://www.yc60.com" /></dd>
                    <dd>Q 　 　Q：<input type="text" class="text" name="qq" value="234234234" /></dd>
                    <dd>个性签名：<input type="radio" name="switch" value="1" /> 启用 <input type="radio" name="switch" value="0" checked="checked" /> 禁用 (可以使用UBB代码)
                        <p><textarea name="autograph"></textarea></p>
                    </dd>
                    <dd>验 证 码：<input type="text" name="code" class="text yzm"  /> <img src="code.php" id="code" onclick="javascript:this.src='code.php?tm='+Math.random();" /> <input type="submit" class="submit" value="修改资料" /></dd>
                </dl>
            </form>
        </div>
	</div>
<?php
require 'footer.php';