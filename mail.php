<?php

require __DIR__ . '/phpmailer/phpmailer/PHPMailerAutoload.php';

class mailController {

  //protected $storePath = null;
  protected $response = array();
  protected $errors = array();
  static $_KEY = '6LeSKRkTAAAAADuRJ348BPWJYTeTTXe5IeLFg0pW';

  public function __construct() {
    //$this->storePath = __DIR__ . '/../../public/uploads/';
  }

  public function sendMail($data) {

    $mail = new PHPMailer;
    $mail->setLanguage('pl');
    $mail->CharSet = "UTF-8";
    $mail->From = $data['email'];
    $mail->FromName = 'Formularz kontaktowy';
    $mail->addAddress('gielarek@gmail.com', 'Kontakt Pszczółka');     // Add a recipient
    $mail->addReplyTo('gielarek@gmail.com', 'Kontakt');


    // Set email format to HTML
    $mail->isHTML(true);
    $mail->Subject = $data['topic'];
    $mail->Body = 'Treść wiadomości<br><b>' . $data['message'] . '</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
      echo 'Message has been sent';
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
    $this->validStrLength($data['topic'], 1, 'topic');
    $this->validStrLength($data['message'], 1, 'message');

    if (!empty($this->errors)) {
      $this->response['err'] = $this->errors;
      return false;
    } else {
      $this->response['ok'] = 'good_data';
    }
  }

}

$save = new mailController();
$save->saveMessage();
