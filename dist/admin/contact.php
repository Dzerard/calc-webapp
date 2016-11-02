<?php
ob_start();
session_start();
require_once("config/lib/data_actions.php");
require_once("lib/newsletter.php");

if (isset($_SESSION["user"])) {
  require_once("lib/_partials/admin_head.phtml");
  echo navi::menuNavi('contact');
  ?>
  <div class="container">
    <?php  require_once("lib/_partials/admin_messages.phtml");  ?>
    <div class="hero-unit">
      <p>Formularz kontaktowy:</p>
      <div class="row-fluid">

        <div class="row-fluid">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="span1 td-spec">ID</th>
                <th class="span2 td-spec">Imię i Nazwisko(Nick)</th>
                <th class="span1 td-spec">E-mail</th>
                <th class="span1 td-spec">Data dodania</th>
                <th class="span2 td-spec">Akcje</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list as $i) : ?>
                <tr>
                  <td class="td-spec-2"><?php echo $i['newsletter_id'] ?></td>
                  <td class="td-spec-2"><?php echo $i['newsletter_user'] ?></td>
                  <td class="td-spec-2"><?php echo $i['newsletter_email'] ?></td>
                  <td class="td-spec-2"><?php echo date('d-m-Y G:i', $i['newsletter_insert']) ?></td>
                  <td class="td-spec-2">
                    <a href="newsletter.php?del_id=<?php echo $i['newsletter_id'] ?>" title="Usuń" class="tool" style="margin-left:8px;">
                      <i class="icon-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <a href="newsletter.php?export=true" class="btn btn-default">Eksport CSV</a>
      </div>
    </div>
  </div>

  <?php
  require_once("lib/_partials/admin_footer.phtml");
}
else {
  ob_start();
  header("Location: login.php");
  ob_end_flush();
  exit();
}
?>
