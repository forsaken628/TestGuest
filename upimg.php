<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG', 'upimg');
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
require 'title.php';
if ($_GET['action'] == 'up') {
    if (!in_array($_FILES["userfile"]["type"], ["image/gif", "image/jpeg", "image/pjpeg","image/png"])
        || $_FILES["file"]["size"] > 1000000
    ) {
        _alert_back('错误类型或大小');
    }
    if ($_FILES['userfile']['error'] > 0) {
        _alert_back('上传失败');
    } else {
        $path = $_POST['dir'] . '/' . time() . '.' . pathinfo($_FILES["userfile"]["name"], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["userfile"]["tmp_name"], $path);
        ?>
        <script>
            opener.document.getElementById('url').value = '<?=$path?>';
            close();
        </script>
        <?php
    }
}
?>
<div id="upimg" style="padding:20px;">
    <form enctype="multipart/form-data" action="upimg.php?action=up" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
        <input type="hidden" name="dir" value="<?= $_GET['dir'] ?>"/>
        选择图片: <input type="file" name="userfile"/>
        <input type="submit" value="上传"/>
    </form>
</div>
</body>
</html>