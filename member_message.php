<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG', 'member_message');
define('IN_JS', 'member_message');
//定义个常量，用来指定本页的内容
define('SCRIPT', 'member_message');
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
            <h2>短信查阅中心</h2>
            <form method="post" action="member_message.php">
                <table cellspacing="1">
                    <tr>
                        <th>来自</th>
                        <th>内容</th>
                        <th>时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    <?php
                    switch ($_POST['action']) {
                        case 'delete':
                            if (count($_POST['ids']) > 0) {
                                $sql = "DELETE FROM tg_message WHERE tg_id IN (";
                                $a = '';
                                foreach ($_POST['ids'] as $id) {
                                    $sql .= $a . $id;
                                    $a = ',';
                                }
                                _query($sql . ')');
                            }
                            break;
                        case 'read':
                            if (count($_POST['ids']) > 0) {
                                $sql = "UPDATE tg_message SET tg_state=1 WHERE tg_id IN (";
                                $a = '';
                                foreach ($_POST['ids'] as $id) {
                                    $sql .= $a . $id;
                                    $a = ',';
                                }
                                _query($sql . ')');
                            }
                    }
                    $sql = "SELECT tg_id,tg_fromuser,tg_content,tg_state,tg_date FROM tg_message WHERE tg_touser='{$_COOKIE['username']}'";
                    $result = _query($sql);
                    while ($row = _fetch_array_list($result)) {
                        ?>
                        <tr>
                            <td><?= $row['tg_fromuser'] ?></td>
                            <td title="<?= $row['tg_content'] ?>"><?= $row['tg_content'] ?></td>
                            <td><?= $row['tg_date'] ?></td>

                            <td><?php
                                if ($row['tg_state']) {
                                    echo '<span style="color:green;">已读</span>';
                                } else {
                                    echo '<span style="color:blue;">未读</span>';
                                }
                                ?>
                            </td>
                            <td><input name="ids[]" value="<?= $row['tg_id'] ?>" type="checkbox"/></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td colspan="5"><label for="all">全选 <input type="checkbox" name="chkall" id="all"/></label>
                            <button name="action" type="submit" value="read">已读</button>
                            <button name="action" type="submit" value="delete">删除</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php
require 'footer.php';