<?php

$list = $adminActions->newsletterList();

//usuwanie mailingu
if (isset($_GET["del_id"])) {
  $adminActions->deleteNewsletter($_GET['del_id']);
}

//eksport csv
if (isset($_GET["export"])) {
  $adminActions->exportNewsletterCSV($_GET['export']);
}

if (isset($_POST["logout"])) {
  $logOut = new methods();
  $logOut->logout('login.php');
}