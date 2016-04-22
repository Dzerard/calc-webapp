<?php

require_once(__DIR__ . "/admin/config/config.php");
require_once(__DIR__ . "/admin/config/dbController.php");
require __DIR__ . '/phpmailer/phpmailer/PHPMailerAutoload.php';

class mailController {

  //protected $storePath = null;
  protected $response = array();
  protected $errors = array();
  protected $pdo;
  static $_KEY = '6LeSKRkTAAAAADuRJ348BPWJYTeTTXe5IeLFg0pW';  
  
  public function __construct() {          
    $dbController = dbController::getInstance();
    $this->pdo = $dbController->setConnection();    
    //$this->storePath = __DIR__ . '/../../public/uploads/';
  }

  public function sendMail($data) {

    $message = file_get_contents('mail/index.html');
    $address = $data['postal-code'] . ' ' . $data['city'] . '<br>' . $data['street'] . ' ' . $data['number'];

    $message = str_replace('[SUBJECT]', 'Zamówienie', $message);
    $message = str_replace('[CLIENTS.WEBSITE]', 'http://lukaszgielar.com', $message);
    $message = str_replace('[NAME]', $data['name'] . ' ' . $data['surname'], $message);
    $message = str_replace('[PHONE]', ($data['phone'] ? $data['phone'] : '-'), $message);
    $message = str_replace('[ADRESS]', $address, $message);
    $message = str_replace('[TOTAL]', $data['total'], $message);
    $message = str_replace('[DELIVERY]', '20zł', $message);
    $message = str_replace('[ITEMS]', $data['message'], $message);
    $message = str_replace('[CLIENTS.WEBSITE.ASSETS]', 'http://lukaszgielar.com/work/calc/mail/', $message);

    $mail = new PHPMailer;
    $mail->setLanguage('pl');
    $mail->CharSet = "UTF-8";
    $mail->From = $data['email'];
    $mail->FromName = 'Formularz kontaktowy';
    $mail->addAddress('gielarek@gmail.com', 'Kontakt Pszczółka Admin');     // Add a recipient
    $mail->addAddress('pawelgrus@outlook.com', 'Kontakt Pszczółka');     // Add a recipient
    $mail->addReplyTo('gielarek@gmail.com', 'Kontakt');

    // Set email format to HTML
    $mail->isHTML(true);
    $mail->MsgHTML($message);
    $mail->Subject = "Zamówienie ze strony";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
      //echo 'Message could not be sent.';
      //echo 'Mailer Error: ' . $mail->ErrorInfo;
      //die;
    } else {
        //echo 'Message has been sent';
        $this->addOrder($data);
    }

    return true;
  }

  public function saveMessage() {

    if (isset($_POST['data'])) {
      $params = array();
      parse_str($_POST['data'], $params);

      if ($this->validForm($params)) {
        $this->sendMail($params);
      }

      echo json_encode($this->response);
    }
  }

  public function validMail($str) {
    if (filter_var($str, FILTER_VALIDATE_EMAIL) === false) {
      $this->errors['email'] = 'invalid_email';
      return false;
    }
  }

  public function validStrLength($str, $min, $name) {
    $len = strlen($str);
    if ($len < $min) {
      $this->errors[$name] = 'to_small_words';
      return false;
    }
  }

  public function validForm($data) {

    $this->validMail($data['email']);
    $this->validStrLength($data['name'], 1, 'name');
    $this->validStrLength($data['surname'], 1, 'surname');
    $this->validStrLength($data['city'], 1, 'city');
    $this->validStrLength($data['postal-code'], 1, 'postal-code');
    $this->validStrLength($data['number'], 1, 'number');
    $this->validStrLength($data['message'], 1, 'message');
    $this->validStrLength($data['street'], 1, 'street');

    if (!empty($this->errors)) {
      $this->response['err'] = $this->errors;
      return false;
    } else {
      $this->response['ok'] = 'good_data';
    }

    return true;
  }
  
  public function addOrder($post) {

    try {
      $time = time();      
      $address = $data['street'] . ' ' . $data['number']; 

      if ($post['message'] != '') {
        $this->pdo->exec('INSERT INTO `orders` ('
                . ' `order_id`,'
                . ' `order_name`,'                
                . ' `order_text`,'
                . ' `order_val`,'
                . ' `order_address`,'
                . ' `order_create`,'
                . ' `order_update`,'
                . ' `order_status`,'
                . ' `order_city`,'
                . ' `order_postal_code`,'
                . ' `order_phone`,'
                . ' `order_email`,'
                . ' `order_delivery_value`'                
                . ') VALUES ('
                . ' "",'
                . ' \'' . $post['name'] . '\','
                . ' \'' . $post['message'] . '\','
                . ' \'' . $post['total'] . '\','                
                . ' \'' . $post['street'] . ' ' . $post['number'] . '\','       
                . ' \'' . $time . '\','
                . ' \'' . $time . '\','
                . ' \'' . 'waiting' . '\','
                . ' \'' . $post['city'] . '\','   
                . ' \'' . $post['postal-code'] . '\','       
                . ' \'' . $post['phone'] . '\','                   
                . ' \'' . $post['email'] . '\','                    
                . ' \'' . '20zł ?' . '\' '
                . ' )');
      }
    } catch (PDOException $e) {
        //
    }
  }
}

$save = new mailController();
$save->saveMessage();
