<?php 

namespace app\controllers;

use app\forms\PersonEditForm;
use DateTime;
use PDOException;

class PersonEditCtrl {

	private $form; //dane formularza

	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->form = new PersonEditForm();
	}

	//validacja danych przed zapisem (nowe dane lub edycja)
	public function validateSave() {
		//0. Pobranie parametrów z walidacją
		$this->form->id = getFromRequest('id',true,'Błędne wywołanie aplikacji');
		$this->form->name = getFromRequest('name',true,'Błędne wywołanie aplikacji');
		$this->form->surname = getFromRequest('surname',true,'Błędne wywołanie aplikacji');
		$this->form->birthdate = getFromRequest('birthdate',true,'Błędne wywołanie aplikacji');
		$this->form->phone = getFromRequest('phone',true,'Błędne wywołanie aplikacji'); // Pobranie numeru telefonu

		if ( getMessages()->isError() ) return false;

		// 1. sprawdzenie czy wartości wymagane nie są puste
		if (empty(trim($this->form->name))) {
			getMessages()->addError('Wprowadź imię');
		}
		if (empty(trim($this->form->surname))) {
			getMessages()->addError('Wprowadź nazwisko');
		}
		if (empty(trim($this->form->birthdate))) {
			getMessages()->addError('Wprowadź datę urodzenia');
		}
		if (empty(trim($this->form->phone))) {
			getMessages()->addError('Wprowadź numer telefonu');
		} elseif (!preg_match('/^\+?[0-9]{7,15}$/', $this->form->phone)) {
			getMessages()->addError('Niepoprawny format numeru telefonu');
		}

		if ( getMessages()->isError() ) return false;
		
		// 2. sprawdzenie poprawności przekazanych parametrów
		$d = DateTime::createFromFormat('Y-m-d', $this->form->birthdate);
		if ( $d === false ){
			getMessages()->addError('Zły format daty. Przykład: 2015-12-20');
		}
		
		return ! getMessages()->isError();
	}

	//validacja danych przed wyswietleniem do edycji
	public function validateEdit() {
		$this->form->id = getFromRequest('id',true,'Błędne wywołanie aplikacji');
		return ! getMessages()->isError();
	}
	
	public function action_personNew(){
		$this->generateView();
	}
	
	public function action_personEdit(){
		if ( $this->validateEdit() ){
			try {
				$record = getDB()->get("person", "*",[
					"idperson" => $this->form->id
				]);

				$this->form->id = $record['idperson'];
				$this->form->name = $record['name'];
				$this->form->surname = $record['surname'];
				$this->form->birthdate = $record['birthdate'];
				$this->form->phone = $record['phone']; // Pobranie numeru telefonu

			} catch (PDOException $e){
				getMessages()->addError('Wystąpił błąd podczas odczytu rekordu');
				if (getConf()->debug) getMessages()->addError($e->getMessage());			
			}	
		} 
		
		$this->generateView();		
	}

	public function action_personDelete(){		
		if ( $this->validateEdit() ){
			try{
				getDB()->delete("person",[
					"idperson" => $this->form->id
				]);
				getMessages()->addInfo('Pomyślnie usunięto rekord');
			} catch (PDOException $e){
				getMessages()->addError('Wystąpił błąd podczas usuwania rekordu');
				if (getConf()->debug) getMessages()->addError($e->getMessage());			
			}	
		}
		forwardTo('personList');		
	}

	public function action_personSave(){
		if ($this->validateSave()) {
			try {
				if ($this->form->id == '') {
					$count = getDB()->count("person");
					if ($count <= 20) {
						getDB()->insert("person", [
							"name" => $this->form->name,
							"surname" => $this->form->surname,
							"birthdate" => $this->form->birthdate,
							"phone" => $this->form->phone // Zapis numeru telefonu
						]);
					} else { 
						getMessages()->addInfo('Ograniczenie: Zbyt dużo rekordów. Aby dodać nowy usuń wybrany wpis.');
						$this->generateView();
						exit();
					}
				} else { 
					getDB()->update("person", [
						"name" => $this->form->name,
						"surname" => $this->form->surname,
						"birthdate" => $this->form->birthdate,
						"phone" => $this->form->phone // Aktualizacja numeru telefonu
					], [ 
						"idperson" => $this->form->id
					]);
				}
				getMessages()->addInfo('Pomyślnie zapisano rekord');

			} catch (PDOException $e){
				getMessages()->addError('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
				if (getConf()->debug) getMessages()->addError($e->getMessage());			
			}
			forwardTo('personList');
		} else {
			$this->generateView();
		}		
	}
	
	public function generateView(){
		getSmarty()->assign('form',$this->form);
		getSmarty()->display('PersonEdit.tpl');
	}
}
