<?php
require_once dirname(__FILE__).'/../config.php';

// KONTROLER strony kalkulatora

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// Ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie, gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

// Pobranie parametrów
function getParams(&$kwota,&$kurs,&$operation){
    $kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
    $kurs = isset($_REQUEST['kurs']) ? $_REQUEST['kurs'] : null;
    $operation = isset($_REQUEST['op']) ? $_REQUEST['op'] : null;    
}

// Walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$kwota,&$kurs,&$operation,&$messages){
    // Sprawdzenie, czy parametry zostały przekazane
    if (!(isset($kwota) && isset($kurs) && isset($operation))) {
        return false; // brak parametrów
    }

    // Sprawdzenie, czy potrzebne wartości zostały przekazane
    if ($kwota == "") {
        $messages[] = 'Nie podano kwoty';
    }
    if ($kurs == "") {
        $messages[] = 'Nie podano kursu';
    }

    // Nie ma sensu walidować dalej, gdy brak parametrów
    if (count($messages) != 0) return false;

    // Sprawdzenie, czy $kwota i $kurs są liczbami
    if (!is_numeric($kwota)) {
        $messages[] = 'Kwota nie jest liczbą';
    }

    if (!is_numeric($kurs)) {
        $messages[] = 'Kurs nie jest liczbą';
    }

    if (count($messages) != 0) return false;
    else return true;
}

// Funkcja przetwarzająca dane, która oblicza kurs wymiany
function process(&$kwota,&$kurs,&$operation,&$messages,&$result){
    global $role;
    // Konwersja parametrów na float
    $kwota = floatval($kwota);
    $kurs = floatval($kurs);
    if ($role != "admin") {
        if ($kwota > 1000) {
          $messages[] = "Tylko ADMIN może obliczać kwoty większe od 1000.";
          return false;
        }  
      }


    // Wykonanie operacji na podstawie kursów walut
    switch ($operation) {
        case 'plnnaeur':
            $result = $kwota / $kurs; // PLN na EUR
            break;
        case 'eurnapln':
            $result = $kwota * $kurs; // EUR na PLN
            break;
        default:
            $messages[] = 'Nieznana operacja';
            break;
    }
}

// Definicja zmiennych kontrolera
$kwota = null;
$kurs = null;
$operation = null;
$result = null;
$messages = array();

// Pobierz parametry i wykonaj zadanie, jeśli wszystko w porządku
getParams($kwota, $kurs, $operation);
if (validate($kwota, $kurs, $operation, $messages)) { // gdy brak błędów
    process($kwota, $kurs, $operation, $messages, $result);
}

// Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages, $kwota, $kurs, $operation, $result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';
?>
