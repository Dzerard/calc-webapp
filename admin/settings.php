<?php
ob_start();
session_start();
require_once("include/data_actions.php");
require_once("lib/settings.php");

if (isset($_SESSION["user"])) {
  require_once("lib/_partials/admin_head.phtml");
  echo navi::menuNavi('settings');
  ?>
  <div class="container">	
    <?php require_once("lib/_partials/admin_messages.phtml"); ?>
    <div class="hero-unit">   
      <p>Dostępne ustawienia:</p>     	

      <div class="accordion" id="accordion2">
                
        <?php foreach ($staticPages as $key=>$val) : ?>
          
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $key ?>">
                  <?php echo $registerItems[$val['pages_name']] ?>
                </a>
              </div>
              <div id="collapse<?php echo $key ?>" class="accordion-body collapse">
                <div class="accordion-inner">
                  <div class="row-fluid">

                    <ul id="myTab" class="nav nav-tabs nav-form">
                      <li class="active"><a href="#<?php echo $val['pages_name'] ?>PL" data-toggle="tab">PL</a></li>
                      <li class=""><a href="#<?php echo $val['pages_name'] ?>EN" data-toggle="tab">EN</a></li>
                    </ul>

                    <form class="form-horizontal form-accordion" action="settings.php" method="post">
                      <div class="settings-wrapper">                              
                        <div id="<?php echo $val['pages_name'] ?>Content" class="tab-content">

                          <div class="tab-pane fade active in" id="<?php echo $val['pages_name'] ?>PL">
                            <div class="control-group">
                              <label class="control-label" for="pagesName<?php echo $key ?>PL">Tytuł</label>
                              <div class="controls">
                                <input type="text" id="panelName<?php echo $key ?>Pl" name="pagesNamePL" class="my-font input-xxlarge full-width" 
                                       value="<?php echo $val['pages_name_pl'] ?>" required="">
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="content<?php echo $key ?>PL">Zawartość</label>
                              <div class="controls">
                                <textarea rows="10" id="content<?php echo $key ?>PL" name="contentPL" class="my-font" required="">
                                  <?php echo $val['pages_context_pl'] ?>
                                </textarea>
                              </div>
                            </div>
                          </div>

                          <div class="tab-pane fade" id="<?php echo $val['pages_name'] ?>EN">
                            <div class="control-group">
                              <label class="control-label" for="pagesName<?php echo $key ?>EN">Tytuł</label>
                              <div class="controls">
                                <input type="text" id="pagesName<?php echo $key ?>EN" name="pagesNameEN" class="my-font input-xxlarge full-width" 
                                       value="<?php echo $val['pages_name_en'] ?>">
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="settingsPanel<?php echo $key ?>EN">Zawartość</label>
                              <div class="controls">
                                <textarea rows="10" id="settingsPanel<?php echo $key ?>EN" name="contentEN" class="my-font">
                                  <?php echo $val['pages_context_en'] ?>
                                </textarea>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div class="control-group">   
                        <label class="control-label" for="pages<?php echo $key ?>Visible">Widoczność</label>
                        <div class="controls">
                          <label class="checkbox"><input type="checkbox" id="settings<?php echo $key ?>Visible" name="pageVisible" <?php if ($val['pages_visible'] == 'yes'): ?>checked=""<?php endif; ?>></label>
                        </div>				
                      </div>

                      <input type="hidden" name="pageName" value="<?php echo $val['pages_name'] ?>" />
                      <div class="control-group">
                        <div class="controls">
                          <button type="submit" class="btn btn-primary tool mr50" name="savePage" data-original-title="zapisz"><i class="icon-ok icon-white"></i></button>
                        </div>
                      </div>
                    </form>            
                  </div>

                </div>
              </div>
            </div>
          
        <?php endforeach; ?>

        <div class="accordion-group">
          <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseYoutube">
              Youtube <small>(lewy panel)</small>
            </a>
          </div>
          <div id="collapseYoutube" class="accordion-body collapse">
            <div class="accordion-inner">
              
              <?php require_once("lib/_partials/youtube.phtml"); ?>
              
            </div>
          </div>
        </div>
                
        <div class="accordion-group">
          <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse6">
              Godziny treningów <small>(lewy panel)</small>
            </a>
          </div>
          <div id="collapse6" class="accordion-body collapse">
            <div class="accordion-inner">
              <div class="row-fluid">

                <ul id="myTab" class="nav nav-tabs nav-form">
                  <li class="active"><a href="#settingspl" data-toggle="tab">PL</a></li>
                  <li class=""><a href="#settingsen" data-toggle="tab">EN</a></li>
                </ul>

                <form class="form-horizontal form-accordion" action="settings.php" method="post">
                  <div class="settings-wrapper">                              
                    <div id="myTabContent" class="tab-content">
                      <div class="tab-pane fade active in" id="settingspl">
                        <div class="control-group">
                          <label class="control-label" for="panelNamePl">Nazwa panelu</label>
                          <div class="controls">
                            <input type="text" id="panelNamePl" name="panelNamePl" class="my-font input-xxlarge full-width" value="<?php echo $settings['settings_title_pl'] ?>" required="">
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label" for="settingsPanelPl">Zawartość</label>
                          <div class="controls">
                            <textarea rows="10" id="settingsPanelPl" name="settingsPanelPl" class="my-font" required=""><?php echo $settings['settings_content_pl'] ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="settingsen">
                        <div class="control-group">
                          <label class="control-label" for="panelNameEn">Nazwa panelu</label>
                          <div class="controls">
                            <input type="text" id="panelNameEn" name="panelNameEn" class="my-font input-xxlarge full-width" value="<?php echo $settings['settings_title_en'] ?>">
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label" for="settingsPanelEn">Zawartość</label>
                          <div class="controls">
                            <textarea rows="10" id="settingsPanelEn" name="settingsPanelEn" class="my-font"><?php echo $settings['settings_content_en'] ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="control-group">   
                    <label class="control-label" for="settingsVisible">Widoczność</label>
                    <div class="controls">
                      <label class="checkbox"><input type="checkbox" id="settingsVisible" name="settingsVisible" <?php if ($settings['settings_visible'] == 'yes'): ?>checked=""<?php endif; ?>></label>
                    </div>				
                  </div>

                  <div class="control-group">
                    <div class="controls">
                      <button type="submit" class="btn btn-primary tool mr50" name="save_settings" data-original-title="zapisz"><i class="icon-ok icon-white"></i></button>
                    </div>
                  </div>
                </form>            
              </div>
            </div>
          </div>
        </div>
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
