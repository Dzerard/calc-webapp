<?php

$contactAction = new contact();

$list = $contactAction->contactList();

//usuwanie newsów
if (isset($_GET["del_id"])) {
  $contactAction->deleteContact($_GET['del_id']);
}

if (isset($_POST["logout"])) {
  $logOut = new methods();
  $logOut->logout('login.php');
}