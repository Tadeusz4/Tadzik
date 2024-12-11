<?php require_once dirname(__FILE__) .'/../config.php';?>

<?php //góra strony z szablonu 
include _ROOT_PATH.'/templates/top.php';
?>

<h2 class="content-head is-center">Prosty kantor</h2>

<div class="pure-g">
<div class="l-box-lrg pure-u-1 pure-u-med-2-5">
	<form class="pure-form pure-form-stacked" action="<?php print(_APP_ROOT);?>/app/calc.php" method="post">
	<form class="pure-form pure-form-stacked" action="<?php print(_APP_ROOT);?>/app/calc.php" method="post">
	<fieldset>
		<label for="x">Kwota</label>
		<input id="x" type="text" placeholder="Kwota" name="x" value="<?php out($form['x']); ?>">

		<label for="op">Operacja</label>
		<select id="op" name="op">
			<option value="eurnapln"> EUR na PLN</option>
			<option value="plnnaeur"> PLN na EURO </option>
		</select>
					
		<label for="y">Kurs</label>
		<input id="y" type="int" placeholder="Kurs" name="y" value="<?php out($form['y']); ?>">

	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>
</div>

<div class="l-box-lrg pure-u-1 pure-u-med-3-5">

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
	echo '<h4>Wystąpiły błędy: </h4>';
	echo '<ol class="err">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php
//wyświeltenie listy informacji, jeśli istnieją
if (isset($infos)) {
	if (count ( $infos ) > 0) {
	echo '<h4>Informacje: </h4>';
	echo '<ol class="inf">';
		foreach ( $infos as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
	<h4>Wynik</h4>
	<p class="res">
<?php print($result); ?>
	</p>
<?php } ?>

</div>
</div>

<?php //dół strony z szablonu 
include _ROOT_PATH.'/templates/bottom.php';
?>