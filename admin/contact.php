<?php 
ob_start();
session_start();
require_once("include/data_actions.php"); 
require_once("lib/contact.php"); 

if ( isset( $_SESSION["user"])) {
  require_once("lib/_partials/admin_head.phtml"); 
  echo navi::menuNavi('contact');
?>
     
  <div class="container">	
    <?php  require_once("lib/_partials/admin_messages.phtml");  ?>
    <div class="hero-unit">	         
      <?php if (!isset($_GET['id'])) : ?>
        <p style="text-align:center; padding-bottom:20px;"><a href="#myModal" role="button" class="btn btn-info" data-toggle="modal">Dodaj trenera</a></p>             
      <?php endif; ?>

      <p>edycja informacji kontaktowych:</p>
      <div class="row-fluid">

        <?php if (isset($_GET['id'])) { ?>

          <form class="form-horizontal" action="contact.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id_coach" value="<?php echo $row['coach_id']; ?>" >
            <div class="control-group">
              <label class="control-label" for="inputEmail">Email</label>
              <div class="controls">
                <input type="email" id="inputEmail" name="coach_email" class="my-font" value="<?php echo $row['coach_email']; ?>" >
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputName">Imię i Nazwisko</label>
              <div class="controls">
                <input type="text" id="inputName" name="coach_name" class="my-font" value="<?php echo $row['coach_name']; ?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputPhone">Numer telefonu</label>
              <div class="controls">
                <input type="text" id="inputPhone" name="coach_phone" class="my-font" value="<?php echo $row['coach_phone']; ?>">
              </div>
            </div>  
            <div class="control-group">
              <label class="control-label" for="inputDesc">Doświadczenie</label>
              <div class="controls">
                <textarea rows="20" id="inputDesc" name="coach_desc" class="my-font span10" style="font-size:10px;"><?php echo $row['coach_desc']; ?></textarea>   
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="inputLogo">Zdjęcie</label>
              <div class="controls">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-preview thumbnail" style="width: 210px; height: 150px;">                          
                    <?php
                    if ($row['coach_img'] != '') {
                      echo '<img src="img/coach/' . $row['coach_img'] . '" data-toggle="tooltip" title data-original-title="' . $row['coach_img'] . '" class="tool"/>';
                    } else {
                      echo '<img src="img/noimage.gif" />';
                    }
                    ?>
                  </div>
                  <div style="margin-left: 48px !important; width:210px !important;">
                    <?php if ($row['coach_img'] != '') { ?>                          
                      <button type="submit" name="del_img" class="btn btn-danger" title="usuń zdjęcie" style="margin-left: 37px !important;"><i class="icon-trash icon-white"></i></button>
                    <?php } else { ?>
                      <span class="btn btn-file">
                        <span class="fileupload-new" style=""> Wybierz obraz</span>
                        <span class="fileupload-exists">Zmień</span>
                        <input type="file" name="coach_img" id="inputLogo"/>
                      </span>                            
                      <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Anuluj</a>
    <?php } ?>
                  </div>
                </div>
              </div>
            </div>        

            <div class="control-group">
              <div class="controls">
                <a href="contact.php" class="btn tool my-font mr50" title="powrót do listy osób"><i class="icon-chevron-left"></i></a>
                <button type="submit" class="btn btn-primary tool mr50" name="save" title="zapisz"><i class="icon-ok icon-white"></i></button>
                <button type="submit" class="btn btn-danger tool" name="delete" title="usuń"><i class="icon-trash icon-white"></i></button>
              </div>
            </div>
          </form>	  
  <?php } else {
    ?>    

          <form class="form-horizontal" action="contact.php" method="get">
            <div class="control-group">
              <label class="control-label" for="inputPerson">Wybierz osobę</label>
              <div class="controls">
                <select  id="inputPerson" name="id" class="my-font input-medium" style="margin-right:50px;">

    <?php
    $people = $contactAction->loadContact();
    foreach ($people as $r => $k) {

      echo '<option value="' . $k['coach_id'] . '" selected>' . $k['coach_name'] . '</option>';
    }
    ?>
                </select>	
                <button type="submit" class="btn tool" title="edytuj"><i class="icon-edit "></i></button>

              </div>
            </div>
          </form>

  <?php } ?>

      </div>
    </div>
  </div> 
  
  <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Wypełnij formularz</h3>
    </div>
    <form action="contact.php" method="post" class="form-modal" style="margin:0px;">
      <div class="modal-body modal-height" style="height: auto !important; ">
        <label for="focusedInput">Imię i Nazwisko</label>
        <input class="my-font span5" id="focusedInput" type="text" name="coach_name" required>			 
      </div>          
      <div class="modal-footer">              	
        <button class="btn" data-dismiss="modal" aria-hidden="true"><span class="my-font">Anuluj</span></button>
        <button type="submit" name="add_new_coach" class="btn btn-primary"><span class="my-font">Zapisz</span></button>               
      </div>
    </form>
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
