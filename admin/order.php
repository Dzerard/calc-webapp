<?php
ob_start();
session_start();
require_once("config/lib/data_actions.php");
require_once("lib/order.php");

if (isset($_SESSION["user"])) {

  require_once("lib/_partials/admin_head.phtml");
  echo navi::menuNavi('admin');
  ?>
  <div class="container">
    <?php if (isset($_SESSION['alerts'])) : ?>
      <div class="alert alert-custom">
        <?php echo $_SESSION['alerts'] ?>
      </div>
    <?php endif; ?>
    <div class="print-show">
      <h3>Zamówienie z Kalkulator Pszczółka <small>(z dnia <?php echo date('d-m-Y G:i', $order[0]['order_create']); ?>)</small></h3>
    </div>

    <div class="hero-unit">
      <p>Szczegóły zamówienia:</p>
      <div class="row-fluid">
        <form class="form-horizontal" action="order.php" method="post">
          <input type="hidden" name="order_id" value="<?php echo $order[0]['order_id']; ?>">

          <div class="control-group">
            <label class="control-label" for="inputTitle">Imię i Nazwisko</label>
            <div class="controls">
              <p class="lead">
                <?php echo $order[0]['order_name']; ?>
              </p>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Adres</label>
            <div class="controls">
              <p>
                <?php echo $order[0]['order_address']; ?><br>
                <?php echo $order[0]['order_postal_code'] . ' ' . $order[0]['order_city']; ?>
              </p>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Telefon</label>
            <div class="controls">
              <p>
                <?php echo $order[0]['order_phone'] ? $order[0]['order_phone'] : '-'; ?>
              </p>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
              <p class="break-word">
                <?php echo $order[0]['order_email']; ?>
              </p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputDelivery">Zamówienie</label>
            <div class="controls">
              <div>
                <table class="order-table table table-hover table-center">
                  <thead>
                    <tr>
                      <th>Nazwa </th>
                      <th>Wymiary </th>
                      <th>Ilość </th>
                      <th>Kolor </th>
                      <th>Wartość </th>
                    </tr>
                  </thead>
                  <?php echo $order[0]['order_text']; ?>
                </table>
              </div>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputDelivery">Wartość zamówienia</label>
            <div class="controls">
              <p class="lead">
                <?php echo $order[0]['order_val']; ?>zł
                  <?php if ($order[0]['order_rabate']) : ?>&ensp;&ensp;<span class="label label-warning middle-align">Cena z rabatem</span><?php else : ?> <?php endif; ?>
              </p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputDelivery">Koszt dostawy</label>
            <div class="controls">
              <p class="lead">
                <?php echo $order[0]['order_delivery_value']; ?>zł&ensp;&ensp;
                <?php if ($order[0]['order_delivery_value'] == '16') : ?>
                  <span class="label label-inverse middle-align">Kurier</span>
                <?php else: ?>
                  <span class="label label-inverse middle-align">Kurier pobranie</span>
                <?php endif; ?>
              </p>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="inputCategory">Status</label>
            <div class="controls">
              <select  id="inputCategory" name="order_status" class="my-font input-medium">
                <?php
                $status = [
                    'waiting' => 'Oczekujące na wpłatę',
                    'closed' => 'Zakończone',
                    'open' => 'Sprzedane',
                    'paid' => 'Zapłacone',
                    'pobranie' => 'Pobranie'
                ];

                foreach ($status as $r => $k) {
                  if ($order[0]['order_status'] == $r) {
                    echo '<option value="' . $r . '" selected>' . $k . '</option>';
                  } else {
                    echo '<option value="' . $r . '">' . $k . '</option>';
                  }
                }
                ?>
              </select>
            </div>
          </div>

          <div class="control-group control-group-date">
            <label class="control-label" for="orderUpdate"><i class="icon-calendar"></i> Data zamówienia</label>
            <div class="controls">
              <p>
                <small><strong><?php echo date('d-m-Y G:i', $order[0]['order_create']); ?></strong></small>
              </p>
            </div>
          </div>

          <div class="control-group control-group-date">
            <label class="control-label" for="orderUpdate"><i class="icon-calendar"></i> Data aktualizacji</label>
            <div class="controls">
              <p>
                <small><?php echo date('d-m-Y G:i', $order[0]['order_update']); ?></small>
              </p>
            </div>
          </div>

          <hr class="print-line">

          <div class="control-group" id="orderActions">
            <div class="footer-controls">
              <div class="control-label">
                <a href="admin.php" class="btn tool my-font"  title="Powrót" data-tooltip><i class="icon-chevron-left"></i></a>
              </div>
              <button type="submit" class="btn btn-primary tool" name="save" title="Zapisz" data-tooltip><i class="icon-ok icon-white"></i></button>
              <a href="admin.php?del_id=<?php echo $order[0]['order_id']; ?>" title="Usuń" class="btn tool btn-danger my-font confirm-remove" data-tooltip><i class="icon-trash icon-white"></i></a>
              <a href="#" title="Drukuj" class="btn tool btn-default my-font print-content" data-tooltip><i class="icon-print"></i></a>
            </div>
          </div>

          <p class="print-show xs-small">
            <small>Data druku: <?php echo date('d-m-Y G:i'); ?></small>
          </p>

        </form>
      </div><!-- /row-fluid -->
    </div><!-- /hero -->
  </div> <!-- /container -->

  <?php
  require_once("lib/_partials/admin_footer.phtml");
  unset($_SESSION['alerts']);
} else {
  require_once("lib/_partials/admin_footer_location.phtml");
}
?>
