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
include_once 'includes/check.func.php';
//判断是否登录了
if (!isset($_COOKIE['username'])) {
    _alert_close('请先登录！');
}
_uniqid();
if($_GET['action']=='modify'){
    _check_code($_SESSION['code'], $_POST['code']);
    $sql='UPDATE tg_user SET';
    if(!empty($_POST['password'])){
        $sql.= ' tg_password='._check_password($_POST['password'],$_POST['password'],6).',';
    }
    $sql.=" tg_sex='{$_POST['sex']}',";
    $sql.=" tg_face='{$_POST['face']}',";
    $email = _check_email($_POST['email'], 1, 20);
    $sql.=" tg_email='{$email}',";
    $url = _check_url($_POST['url'], 30);
    $sql.=" tg_url='{$url}',";
    $qq = _check_qq($_POST['qq']);
    $sql.=" tg_qq='{$qq}',";
    $sql.=" tg_switch='{$_POST['switch']}',";
    $sql.=" tg_autograph='{$_POST['autograph']}'";
    $sql.=" WHERE tg_username='{$_COOKIE['username']}';";
    _query($sql);
    _alert_back('已修改');
    exit();
}
require 'title.php';
require 'header.php';
$sql = "SELECT tg_id,tg_username,tg_sex,tg_face,tg_email,tg_url,tg_autograph,tg_qq FROM tg_user WHERE tg_username='{$_COOKIE['username']}'";
$row = _fetch_array($sql);

?>
    <script type="text/javascript" src="js/skin.js"></script>
    <div id="member">
        <?php require 'includes/member.inc.php' ?>
        <div id="member_main">
            <h2>会员管理中心</h2>
            <form method="post" action="?action=modify">
                <dl>
                    <dd>用 户 名：<?=$row['tg_username']?></dd>
                    <dd>密　　码：<input type="password" class="text" name="password"/> (留空则不修改)</dd>
                    <dd>性　　别：<input type="radio" name="sex" value="男" <?=($row['tg_sex']=='男'?'checked="checked"':'')?> /> 男 <input type="radio"
                                                                                                   name="sex"
                                                                                                   value="女" <?=($row['tg_sex']=='女'?'checked="checked"':'')?>/> 女
                    </dd>
                    <dd>头　　像：<select name="face">
                            <?php for($i=1;$i<=64;$i++){?>
                            <option value="face/m<?php echo str_pad($i,2,0,STR_PAD_LEFT)?>.gif" <?=('face/m'.str_pad($i,2,0,STR_PAD_LEFT).'.gif'==$row['tg_face']?'selected="selected"':'')?>>face/m<?php echo str_pad($i,2,0,STR_PAD_LEFT)?>.gif</option>
                            <?php }?>
                        </select></dd>
                    <dd>电子邮件：<input type="text" class="text" name="email" value="<?=$row['tg_email']?>"/></dd>
                    <dd>主　　页：<input type="text" class="text" name="url" value="<?=$row['tg_url']?>"/></dd>
                    <dd>Q 　 　Q：<input type="text" class="text" name="qq" value="<?=$row['tg_qq']?>"/></dd>
                    <dd>个性签名：<input type="radio" name="switch" value="1" <?=($row['tg_switch']?'checked="checked"':'')?>/> 启用
                        <input type="radio" name="switch" value="0" <?=($row['tg_switch']?'':'checked="checked"')?>/> 禁用
                        (可以使用UBB代码)
                        <p><textarea name="autograph"><?=$row['tg_autograph']?></textarea></p>
                    </dd>
                    <dd>验 证 码：<input type="text" name="code" class="text yzm"/> <img src="code.php" id="code"
                                                                                     onclick="javascript:this.src='code.php?tm='+Math.random();"/>
                        <input type="submit" class="submit" value="修改资料"/></dd>
                </dl>
            </form>
        </div>
    </div>
<?php
require 'footer.php';