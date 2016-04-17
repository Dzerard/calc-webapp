<?php 
ob_start();
session_start();

require_once("include/data_actions.php"); 
require_once("lib/schedule.php");   

if ( isset( $_SESSION["user"])) {
  
  require_once("lib/_partials/admin_head.phtml"); 
  echo navi::menuNavi('terminarz');
?>

    <div class="container">	
      <div class="hero-unit">
          <?php if(isset($item)) :?>
            <p>edycja wpisu terminarza:</p>
          <?php else: ?>
            <p>dodawanie wpisu terminarza:</p>
          <?php endif; ?>
        
            <div class="row-fluid">

                <form class="form-horizontal" action="schedule.php"  method="post">	  
                  <div class="row-fluid">	
                    <?php if (isset($item)) : ?>
                      <input type="hidden" value="<?php echo $item['scheduleId'] ?>" name="scheduleId">
                    <?php endif; ?>
                    <div class="control-group">
                      <label class="control-label" for="scheduleDate">Data</label>
                      <div class="controls">
                        <input type="text" id="scheduleDate" name="scheduleDate" class="datepicker my-font span3" value="<?php echo!empty($item['scheduleDate']) ? $item['scheduleDate'] : '' ?>" required>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="scheduleDateName">Dzień</label>
                      <div class="controls">
                        <input type="text" id="scheduleDateName" name="scheduleDateName" class="my-font span3" value="<?php echo!empty($item['scheduleDateName']) ? $item['scheduleDateName'] : '' ?>" required>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="scheduleGameTime">Godzina meczu</label>
                      <div class="controls">
                        <input type="text" id="scheduleGameTime" name="scheduleGameTime" class="my-font span3" value="<?php echo!empty($item['scheduleGameTime']) ? $item['scheduleGameTime'] : '' ?>" required>
                      </div>
                    </div> 
                    <div class="control-group">
                      <label class="control-label" for="scheduleMeetTime">Godzina zbiórki</label>
                      <div class="controls">
                        <input type="text"  id="scheduleMeetTime" name="scheduleMeetTime" class="my-font span3" value="<?php echo!empty($item['scheduleMeetTime']) ? $item['scheduleMeetTime'] : '' ?>" required>
                      </div>
                    </div>				  
                    <div class="control-group">
                      <label class="control-label" for="scheduleTeamHosts">Gospodarze</label>
                      <div class="controls">
                        <input type="text" id="scheduleTeamHosts" name="scheduleTeamHosts" class="my-font span5" value="<?php echo!empty($item['scheduleTeamHosts']) ? $item['scheduleTeamHosts'] : '' ?>" required>
                      </div>
                    </div>  
                    <div class="control-group">
                      <label class="control-label" for="scheduleTeamAway">Goście</label>
                      <div class="controls">
                        <input type="text" id="scheduleTeamAway" name="scheduleTeamAway" class="my-font span5" value="<?php echo!empty($item['scheduleTeamAway']) ? $item['scheduleTeamAway'] : '' ?>" required>
                      </div>
                    </div> 
                    <div class="control-group">
                      <label class="control-label" for="scheduleScore">Wynik</label>
                      <div class="controls">
                        <input type="text" id="scheduleScore" name="scheduleScore" class="my-font span2" value="<?php echo!empty($item['scheduleScore']) ? $item['scheduleScore'] : '' ?>" required>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="schedulePlayers">Strzelcy bramek</label>
                      <div class="controls">
                        <input type="text" id="schedulePlayers" name="schedulePlayers" class="my-font span5" value="<?php echo!empty($item['schedulePlayers']) ? $item['schedulePlayers'] : '' ?>" required>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="scheduleType">Kategoria</label>
                      <div class="controls">
                        <select type="text" id="scheduleType" name="scheduleType" class="my-font span5" required>
                          <option> -- wybierz --</option>
                          <option value="orlik" <?php echo (!empty($item['scheduleType']) && $item['scheduleType'] === 'orlik') ? 'selected=""' : '' ?>>Orliki</option>
                          <option value="zak" <?php echo (!empty($item['scheduleType']) && $item['scheduleType'] === 'zak') ? 'selected=""' : '' ?>>Żaki</option>
                          <option value="mlodzik" <?php echo (!empty($item['scheduleType']) && $item['scheduleType'] === 'mlodzik') ? 'selected=""' : '' ?>>Młodzicy</option>
                          <option value="trampkarz" <?php echo (!empty($item['scheduleType']) && $item['scheduleType'] === 'trampkarz') ? 'selected=""' : '' ?>>Trampkarze</option>
                        </select>
                      </div>
                    </div>
                    <div class="control-group" style="margin-top:30px;">
                      <div class="controls">
                        <a href="list.php" class="btn tool my-font"  title="powrót" style="margin-right:25px;"><i class="icon-chevron-left"></i></a>
                        <button type="submit" class="btn btn-primary tool" name="save" title="zapisz"><i class="icon-ok icon-white"></i></button>                  
                      </div>
                    </div>

                  </div><!-- /row-fluid -->  
                </form>
              </div>
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
