<?php

$list = $adminActions->showShedule($all = true);

//usuwanie newsów
if (isset($_GET["del_id"])) {

  $adminActions->deleteShedule($_GET['del_id']);
}

if (isset($_POST["logout"])) {

  $logOut = new methods();
  $logOut->logout('login.php');
}