<?php
ob_start();
session_start();
require_once("include/data_actions.php");
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
        <div class="hero-unit">	         
            <p>Szczegóły zamówienia:</p>
            <div class="row-fluid">
                <form class="form-horizontal" action="order.php" method="post">  
                    <input type="hidden" name="news_id" value="<?php echo $news[0]['order_id']; ?>">          

                    <div class="control-group">
                        <label class="control-label" for="inputTitle">Imię i Nazwisko</label>
                        <div class="controls">
                            <p class="lead">
                                <?php echo $news[0]['order_name']; ?>
                            </p>				    
                        </div>
                    </div>  

                    <div class="control-group">
                        <label class="control-label">Adres</label>
                        <div class="controls">
                            <p class="lead">
                                <?php echo $news[0]['order_address']; ?><br>
                                <?php echo $news[0]['order_postal_code'] . ' ' . $news[0]['order_city']; ?>
                            </p>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Telefon</label>
                        <div class="controls">
                            <p class="lead">
                                <?php echo $news[0]['order_phone']; ?>                         
                            </p>
                        </div>
                    </div>                

                    <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <p class="lead">
                                <?php echo $news[0]['order_email']; ?>                         
                            </p>
                        </div>
                    </div>      
                    <div class="control-group">
                        <label class="control-label" for="inputDelivery">Zamówienie</label>
                        <div class="controls">
                            <div>
                                <table class="order-table">
                                    <thead>
                                        <tr>
                                            <th>Nazwa </th>
                                            <th>Wymiary </th>
                                            <th>Ilość </th>
                                            <th>Wartość </th>
                                        </tr>
                                    </thead>
                                    <?php echo $news[0]['order_text']; ?>                         
                                </table>
                            </div>
                        </div>
                    </div>   
                    <div class="control-group">
                        <label class="control-label" for="inputDelivery">Wartość zamówienia</label>
                        <div class="controls">
                            <p class="lead">
                                <?php echo $news[0]['order_val']; ?>                        
                            </p>
                        </div>
                    </div>   
                    <div class="control-group">
                        <label class="control-label" for="inputDelivery">Koszt dostawy</label>
                        <div class="controls">
                            <p class="lead">
                                <input type="text" id="inputDelivery" name="order_delivery_value" class="my-font span5" value="<?php echo $news[0]['order_delivery_value']; ?>" required readonly="">                                                       
                            </p>
                        </div>
                    </div>   

                    <div class="control-group">
                        <label class="control-label" for="inputCategory">Status</label>
                        <div class="controls">
                            <select  id="inputCategory" name="news_category_id" class="my-font input-medium">
                                <?php
                                $status = [
                                    'waiting' => 'Oczekiwanie',
                                    'closed' => 'Zamknięte',
                                    'open' => 'Otwarte',
                                ];

                                foreach ($status as $r => $k) {
                                    if ($news[0]['order_status'] == $r) {
                                        echo '<option value="' . $r . '" selected>' . $k . '</option>';
                                    } else {
                                        echo '<option value="' . $r . '">' . $k . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> 			   

                    <div class="control-group">
                        <div class="controls footer-controls">
                            <a href="admin.php" class="btn tool my-font"  title="powrót"><i class="icon-chevron-left"></i></a>
                            <button type="submit" class="btn btn-primary tool" name="save" title="zapisz" disabled=""><i class="icon-ok icon-white"></i></button>                                              
                            <a href="admin.php?del_id=<?php echo $news[0]['order_id']; ?>" title="Usuń" class="btn tool btn-danger my-font"><i class="icon-trash"></i></a>
                        </div>
                    </div>

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