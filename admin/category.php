<?php 
ob_start();
session_start();
require_once("include/data_actions.php"); 

if ( isset( $_SESSION["user"])) {
  require_once("lib/_partials/admin_head.phtml"); 
  echo navi::menuNavi('wyniki');
?>
    <div class="container">	
    <div class="hero-unit">
      <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#lA" data-toggle="tab">Trampkarze</a></li>
          <li><a href="#lB" data-toggle="tab">Młodzicy</a></li>
          <li><a href="#lC" data-toggle="tab">Orliki</a></li>
          <li><a href="#lD" data-toggle="tab">Żaki</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="lA">
            <form class="form-horizontal" action="category.php"  method="post">	  
              <div class="row-fluid">				 
                <div class="control-group">
                  <label class="control-label" for="score_team_win">Drużyna A</label>
                  <div class="controls">
                    <input type="text" id="score_team_win" name="score_team_win" class="my-font span3" value="" required>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="score_team_win_goals">Gole</label>
                  <div class="controls">
                    <input type="text" id="score_team_win_goals" name="score_team_win_goals" class="my-font span2" value="" required>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="score_team_loss">Drużyna B</label>
                  <div class="controls">
                    <input type="text" id="score_team_loss" name="score_team_loss" class="my-font span3" value="" required>
                  </div>
                </div> 
                <div class="control-group">
                  <label class="control-label" for="score_team_loss_goals">Gole</label>
                  <div class="controls">
                    <input type="text" id="score_team_loss_goals" name="score_team_loss_goals" class="my-font span2" value="" required>
                  </div>
                </div>				  
                <div class="control-group">
                  <label class="control-label" for="Tdatepicker">Data</label>
                  <div class="controls">
                    <input type="text" id="Tdatepicker" name="score_time" class="my-font span2" value="" required>
                  </div>
                </div>  

                <div class="control-group">
                  <div class="controls">
                    <button type="submit" class="btn btn-primary tool" name="saveT" title="zapisz"><i class="icon-ok icon-white"></i></button>                  
                    <a href="#ModalT" role="button" class="btn tool" data-toggle="modal" title="ostatnie wyniki"><i class="icon-info-sign "></i></a>								  

                    <?php $score = $adminActions->score('t') ?>  


                    <!-- Modal -->
                    <div id="ModalT" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Wyniki "Trampkarze"</h3>
                      </div>
                      <div class="modal-body">
                        <p class="modal-score"><?php echo $score['score_team_win'] ?> <span class="label"><?php echo $score['score_team_win_goals'] ?></span> : <span class="label"><?php echo $score['score_team_loss_goals'] ?></span> <?php echo $score['score_team_loss'] ?></p>
                        <p class="modal-time">Mecz rozegrany: <b><?php echo $score['score_time'] ?></b> </p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn my-font" data-dismiss="modal" aria-hidden="true">Zamknij</button>

                      </div>
                    </div>
                    <!-- /Modal -->
                  </div>
                </div>

              </div><!-- /row-fluid -->  
            </form>
          </div>

          <div class="tab-pane" id="lB">
            <form class="form-horizontal" action="category.php" enctype="multipart/form-data" method="post">	  
              <div class="row-fluid">				 
                <div class="control-group">
                  <label class="control-label" for="score_team_win">Drużyna A</label>
                  <div class="controls">
                    <input type="text" id="score_team_win" name="score_team_win" class="my-font span3" value="" required>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="score_team_win_goals">Gole</label>
                  <div class="controls">
                    <input type="text" id="score_team_win_goals" name="score_team_win_goals" class="my-font span2" value="" required>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="score_team_loss">Drużyna B</label>
                  <div class="controls">
                    <input type="text" id="score_team_loss" name="score_team_loss" class="my-font span3" value="" required>
                  </div>
                </div> 
                <div class="control-group">
                  <label class="control-label" for="score_team_loss_goals">Gole</label>
                  <div class="controls">
                    <input type="text" id="score_team_loss_goals" name="score_team_loss_goals" class="my-font span2" value="" required>
                  </div>
                </div>					  
                <div class="control-group">
                  <label class="control-label" for="Mdatepicker">Data</label>
                  <div class="controls">
                    <input type="text" id="Mdatepicker" name="score_time" class="my-font span2" value="" required>
                  </div>
                </div>  

                <div class="control-group">
                  <div class="controls">
                    <button type="submit" class="btn btn-primary tool" name="saveM" title="zapisz"><i class="icon-ok icon-white"></i></button>  

                    <a href="#ModalM" role="button" class="btn tool" data-toggle="modal" title="ostatnie wyniki"><i class="icon-info-sign "></i></a>								  

                    <?php $score = $adminActions->score('m') ?>  


                    <!-- Modal -->
                    <div id="ModalM" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Wyniki "Młodzicy"</h3>
                      </div>
                      <div class="modal-body">
                        <p class="modal-score"><?php echo $score['score_team_win'] ?> <span class="label"><?php echo $score['score_team_win_goals'] ?></span> : <span class="label"><?php echo $score['score_team_loss_goals'] ?></span> <?php echo $score['score_team_loss'] ?></p>
                        <p class="modal-time">Mecz rozegrany: <b><?php echo $score['score_time'] ?></b> </p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn my-font" data-dismiss="modal" aria-hidden="true">Zamknij</button>

                      </div>
                    </div>
                    <!-- /Modal -->

                  </div>
                </div>

              </div><!-- /row-fluid -->  
            </form>
          </div>

          <div class="tab-pane" id="lC">
            <form class="form-horizontal" action="category.php" enctype="multipart/form-data" method="post">	  
              <div class="row-fluid">				 
                <div class="control-group">
                  <label class="control-label" for="score_team_win">Drużyna A</label>
                  <div class="controls">
                    <input type="text" id="score_team_win" name="score_team_win" class="my-font span3" value="" required>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="score_team_win_goals">Gole</label>
                  <div class="controls">
                    <input type="text" id="score_team_win_goals" name="score_team_win_goals" class="my-font span2" value="" required>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="score_team_loss">Drużyna B</label>
                  <div class="controls">
                    <input type="text" id="score_team_loss" name="score_team_loss" class="my-font span3" value="" required>
                  </div>
                </div> 
                <div class="control-group">
                  <label class="control-label" for="score_team_loss_goals">Gole</label>
                  <div class="controls">
                    <input type="text" id="score_team_loss_goals" name="score_team_loss_goals" class="my-font span2" value="" required>
                  </div>
                </div>					  
                <div class="control-group">
                  <label class="control-label" for="Odatepicker">Data</label>
                  <div class="controls">
                    <input type="text" id="Odatepicker" name="score_time" class="my-font span2" value="" required>
                  </div>
                </div>  

                <div class="control-group">
                  <div class="controls">
                    <button type="submit" class="btn btn-primary tool" name="saveO" title="zapisz"><i class="icon-ok icon-white"></i></button>                  
                    <a href="#ModalO" role="button" class="btn tool" data-toggle="modal" title="ostatnie wyniki"><i class="icon-info-sign "></i></a>								  

                    <?php $score = $adminActions->score('o') ?>  


                    <!-- Modal -->
                    <div id="ModalO" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Wyniki "Orliki"</h3>
                      </div>
                      <div class="modal-body">
                        <p class="modal-score"><?php echo $score['score_team_win'] ?> <span class="label"><?php echo $score['score_team_win_goals'] ?></span> : <span class="label"><?php echo $score['score_team_loss_goals'] ?></span> <?php echo $score['score_team_loss'] ?></p>
                        <p class="modal-time">Mecz rozegrany: <b><?php echo $score['score_time'] ?></b> </p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn my-font" data-dismiss="modal" aria-hidden="true">Zamknij</button>

                      </div>
                    </div>
                    <!-- /Modal -->
                  </div>
                </div>

              </div><!-- /row-fluid -->  
            </form>
          </div>

          <div class="tab-pane" id="lD">
            <form class="form-horizontal" action="category.php" enctype="multipart/form-data" method="post">	  
              <div class="row-fluid">				 
                <div class="control-group">
                  <label class="control-label" for="score_team_win">Drużyna A</label>
                  <div class="controls">
                    <input type="text" id="score_team_win" name="score_team_win" class="my-font span3" value="" required>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="score_team_win_goals">Gole</label>
                  <div class="controls">
                    <input type="text" id="score_team_win_goals" name="score_team_win_goals" class="my-font span2" value="" required>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="score_team_loss">Drużyna B</label>
                  <div class="controls">
                    <input type="text" id="score_team_loss" name="score_team_loss" class="my-font span3" value="" required>
                  </div>
                </div> 
                <div class="control-group">
                  <label class="control-label" for="score_team_loss_goals">Gole</label>
                  <div class="controls">
                    <input type="text" id="score_team_loss_goals" name="score_team_loss_goals" class="my-font span2" value="" required>
                  </div>
                </div>						  
                <div class="control-group">
                  <label class="control-label" for="Zdatepicker">Data</label>
                  <div class="controls">
                    <input type="text" id="Zdatepicker" name="score_time" class="my-font span2" value="" required>
                  </div>
                </div>  

                <div class="control-group">
                  <div class="controls">
                    <button type="submit" class="btn btn-primary tool" name="saveZ" title="zapisz"><i class="icon-ok icon-white"></i></button>                  
                    <a href="#ModalZ" role="button" class="btn tool" data-toggle="modal" title="ostatnie wyniki"><i class="icon-info-sign "></i></a>								  

                    <?php $score = $adminActions->score('z') ?>  


                    <!-- Modal -->
                    <div id="ModalZ" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Wyniki "Żaki"</h3>
                      </div>
                      <div class="modal-body">
                        <p class="modal-score"><?php echo $score['score_team_win'] ?> <span class="label"><?php echo $score['score_team_win_goals'] ?></span> : <span class="label"><?php echo $score['score_team_loss_goals'] ?></span> <?php echo $score['score_team_loss'] ?></p>
                        <p class="modal-time">Mecz rozegrany: <b><?php echo $score['score_time'] ?></b> </p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn my-font" data-dismiss="modal" aria-hidden="true">Zamknij</button>

                      </div>
                    </div>
                    <!-- /Modal -->
                  </div>
                </div>

              </div><!-- /row-fluid -->  
            </form>
          </div>

        </div>
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
