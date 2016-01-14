<?php
/**
 * @Author: ananayarora
 * @Date:   2016-01-10 14:30:17
 * @Last Modified by:   ananayarora
 * @Last Modified time: 2016-01-14 22:45:07
 */
error_reporting(0);
if (session_status() != "PHP_SESSION_ACTIVE"){ session_start();}
?>
<html>
<head>
	<title>Seedup</title>
	<link rel="stylesheet" type="text/css" href="css/material.min.css">
	<script type="text/javascript" src="js/material.min.js"></script>
  <meta charset='utf-8' />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" type="text/css">
</head>
<body>
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  	<header class="mdl-layout__header">
  	  <div class="mdl-layout__header-row">
  	    <!-- Title -->
  	    <span class="mdl-layout-title">Seedup</span>
  	    <!-- Add spacer, to align navigation to the right -->
  	    <div class="mdl-layout-spacer"></div>
  	    <!-- Navigation. We hide it in small screens. -->
  	    <nav class="mdl-navigation mdl-layout--large-screen-only">
  	      <a class="mdl-navigation__link" href="discover.php">Discover</a>
  	      <a class="mdl-navigation__link" href="add.php">Add your startup</a>
  	      <a class="mdl-navigation__link" href="about.php">About Us</a>
  	      <a class="mdl-navigation__link" href="investors.php">Investors</a>
  	    </nav>
  	  	<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                  mdl-textfield--floating-label mdl-textfield--align-right">
        	<label class="mdl-button mdl-js-button mdl-button--icon"
               for="waterfall-exp">
        	  <i class="material-icons">search</i>
        	</label>
        	<div class="mdl-textfield__expandable-holder">
        	  <input class="mdl-textfield__input" type="text" name="sample"
        	         id="waterfall-exp">
        	</div>
    	</div>
    	<button id="demo-menu-lower-right"
        	class="mdl-button mdl-js-button mdl-button--icon">
  			<i class="material-icons">more_vert</i>
		</button>
  	  </div>
  	</header>
  	<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
    for="demo-menu-lower-right">
    <?php if (isset($_SESSION['loggedin'])){ ?>
 		<li class="mdl-menu__item">Welcome, <?php echo $_SESSION['username']; ?></li>
 		<li class="mdl-menu__item" onclick='window.location.href="signout.php"'>Sign Out</li>
     <?php } else { ?>
    <li class="mdl-menu__item" onclick='window.location.href="signin.php"'>Sign in</li>
    <li class="mdl-menu__item" onclick='window.location.href="signup.php"'>Sign up</li>
      <?php }?>
 		<li class="mdl-menu__item" onclick='window.location.href="advanced.php"'>Advanced Search</li>
	</ul>
  	<div class="mdl-layout__drawer">
  	  <span class="mdl-layout-title">Seedup</span>
  	  <nav class="mdl-navigation">
  	  	 <a class="mdl-navigation__link" href="discover.php">Discover</a>
  	  	 <a class="mdl-navigation__link" href="add.php">Add your startup</a>
  	  	 <a class="mdl-navigation__link" href="advanced.php">Advanced Search</a>
  	  	 <a class="mdl-navigation__link" href="about.php">About Us</a>
  	     <a class="mdl-navigation__link" href="investors.php">Investors</a>
         <?php if (isset($_SESSION['loggedin'])){ ?>
           <a class="mdl-navigation__link">Welcome, <?php echo $_SESSION['username']; ?></a>
           <a class="mdl-navigation__link" href="signout.php">Sign Out</a>
         <?php } else { ?>
  	       <a class="mdl-navigation__link" href="signin.php">Signin</a>
  	       <a class="mdl-navigation__link" href="signup.php">Signup</a>
  	     <?php } ?>
      </nav>
  	</div>