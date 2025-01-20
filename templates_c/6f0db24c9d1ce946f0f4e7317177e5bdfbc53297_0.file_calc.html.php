<?php
/* Smarty version 5.4.1, created on 2025-01-20 13:08:05
  from 'file:C:\xampp\htdocs\kantor_04/app/calc.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.1',
  'unifunc' => 'content_678e3ca542fdf3_07965488',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6f0db24c9d1ce946f0f4e7317177e5bdfbc53297' => 
    array (
      0 => 'C:\\xampp\\htdocs\\kantor_04/app/calc.html',
      1 => 1737374875,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_678e3ca542fdf3_07965488 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\kantor_04\\app';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1680126825678e3ca5417994_81675810', 'footer');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1096469023678e3ca541b162_28157598', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "../templates/main.html", $_smarty_current_dir);
}
/* {block 'footer'} */
class Block_1680126825678e3ca5417994_81675810 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\kantor_04\\app';
?>
przykładowa tresć stoopki<?php
}
}
/* {/block 'footer'} */
/* {block 'content'} */
class Block_1096469023678e3ca541b162_28157598 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\kantor_04\\app';
?>


<h3>Kantor</h2>


<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->getValue('app_url');?>
/app/calc.php" method="post">
	<fieldset>
		<label for="kwota">Kwota</label>
		<input id="kwota" type="text" placeholder="kwota" name="kwota" value="<?php echo $_smarty_tpl->getValue('form')['kwota'];?>
">
		<label for="op">Operacja</label>
		
		<select id="op" name="op">
			<option value="zplnnaeur" <?php if ((null !== ($_smarty_tpl->getValue('form')['op'] ?? null)) && $_smarty_tpl->getValue('form')['op'] == 'zplnnaeur') {?>selected<?php }?>>z pln na eur</option>
            <option value="zeurnapln" <?php if ((null !== ($_smarty_tpl->getValue('form')['op'] ?? null)) && $_smarty_tpl->getValue('form')['op'] == 'zeurnapln') {?>selected<?php }?>>z eur na pln</option>
		</select>
					
		<label for="kurs">Kurs</label>
		<input id="kurs" type="text" placeholder="kurs" name="kurs" value="<?php echo $_smarty_tpl->getValue('form')['kurs'];?>
">
	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>

<div class="messages">

<?php if ((null !== ($_smarty_tpl->getValue('messages') ?? null))) {?>
	<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('messages')) > 0) {?> 
		<h4>Wystąpiły błędy: </h4>
		<ol class="err">
		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('messages'), 'msg');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach0DoElse = false;
?>
		<li><?php echo $_smarty_tpl->getValue('msg');?>
</li>
		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
		</ol>
	<?php }
}?>

<?php if ((null !== ($_smarty_tpl->getValue('infos') ?? null))) {?>
	<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('infos')) > 0) {?> 
		<h4>Informacje: </h4>
		<ol class="inf">
		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('infos'), 'msg');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach1DoElse = false;
?>
		<li><?php echo $_smarty_tpl->getValue('msg');?>
</li>
		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
		</ol>
	<?php }
}?>

<?php if ((null !== ($_smarty_tpl->getValue('result') ?? null))) {?>
	<h4>Wynik</h4>
	<p class="res">
	<?php echo $_smarty_tpl->getValue('result');?>

	</p>
<?php }?>

</div>

<?php
}
}
/* {/block 'content'} */
}
