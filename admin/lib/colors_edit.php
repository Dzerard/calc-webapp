<?php

//wyswietalnie galerii
$galleryAction = new gallery();

//update single picture
if (isset($_POST["singlePicture"])) {
  header('Content-Type: application/json');
  echo json_encode($galleryAction->updatePictureTitle($_POST));
  die;
}

$gallery = $galleryAction->loadGallery($_GET['id']);
@ $pics = $galleryAction->loadGalleryPics($_GET['id']);

//update gallery
if(isset($_POST["save"])){	
  $galleryAction->saveGallery($_POST, $_POST['gallery_id'], $_FILES);	
}

//usuwanie obrazka
if(isset($_GET['picDel'])) {
  $galleryAction->delImage($_GET['picDel']);
}

//wylogowywanie
if (isset($_POST["logout"])) {
  $logOut = new methods();
  $logOut->logout('login.php');
}