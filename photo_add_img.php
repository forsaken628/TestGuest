<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG', 'photo_add_img');
define('IN_JS', 'photo_add_img');
//定义个常量，用来指定本页的内容
define('SCRIPT', 'photo_add_img');
$_id = 'id=' . $_GET['id'] . '&';
//引入公共文件
require dirname(__FILE__) . '/includes/common.inc.php';
//判断是否登录了
if (!isset($_COOKIE['username'])) {
    _alert_close('请先登录！');
}
_uniqid();
if ($_GET['action'] == 'addimg') {
    var_dump($_POST);
    $date=date('Y-m-d H:i:s');
    _query("INSERT INTO tg_photo SET tg_name='{$_POST['name']}',tg_url='{$_POST['url']}',tg_content='{$_POST['content']}',
tg_sid={$_POST['sid']},tg_username='{$_COOKIE['username']}',tg_date='{$date}'");
    _location('',"photo_show.php?id={$_POST['sid']}");
}
$row = _fetch_array("SELECT * FROM tg_dir WHERE tg_id={$_GET['id']}");
require 'title.php';
require 'header.php';
?>
    <script type="text/javascript" src="js/skin.js"></script>
    <div id="photo">
        <h2>上传图片</h2>
        <form method="post" name="up" action="?action=addimg">
            <input type="hidden" name="sid" value="<?=$row['tg_id']?>"/>
            <dl>
                <dd>图片名称：<input type="text" name="name" class="text"/></dd>
                <dd>图片地址：<input type="text" name="url" id="url" readonly="readonly" class="text"/>
                    <a href="javascript:;" title="<?=$row['tg_dir']?>" id="up">上传</a>
                </dd>
                <dd>图片描述：<textarea name="content"></textarea></dd>
                <dd><input type="submit" class="submit" value="添加图片"/></dd>
            </dl>
        </form>
    </div>
<?php
require 'footer.php';