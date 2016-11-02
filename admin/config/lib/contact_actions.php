<?php

require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../dbController.php");

require_once("methods.php");

class contact {

  protected $db = null;
  protected $response = array();
  const ABOUT_PAGE = 'about';
  
  public function __construct() {
    $dbController = dbController::getInstance();
    $this->db = $dbController->setConnection();
  }
  
  public function contactList() {
    try {
      $stmt = $this->db->query('SELECT * FROM `contact` ORDER BY `contact_insert` ASC');
      $this->response = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
    } catch (PDOException $e) {

    }
    
    return $this->response;         
  }
  
  public function getAboutPage() {
   
    try {
      $stmt = $this->db->query('SELECT * FROM `pages` WHERE `pages_name` IN (\'' . self::ABOUT_PAGE . '\')');
      $this->response['data'] = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
    } catch (PDOException $e) {

    }
    
    return $this->response;
  }
  
  public function deleteContact($id) {
    try {
      $this->db->exec('DELETE FROM `contact` WHERE `contact_id` IN (\'' . $id . '\') ');       
      
      alerts::setMessage('Wiadomość została usunięta');
      header("Location: contact.php");
      ob_end_flush();
      exit();
    } catch(PDOException $e){    
      
    }
  }

  public function insertMessage($data) {
    try {     
      $stmt = $this->db->prepare('INSERT INTO `contact` (`contact_user`, `contact_email`, `contact_message`, `contact_topic`, `contact_insert`)	VALUES(
				:user,
				:email,
				:message,
				:topic,
				:insert)');	
 
			$stmt -> bindValue(':user', '', PDO::PARAM_STR);
			$stmt -> bindValue(':email', $data['email'], PDO::PARAM_STR);
			$stmt -> bindValue(':message', $data['message'], PDO::PARAM_STR);
			$stmt -> bindValue(':topic', $data['topic'], PDO::PARAM_STR);
			$stmt -> bindValue(':insert', time(), PDO::PARAM_INT);
 
			$ilosc = $stmt->execute(); 
            $stmt->closeCursor();	 
            
			if($ilosc > 0) {
        return 'ADED_NEW_MESSAGE';
			} else {
        return 'ERR_ADDING_MESSAGE';
			}
      
    } catch(PDOException $e){      
      return $e->getMessage();
    }     
  }
  
  public function addMessage($data) {
        
    $params = array();
    parse_str($data, $params);
    
    try {
      if (filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {       
          $this->response['ok'] = $this->insertMessage($params);
          
      } else {
        $this->response['err'] = 'incorrect_email';                
      }
    } catch (Exception $ex) {
      $this->response['exc'] = 'Some exception occured';
      $this->response['exc_message'] = $ex->getMessage();
    }
    return $this->response;        
  }
}

