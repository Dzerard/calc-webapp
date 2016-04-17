<?php

$list = $adminActions->eventsList();

//usuwanie newsów
if (isset($_GET["del_id"])) {
  $adminActions->deleteEvent($_GET['del_id']);
}
//add
if (isset($_POST["add_event"])) {
  $adminActions->addEvent($_POST);  
}
//update
if (isset($_POST["update_event"])) {
  $adminActions->updateEvent($_POST);  
}
//getId
if (isset($_POST["id"])) {
  header('Content-Type: application/json');
  echo json_encode($adminActions->getEvent($_POST["id"]));
  die;
}

if (isset($_POST["logout"])) {
  $logOut = new methods();
  $logOut->logout('login.php');
}