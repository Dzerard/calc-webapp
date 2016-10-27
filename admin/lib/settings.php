<?php
//get Data
$SETTINGS_PANEL_DEFALUT = (int)1;
//$settings = $adminActions->getSettings($SETTINGS_PANEL_DEFALUT);

$staticPages = $adminActions->getPages();
$registerItems = [
  'about'       => 'O Kalkulatorze'  
 ];

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