<?php

//wyświetlanie dostepnych zamówień
$news = $adminActions->showOrders($all = true);

//usuwanie zamówienia
if (isset($_GET["del_id"])) {
  $adminActions->deleteOrder($_GET['del_id']);
}

////zmiana widocznosci konkretnego newsa
//if(isset($_GET["visibleID"])) {
//  $adminActions->setVisbility($_GET["visibleID"]);
//}
//wylogowywanie
if (isset($_POST["logout"])) {
  $logOut = new methods();
  $logOut->logout('login.php');
}