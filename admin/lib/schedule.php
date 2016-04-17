<?php

if (isset($_GET['id'])) {
  $item = $adminActions->showShedule();
}

//trampkarze, orliki, mlodziki, zaki
if (isset($_POST["save"])) {
  $update = false;
  if (isset($_POST['scheduleId'])) {
    $update = true;
  }
  $adminActions->addSchedule($_POST, $update);
}

if (isset($_POST["logout"])) {

  $logOut = new methods();
  $logOut->logout('login.php');
}