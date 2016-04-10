<?php
define('IN_TG', 'blog');
define('IN_JS', 'blog');
define('SCRIPT', 'index');
include_once 'includes/common.inc.php';
require_once 'title.php';
require_once 'header.php';
?>
<div id="blog">
    <dl>
        <?php
        $sql = 'SELECT tg_id,tg_username,tg_sex,tg_face,tg_email,tg_url FROM tg_user ORDER BY tg_reg_time DESC LIMIT 1';
        $row = _fetch_array($sql);
        echo <<<a
<dd class="user">{$row['tg_username']}({$row['tg_sex']})</dd>
        <dt><img alt="{$row['tg_username']}" src="{$row['tg_face']}"></dt>
        <dd class="message"><a title="{$row['tg_id']}" name="message" href="javascript:;">发消息</a></dd>
        <dd class="friend"><a title="{$row['tg_id']}" name="friend" href="javascript:;">加为好友</a></dd>
        <dd class="guest">写留言</dd>
        <dd class="flower"><a title="{$row['tg_id']}" name="flower" href="javascript:;">给他送花</a></dd>
        <dd class="email">邮件：<a href="mailto:{$row['tg_email']}">{$row['tg_email']}</a></dd>
        <dd class="url">网址：<a target="_blank" href="{$row['tg_url']}">{$row['tg_url']}</a></dd>
a;
        ?>
    </dl>
</div>
