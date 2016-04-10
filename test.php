<?php
//echo dirname(__FILE__);
date_default_timezone_set('PRC');

echo md5(iconv("utf-8","gbk","金牌橱柜"))."\n";
echo md5(iconv("utf-8","GBK","金易装饰"))."\n";
echo md5("金牌橱柜")."\n";
echo md5("金易装饰")."\n";