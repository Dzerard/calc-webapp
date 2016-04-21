<?php
ob_start();
session_start();
require_once("lib/login.php");
require_once("lib/_partials/admin_head.phtml");
?>
<div class="container-fluid">
  <div class="my-form">
    <form class="form-signin" action="" method="post">
      <h2 class="form-signing-heading">Logowanie</h2>
      <input type="text" class="input-block-level my-font sm-font" placeholder="Login" name="username" required>
      <input type="password" class="input-block-level my-font sm-font" placeholder="Hasło" name="password">
      <input type="submit" value="Zaloguj" name="submit" class="btn btn-inverse my-font" />
    </form>
  </div>
</div>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
