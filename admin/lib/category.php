<?php

//trampkarze
if (isset($_POST["saveT"])) {
  $adminActions->addScores($_POST, 't');
}
//orliki
if (isset($_POST["saveO"])) {
  $adminActions->addScores($_POST, 'o');
}
//mlodziki
if (isset($_POST["saveM"])) {
  $adminActions->addScores($_POST, 'm');
}
//zaki
if (isset($_POST["saveZ"])) {
  $adminActions->addScores($_POST, 'z');
}

if (isset($_POST["logout"])) {
  $logOut = new methods();
  $logOut->logout('login.php');
}