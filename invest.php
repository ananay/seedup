<?php
/**
 * @Author: ananayarora
 * @Date:   2016-01-14 22:50:53
 * @Last Modified by:   ananayarora
 * @Last Modified time: 2016-01-15 01:19:41
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
$o->where("username",$_SESSION['username']);
$g = $o->get("users");
function suggestedFunding($valuation, $fundingReceived, $investorBudget, $stage)
{
	$perc = 10;
	if ($stage == "Seed Capital" || $stage == "Angel Investor Funding")
		$perc = 40;
	else if ($stage == "Venture Capitalist Funding (Series A)")
		$perc = 20;

	$final = 0;
	$toRaise = ($valuation * $perc) / 100 - $fundingReceived;

	if ($stage == "Seed Capital" || $stage == "Angel Investor Funding")
	{
		if ($investorBudget > $toRaise * 5)
			$final = $toRaise;
		else if ($investorBudget > $toRaise)
			$final = $toRaise / 2;
		else
			$final = $investorBudget;
	}
	else 
	{
		if ($investorBudget > $toRaise * 5)
			$final = $toRaise / 2;
		else if ($investorBudget > $toRaise)
			$final = $toRaise / 3;
		else
			$final = $investorBudget;
	}

	if ($final < 100)
	{
		return 0;
	}
	else if ($final < 100000)
	{
		return $final - ($final % 100);
	}
	else
	{
		return $final - ($final % 10000);
	}
}

?>
<center>
	<h3>Invest in <?php echo $k[0]['name']; ?></h3>
	<br>
	<br>	
	<h5>Valuation of <?php echo $k[0]['name']; ?>: <?php echo '$'.$k[0]['valuation']; ?></h5>
	<h5>Suggested funding: $<?php echo suggestedFunding($k[0]['valuation'], $k[0]['currentfunding']+$k[0]['fundingonseedup'], $g[0]['investorbudget'], $k[0]['stage']) ?></h5>
	<br>
	<p>Our sophisticated algorithms suggest you a reasonable price for funding. However, the investors are free to choose how much they want to invest.</p>
	<br>
	
</center>
<?php require('footer.php'); ?>