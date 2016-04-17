<?php

$contactAction = new contact();

if (isset($_POST["logout"])) {
  $logOut = new methods();
  $logOut->logout('login.php');
}

//wypisywanie inforamcji o trenerze numer 
//do zmiany $_GET['id']
if (isset($_GET['id'])) {

  $row = $contactAction->loadContact($_GET['id']);
}

//usuwanie obrazka
if (isset($_POST['del_img'])) {
  $contactAction->delImageContact($_POST['id_coach']);
}

if (isset($_POST["add_new_coach"])) {
  $contactAction->insertContact($_POST['coach_name']);
}
//edycja informacji
if (isset($_POST["save"])) {
  $contactAction->saveContact($_POST, $_POST['id_coach'], $_FILES);
}

//usunięcie trenera
if (isset($_POST["delete"])) {
  $contactAction->deleteContact($_POST['id_coach']);
}
