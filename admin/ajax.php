<?php

require_once("config/lib/gallery_actions.php");
require_once("config/lib/contact_actions.php");

//wyswietalnie galerii
$galleryAction = new gallery();
$contactAction = new contact();

//update single picture
if (isset($_POST["getPics"])) {
  header('Content-Type: application/json');
  echo json_encode($galleryAction->getAllPics());
  die;
}

//save contact
if (isset($_POST["contactForm"])) {
  header('Content-Type: application/json');
  echo json_encode($contactAction->addMessage($_POST["contactForm"]));
  die;
}

//save contact
if (isset($_POST["aboutPage"])) {
  header('Content-Type: application/json');
  echo json_encode($contactAction->getAboutPage());
  die;
}
