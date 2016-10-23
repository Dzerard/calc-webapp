<?php

class helpers {

  public static function clearHtml($string) {
    //$help = htmlentities($string, ENT_QUOTES, "UTF-8");
    return strip_tags($string);
  }

  public static function statusLabel($type) {

    switch ($type) {

      case('waiting') :
        $label = '<span class="label label-default">Oczekujące na wpłatę</span>';
        break;
      case('closed') :
        $label = '<span class="label label-success">Zakończone</span>';
        break;
      case('open') :
        $label = '<span class="label label-warning">Sprzedane</span>';
        break;
      case('paid') :
        $label = '<span class="label label-inverse">Zapłacone</span>';
        break;
      case('pobranie') :
        $label = '<span class="label label-inverse"><strong>Pobranie</strong></span>';
        break;
      default:
        $label = '<span class="label">-</span>';
    }

    echo $label;
  }

  public static function link($category, $id) {
    return htmlspecialchars($category . '/' . $id);
  }

  public static function linkCategory($category, $subcategory) {
    return htmlspecialchars($category . '/' . $subcategory);
  }

  public static function myLabels($id, $name) {

    switch ($id) {

      case(1) :
        $label = '<span class="label label-info">' . $name . '</span>';
        break;
      case(2) :
        $label = '<span class="label label-success">' . $name . '</span>';
        break;
      case(3) :
        $label = '<span class="label label-inverse">' . $name . '</span>';
        break;
      case(4) :
        $label = '<span class="label label-important">' . $name . '</span>';
        break;
      default:
        $label = '<span class="label">' . $name . '</span>';
    }

    echo $label;
  }

}

class methods {

  function __construct() {

  }

  public function is_logged() {
    return $this->logged;
  }

  public function logout($header) {
    ob_start();
    session_start();
    session_unset();
    session_destroy();
    header('Location: ' . $header);
    ob_end_flush();
  }

}

$allowedExts = array("jpg", "jpeg", "gif", "png", "ico");

class alerts {

  function __construct() {

  }

  public static function setMessage($message) {
    $_SESSION['alerts'] = $message;
  }

  public static function flushAlert($code) {
    echo '<div class="container"><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Return Code: " ' . $code . ' "<br></div></div>';
  }

  public static function flushAlert_2($code = null) {
    echo '<div class="container"><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Nieobsługiwany format pliku !</div></div>';
  }

}

class navi {

  function __construct() {

  }

  public static function menuNavi($name) {

    $myMenu = '<div class="navbar navbar-inverse navbar-fixed-top">
                        <div class="navbar-inner">
                          <div class="container">
                            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                            <form class="navbar-form pull-right" action="admin.php" method="post">
                                <button type="submit" class="btn btn-danger btn-medium btn-logout" data-placement="left" title="wyloguj" name="logout"><i class="icon-off icon-white"></i></button>
                            </form>
                            <a class="brand" href="../">Pszczółka Calc Admin</a>
                            <div class="nav-collapse collapse">
                              <ul class="nav">
                                <li ' . ($name == "admin" ? "class='active'" : " " ) . '><a href="admin.php">Zamówienia</a></li>
                              </ul>

                            </div><!--/.nav-collapse -->
                          </div>
                        </div>
                      </div>';
    return htmlspecialchars_decode($myMenu);
  }

}

class baseController {

  public function redirect($url) {
    unset($_POST);
    header("Location:" . $url);
    ob_end_flush();
    exit();
  }

}
