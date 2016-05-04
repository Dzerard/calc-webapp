<?php

//wyświetlanie dostepnych newsów
$order = $adminActions->showOrders();

//update mail
if (isset($_POST["save"])) {
  $adminActions->saveOrder($_POST);
}
//wylogowywanie
if (isset($_POST["logout"])) {
  $logOut = new methods();
  $logOut->logout('login.php');
}