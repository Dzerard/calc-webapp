<?php 
ob_start();
session_start();

require_once("include/data_actions.php"); 
require_once("lib/admin.php"); 

if ( isset( $_SESSION["user"])) {
  require_once("lib/_partials/admin_head.phtml"); 
  echo navi::menuNavi('admin');			 
?>
    <div class="container">	
        <div class="hero-unit">	
          <?php if (isset($_GET['category'])) { ?>
            <p style="text-align:center; padding-bottom:10px;"><a href="admin.php" role="button" class="btn btn-primary">Pokaż wszystkie kategorie</a></p>                   
          <?php } ?>
          <!-- Button to trigger modal -->
          <p style="text-align:center; padding-bottom:20px;"><a href="#myModal" role="button" class="btn btn-info" data-toggle="modal">Dodaj news</a></p>             

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

          <p>Lista newsów:</p>     		
          <div class="row-fluid">  
            <div style="text-align:left;">

              <div class="row-fluid">		
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th class="span1 td-spec">ID</th>
                      <th class="td-spec">Tytuł</th>
                      <th class="span1 td-spec">Kategoria</th> 
                      <th class="span1 td-spec">Top</th> 
                      <th class="span1 td-spec">Widoczne</th> 
                      <th class="span2 td-spec">Data dodania</th>
                      <th class="span2 td-spec">Akcje</th>                        
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($news as $i) : ?>
                      <tr>
                        <td class="td-spec-2"><?php echo $i['news_id'] ?></td>
                        <td>  <a href="news.php?id=<?php echo $i['news_id'] ?>" title="Edytuj" class="tool"><?php echo $i['news_title'] ?></a></td>
                        <td class="td-spec-2"> 
                          <a href="admin.php?category=<?php echo $i['news_category_id'] ?>" name="category_sort" title="" data-original-title="galeria">                        
                            <?php helpers::myLabels($i['news_category_id'], $i['category_name']) ?>
                          </a>                       
                        </td>
                        <td class="td-spec-2"><a href="admin.php?topID=<?php echo $i['news_id']; ?>"> <?php echo ($i['news_top'] == 'yes') ? '<i class="icon-ok-sign"></i>' : '<i class="icon-remove-sign"></i>' ?></a></td>
                        <td class="td-spec-2"><a href="admin.php?visibleID=<?php echo $i['news_id']; ?>"> <?php echo ($i['news_visible'] == 'yes') ? '<i class="icon-ok-sign"></i>' : '<i class="icon-remove-sign"></i>' ?></a></td>

                        <td class="td-spec-2"><?php echo date('d-m-Y G:i', $i['news_insert']) ?></td>
                        <td class="td-spec-2">
                          <a href="news.php?id=<?php echo $i['news_id'] ?>" title="Edytuj" class="tool">
                            <i class="icon-edit" style="margin-right:10px;"></i></a>	  					
                          <a href="admin.php?del_id=<?php echo $i['news_id'] ?>" title="Usuń" class="tool"><i class="icon-trash"></i></a>                             
                        </td>
                      </tr>
                    <?php endforeach; ?>   
                  </tbody>
                </table>            
              </div> <!-- /rowfluid -->            
            </div>
          </div>

        </div> 
      </div> 

<?php 
  require_once("lib/_partials/admin_footer.phtml"); 
}
else {
	ob_start();
	header("Location: login");      	
	ob_end_flush();
	exit();   
}
