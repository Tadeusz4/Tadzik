{extends file="main.tpl"}

{block name=top}

<div class="bottom-margin">
<form action="{$conf->action_root}personSave" method="post" class="pure-form pure-form-aligned">
	<fieldset>
		<legend>Dane osoby</legend>
		<div class="pure-control-group">
            <label for="name">Imię</label>
            <input id="name" type="text" placeholder="Imię" name="name" value="{$form->name}">
        </div>
		<div class="pure-control-group">
            <label for="surname">Nazwisko</label>
            <input id="surname" type="text" placeholder="Nazwisko" name="surname" value="{$form->surname}">
        </div>
		<div class="pure-control-group">
            <label for="birthdate">Data ur.</label>
            <input id="birthdate" type="text" placeholder="Data urodzenia" name="birthdate" value="{$form->birthdate}">
        </div>
		<div class="pure-control-group">
            <label for="phone">Telefon</label>
            <input maxlength="9" id="phone" type="text" placeholder="Numer telefonu" name="phone" value="{$form->phone}">
        </div>
		<div class="pure-controls">
			<input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
			<a class="pure-button button-secondary" href="{$conf->action_root}personList">Powrót</a>
		</div>
	</fieldset>
    <input type="hidden" name="id" value="{$form->id}">
</form>	
</div>

{/block}
