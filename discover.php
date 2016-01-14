<?php
/**
 * @Author: ananayarora
 * @Date:   2016-01-10 21:22:57
 * @Last Modified by:   ananayarora
 * @Last Modified time: 2016-01-14 23:36:59
 */
require("header.php");
?>
	<main class="mdl-layout__content">
		<div class="discover">
			<h1 class="discover-text">Discover</h1>
		</div>
		<div class="main-section">
			<center>
				
			</center>

			<?php 
				require('conf.php');
				require('sql.php');
				$c = new Conf();	
				$o = new MysqliDb($c->host, $c->username, $c->password, $c->db);
				$o->orderBy('timeadded','desc');
				$k = $o->get('startups', 20);
				foreach ($k as $key => $value) {
			?>

			<div class="mdl-card mdl-shadow--2dp startup-card">
			  <div class="mdl-card__title mdl-card--expand startup-image" style="background-image:url('<?php echo $value['imageurl']; ?>');">
			  	<div class="startup-overlay"></div>
			    <h2 class="mdl-card__title-text startup-name"><?php echo $value['name']; ?></h2>
			  </div>
			  <div class="mdl-card__supporting-text">
			  	<center>
			    <?php echo $value['oneliner']; ?>
			    <br />
			    <h5 class="current_funding"><?php echo $value['numinvest']; ?><br /><span style="font-size:11pt;"><b>Investors Funded</b></span></h5>
				<h5 class="valuation">$<?php echo $value['valuation']; ?><br /><span style="font-size:11pt;"><b>Valuation</b></span></h5>
			  	</center>
			  </div>
			  <div class="mdl-card__actions mdl-card--border">
			    <a href="view-startup.php?id=<?php echo $value['id']; ?>" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
			     <center> View </center>
			    </a>
			  </div>
			</div>
			<?php 
				}
			?>

		</div>
	</main>
<?php require("footer.php"); ?>