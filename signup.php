<?php
/**
 * @Author: ananayarora
 * @Date:   2016-01-14 22:34:55
 * @Last Modified by:   ananayarora
 * @Last Modified time: 2016-01-14 22:45:04
 */
require('header.php');
if (isset($_POST['submit'])){
	require('conf.php');
	require('sql.php');
	$c = new Conf();	
	$o = new MysqliDb($c->host, $c->username, $c->password, $c->db);
	$insArr = Array();
	foreach ($_POST as $key => $value) {
		$insArr[$key] = $o->escape($value);
	}
	unset($insArr['submit']);
	$o->insert("users",$insArr);
	header("Location: signin.php");
}
?>
	<center>
		<h2>Signup</h2>
	<form method="POST">
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" id="username" name="username" required/>
				<label class="mdl-textfield__label" for="username">Username</label>
			</div><br />
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" type="password" id="password" name="password" required/>
				<label class="mdl-textfield__label" for="password">Password</label>
			</div><br />
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" id="firstname" name="firstname" required/>
				<label class="mdl-textfield__label" for="firstname">First Name</label>
			</div><br />
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" id="lastname" name="lastname" required/>
				<label class="mdl-textfield__label" for="lastname">Last Name</label>
			</div><br />
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" id="email" name="email" required/>
				<label class="mdl-textfield__label" for="email">Email</label>
			</div><br />
			Investor: 
			<select name="investor">
				<option>true</option>
				<option>false</option>
			</select>
			<br />
			<br />
			<input value="Sign Up" type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
	</form>
	</center>