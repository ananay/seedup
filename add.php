<?php
/**
 * @Author: ananayarora
 * @Date:   2016-01-10 14:28:40
 * @Last Modified by:   ananayarora
 * @Last Modified time: 2016-01-14 20:15:12
 */
	session_start();
	if (!isset($_SESSION['loggedin'])){
		header("Location: signin.php?next=add.php");
	}
	if (isset($_POST['submit'])){
		require('conf.php');
		require('sql.php');
		$c = new Conf();	
		$o = new MysqliDb($c->host, $c->username, $c->password, $c->db);
		$insArr = Array();
		foreach ($_POST as $key => $value) {
			if ($key == "valuation" || $key == "currentfunding"){
				$insArr[$key] = str_replace(",","",$o->escape($value));
			} else {
				$insArr[$key] = $o->escape($value);
			}
		}
		$insArr['timeadded'] = time();
		$insArr['imageurl'] = 'data:image/png;base64,'.base64_encode(file_get_contents($_FILES['imageurl']['tmp_name']));
		unset($insArr['submit']);
		$o->insert("startups",$insArr);
		// header("Location: index.php");
	}
	require('header.php');
?>
	<script src="http://clouddelivery.textbox.io/1/getEditor?apiKey=838eacr76gusx262p3cs4fwkjk104wsqun1nyelzulvy6okw"></script>
	<style type="text/css">
	textarea {
    	margin:10px 0;
    	height:500px;
    	width: 60%;
	}
	</style>
	<center>
		<h3>Add your startup</h3>
		<form method="POST" enctype="multipart/form-data">
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" id="startup-name" name="name" />
				<label class="mdl-textfield__label" for="startup-name">Startup Name</label>
			</div><br />
			<!-- <div class="mdl-textfield mdl-js-textfield"> -->
				<!-- <input class="mdl-textfield__input" id="imageurl" name="imageurl" /> -->
				<label for="imageurl">Preview Image</label>
				<input id="imageurl" name="imageurl" type="file" />
			<!-- </div><br /> -->
			<br />
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" id="oneliner" name="oneliner" />
				<label class="mdl-textfield__label" for="oneliner">A one line description for your startup.</label>
			</div><br />
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" id="currentfunding" name="currentfunding" />
				<label class="mdl-textfield__label" for="currentfunding">Current Funding (In Dollars)</label>
			</div><br />
			<h4>Full Description</h4>
			<textarea id="fulldesc" name="fulldesc">
			</textarea>

			<div style="text-align:left; line-height:2em;" class="mdl-textfield mdl-js-textfield">
				<!-- <input class="mdl-textfield__input" id="stage" name="stage" /> -->
				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
 				 <input type="radio" id="option-1" class="mdl-radio__button" name="stage" value="Seed Capital" checked>
				  <span class="mdl-radio__label">Seed Capital</span>
				</label>
				<br />
				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
				  <input type="radio" id="option-2" class="mdl-radio__button" name="stage" value="Angel Investor Funding">
				  <span class="mdl-radio__label">Angel Investor Funding</span>
				</label>
				<br />
				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
				  <input type="radio" id="option-3" class="mdl-radio__button" name="stage" value="Venture Capitalist Funding (Series A)">
				  <span class="mdl-radio__label">Venture Capitalist Funding (Series A)</span>
				</label>
				<br />
				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-4">
				  <input type="radio" id="option-4" class="mdl-radio__button" name="stage" value="Venture Capitalist Funding (Series B)">
				  <span class="mdl-radio__label">Venture Capitalist Funding (Series B)</span>
				</label>
				<br />
				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-5">
				  <input type="radio" id="option-5" class="mdl-radio__button" name="stage" value="Venture Capitalist Funding (Series C)">
				  <span class="mdl-radio__label">Venture Capitalist Funding (Series C)</span>
				</label>
				<br />
				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-6">
				  <input type="radio" id="option-6" class="mdl-radio__button" name="stage" value="Mezzanine Financing & Bridge Loans">
				  <span class="mdl-radio__label">Mezzanine Financing & Bridge Loans</span>
				</label>
				<br />
				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-7">
				  <input type="radio" id="option-7" class="mdl-radio__button" name="stage" value="Initital Public Offering">
				  <span class="mdl-radio__label">Initital Public Offering</span>
				</label>
			</div><br />
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" id="valuation" name="valuation" />
				<label class="mdl-textfield__label" for="valuation">Valuation</label>
			</div><br />
			<input value="Add" type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
		</form>
	</center>
	<script type="text/javascript">
		var editor = textboxio.replaceAll('textarea');
	</script>
<?php require('footer.php'); ?>
