<?php

require_once("config/lib/gallery_actions.php");

//wyswietalnie galerii
$galleryAction = new gallery();

//update single picture
if (isset($_POST["getPics"])) {
  header('Content-Type: application/json');
  echo json_encode($galleryAction->getAllPics());  
  die;
}
