<?php
/**
 * @Author: ananayarora
 * @Date:   2016-01-14 20:08:08
 * @Last Modified by:   ananayarora
 * @Last Modified time: 2016-01-14 23:41:31
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
<center>
	<div class="main_startup">
		<div style='background-image:url("<?php echo $k[0]['imageurl']; ?>");' class="startup_photo"></div>
		<div class="startup_details">
			<h3 class="startup_name"><?php echo $k[0]['name']; ?></h3>
			<p class="oneliner"><?php echo $k[0]['oneliner']; ?></p>
			<h5 class="current_funding"><?php echo $k[0]['numinvest']; ?><br /><span style="font-size:11pt;"><b>Investors Funded</b></span></h5>
			<h5 class="valuation">$<?php echo $k[0]['valuation'] ?><br /><span style="font-size:11pt;"><b>Valuation</b></span></h5>
		</div>
		<br />
		<br />
		<?php $o->where("username", $_SESSION['username']); $ka = $o->get("users");
		if ($ka[0]['investor']){
			?>
		<a href="invest.php?id=<?php echo $k[0]['id']; ?>" class="invest mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Invest in <?php echo $k[0]['name']; ?></a>
		
		<?php } ?>
		<br>
		<br>
		<br>
		<hr />
		<br>
		<h3>About <?php echo $k[0]['name']; ?></h3>
		<div class="startup_info">
			<?php echo $k[0]['fulldesc']; ?>
		</div>
		
	</div>
</center>
<?php require('footer.php'); ?>