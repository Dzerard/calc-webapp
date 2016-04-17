<?php
  class appBase {
    protected $path;
    protected $menu;
	protected $subMenu;
    protected $teams = array(
      'u6','u8','u12','u16'  
    );
	
    public function __construct(){     
      $this->path = $GLOBALS['appConfiguration']['basePath'];	  
    }
    
    public function basePath($url) {
      return $this->path.$url;
    }
    public function baseUrl($url) {
      return $this->path.$url;
    }
	public function setMenuContext($menu, $submenu) {
		$this->menu = $menu;
		$this->subMenu = $submenu;
	}
	public function activeMenu($item) {
		
		$activeClass = ' active';
		if($this->menu == $item) {
			return $activeClass;
		}
		return;
	}
    //funkcja do licznika
    public function eventCounter($time) {
      
     // $diff = date_diff(strtotime($time), time());
      $diff = (strtotime($time) - time());
      if($diff<0) {
        return 0;
      }
      return $diff;
    }
    //spradza czy event aktywny   
    public function checkIfObsolete($time) {

      // $diff = date_diff(strtotime($time), time());
        $diff = (strtotime($time) - time());
        if($diff<0) {
          echo "historical";
        }
        return;
    }
    //funkcja do licznika
    public function eventDate($time) {      
      return date('F j, Y', strtotime($time));
    }
    
    //funkcja do licznika
    public function checkTeam($name) {
      if(in_array($name, $this->teams)) {
        return true;
      }
      header("Location: /");
      ob_end_flush();
      exit();
    }
    
  }
  
  $app = new appBase();
