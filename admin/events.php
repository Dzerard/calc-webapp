<?php
ob_start();
session_start();
require_once("include/data_actions.php");

if (isset($_SESSION["user"])) {
  require_once("lib/events.php");
  require_once("lib/_partials/admin_head.phtml");    
  echo navi::menuNavi('events');  
  ?>
  <div class="container">	
    <?php require_once("lib/_partials/admin_messages.phtml"); ?>
    <div class="hero-unit">
      <p class="submit-event">
        <a href="#myModal" role="button" class="btn btn-info" data-toggle="modal">Dodaj nowy event</a>
      </p>             
      <p>Lista eventów:</p>     		
      <div class="row-fluid">           

        <div class="row-fluid">		
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="span1 td-spec">ID</th>
                <th class="span2 td-spec">Data eventu</th>                        
                <th class="span1 td-spec">Nazwa</th> 
                <th class="span1 td-spec">Opis</th> 
                <th class="span1 td-spec">Dodany</th> 
                <th class="span2 td-spec">Akcje</th>                        
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list as $i) : ?>
                <tr <?php $adminActions->checkIfObsolete($i['event_date']); ?>>
                  <td class="td-spec-2"><?php echo $i['event_id'] ?></td>
                  <td class="td-spec-2"><?php echo date('d-m-Y G:i', strtotime($i['event_date'])) ?></td>
                  <td class="td-spec-2"><?php echo $i['event_title'] ?></td>                  
                  <td class="td-spec-2 no-wrap-text"><?php echo strip_tags($i['event_description']) ?></td>                                       
                  <td class="td-spec-2"><?php echo date('d-m-Y G:i', strtotime($i['event_insert'])) ?></td>
                  <td class="td-spec-2">
                    <a href="#editModal" role="button" title="Edytuj" class="tool edit-modal" data-id="<?php echo $i['event_id']; ?>">
                      <i class="icon-edit" ></i>
                    </a>	  					
                    <a href="events.php?del_id=<?php echo $i['event_id'] ?>" title="Usuń" class="tool remove-confirm" style="margin-left:8px;">
                      <i class="icon-trash"></i>
                    </a>                             
                  </td>
                </tr>
              <?php endforeach; ?>   
            </tbody>
          </table>            
        </div> 

      </div>    
    </div>
  </div>

  <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Wypełnij formularz</h3>
    </div>
    <form action="events.php" method="post" class="form-modal" style="margin:0px;">
      <div class="modal-body modal-height">
        <div class='relative'>
          <label for="event_title">Tytuł eventu</label>
          <input class="my-font full-width" id="event_title" type="text" name="event_title" required>			
        </div>
        <div class='relative'>
          <label for="event_description">Opis</label>
          <textarea rows="15" id="event_description" name="event_description" class="my-font span6"></textarea>                                              
        </div>
        <label for="event_date">Data wydarzenia</label>
        <input class="my-font datetimepickcer" id="event_date" type="text" name="event_date" required>			                                
      </div>         

      <div class="modal-footer">              	
        <button class="btn" data-dismiss="modal" aria-hidden="true"><span class="my-font">Anuluj</span></button>
        <button type="submit" name="add_event" class="btn btn-primary"><span class="my-font">Zapisz</span></button>               
      </div>
    </form>
  </div>
  
  <div id="editModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Edytuj wydarzenie</h3>
    </div>
    <form action="events.php" method="post" class="form-modal" style="margin:0px;" id="editEventForm">
      <div class="modal-body modal-height">
        <input type="hidden" name="event_id" id="event_id_edit" value=''>	
        <div class='relative'>
          <label for="event_title_edit">Tytuł eventu</label>
          <input class="my-font full-width" id="event_title_edit" type="text" name="event_title" required>			
        </div>
        <div class='relative'>
          <label for="event_description_edit">Opis</label>
          <textarea rows="15" id="event_description_edit" name="event_description" class="my-font span6"></textarea>                                              
        </div>
        <label for="event_date_edit">Data wydarzenia</label>
        <input class="my-font datetimepickcer" id="event_date_edit" type="text" name="event_date" required>			                                
      </div>         

      <div class="modal-footer">              	
        <button class="btn" data-dismiss="modal" aria-hidden="true"><span class="my-font">Anuluj</span></button>
        <button type="submit" name="update_event" class="btn btn-primary"><span class="my-font">Zapisz</span></button>               
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
?>
