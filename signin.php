<?php
/**
 * @Author: ananayarora
 * @Date:   2016-01-10 14:28:50
 * @Last Modified by:   ananayarora
 * @Last Modified time: 2016-01-10 21:22:46
 */
session_start();
if (isset($_SESSION['loggedin'])){
	header("Location: discover.php");
}
if (isset($_POST['submit'])){
	require('conf.php');
	require('sql.php');
	$c = new Conf();	
	$o = new MysqliDb($c->host, $c->username, $c->password, $c->db);
	$o->where("username",$_POST['username']);
	$o->where("password",md5($_POST['password']));
	$o->get("users");
	if ($o->count == 1 && !isset($_GET['next'])){
		header("Location: discover.php");
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $_POST['username'];
	} elseif ($o->count == 1 && isset($_GET['next'])){
		header("Location: ".$_GET['next']);
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $_POST['username'];
	} elseif ($o->count == 0 && !isset($_GET['next'])) {
		header("Location: signin.php?wrong");
	} elseif ($o->count == 0 && isset($_GET['next'])){
		header("Location: signin.php?wrong&next=".$_GET['next']);
	}
}
require("header.php");
?>
	<main class="mdl-layout__content">
		<div class="mdl-card mdl-shadow--6dp login-form">
			<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
				<h2 class="mdl-card__title-text">Sign in to Seedup</h2>
			</div>
			<form method="POST">
	  			<div class="mdl-card__supporting-text">
	  					<?php if (isset($_GET['wrong'])){ echo "<center><p>Invalid Credentials</p></center>"; } ?>
						<div class="mdl-textfield mdl-js-textfield">
							<?php if (isset($_GET['wrong'])){ ?>
							<input class="mdl-textfield__input invalid" type="text" name="username" id="username" required/>
							<?php 	} else { ?>
							<input class="mdl-textfield__input" type="text" name="username" id="username" required/>
							<?php  	}	?>
							<label class="mdl-textfield__label" for="username">Username</label>
						</div>
						<div class="mdl-textfield mdl-js-textfield">
							<?php if (isset($_GET['wrong'])){ ?>
									<input class="mdl-textfield__input invalid" name="password" type="password" id="userpass" required/>
							<?php 	} else { ?>
									<input class="mdl-textfield__input" name="password" type="password" id="userpass" required/>
							<?php  	}	?>
							<label class="mdl-textfield__label" for="userpass">Password</label>
						</div>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<input type="submit" name="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value='Log In'>
				</div>
			</form>
		</div>
	</main>
<?php 
	require("footer.php");
?>