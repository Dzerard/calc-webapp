<?php

require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../dbController.php");

require_once("methods.php");

class gallery {

  protected $pdo;

  function __construct() {
    $dbController = dbController::getInstance();
    $this->pdo = $dbController->setConnection();
  }

  public function saveGallery($_myPOST, $id, $_myFILES) {

    //var_dump('UPDATE `gallery` SET `gallery_name`= \''.$_myPOST['gallery_name'].'\', `gallery_desc`= \''.$_myPOST['gallery_desc'].'\', `gallery_visible`= \''.$visible.'\'  WHERE  `gallery_id` IN (\''.$id.'\')');
    try {
      (isset($_myPOST['gallery_visible']) == 'on') ? $visible = 'yes' : $visible = 'no';
      $this->pdo->exec('UPDATE `gallery` SET `gallery_title`= \'' . $_myPOST['gallery_title'] . '\', `gallery_desc`= \'' . $_myPOST['gallery_desc'] . '\', `gallery_visible`= \'' . $visible . '\', `gallery_update`= \'' . time() . '\'  WHERE  `gallery_id` IN (\'' . $id . '\')');
      // exit();
    } catch (PDOException $e) {
      
    }

    if (isset($_myFILES["gallery_img"])) {

      $extension = end(explode(".", $_myFILES["gallery_img"]["name"]));
      $allowedExts = array("jpg", "jpeg", "gif", "png", "ico");

      if ($_myFILES["gallery_img"]["type"] != "") {

        if ((($_myFILES["gallery_img"]["type"] == "image/gif") || ($_myFILES["gallery_img"]["type"] == "image/jpeg") || ($_myFILES["gallery_img"]["type"] == "image/png") || ($_myFILES["gallery_img"]["type"] == "image/pjpeg")) && ($_myFILES["gallery_img"]["size"] < 2000000) && in_array($extension, $allowedExts)) {

          if ($_myFILES["gallery_img"]["error"] > 0) {
            echo $_myFILES["file"]["error"];
          } else {
            echo 'Rozmiar: ' . ($_myFILES["gallery_img"]["size"] / 1024) . ' kB<br>';

            $name = substr(md5(uniqid(rand(0, 100), true)), 0, 5) . "_" . $_myFILES["gallery_img"]["name"];

            move_uploaded_file($_myFILES["gallery_img"]["tmp_name"], "img/gallery/" . $name);

            // The file
            $filename = 'img/gallery/' . $name;
            $new_width = 480;
            $new_height = 270;

            // Content type
            if ($_myFILES["gallery_img"]["type"] == "image/jpeg") {

              header('Content-Type: image/jpeg');
              // Get new dimensions
              list($width, $height) = getimagesize($filename);

              // Resample
              $image_p = imagecreatetruecolor($new_width, $new_height);
              $image = imagecreatefromjpeg($filename);
              imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
              imagejpeg($image_p, "img/gallery/small_" . $name, 100);
            } else {

              header('Content-Type: image/png');
              // Get new dimensions
              list($width, $height) = getimagesize($filename);

              // Resample
              $image_p = imagecreatetruecolor($new_width, $new_height);
              $image = imagecreatefrompng($filename);
              imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
              imagepng($image_p, "img/gallery/small_" . $name, 9);
              imagedestroy($image);
            }

            echo "Zapisany w katalogu: img/gallery/" . $name;

            try {
              //update tabeli pic		
              $this->pdo->exec('INSERT INTO `pic` (`pic_id`, `pic_gallery_id`, `pic_name` ) VALUES ( "", \'' . $id . '\', \'' . $name . '\' )');
            } catch (PDOException $e) {
              
            }
          }
        } else {
          echo 'jakis blad';
        }
      }
    }

    unset($_POST);
    unset($_GET);
    header("Location: colors_edit.php?id=" . $id);
    ob_end_flush();
    exit();
  }

  public function loadGallery($id = '') {

    try {

      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if ($id == '') {
        $stmt = $this->pdo->query('SELECT * FROM gallery');
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
        $stmt = $this->pdo->query('SELECT * FROM gallery WHERE `gallery_id` IN (\'' . $id . '\')');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      }

      $stmt->closeCursor();
    } catch (PDOException $e) {
      
    }

    return $row;
  }

  public function loadGalleryPics($id) {
    try {

      $stmt = $this->pdo->query('SELECT * FROM pic WHERE `pic_gallery_id` IN (\'' . $id . '\')');
      $pics = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
    } catch (PDOException $e) {
      
    }

    return $pics;
  }

  public function delGallery($id) {

    try {

      $this->pdo->exec('DELETE FROM `gallery` WHERE `gallery_id` IN (\'' . $id . '\') ');

      //dorobic petle do usuwania zdjec
      $file = $this->pdo->query('SELECT * FROM `pic` WHERE `pic_gallery_id` IN (\'' . $id . '\')');
      $row = $file->fetchAll(PDO::FETCH_ASSOC);
      $file->closeCursor();
      $katalog = "img/gallery/";

      foreach ($row as $i) {
        if (file_exists($katalog . $i['pic_name'])) {
          unlink($katalog . $i['pic_name']);
          unlink($katalog . 'small_' . $i['pic_name']);
        }
      }

      $this->pdo->exec('DELETE FROM `pic` WHERE `pic_gallery_id` IN (\'' . $id . '\') ');
    } catch (PDOException $e) {
      
    }

    unset($_POST);
    header('Location: colors.php');
    ob_end_flush();
    exit();
  }

  public function addGallery($_myPOST) {

    try {
      $time = time();
      (isset($_myPOST['gallery_visible']) == 'on') ? $visible = 'yes' : $visible = 'no';


      if ($_myPOST['gallery_title'] != '') {

        $this->pdo->exec('INSERT INTO `gallery` (`gallery_id`, `gallery_title`, `gallery_desc`, `gallery_insert`, `gallery_update`, `gallery_visible` ) VALUES ( "",  \'' . $_myPOST['gallery_title'] . '\', \'' . $_myPOST['gallery_desc'] . '\',  \'' . $time . '\',  \'' . $time . '\', \'' . $visible . '\')');
      }

      unset($_myPOST);
      header("Location: colors_edit.php?id=" . $this->pdo->lastInsertId());
      ob_end_flush();
      exit();
    } catch (PDOException $e) {
      
    }
  }

  public function delImage($id) {

    try {


      $file = $this->pdo->query('SELECT * FROM `pic` WHERE `pic_id` IN (\'' . $id . '\') ');
      $fileDel = $file->fetch(PDO::FETCH_ASSOC);
      $file->closeCursor();

      $this->pdo->exec('DELETE FROM `pic` WHERE `pic_id` IN (\'' . $id . '\') ');

      $katalog = 'img/gallery/';
      if (file_exists($katalog . $fileDel['pic_name'])) {
        unlink($katalog . $fileDel['pic_name']);
        unlink($katalog . 'small_' . $fileDel['pic_name']);
      }
    } catch (PDOException $e) {
      
    }


    $idBack = $fileDel['pic_gallery_id'];

    unset($_myPOST);
    header("Location: colors_edit.php?id=" . $idBack);
    ob_end_flush();
    exit();
  }

  public function setVisbility($id) {
    try {

      $stmt = $this->pdo->query('SELECT `gallery_visible` FROM gallery WHERE `gallery_id` IN (\'' . $id . '\')');
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      if ($row['gallery_visible'] == 'yes') {
        $this->pdo->exec('UPDATE `gallery` SET `gallery_visible`= "no"  WHERE  `gallery_id` IN (\'' . $id . '\')');
      } else {
        $this->pdo->exec('UPDATE `gallery` SET `gallery_visible`= "yes"  WHERE  `gallery_id` IN (\'' . $id . '\')');
      }
    } catch (PDOException $e) {
      
    }

    unset($_POST);
    unset($_GET);
    header("Location: colors.php");
    ob_end_flush();
    exit();
  }

  //ajax
  public function updatePictureTitle($_myPOST) {
    try {
      $id = $_myPOST['singlePicture'];
      $this->pdo->exec('UPDATE `pic` SET `pic_title`= \'' . $_myPOST['title'] . '\'  WHERE  `pic_id` IN (\'' . $id . '\')');
      
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }
  
  public function getAllPics() {
     
    //troche to do dupy ale bedzie
    try {      
      $temp = $this->pdo->query('SELECT `pic_gallery_id`,`pic_id`,`pic_name`,`pic_title` FROM `gallery` JOIN `pic` ON pic_gallery_id = gallery_id ORDER BY gallery_id DESC');      
      $pics = $temp->fetchAll(PDO::FETCH_ASSOC);
      $temp->closeCursor();
      
      $temp2 = $this->pdo->query('SELECT * FROM `gallery`');      
      $data['schemes'] = $temp2->fetchAll(PDO::FETCH_ASSOC);
            
      foreach ($data['schemes'] as $k => $i) {
        
        foreach ($pics as $kk => $ii) {
        
          if($ii['pic_gallery_id'] == $i['gallery_id']) {
            $data['schemes'][$k]['pics'][] = $pics[$kk];
          }
        } 
      }
      
      $temp2->closeCursor();
    } catch (PDOException $e) {
      
      //return false;
    }
    
    return $data;
  }
}