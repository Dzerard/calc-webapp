<?php
ob_start();
session_start();

require_once("config/lib/gallery_actions.php");
require_once("lib/colors.php");

if (isset($_SESSION["user"])) {
  require_once("lib/_partials/admin_head.phtml");
  echo navi::menuNavi('colors');
  ?>

  <div class="container">	
    <div class="hero-unit">	
      
      <p class="text-center">
        <a href="#myModal" role="button" class="btn btn-info" data-toggle="modal">Dodaj zestaw</a>
      </p>             

      <br>
            
      <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 id="myModalLabel">Wypełnij formularz</h3>
        </div>
        <form action="colors.php" method="post">
          <div class="modal-body">
            <label for="focusedInput">Tytuł galerii:</label>
            <input class="my-font span6" id="focusedInput" type="text" name="gallery_title" required>			

            <label for="galleryDesc">Opis galerii:</label>
            <textarea rows="10" id="galleryDesc" name="gallery_desc" class="my-font span6"></textarea>                                                                                
            <br />
            <label class="checkbox hidden">
              Widoczna <input type="checkbox" id="inputVisible" name="gallery_visible" checked="checked">
            </label>             
          </div>          
          <div class="modal-footer">              	
            <button class="btn" data-dismiss="modal" aria-hidden="true"><span class="my-font">Anuluj</span></button>
            <button type="submit" name="add_gallery" class="btn btn-primary"><span class="my-font">Zapisz</span></button>               
          </div>
        </form>
      </div>

      <p>Lista zestawów kolorystycznych:</p>     		
      <div class="row-fluid">  
        <div style="text-align:left;">

          <div class="row-fluid">		
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th class="span1 td-spec">ID</th>
                  <th class="td-spec">Tytuł</th>                       
                  <th class="span2 td-spec">Data dodania</th>
                  <th class="span2 td-spec">Akcje</th>                        
                </tr>
              </thead>
              <tbody>
                <?php if ($gallery) { ?>
                  <?php foreach ($gallery as $i) : ?>
                    <tr>
                      <td class="td-spec-2"><?php echo $i['gallery_id'] ?></td>
                      <td>  
                        <a href="colors_edit.php?id=<?php echo $i['gallery_id'] ?>" title="Edytuj" class="tool"><?php echo $i['gallery_title'] ?></a>
                      </td>
                      <td class="td-spec-2"><?php echo date('d-m-Y G:i', $i['gallery_insert']) ?></td>
                      <td class="td-spec-2">
                        <a href="colors_edit.php?id=<?php echo $i['gallery_id'] ?>" title="Edytuj" class="tool">
                          <i class="icon-edit" style="margin-right:10px;"></i></a>	  					
                        <a href="colors.php?del_id=<?php echo $i['gallery_id'] ?>" title="Usuń" class="tool"><i class="icon-trash"></i></a>                             
                      </td>
                    </tr>
                  <?php endforeach; ?> 
                <?php } else {
                  
                } ?>				
              </tbody>
            </table>            
          </div> <!-- /rowfluid -->            
        </div>
      </div>

    </div> <!-- /hero-unit -->
  </div> <!-- /container -->

  <?php
  require_once("lib/_partials/admin_footer.phtml");
} else {
  ob_start();
  header("Location: login.php");
  ob_end_flush();
  exit();
}
?>