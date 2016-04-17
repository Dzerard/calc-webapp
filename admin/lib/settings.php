<?php
//get Data
$SETTINGS_PANEL_DEFALUT = (int)1;
$settings = $adminActions->getSettings($SETTINGS_PANEL_DEFALUT);

$staticPages = $adminActions->getPages();
$registerItems = [
  'our_mission' => 'Nasza misja',
  'regulations' => 'Regulamin',
  'about'       => 'O Akademii',
  'sponsor'     => 'Sponsoring',
  'subscribe'   => 'Zapisy'
 ];

$youtubeList = $adminActions->getYoutube();

//youtube order
if (isset($_POST["order"])) {
  header('Content-Type: application/json');
  echo json_encode($adminActions->sortYoutube($_POST));
  die;
}
//youtube visibility
if (isset($_POST["youtube_visibility"])) {
  header('Content-Type: application/json');
  echo json_encode($adminActions->visibilityYoutube($_POST));
  die;
}
//youtube delete
if (isset($_POST["youtube_del"])) {
  $adminActions->removeYoutube($_POST);
}
//youtube update

if (isset($_POST["youtube_update"])) {
  $adminActions->updateYoutube($_POST);
}
//youtube save
if (isset($_POST["youtube_save"])) {
  $adminActions->saveYoutube($_POST);
}

//zapis ustawień
if (isset($_POST["save_settings"])) {
  $adminActions->saveSettings($_POST, $SETTINGS_PANEL_DEFALUT);
}

//zapis ustawień
if (isset($_POST["savePage"])) {
  $adminActions->savePage($_POST);
}


if (isset($_POST["logout"])) {
  $logOut = new methods();
  $logOut->logout('login.php');
}