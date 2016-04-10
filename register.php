<?php
define('IN_TG', 'register');
define('IN_JS', 'register');
include_once 'includes/common.inc.php';
include_once 'includes/check.func.php';
require_once 'title.php';
require_once 'header.php';
session_start();
if (isset($_GET['action']) && $_GET['action'] == 'register') {
    $uniqid = _sha1_uniqid();
    $username = _check_username($_POST['username'], 2, 20);
    $password = _check_password($_POST['password'], $_POST['notpassword'], 6);
    $question = _check_question($_POST['question'], 2, 20);
    $answer = _check_answer($question, $_POST['answer'], 2, 20);
    $sex = _check_sex($_POST['sex']);
    $face = _check_face($_POST['face']);
    $email = _check_email($_POST['email'], 1, 20);
    $qq = _check_qq($_POST['qq']);
    $url = _check_url($_POST['url'], 30);
    _check_code($_SESSION['code'], $_POST['code']);
    $reg_time = date("Y-m-d H:i:s");
    $last_time = $reg_time;
    $last_ip = $_SERVER['REMOTE_ADDR'];
    $sql = "INSERT INTO tg_user (tg_uniqid, tg_active, tg_username, tg_password, tg_question, tg_answer, tg_email,
 tg_qq, tg_url, tg_sex, tg_face, tg_reg_time, tg_last_time, tg_last_ip)
 VALUE ('$uniqid','','$username','$password','$question','$answer','$email',$qq,'$url','$sex','$face','$reg_time','$last_time','$last_ip');";
    _query($sql);
    header('location:login.php');
}
?>
    <script type="text/javascript" src="js/code.js"></script>
    <div id="register">
        <h2>会员注册</h2>
        <form method="post" name="register" action="register.php?action=register">
            <dl>
                <dt>请认真填写一下内容</dt>
                <dd>用 户 名：<input type="text" name="username" class="text"/> (*必填，至少两位)</dd>
                <dd>密　　码：<input type="password" name="password" class="text"/> (*必填，至少六位)</dd>
                <dd>确认密码：<input type="password" name="notpassword" class="text"/> (*必填，同上)</dd>
                <dd>密码提示：<input type="text" name="question" class="text"/> (*必填，至少两位)</dd>
                <dd>密码回答：<input type="text" name="answer" class="text"/> (*必填，至少两位)</dd>
                <dd>性　　别：<input type="radio" name="sex" value="男" checked="checked"/>男
                    <input type="radio" name="sex" value="女"/>女
                </dd>
                <dd class="face"><input type="hidden" name="face" value="face/m01.gif"/><img src="face/m01.gif"
                                                                                             alt="头像选择" id="faceimg"/>
                </dd>
                <dd>电子邮件：<input type="text" name="email" class="text"/> (*必填，激活账户)</dd>
                <dd>　Q Q 　：<input type="text" name="qq" class="text"/></dd>
                <dd>主页地址：<input type="text" name="url" class="text" value="http://"/></dd>
                <dd>验 证 码：<input type="text" name="code" class="text yzm"/> <img src="/code.php" id="code"/>
                </dd>
                <dd><input type="submit" class="submit" value="注册"/></dd>
            </dl>
        </form>
    </div>
<?php
require_once 'footer.php';