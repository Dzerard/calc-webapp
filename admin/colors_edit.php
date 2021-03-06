<?php
ob_start();
session_start();
require_once("config/lib/gallery_actions.php");
require_once("lib/colors_edit.php");

if (isset($_SESSION["user"])) {
  require_once("lib/_partials/admin_head.phtml");
  echo navi::menuNavi('colors');
  ?>
  <div class="container">
    <div class="hero-unit">
      <p>edycja zestawu kolorów:</p>
      <div class="row-fluid">

        <form class="form-horizontal" action="colors_edit.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="gallery_id" value="<?php echo $gallery['gallery_id']; ?>">

          <div class="control-group">
            <label class="control-label" for="inputTitle">Tytuł</label>
            <div class="controls">
              <input type="text" id="inputTitle" name="gallery_title" class="my-font span10" value="<?php echo $gallery['gallery_title']; ?>" required>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="inputDesc">Opis</label>
            <div class="controls">
              <textarea rows="10" id="inputDesc" name="gallery_desc" class="my-font span10" style="font-size:10px;"><?php echo $gallery['gallery_desc']; ?></textarea>
            </div>
          </div>

          <div class="control-group hidden">
            <label class="control-label" for="inputVisible">Widoczna</label>
            <div class="controls">
              <label class="checkbox"><input type="checkbox" id="inputVisible" name="gallery_visible" <?php echo ($gallery['gallery_visible'] == 'yes' ? "checked=''" : " " ) ?>></label>
            </div>
          </div>

          <!-- tutaj panel do zdjęć -->
          <div class="control-group">
            <label class="control-label" for="inputLogo">Dodaj zdjęcie</label>
            <div class="controls">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-preview thumbnail" style="width: 210px; height: 150px;">
                  <img src="img/noimage.gif" />
                </div>
                <div style="margin-left: 48px !important; width:210px !important;">
                  <span class="btn btn-file">
                    <span class="fileupload-new" style=""> Wybierz obraz</span>
                    <span class="fileupload-exists">Zmień</span>
                    <input type="file" name="gallery_img" id="inputLogo"/>
                  </span>
                  <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Anuluj</a>
                </div>
              </div>
            </div>
          </div>

          <?php if ($pics) : ?>
            <div class="control-group">
              <label class="control-label" for="inputPics">Zapisane zdjęcia</label>
              <div class="controls">
                <?php foreach ($pics as $i) : ?>
                  <div class="small-controls-image">
                    <img src="img/gallery/small_<?php echo $i['pic_name'] ?>" title="" alt="" />

                    <div class="image-title-change">
                      <input type="text" placeholder="Kolor" class="my-font image-title input-sm" value="<?php echo $i['pic_title'] ?>"/>
                      <button class="btn btn-primary tool" type="button" data-id="<?php echo $i['pic_id'] ?>" data-original-title="zapisz kolor"><i class="icon-ok icon-white"></i></button>
                      <a href="colors_edit.php?picDel=<?php echo $i['pic_id'] ?>" class="confirm-remove btn btn-danger tool" data-original-title="usuń zdjęcie" >
                        <i class="icon-trash icon-white"></i>
                      </a>
                    </div>

                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>

          <hr class="print-line">

          <div class="control-group">
            <div class="controls">
              <a href="colors.php" class="btn tool my-font"  title="powrót" style="margin-right:25px;"><i class="icon-chevron-left"></i></a>
              <button type="submit" class="btn btn-primary tool" name="save" title="zapisz"><i class="icon-ok icon-white"></i></button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

  <?php
  require_once("lib/_partials/admin_footer.phtml");
} else {
  ob_start();
  header("Location: login.php");
  ob_end_flush();
  exit();
}
?>
