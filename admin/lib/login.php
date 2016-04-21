<?php

require_once(__DIR__ . "/../config/config.php");
require_once(__DIR__ . "/../config/dbController.php");

class loginAction {

  protected $pdo;

  function __construct() {
    $this->checkUser();
    $dbController = dbController::getInstance();
    $this->pdo = $dbController->setConnection();
  }

  function checkUser() {
    if (isset($_SESSION['goodLogin'])) {
      header('Location: admin');
      ob_end_flush();
      exit();
    }
  }

  function login() {

    $alert = '<div class="container-fluid" style="margin-top:10px;">
                <div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Uwaga! </strong> Użykownik nie został znaleziony ...
                </div>
                </div>';

    if (isset($_POST["submit"])) {

      try {
        $stmt = $this->pdo->query('SELECT `login_salt` FROM `login` WHERE   login_login IN (\'' . $_POST['username'] . '\')');
        $usr  = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
      } catch (PDOException $e) { }

      if ($stmt->rowCount() !== 0) {

        $pass = md5($_POST['password'] . $usr['login_salt']);
        $stmt = $this->pdo->query('SELECT `login_login` FROM `login` WHERE   login_login IN (\'' . $_POST['username'] . '\') AND  login_pass IN (\'' . $pass . '\')');

        if ($stmt->rowCount() !== 0) {
          $_SESSION['user'] = $_POST['username'];
          $_SESSION['goodLogin'] = 'yes';
          header('Location: admin');
          ob_end_flush();
          exit();
        } else {
          echo $alert;
        }
      } else {
        echo $alert;
      }
    }
  }

}

$login = new loginAction();
$login->login();
