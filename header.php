<?php
/**
 * Created by PhpStorm.
 * User: ad
 * Date: 2016/4/8
 * Time: 15:06
 */
?>
<body>
<div id="header">
    <h1><a href="index.php">瓢城Web俱乐部多用户留言系统</a></h1>
    <ul>
        <li><a href="index.php">首页</a></li>

        <li><a href="register.php">注册</a></li>

        <li><a href="login.php">登录</a></li>

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

        <li><a href="logout.php">退出</a></li>
    </ul>
</div>

