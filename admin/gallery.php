<?php 
ob_start();
session_start();
require_once("include/methods.php");   
require_once("include/gallery_actions.php"); 
require_once("lib/gallery.php"); 

if ( isset( $_SESSION["user"])) {
  require_once("lib/_partials/admin_head.phtml"); 
  echo navi::menuNavi('galerie');			 
?>

    <div class="container">	
      <div class="hero-unit">	
         <!-- Button to trigger modal -->
            <p style="text-align:center; padding-bottom:20px;"><a href="#myModal" role="button" class="btn btn-info" data-toggle="modal">Dodaj galerię</a></p>             
           
            <!-- Modal -->
            <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Wypełnij formularz</h3>
              </div>
              <form action="gallery.php" method="post">
              <div class="modal-body">
                <label for="focusedInput">Tytuł galerii:</label>
                <input class="my-font span6" id="focusedInput" type="text" name="gallery_title" required>			

                <label for="galleryDesc">Opis galerii:</label>
                <textarea rows="10" id="galleryDesc" name="gallery_desc" class="my-font span6"></textarea>                                                                                
				<br />
                <label class="checkbox">
                	Widoczna <input type="checkbox" id="inputVisible" name="gallery_visible">
                </label>             
                       
              </div>          
              
              <div class="modal-footer">              	
                    <button class="btn" data-dismiss="modal" aria-hidden="true"><span class="my-font">Anuluj</span></button>
                    <button type="submit" name="add_gallery" class="btn btn-primary"><span class="my-font">Zapisz</span></button>               
              </div>
              </form>
            </div>
      
        <p>Lista galerii:</p>     		
      	<div class="row-fluid">  
		  <div style="text-align:left;">
		    
            <div class="row-fluid">		
			  <table class="table table-striped table-hover">
        		<thead>
            		<tr>
                		<th class="span1 td-spec">ID</th>
                        <th class="td-spec">Tytuł</th>                       
                        <th class="span1 td-spec">Widoczne</th> 
                        <th class="span2 td-spec">Data dodania</th>
                        <th class="span2 td-spec">Akcje</th>                        
                	</tr>
                </thead>
                <tbody>
				<?php if ($gallery) { ?>
	            <?php foreach ($gallery as $i) : ?>
    	            <tr>
        	            <td class="td-spec-2"><?php echo $i['gallery_id'] ?></td>
                        <td>  <a href="gallery_edit.php?id=<?php echo $i['gallery_id'] ?>" title="Edytuj" class="tool"><?php echo $i['gallery_title'] ?></a></td>
                       
                        <td class="td-spec-2"><a href="gallery.php?visibleID=<?php echo $i['gallery_id']; ?>"> <?php echo ($i['gallery_visible'] == 'yes') ? '<i class="icon-ok-sign"></i>' : '<i class="icon-remove-sign"></i>' ?></a></td>
						
                        <td class="td-spec-2"><?php echo date('d-m-Y G:i',$i['gallery_insert']) ?></td>
                        <td class="td-spec-2">
                             <a href="gallery_edit.php?id=<?php echo $i['gallery_id'] ?>" title="Edytuj" class="tool">
                             <i class="icon-edit" style="margin-right:10px;"></i></a>	  					
                             <a href="gallery.php?del_id=<?php echo $i['gallery_id'] ?>" title="Usuń" class="tool"><i class="icon-trash"></i></a>                             
					    </td>
            	    </tr>
                <?php endforeach; ?> 
				<?php } else {}?>				
                </tbody>
              </table>            
			</div> <!-- /rowfluid -->            
         </div>
       </div>
       
	 </div> <!-- /hero-unit -->
	</div> <!-- /container -->
 
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