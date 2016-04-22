<?php 

//wyświetlanie dostepnych newsów
$news = $adminActions->showOrders();
//wyświetlanie ostepnych kategorii
//$categories = $adminActions->showCategories();

////update news
//if(isset($_POST["save"])){
//	
//	$adminActions->saveNews($_POST,$_FILES);
//}
//
////usuwanie obrazka
//if(isset($_POST['del_img'])) {
//	$adminActions->deleteImage($_POST, 'news.php','news');
//}
////usuwanie obrazka
//if(isset($_POST['del_file'])) {
//	$adminActions->deleteFileNews($_POST, 'news.php','news');
//}

//wylogowywanie
if(isset($_POST["logout"])){
    $logOut = new methods();
    $logOut->logout('login.php');	
}