<?php
ob_start();
session_start();

require_once("config/lib/data_actions.php");
require_once("lib/admin.php");

if (isset($_SESSION["user"])) {
    require_once("lib/_partials/admin_head.phtml");
    echo navi::menuNavi('admin');
    ?>
    <div class="container">
        <?php require_once("lib/_partials/admin_messages.phtml"); ?>
        <div class="hero-unit">

            <!-- Modal -->
            <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Wypełnij formularz</h3>
                </div>
                <form action="admin.php" method="post" class="form-modal" style="margin:0px;">
                    <div class="modal-body modal-height">
                        <label for="focusedInput">Tytuł wiadomości:</label>
                        <input class="my-font span6" id="focusedInput" type="text" name="news_title" required>

                        <label for="newsDesc">Treść wiadomości:</label>
                        <textarea rows="15" id="newsDesc" name="news_desc" class="my-font span6"></textarea>

                        <label for="inputCategory"  style="margin-top:10px;">Kategoria:</label>
                        <select  id="inputCategory" name="news_category_id" class="my-font input-medium">
                            <?php
                            foreach ($categories as $r => $k) {
                                echo '<option value="' . $r . '">' . $k . '</option>';
                            }
                            ?>
                        </select>

                        <label class="checkbox">
                            Widoczna <input type="checkbox" id="inputVisible" name="news_visible">
                        </label>
                        <label class="checkbox">
                            Strona główna <input type="checkbox" id="inputMain" name="news_top">
                        </label>

                    </div>

                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true"><span class="my-font">Anuluj</span></button>
                        <button type="submit" name="add_news" class="btn btn-primary"><span class="my-font">Zapisz</span></button>
                    </div>
                </form>
            </div>


            <div class="row-fluid">

                <?php if (!empty($news)) : ?>
                    <div>
                        <div class="span6">
                            <p>Lista zamówień:</p>
                        </div>
                        <div class="span6 text-right">
                            <?php if (isset($_GET['status'])) : ?>
                                <a href="admin.php" class="btn btn-default">Pokaż wszystkie</a>
                            <?php endif; ?>
                        </div>
                    </div>                              

                    <div class="row-fluid">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="span1 td-spec">ID</th>
                                    <th class="td-spec">Imię i Nazwisko</th>
                                    <th class="span1 td-spec"><span data-tooltip title="Kliknij w labelkę aby posortować">Status</span></th>
                                    <th class="span1 td-spec"><span data-tooltip title="Wraz z przesyłką">Suma</span></th>
                                    <th class="span2 td-spec">Data dodania</th>
                                    <th class="span2 td-spec">Akcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($news as $i) : ?>
                                    <tr>
                                        <td class="td-spec-2"><?php echo $i['order_id'] ?></td>
                                        <td class="td-spec-2">  <a href="order.php?id=<?php echo $i['order_id'] ?>" title="Szczegóły" class="tool"><?php echo $i['order_name'] ?></a></td>
                                        <td class="td-spec-2">
                                            <a href="admin.php?status=<?php echo $i['order_status'] ?>" name="order_status" title="" data-original-title="status">
                                                <?php helpers::statusLabel($i['order_status']) ?>
                                            </a>
                                        </td>
                                        <td class="td-spec-2">
                                            <?php echo $i['order_val'] + $i['order_delivery_value'] ?>zł
                                        </td>

                                        <td class="td-spec-2"><?php echo date('d-m-Y G:i', $i['order_create']) ?></td>
                                        <td class="td-spec-2">
                                            <a href="order.php?id=<?php echo $i['order_id'] ?>" title="Szczegóły" class="tool">
                                                <i class="icon-list-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger">
                        Brak zamówień
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </div>

    <?php
    require_once("lib/_partials/admin_footer.phtml");
}

else {
    require_once("lib/_partials/admin_footer_location.phtml");
}
