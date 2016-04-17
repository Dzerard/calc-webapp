<?php
require_once("config/config.php"); 
require_once("config/dbController.php"); 

class methods {	
  
  protected $db;
  function __construct(){     
    $dbController = dbController::getInstance();
    $this->db = $dbController->setConnection();
  }

  public static function fileAdd($name) {
      $name   = "lib/tree/$name.php";
      $file   = fopen($name,'r');
      $output = fread($file, filesize($name));
      fclose($file);				
      printf($output);
  }	

  /**
   * Wyświetlanie dostępnych wszsytkich/i z limitem wiadomości
   * @param int $limit
   * @return array
   */
  public function lastNews($limit = 0) {

    try {
      if ($limit == 0) {
        $temp = $this->db->query("SELECT * FROM news JOIN category ON category_id = news_category_id WHERE `news_visible` IN ('yes')  ORDER BY news_insert DESC");
      } else {
        $temp = $this->db->query("SELECT * FROM news JOIN category ON category_id = news_category_id WHERE `news_visible` IN ('yes')  ORDER BY news_insert DESC LIMIT $limit");
      }

      $news = $temp->fetchAll();
      $temp->closeCursor();
    } catch (PDOException $e) {
      //var_dump($e);
    }
    return $news;
  }

  /**
   * Wyświetlanie trzech informacji w sliderze
   * @return array
   */
  public function nivoNews() {

    try {
      $temp = $this->db->query("SELECT * FROM news JOIN category ON category_id = news_category_id WHERE `news_visible` IN ('yes') AND `news_top` IN ('yes') ORDER BY news_insert DESC LIMIT 4");
      $nivo = $temp->fetchAll();
      $temp->closeCursor();
    } catch (PDOException $e) {
      //var_dump($e);
    }
    return $nivo;
  }

  /**
   * Wyświetlanie dostępnych konkretnych kategori
   * @param string $category
   * @param string $subcategory
   * @return array
   */
  public function lastNewsCategory($category, $subcategory='') {		

    try {
      if ($subcategory != '') {
        $temp = $this->db->query("SELECT * FROM news JOIN category ON category_id = news_category_id WHERE `category_name` IN ('$category') AND `news_visible` IN ('yes') AND `news_subcategory` IN ('$subcategory') ORDER BY news_insert DESC");
      } else {
        $temp = $this->db->query("SELECT * FROM news JOIN category ON category_id = news_category_id WHERE `category_name` IN ('$category') AND `news_visible` IN ('yes') ORDER BY news_insert DESC");
      }
      $news = $temp->fetchAll();
      $temp->closeCursor();
    } catch (PDOException $e) {
      //var_dump($e);
    }
    return $news;
  }

  /**
   * Terminarz 
   */    
  public function scheduleForCategory($all=false, $type='', $id) {		  	

    try {
      if ($all) {
        if ($type != '') {
          $temp = $this->db->query("SELECT * FROM `schedule`  WHERE `scheduleType` IN ('$type') ORDER BY scheduleDate DESC");
        } else {
          $temp = $this->db->query('SELECT * FROM `schedule` ORDER BY scheduleDate DESC');
        }
        $list = $temp->fetchAll();
      } else {
        $temp = $pdo->query('SELECT * FROM `schedule` WHERE `scheduleId` IN (\'' . $_GET['id'] . '\') ');
        $list = $temp->fetch();
      }
      $temp->closeCursor();
    } catch (PDOException $e) {
      //var_dump($e);
    }
    return $list;
  }

  /**
   * Informacje o trenerach
   * @return array
   */	 
  public function coachInfo() {		

    try{
      $temp  = $this->db->query("SELECT * FROM coach");			 
      $coach = $temp->fetchAll();			  
      $temp->closeCursor();	 
    }	  catch(PDOException $e){}        

    return $coach;
  }

  /**
   * Pojedyńczy news
   * @param int $id
   * @return array
   */
  public function oneNews($id) {			

    try{
      $temp = $this->db->query("SELECT * FROM news WHERE `news_id` IN ('$id') ");			 
      $news = $temp->fetch();			  
      $temp->closeCursor();	 
    } catch(PDOException $e){}        

    return $news;
  }

  public function loadGallery($id = '') {

    try {		
      if ($id == '') {
        $stmt = $this->db->query("SELECT * FROM gallery WHERE `gallery_visible` IN ('yes') ORDER BY gallery_insert DESC");
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
        $stmt = $this->db->query("SELECT * FROM gallery WHERE `gallery_id` IN ('$id')  AND `gallery_visible` IN ('yes')");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      }
      $stmt->closeCursor();					 			  
    } catch(PDOException $e){}

    return $row;
  }

  public function loadLastAddedGallery() {
    try {		     
//      $stmt = $this->db->query("SELECT * FROM pic WHERE pic_gallery_id =(SELECT `gallery_id` FROM gallery ORDER BY `gallery_insert` DESC LIMIT 1 ) ");
      $stmt = $this->db->query("SELECT * FROM pic WHERE pic_gallery_id =3 ");
      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();					 			  
    } catch(PDOException $e){}

    return $row;
  }
  public function getAllEvents() {
    try {		     
      $stmt = $this->db->query("SELECT * FROM events ORDER BY event_date DESC");
      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();					 			  
    } catch(PDOException $e){}

    return $row;   
  }
  
  
  public function loadLastEvents($limit=5) {
    try {		     
      $stmt = $this->db->query("SELECT * FROM events ORDER BY event_date DESC LIMIT $limit ");
      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();					 			  
    } catch(PDOException $e){}

    return $row;
  }
  public function loadGalleryPics($id) {
    try {
      $stmt = $this->db->query('SELECT * FROM pic WHERE `pic_gallery_id` IN (\'' . $id . '\')');
      $pics = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
    } catch(PDOException $e){}

    return $pics;
  }	 
  
  //settings
  public function getSettings() {
    
    //static 
    $id = 1;
    
    try {
      $stmt = $this->db->query('SELECT * FROM `settings` WHERE `settings_id` IN (\'' . $id . '\') ');
      $all = $stmt->fetch(PDO::FETCH_ASSOC);      
      $stmt->closeCursor();  
    } catch (PDOException $e) { }
    return $all;        
  }
  
  //getPageByName
  public function getPage($name) {
    $page = null;
    try {
      $stmt = $this->db->query('SELECT * FROM `pages` WHERE `pages_name` IN (\'' . $name . '\') ');
      $page = $stmt->fetch(PDO::FETCH_ASSOC);      
      $stmt->closeCursor();  
    } catch (PDOException $e) { }
    return $page;     
  }
}

require_once("helpers.php"); 
require_once("app.php"); 