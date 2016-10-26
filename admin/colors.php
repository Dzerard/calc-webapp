<?php
ob_start();
session_start();
require_once("config/lib/data_actions.php");
require_once("lib/order.php");

if (isset($_SESSION["user"])) {

  require_once("lib/_partials/admin_head.phtml");
  echo navi::menuNavi('colors');
  ?>
  <div class="container">
    <?php if (isset($_SESSION['alerts'])) : ?>
      <div class="alert alert-custom">
        <?php echo $_SESSION['alerts'] ?>
      </div>
    <?php endif; ?>

    <div class="hero-unit">
      <p>Kolory:</p>
      <div class="row-fluid">

      </div>
    </div>
  </div>

  <?php
  require_once("lib/_partials/admin_footer.phtml");
  unset($_SESSION['alerts']);
} else {
  require_once("lib/_partials/admin_footer_location.phtml");
}
?>
