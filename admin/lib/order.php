<?php

//wyświetlanie dostepnych newsów
$news = $adminActions->showOrders();

//update mail
//if(isset($_POST["save"])){
//	$adminActions->saveOrder($_POST, $_FILES);
//}
//wylogowywanie
if (isset($_POST["logout"])) {
  $logOut = new methods();
  $logOut->logout('login.php');
}