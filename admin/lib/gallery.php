<?php

//wyswietalnie galerii
$galleryAction = new gallery();

$gallery = $galleryAction->loadGallery();
//usuwanie galerii
if (isset($_GET["del_id"])) {
  $galleryAction->delGallery($_GET['del_id']);
}

// dodawanie nowej galerii
if (isset($_POST["add_gallery"])) {

  $galleryAction->addGallery($_POST);
}

//zmiana widocznosci konkretnej galerii 
if (isset($_GET["visibleID"])) {
  $galleryAction->setVisbility($_GET["visibleID"]);
}

//wylogowywanie
if (isset($_POST["logout"])) {
  $logOut = new methods();
  $logOut->logout('login.php');
}