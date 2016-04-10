<?php
define('IN_TG', 'login');
define('IN_JS', 'login');
include_once 'includes/common.inc.php';
include_once 'includes/login.func.php';


if (isset($_GET['action']) && $_GET['action'] == 'login') {
    $username = _check_username($_POST['username'], 2, 20);
    $password = _check_password($_POST['password'], 6);
    $time = _check_time($_POST['time']);
    $sql = "SELECT * FROM tg_user WHERE tg_username='{$username}' AND tg_password='{$password}';";
    $row = _fetch_array($sql);
    var_dump($row);
    if (!is_null($row)) {
        $uniqid = _sha1_uniqid();
        _setcookies($username, $uniqid, $time);
        $sql = "UPDATE tg_user SET tg_uniqid='$uniqid' WHERE tg_username='$username'";
        _query($sql);
        header('location:index.php');
    } else {
        _alert_back('账号密码不匹配');
    }
}
require_once 'title.php';
require_once 'header.php';
?>
    <script type="text/javascript" src="js/code.js"></script>
    <div id="login">
        <h2>登录</h2>
        <form method="post" name="login" action="login.php?action=login">
            <dl>
                <dt></dt>
                <dd>用 户 名：<input type="text" name="username" class="text"/></dd>
                <dd>密　　码：<input type="password" name="password" class="text"/></dd>
                <dd>保　　留：<input type="radio" name="time" value="0" checked="checked"/> 不保留
                    <input type="radio" name="time" value="1"/> 一天
                    <input type="radio" name="time" value="2"/> 一周
                    <input type="radio" name="time" value="3"/> 一月
                </dd>

                <dd>验 证 码：<input type="text" name="code" class="text code"/>
                    <img src="code.php" id="code"/>
                </dd>

                <dd><input type="submit" value="登录" class="button"/>
                    <input type="button" value="注册" id="location" class="button location"/></dd>
            </dl>
        </form>
    </div>
<?php
require_once 'footer.php';
