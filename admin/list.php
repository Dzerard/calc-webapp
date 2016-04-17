<?php 
ob_start();
session_start();
require_once("include/data_actions.php"); 
require_once("lib/list.php"); 

if ( isset( $_SESSION["user"])) {
  require_once("lib/_partials/admin_head.phtml"); 
  echo navi::menuNavi('terminarz');
?>
    <div class="container">	
      <div class="hero-unit">
          <p style="text-align:center; padding-bottom:20px;">
              <a href="schedule.php" role="button" class="btn btn-info">Dodaj wpis do terminarza</a>
          </p>             
            <p>Lista wpisów terminarza:</p>     		
      	<div class="row-fluid">           
		    
            <div class="row-fluid">		
                <table class="table table-striped table-hover">
        		<thead>
            		<tr>
                        <th class="span1 td-spec">ID</th>
                        <th class="span2 td-spec">Data</th>                        
                        <th class="span1 td-spec">Godzina meczu</th> 
                        <th class="span1 td-spec">Wynik</th> 
                        <th class="span2 td-spec">Kategoria</th>
                        <th class="span1 td-spec">Data edycji</th> 
                        <th class="span2 td-spec">Akcje</th>                        
                	</tr>
                </thead>
                <tbody>
	            <?php foreach ($list as $i) : ?>
    	            <tr>
                        <td class="td-spec-2"><?php echo $i['scheduleId'] ?></td>
                        <td>  
                            <a href="schedule.php?id=<?php echo $i['scheduleId'] ?>" title="Edytuj" class="tool">
                                <?php echo $i['scheduleDate'] ?>
                            </a>
                        </td>
                        <td class="td-spec-2"><?php echo $i['scheduleGameTime'] ?></td>
                        <td class="td-spec-2"><?php echo $i['scheduleScore'] ?></td>                     
                        <td class="td-spec-2"> 
                            <a href="#">                        
                                <?php helpers::myLabelsType($i['scheduleType']) ?>
                            </a>                       
                        </td>
                        <td class="td-spec-2"><?php echo date('d-m-Y G:i',$i['scheduleUpdate']) ?></td>
                        <td class="td-spec-2">
                             <a href="schedule.php?id=<?php echo $i['scheduleId'] ?>" title="Edytuj" class="tool" style="text-decoration: none;">
                                <i class="icon-edit" ></i>
                             </a>	  					
                             <a href="list.php?del_id=<?php echo $i['scheduleId'] ?>" title="Usuń" class="tool" style="margin-left:8px;">
                                 <i class="icon-trash"></i>
                             </a>                             
                        </td>
            	    </tr>
                <?php endforeach; ?>   
                </tbody>
              </table>            
        </div> <!-- /rowfluid -->    
          
      </div><!-- /row-fluid -->       
      </div><!-- /hero -->	       
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
