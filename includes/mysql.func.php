<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2010-2012 yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2010-8-19
*/
//防止恶意调用
if (!defined('IN_TG')) {
	exit('Access Defined!');
}


/**
 * _connect() 连接MYSQL数据库
 * @access public
 * @return void
 */

function _connect() {
	//global 表示全局变量的意思，意图是将此变量在函数外部也能访问
	global $_conn;
	if (!$_conn = mysqli_connect(DB_HOST,DB_USER,DB_PWD)) {
		exit('数据库连接失败');
	}
}

/**
 * _select_db选择一款数据库
 * @return void
 */

function _select_db() {
	global $_conn;
	if (!mysqli_select_db($_conn,DB_NAME)) {
		exit('找不到指定的数据库');
	}
}

/**
 * 设置utf8字符集
 */

function _set_names() {
	global $_conn;
	if (!mysqli_query($_conn,'SET NAMES UTF8')) {
		exit('字符集错误');
	}
}

/**
 * 执行SQL语句
 * @param $_sql
 */

function _query($_sql) {
	global $_conn;
	if (!$_result = mysqli_query($_conn,$_sql)) {
		exit('SQL执行失败'.mysqli_error($_conn));
	}
	return $_result;
}

/**
 * _fetch_array只能获取指定数据集一条数据组
 * @param $_sql
 */

function _fetch_array($_sql) {
	return mysqli_fetch_assoc(_query($_sql));
}

/**
 * _fetch_array_list可以返回指定数据集的所有数据
 * @param $_result
 */

function _fetch_array_list($_result) {
	return mysqli_fetch_assoc($_result);
}

/*
*获得记录数
*/
function _num_rows($_result) {
	return mysqli_num_rows($_result);
}


/**
 * _free_result销毁结果集
 * @param $_result
 */

function _free_result($_result) {
	mysqli_free_result($_result);
}

/**
 * _insert_id
 */

function _insert_id() {
	global $_conn;
	return mysqli_insert_id($_conn);
}

/**
 * 
 * @param $_sql
 * @param $_info
 */

function _is_repeat($_sql,$_info) {
	if (_fetch_array($_sql)) {
		_alert_back($_info);
	}
}


function _close() {
	global $_conn;
	if (!mysqli_close($_conn)) {
		exit('关闭异常');
	}
}
 

/**
 * _affected_rows表示影响到的记录数
 */

function _affected_rows() {
	global $_conn;
	return mysqli_affected_rows($_conn);
}

function mysql_real_escape_string($_string){
	global $_conn;
	return mysqli_real_escape_string($_conn,$_string);
}