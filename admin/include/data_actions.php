<?php

//@todo podział na mniejsze modele
require_once(__DIR__ . "/../config/config.php");
require_once(__DIR__ . "/../config/dbController.php");

require_once("methods.php");

class db_actions {

  protected $pdo;

  function __construct() {
    $dbController = dbController::getInstance();
    $this->pdo = $dbController->setConnection();
  }

  /**
    dodawanie nowych newsów
   */
  public function saveNews($_myPOST, $_myFILES) {

    $id = $_myPOST['news_id'];
    try {
      $time = time();
      (isset($_myPOST['news_visible']) == 'on') ? $visible = 'yes' : $visible = 'no';
      (isset($_myPOST['news_top']) == 'on') ? $top = 'yes' : $top = 'no';

      $this->pdo->exec('UPDATE `news` SET `news_title`= \'' . $_myPOST['news_title'] . '\', `news_desc`=\'' . $_myPOST['news_desc'] . '\', `news_update`=\'' . $time . '\',`news_visible`=\'' . $visible . '\',`news_top`=\'' . $top . '\',`news_category_id`=\'' . $_myPOST['news_category_id'] . '\', `news_video`=\'' . $_myPOST['news_video'] . '\', `news_subcategory`="NULL"    WHERE  `news_id` IN (\'' . $_myPOST['news_id'] . '\')');

      if ($_myPOST['news_category_id'] == 2) {
        $this->pdo->exec('UPDATE `news` SET `news_title`= \'' . $_myPOST['news_title'] . '\', `news_desc`=\'' . $_myPOST['news_desc'] . '\', `news_update`=\'' . $time . '\',`news_visible`=\'' . $visible . '\',`news_top`=\'' . $top . '\',`news_category_id`=\'' . $_myPOST['news_category_id'] . '\', `news_video`=\'' . $_myPOST['news_video'] . '\', `news_subcategory`=\'' . $_myPOST['news_subcategory'] . '\'    WHERE  `news_id` IN (\'' . $_myPOST['news_id'] . '\')');
      }
    } catch (PDOException $e) {

    }

    /** !! do przerobienia */
    if (isset($_myFILES["news_image"])) {

      $extension = end(explode(".", $_myFILES["news_image"]["name"]));
      $allowedExts = array("jpg", "jpeg", "gif", "png", "ico");

      if ($_myFILES["news_image"]["type"] != "") {

        if ((($_myFILES["news_image"]["type"] == "image/gif") || ($_myFILES["news_image"]["type"] == "image/jpeg") || ($_myFILES["news_image"]["type"] == "image/png") || ($_myFILES["news_image"]["type"] == "image/pjpeg")) && ($_myFILES["news_image"]["size"] < 2000000) && in_array($extension, $allowedExts)) {

          if ($_myFILES["news_image"]["error"] > 0) {
            alerts::flushAlert($_myFILES["file"]["error"]);
          } else {
            echo 'Rozmiar: ' . ($_myFILES["news_image"]["size"] / 1024) . ' kB<br>';

            $name = substr(md5(uniqid(rand(0, 100), true)), 0, 5) . "_" . $_myFILES["news_image"]["name"];

            move_uploaded_file($_myFILES["news_image"]["tmp_name"], "img/news/" . $name);

            // The file
            $filename = 'img/news/' . $name;
            $new_width = 480;
            $new_height = 270;

            // Content type
            if ($_myFILES["news_image"]["type"] == "image/jpeg") {

              header('Content-Type: image/jpeg');
              // Get new dimensions
              list($width, $height) = getimagesize($filename);

              // Resample
              $image_p = imagecreatetruecolor($new_width, $new_height);
              $image = imagecreatefromjpeg($filename);
              imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
              imagejpeg($image_p, "img/news/small_" . $name, 100);
            } else {

              header('Content-Type: image/png');
              // Get new dimensions
              list($width, $height) = getimagesize($filename);

              // Resample
              $image_p = imagecreatetruecolor($new_width, $new_height);
              $image = imagecreatefrompng($filename);
              imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
              imagepng($image_p, "img/news/small_" . $name, 9);
              imagedestroy($image);
            }


            echo "Zapisany w katalogu: " . "img/news/" . $name . '</div></div>';

            try {
              //update zdjecia newsa
              $this->pdo->exec('UPDATE `news` SET `news_image`= \'' . $name . '\' WHERE  `news_id` IN (\'' . $_myPOST['news_id'] . '\')');
            } catch (PDOException $e) {

            }
          }
        } else {
          alerts::flushAlert_2();
        }
      }
    }
    if (isset($_myFILES["news_file"])) {

      if ($_myFILES["news_file"]["type"] != "") {

        if ($_myFILES["news_file"]["size"] < 2000000) {

          if ($_myFILES["news_file"]["error"] > 0) {
            alerts::flushAlert($_myFILES["file"]["error"]);
          } else {
            echo 'Rozmiar: ' . ($_myFILES["news_file"]["size"] / 1024) . ' kB<br>';

            $name = substr(md5(uniqid(rand(0, 100), true)), 0, 5) . "_" . $_myFILES["news_file"]["name"];

            move_uploaded_file($_myFILES["news_file"]["tmp_name"], "files/" . $name);

            try {
              //update zdjecia newsa
              $this->pdo->exec('UPDATE `news` SET `news_file`= \'' . $name . '\' WHERE  `news_id` IN (\'' . $_myPOST['news_id'] . '\')');
              $_SESSION['alerts'] = 'plik zapisany';
            } catch (PDOException $e) {

            }
          }
        }
      }
    }

    unset($_myPOST);
    unset($_POST);
    header("Location: news.php?id=" . $id);
    ob_end_flush();
    exit();
  }

  //wyswietlanie newsa/newsów
  public function showOrders($all = false, $status = '') {
    $temp = [];
    try {

      if ($all) {
        if ($status != '') {
          // @$temp = $this->pdo->query("SELECT * FROM `news` JOIN `category` ON category_id = news_category_id WHERE category_id IN ($status) ORDER BY news_update DESC");
        } else {
          @$temp = $this->pdo->query('SELECT * FROM `orders` ORDER BY order_update DESC');
        }
      } else {
        @$temp = $this->pdo->query('SELECT * FROM `news` WHERE `news_id` IN (\'' . $_GET['id'] . '\') ');
      }
      $orders = $temp->fetchAll();
      $temp->closeCursor();
    } catch (PDOException $e) {
      //exception
    }

    return $orders;
  }

  //wyswietlanie newsa/newsów
  public function showNews($all = false, $category = '') {

    try {

      if ($all) {
        if ($category != '') {
          @$temp = $this->pdo->query("SELECT * FROM `news` JOIN `category` ON category_id = news_category_id WHERE category_id IN ($category) ORDER BY news_update DESC");
        } else {
          @$temp = $this->pdo->query('SELECT * FROM `news` JOIN `category` ON category_id = news_category_id ORDER BY news_update DESC');
        }
      } else {
        @$temp = $this->pdo->query('SELECT * FROM `news` WHERE `news_id` IN (\'' . $_GET['id'] . '\') ');
      }
      $news = $temp->fetchAll();
      $temp->closeCursor();
    } catch (PDOException $e) {

    }

    return $news;
  }

  //settings
  public function getSettings($id) {

    try {
      $stmt = $this->pdo->query('SELECT * FROM `settings` WHERE `settings_id` IN (\'' . $id . '\') ');
      $all = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
    } catch (PDOException $e) {

    }
    return $all;
  }

  //save settings
  public function saveSettings($post, $id) {

    try {
      //update rekordu
      $this->pdo->exec('UPDATE `settings` SET '
              . '`settings_title_pl`= \'' . $post['panelNamePl'] . '\', '
              . '`settings_title_en`= \'' . $post['panelNameEn'] . '\', '
              . '`settings_content_pl`= \'' . $post['settingsPanelPl'] . '\', '
              . '`settings_content_en`= \'' . $post['settingsPanelEn'] . '\', '
              . '`settings_visible`= \'' . ($post['settingsVisible'] == 'on' ? 'yes' : 'no') . '\', '
              . '`settings_update`= \'' . time() . '\'  WHERE  `settings_id` IN (\'' . $id . '\')');

      alerts::setMessage('Ustawienia panelu zostały zaktualizowane');
    } catch (PDOException $e) {
      var_dump($e);
      die;
      alerts::setMessage('Wystąpił błąd');
    }
    header("Location: settings.php");
    ob_end_flush();
    exit();
  }

  //settings - get pages
  public function getPages() {

    try {
      $stmt = $this->pdo->query('SELECT * FROM `pages`');
      $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
    } catch (PDOException $e) {

    }
    return $all;
  }

  //settings - save page
  public function savePage($post) {

    try {
      //update rekordu
      $this->pdo->exec('UPDATE `pages` SET '
              . '`pages_name_pl`= \'' . $post['pagesNamePL'] . '\', '
              . '`pages_name_en`= \'' . $post['pagesNameEN'] . '\', '
              . '`pages_context_pl`= \'' . $post['contentPL'] . '\', '
              . '`pages_context_en`= \'' . $post['contentEN'] . '\', '
              . '`pages_update`= \'' . time() . '\', '
              . '`pages_visible`= \'' . ($post['pageVisible'] == 'on' ? 'yes' : 'no') . '\' '
              . ' WHERE  `pages_name` IN (\'' . $post['pageName'] . '\')');
      alerts::setMessage('Strona: "' . $post['pagesNamePL'] . '" została zaktualizowana');
    } catch (PDOException $e) {
      alerts::setMessage('Wystąpił błąd');
    }
    header("Location: settings.php");
    ob_end_flush();
    exit();
  }

  //settings youtube
  public function getYoutube() {

    try {
      $stmt = $this->pdo->query('SELECT * FROM `youtube` ORDER BY youtube_order ASC');
      $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
    } catch (PDOException $e) {

    }
    return $all;
  }

  //sort youtube
  public function sortYoutube($post) {

    foreach ((array) $post['order'] as $k => $v) {
      $this->pdo->exec('UPDATE `youtube` SET `youtube_order` = \'' . $k . '\' WHERE youtube_id IN (\'' . $v . '\')');
    }

    return array('message' => 'Linki zostały posortowane!');
  }

  //visibility youtube
  public function visibilityYoutube($post) {
    $status = $post['youtube_visibility_status'] == 'on' ? 'off' : 'on';

    $this->pdo->exec('UPDATE `youtube` SET `youtube_visible` = \'' . $status . '\' WHERE youtube_id IN (\'' . $post['youtube_visibility'] . '\')');

    return array('current_status' => $status);
  }

  //youtube delete
  public function removeYoutube($post) {
    try {

      //usuwanie rekordu
      $this->pdo->exec('DELETE FROM `youtube` WHERE `youtube_id` IN (\'' . $post['youtube_id'] . '\') ');
      alerts::setMessage('Link został usunięty');
      header("Location: settings.php");
      ob_end_flush();
      exit();
    } catch (PDOException $e) {

    }
  }

  //youtube update
  public function updateYoutube($post) {
    try {
      $this->pdo->exec('UPDATE `youtube` SET '
              . '`youtube_url`= \'' . $post['youtube_url'] . '\' '
              . ' WHERE  `youtube_id` IN (\'' . $post['youtube_id'] . '\')');
      alerts::setMessage('Link został zaktualizowany');
    } catch (PDOException $e) {
      alerts::setMessage('Wystąpił błąd');
    }
    header("Location: settings.php");
    ob_end_flush();
    exit();
  }

  //youtube save
  public function saveYoutube($post) {

    try {
      $this->pdo->exec('INSERT INTO `youtube` (`youtube_id`, `youtube_url`, `youtube_visible`) VALUES ( '
              . '"",'
              . '\'' . $post['youtube_url'] . '\', '
              . '\'' . ($post['youtube_visible'] == 'on' ? 'on' : 'off') . '\'  '
              . ')');
      alerts::setMessage('Nowy link został dodany');
    } catch (PDOException $e) {
      alerts::setMessage('Wystąpił błąd');
    }

    header("Location: settings.php");
    ob_end_flush();
    exit();
  }

  public function addEvent($_myPOST) {

    try {
      $time = time();
      if ($_myPOST['event_title'] != '' && $_myPOST['event_description'] != '') {
        $this->pdo->exec('INSERT INTO `events` (`event_id`, `event_title`, `event_description`, `event_insert`, `event_date`, `event_type`) VALUES ( '
                . '"",'
                . '\'' . $_myPOST['event_title'] . '\', '
                . '\'' . $_myPOST['event_description'] . '\',  '
                . '\'' . date('Y-m-d H:i:s', $time) . '\',  '
                . '\'' . $_myPOST['event_date'] . '\', '
                . '"1")');
        alerts::setMessage('Nowy event został dodany');
      } else {
        alerts::setMessage('Wystąpił błąd');
      }
      unset($_myPOST);
      header("Location: events.php");
      ob_end_flush();
      exit();
    } catch (PDOException $e) {

    }
  }

  public function updateEvent($post) {

    try {
      //update rekordu
      $this->pdo->exec('UPDATE `events` SET '
              . '`event_title`= \'' . $post['event_title'] . '\', '
              . '`event_description`= \'' . $post['event_description'] . '\', '
              . '`event_date`= \'' . $post['event_date'] . '\' WHERE  `event_id` IN (\'' . $post['event_id'] . '\')');
      alerts::setMessage('Event został zaktualizowany');
    } catch (PDOException $e) {
      alerts::setMessage('Wystąpił błąd');
    }
    header("Location: events.php");
    ob_end_flush();
    exit();
  }

  public function getEvent($id) {

    try {
      //usuwanie rekordu
      $stmt = $this->pdo->query('SELECT * FROM `events` WHERE `event_id` IN (\'' . $id . '\') ');
      $all = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
    } catch (PDOException $e) {

    }
    return $all;
  }

  //usuwanie evenu
  public function deleteEvent($id) {
    try {

      //usuwanie rekordu
      $this->pdo->exec('DELETE FROM `events` WHERE `event_id` IN (\'' . $id . '\') ');
      alerts::setMessage('Event został usunięty');
      header("Location: events.php");
      ob_end_flush();
      exit();
    } catch (PDOException $e) {

    }
  }

  //lista eventow
  public function eventsList() {

    try {
      $stmt = $this->pdo->query('SELECT * FROM `events` ORDER BY event_date DESC');
      $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
    } catch (PDOException $e) {

    }

    return $all;
  }

  //spradza czy event aktywny
  public function checkIfObsolete($time) {

    // $diff = date_diff(strtotime($time), time());
    $diff = (strtotime($time) - time());
    if ($diff < 0) {
      echo "class='danger'";
    }
    return;
  }

  //lista newsletter
  public function newsletterList($emailOnly = false) {

    try {
      $stmt = $this->pdo->query('SELECT * FROM `newsletter` ORDER BY `newsletter_insert` ASC');
      if ($emailOnly) {
        $stmt = $this->pdo->query('SELECT `newsletter_user`,`newsletter_email` FROM `newsletter` ORDER BY `newsletter_insert` ASC');
      }
      $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
    } catch (PDOException $e) {

    }

    return $all;
  }

  public function showCategories() {

    try {

      $stmt = $this->pdo->query('SELECT * FROM category ORDER BY category_name ASC');
      $categoryName = array();
      foreach ($stmt as $row) {
        $categoryName[$row['category_id']] = $row['category_name'];
      }
    } catch (PDOException $e) {

    }

    return $categoryName;
  }

  public function deleteImage($_myPOST, $location, $table) {


    try {

      $file = $this->pdo->query('SELECT `' . $table . '_image` FROM `' . $table . '` WHERE `' . $table . '_id` IN (\'' . $_myPOST[$table . '_id'] . '\')');
      $row = $file->fetch(PDO::FETCH_ASSOC);


      $file->closeCursor();
      $fileToDelete = $row[$table . '_image'];
      $this->pdo->exec('UPDATE `' . $table . '` SET `' . $table . '_image`= ""  WHERE  `' . $table . '_id` IN (\'' . $_myPOST[$table . '_id'] . '\')');

      $katalog = 'img/' . $table . '/';
      if (file_exists($katalog . $fileToDelete)) {
        unlink($katalog . $fileToDelete);
        unlink($katalog . 'small_' . $fileToDelete);
      }
    } catch (PDOException $e) {

    }

    $url = $location . '?id=' . $_myPOST[$table . '_id'];
    $this->redirect($url);
  }

  public function redirect($url) {
    unset($_POST);
    header("Location:" . $url);
    ob_end_flush();
    exit();
  }

  public function deleteFileNews($_myPOST, $location, $table) {

    try {

      $file = $this->pdo->query('SELECT `' . $table . '_file` FROM `' . $table . '` WHERE `' . $table . '_id` IN (\'' . $_myPOST[$table . '_id'] . '\')');
      $row = $file->fetch(PDO::FETCH_ASSOC);

      $file->closeCursor();
      $fileToDelete = $row[$table . '_file'];
      $this->pdo->exec('UPDATE `' . $table . '` SET `' . $table . '_file`= NULL  WHERE  `' . $table . '_id` IN (\'' . $_myPOST[$table . '_id'] . '\')');

      $katalog = 'files/' . $table . '/';
      if (file_exists($katalog . $fileToDelete)) {
        unlink($katalog . $fileToDelete);
      }
    } catch (PDOException $e) {

    }


    $url = $location . '?id=' . $_myPOST[$table . '_id'];
    $this->redirect($url);
  }

  public function deleteNews($id) {
    try {


      $file = $this->pdo->query('SELECT news_image FROM news WHERE `news_id` IN (\'' . $id . '\')');
      $row = $file->fetch(PDO::FETCH_ASSOC);
      $file->closeCursor();
      //usuwanie zdjecia lub plików
      $fileToDelete = $row['news_image'];
      $katalog = "img/news/";
      if (file_exists($katalog . $fileToDelete)) {
        unlink($katalog . $fileToDelete);
      }

      //usuwanie rekordu
      $this->pdo->exec('DELETE FROM `news` WHERE `news_id` IN (\'' . $id . '\') ');

      unset($_myGET);
      header("Location: admin.php");
      ob_end_flush();
      exit();
    } catch (PDOException $e) {

    }
  }

  public function addNews($_myPOST) {

    try {
      $time = time();
      (isset($_myPOST['news_visible']) == 'on') ? $visible = 'yes' : $visible = 'no';
      (isset($_myPOST['news_top']) == 'on') ? $top = 'yes' : $top = 'no';

      if ($_myPOST['news_title'] != '') {
        $this->pdo->exec('INSERT INTO `news` ('
                . '`news_id`,'
                . ' `news_title`,'
                . ' `news_desc`,'
                . ' `news_insert`,'
                . ' `news_update`,'
                . ' `news_visible`,'
                . '`news_top`,'
                . '`news_category_id`,'
                . '`news_user` ) VALUES ('
                . ' "",'
                . '  \'' . $_myPOST['news_title'] . '\','
                . ' \'' . $_myPOST['news_desc'] . '\','
                . '  \'' . $time . '\','
                . '  \'' . $time . '\','
                . ' \'' . $visible . '\','
                . ' \'' . $top . '\','
                . ' \'' . $_myPOST['news_category_id'] . '\' ,'
                . ' "1")');
      }

      unset($_myPOST);
      header("Location: news.php?id=" . $this->pdo->lastInsertId());
      ob_end_flush();
      exit();
    } catch (PDOException $e) {

    }
  }

  //zapisywanie wyników meczy
  public static function addScores($_myPOST, $category) {
    //var_dump($_myPOST);

    try {

      $this->pdo->exec('INSERT INTO `score` (`score_id`, `score_team_win`, `score_team_win_goals`, `score_team_loss`, `score_team_loss_goals`, `score_time`,`score_insert`,`score_category` ) VALUES ( "",  \'' . $_myPOST['score_team_win'] . '\', \'' . $_myPOST['score_team_win_goals'] . '\', \'' . $_myPOST['score_team_loss'] . '\',  \'' . $_myPOST['score_team_loss_goals'] . '\',  \'' . $_myPOST['score_time'] . '\', \'' . time() . '\', \'' . $category . '\' )');

      unset($_myPOST);
      header("Location: category.php");
      ob_end_flush();
      exit();
    } catch (PDOException $e) {

    }
  }

  public function setVisbility($id) {
    try {
      $stmt = $this->pdo->query('SELECT `news_visible` FROM news WHERE `news_id` IN (\'' . $id . '\')');
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      if ($row['news_visible'] == 'yes') {
        $this->pdo->exec('UPDATE `news` SET `news_visible`= "no"  WHERE  `news_id` IN (\'' . $id . '\')');
      } else {
        $this->pdo->exec('UPDATE `news` SET `news_visible`= "yes"  WHERE  `news_id` IN (\'' . $id . '\')');
      }
    } catch (PDOException $e) {

    }

    unset($_POST);
    unset($_GET);
    header("Location: admin.php");
    ob_end_flush();
    exit();
  }

  public function setTopVisbility($id) {
    try {

      $stmt = $this->pdo->query('SELECT `news_top` FROM news WHERE `news_id` IN (\'' . $id . '\')');
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      if ($row['news_top'] == 'yes') {
        $this->pdo->exec('UPDATE `news` SET `news_top`= "no"  WHERE  `news_id` IN (\'' . $id . '\')');
      } else {
        $this->pdo->exec('UPDATE `news` SET `news_top`= "yes"  WHERE  `news_id` IN (\'' . $id . '\')');
      }
    } catch (PDOException $e) {

    }

    unset($_POST);
    unset($_GET);
    header("Location: admin.php");
    ob_end_flush();
    exit();
  }

  //zapisywanie(edycja i dodawanie) terminarzu
  public function addSchedule($_myPOST, $update = false) {

    try {

      if ($update) {
        $id = $_myPOST['scheduleId'];
        $this->pdo->exec('UPDATE `schedule` SET
                             `scheduleDate`     =\'' . $_myPOST['scheduleDate'] . '\',
                             `scheduleDateName` =\'' . $_myPOST['scheduleDateName'] . '\',
                             `scheduleGameTime` =\'' . $_myPOST['scheduleGameTime'] . '\',
                             `scheduleMeetTime` =\'' . $_myPOST['scheduleMeetTime'] . '\',
                             `scheduleTeamHosts`=\'' . $_myPOST['scheduleTeamHosts'] . '\',
                             `scheduleTeamAway` =\'' . $_myPOST['scheduleTeamAway'] . '\',
                             `scheduleScore`    =\'' . $_myPOST['scheduleScore'] . '\',
                             `schedulePlayers`  =\'' . $_myPOST['schedulePlayers'] . '\',
                             `scheduleUpdate`   =\'' . time() . '\',
                             `scheduleType`     =\'' . $_myPOST['scheduleType'] . '\'
                             WHERE  `scheduleId` IN (\'' . $_myPOST['scheduleId'] . '\')');
      } else {

        $this->pdo->exec('INSERT INTO `schedule` (`scheduleId`, `scheduleDate`, `scheduleDateName`, `scheduleGameTime`, `scheduleMeetTime`, `scheduleTeamHosts`,`scheduleTeamAway`,`scheduleScore`, `schedulePlayers`, `scheduleUpdate`, `scheduleType` ) VALUES (
                                  "",
                                  \'' . $_myPOST['scheduleDate'] . '\',
                                  \'' . $_myPOST['scheduleDateName'] . '\',
                                  \'' . $_myPOST['scheduleGameTime'] . '\',
                                  \'' . $_myPOST['scheduleMeetTime'] . '\',
                                  \'' . $_myPOST['scheduleTeamHosts'] . '\',
                                  \'' . $_myPOST['scheduleTeamAway'] . '\',
                                  \'' . $_myPOST['scheduleScore'] . '\',
                                  \'' . $_myPOST['schedulePlayers'] . '\',
                                  \'' . time() . '\',
                                  \'' . $_myPOST['scheduleType'] . '\' )');
      }
      unset($_myPOST);
      if ($update) {
        header("Location: schedule.php?id=" . $id);
      } else {
        header("Location: schedule.php");
      }
      ob_end_flush();
      exit();
    } catch (PDOException $e) {

    }
  }

  //wyswietlanie wpisu terminarza/ listy terminarza
  public function showShedule($all = false, $type = '') {

    try {

      if ($all) {
        if ($type != '') {
          @$temp = $this->pdo->query("SELECT * FROM `schedule`  WHERE scheduleType IN ($type) ORDER BY scheduleDate DESC");
        } else {
          @$temp = $this->pdo->query('SELECT * FROM `schedule` ORDER BY scheduleDate DESC');
        }
        $list = $temp->fetchAll();
      } else {
        @$temp = $this->pdo->query('SELECT * FROM `schedule` WHERE `scheduleId` IN (\'' . $_GET['id'] . '\') ');
        $list = $temp->fetch();
      }

      $temp->closeCursor();
    } catch (PDOException $e) {

    }

    return $list;
  }

  //usuwanie newslettera @todo mail z potwierdzeniem
  public function deleteNewsletter($id) {
    try {

      //usuwanie rekordu
      $this->pdo->exec('DELETE FROM `newsletter` WHERE `newsletter_id` IN (\'' . $id . '\') ');
      alerts::setMessage('E-mail został usunięty');
      header("Location: newsletter.php");
      ob_end_flush();
      exit();
    } catch (PDOException $e) {

    }
  }

  public function exportHeaderCSV($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header('HTTP/1.1 200 OK');
    header("Expires: Tue, 03 Jul 20016 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    echo "\xEF\xBB\xBF"; // UTF-8 BOM
  }

  public function exportNewsletterCSV() {

    $fileName = "data_export_" . date("Y-m-d") . ".csv";
    $this->exportHeaderCSV($fileName);
    $array = $this->newsletterList(true);
    if (count($array) == 0) {
      return null;
    }
    ob_start();
    $df = fopen("php://output", 'w');
    fputcsv($df, array_keys(reset($array)), ";");

    foreach ($array as $row) {
      fputcsv($df, $row, ";");
    }
    fclose($df);
    echo ob_get_clean();
    die;
  }

  public function deleteShedule($id) {
    try {

      //usuwanie rekordu
      $this->pdo->exec('DELETE FROM `schedule` WHERE `scheduleId` IN (\'' . $id . '\') ');
      header("Location: list.php");
      ob_end_flush();
      exit();
    } catch (PDOException $e) {

    }
  }

  public function score($category) {

    try {

      $temp = $this->pdo->query("SELECT * FROM score WHERE `score_category` IN ('$category') ORDER BY score_insert DESC LIMIT 1");
      $score = $temp->fetch();
      $temp->closeCursor();
    } catch (PDOException $e) {

    }
    return $score;
  }

}

$adminActions = new db_actions();
