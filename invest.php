<?php
/**
 * @Author: ananayarora
 * @Date:   2016-01-14 22:50:53
 * @Last Modified by:   ananayarora
 * @Last Modified time: 2016-01-14 23:39:05
 */
if (!isset($_GET['id'])){
	header("Location: index.php");
}
require('header.php');
require('conf.php');
require('sql.php');
$c = new Conf();	
$o = new MysqliDb($c->host, $c->username, $c->password, $c->db);
$o->where("id",$o->escape($_GET['id']));
$k = $o->get("startups");

?>