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
    $mail->Subject = "Zamówienie ze strony";
    $mail->Body = '<p style="font-size: 15px; margin-bottom: 10px;">Treść wiadomości:</p>'
            . '<table>'
            . '<tr><td>Od:</td><td> <b>' . $data['name'] . ' ' . $data['surname'] . '</b></td></tr>'
            . '<tr><td>Telefon:</td><td><b>' . ($data['phone'] ? $data['phone'] : '-') . '</b></td></tr>'
            . '<tr><td>Adres zamówienia:</td><td><b>' . $data['postal-code'] . ' ' . $data['city'] . '</b><br><b> ' . $data['street'] . ' ' . $data['number'] . ' </b></td></tr>'
            . '</table>'
            . '<p style="font-size: 15px; margin-bottom: 10px;"> Tabela: </p>'
            . $data['message'];


    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
      //echo 'Message could not be sent.';
      //echo 'Mailer Error: ' . $mail->ErrorInfo;
      //die;
    } else {
      //echo 'Message has been sent';
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

}

$save = new mailController();
$save->saveMessage();
