<?php

namespace app\controllers;

use app\forms\PersonSearchForm;
use PDOException;

class PersonListCtrl {

	private $form; //dane formularza wyszukiwania
	private $records; //rekordy pobrane z bazy danych

	public function __construct(){
		$this->form = new PersonSearchForm();
	}
		
	public function validate() {
		$this->form->surname = getFromRequest('sf_surname');
		return ! getMessages()->isError();
	}
	
	public function action_personList(){
		$this->validate();
		
		// 2. Przygotowanie mapy z parametrami wyszukiwania
		$search_params = [];
		if ( isset($this->form->surname) && strlen($this->form->surname) > 0) {
			$search_params['surname[~]'] = $this->form->surname.'%';
		}
		
		// 3. Pobranie listy rekordów z bazy danych
		$num_params = sizeof($search_params);
		if ($num_params > 1) {
			$where = [ "AND" => &$search_params ];
		} else {
			$where = &$search_params;
		}
		
		$where ["ORDER"] = "surname";
		
		try {
			$this->records = getDB()->select("person", [
					"idperson",
					"name",
					"surname",
					"birthdate",
					"phone" // Pobranie numeru telefonu
				], $where );
		} catch (PDOException $e) {
			getMessages()->addError('Wystąpił błąd podczas pobierania rekordów');
			if (getConf()->debug) getMessages()->addError($e->getMessage());			
		}	
		
		// 4. wygeneruj widok
		getSmarty()->assign('searchForm',$this->form);
		getSmarty()->assign('people',$this->records);
		getSmarty()->display('PersonList.tpl');
	}
}
