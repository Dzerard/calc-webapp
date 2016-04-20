<?php

//wyświetlanie dostepnych newsów
if (isset($_GET["category"])) {
  $news = $adminActions->showOrders($all = true, $_GET["category"]);
} else {
  $news = $adminActions->showOrders($all = true);
}
//
////usuwanie newsów
//if(isset($_GET["del_id"])){
//
//	$adminActions->deleteNews($_GET['del_id']);
//}
////wyświetlanie dostepnych kategorii
//
//$categories = $adminActions->showCategories();
//
//
//// dodawanie nowego newsa
//if(isset($_POST["add_news"])){
//  $adminActions->addNews($_POST);
//}
////zmiana widocznosci konkretnego newsa
//if(isset($_GET["visibleID"])) {
//  $adminActions->setVisbility($_GET["visibleID"]);
//}
////zmiana widocznosci na stronie glownej konkretnego newsa
//if(isset($_GET["topID"])) {
//  $adminActions->setTopVisbility($_GET["topID"]);
//}
//wylogowywanie
if (isset($_POST["logout"])) {
  $logOut = new methods();
  $logOut->logout('login.php');
}