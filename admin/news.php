<?php 
ob_start();
session_start();
require_once("include/data_actions.php"); 
require_once("lib/news.php"); 

if ( isset( $_SESSION["user"])) {
  
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
         	<p>edycja wiadomości:</p>
         <div class="row-fluid">
             <form class="form-horizontal" action="news.php" method="post" enctype="multipart/form-data">  
             	<input type="hidden" name="news_id" value="<?php echo $news[0]['news_id']; ?>">          
				
                <div class="control-group">
                <label class="control-label" for="inputTitle">Tytuł</label>
                 <div class="controls">
				    <input type="text" id="inputTitle" name="news_title" class="my-font span10" value="<?php echo $news[0]['news_title']; ?>" required>     
                 </div>
               </div>  
			   
               <div class="control-group">
                <label class="control-label" for="inputDesc">Treść</label>
                 <div class="controls">
				   <textarea rows="20" id="inputDesc" name="news_desc" class="my-font span10" style="font-size:10px;"><?php echo $news[0]['news_desc']; ?></textarea>                                    
                 </div>
               </div>
			   <div class="control-group">
                <label class="control-label" for="inputVideo">Link do video</label>
                 <div class="controls">
				    <input type="text" id="inputVideo" name="news_video" class="my-font span10" value="<?php echo $news[0]['news_video']; ?>">     
                 </div>
               </div> 
               
               <div class="control-group">
                 <label class="control-label" for="inputLogo">Zdjęcie</label>
                   <div class="controls">
                       <div class="fileupload fileupload-new" data-provides="fileupload">
                          <div class="fileupload-preview thumbnail" style="width: 210px; height: 150px;">                          
                        <?php	
						if ($news[0]['news_image'] !='') {
							echo '<img src="img/news/'.$news[0]['news_image'].'" data-toggle="tooltip" title data-original-title="'.$news[0]['news_image'].'" class="tool"/>'; 
						}
						else {
							echo '<img src="img/noimage.gif" />'; 	
						}
						?>
                          </div>
                          <div style="margin-left: 48px !important; width:210px !important;">
                        <?php	
						if ($news[0]['news_image'] !='') { ?>                          
                            <button type="submit" name="del_img" class="btn btn-danger" title="usuń zdjęcie" style="margin-left: 37px !important;"><i class="icon-trash icon-white"></i></button>
                        <?php } else { ?>
 								<span class="btn btn-file">
                                <span class="fileupload-new" style=""> Wybierz obraz</span>
                                <span class="fileupload-exists">Zmień</span>
                                <input type="file" name="news_image" id="inputLogo"/>
                            </span>                            
                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Anuluj</a>
						<?php } ?>
                          </div>
                       </div>
                   </div>
               </div>   
            
                <div class="control-group">
                 <label class="control-label" for="inputLogo">Plik do pobrania</label>
                   <div class="controls">
                       
                       <div class="fileupload fileupload-new" data-provides="fileupload">
                          <div class="fileupload-preview thumbnail" style="width: 210px; height:70px; background: #fff;">                          
                            <?php	
                                if ($news[0]['news_file'] != NULL) {
                                    
                                        echo '<a href="files/'.$news[0]['news_file'].'"><img src="img/file.png" data-toggle="tooltip" title data-original-title="podgląd pliku" class="tool"/></a>'; 
                                }
                                else {
                                        echo '<img src="img/noimage.gif" />'; 	
                                }
                            ?>
                          </div>
                          <div style="margin-left: 48px !important; width:210px !important;">
                            <?php	
                                if ($news[0]['news_file'] !='') { ?>                          
                                    <button type="submit" name="del_file" class="btn btn-danger" title="usuń plik" style="margin-left: 37px !important;"><i class="icon-trash icon-white"></i></button>
                            <?php } else { ?>
                            <span class="btn btn-file">
                                <span class="fileupload-new" style=""> Wybierz plik</span>
                                <span class="fileupload-exists">Zmień</span>
                                <input type="file" name="news_file" id="inputLogo"/>
                            </span>                            
                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Anuluj</a>
						<?php } ?>
                          </div>
                       </div>
                   </div>
               </div>   
               
               <div class="control-group">
                <label class="control-label" for="inputCategory">Kategoria</label>
				 <div class="controls">
                   <select  id="inputCategory" name="news_category_id" class="my-font input-medium">
                   <?php 
				    	
						foreach($categories as $r=>$k) {					    	
							if($news[0]['news_category_id'] == $r) { echo '<option value="'.$r.'" selected>'.$k.'</option>'; }
							else {	echo '<option value="'.$r.'">'.$k.'</option>'; }
                       } ?>
                       
                   </select>
                 </div>
               </div> 
			   
			   <div class="control-group" style="display:none;" id="subcategoryDiv">
                <label class="control-label" for="inputSubCategory">Podkategoria </label>
				 <div class="controls">
                   <select  id="inputSubCategory" name="news_subcategory" class="my-font input-medium">              
				    	<option value="trening" <?php if($news[0]['news_subcategory']== 'trening') {echo 'selected';} ?>>treningu</option>    
						<option value="rodzic" <?php if($news[0]['news_subcategory']== 'rodzic') {echo 'selected';} ?>>rodzica</option>   
						<option value="zawodnik" <?php if($news[0]['news_subcategory']== 'zawodnik') {echo 'selected';} ?>>zawodnika</option>   						
                   </select>
                 </div>
               </div> 
               
               <div class="control-group">   
				 <label class="control-label" for="inputVisible">Widoczna</label>
				 <div class="controls">
					<label class="checkbox"><input type="checkbox" id="inputVisible" name="news_visible" <?php  echo ($news[0]['news_visible'] == 'yes' ? "checked=''" : " " ) ?>></label>
				 </div>				
               </div>    
                          
               <div class="control-group">   
				 <label class="control-label" for="inputMain">Strona główna</label>
				 <div class="controls">
					<label class="checkbox"><input type="checkbox" id="inputMain" name="news_top" <?php  echo ($news[0]['news_top'] == 'yes' ? "checked=''" : " " ) ?>></label>
				 </div>				
               </div>   
                   
               <div class="control-group">
                 <div class="controls">
                 	<a href="admin.php" class="btn tool my-font"  title="powrót" style="margin-right:25px;"><i class="icon-chevron-left"></i></a>
                    <button type="submit" class="btn btn-primary tool" name="save" title="zapisz"><i class="icon-ok icon-white"></i></button>                  
                 </div>
               </div>
              
            </form>
        </div><!-- /row-fluid -->                
      </div><!-- /hero -->	       
    </div> <!-- /container -->
  
<?php 
  require_once("lib/_partials/admin_footer.phtml"); 
  unset($_SESSION['alerts']);
}
else {
	ob_start();
	header("Location: login.php");      	
	ob_end_flush();
	exit();   
}
?>