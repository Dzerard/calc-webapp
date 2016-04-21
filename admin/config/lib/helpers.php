<?php 

class helpers {
	
  public static function getSub($subName) {
    switch ($subName) {
      case 'rodzic':
        return "rodzica";
        break;
      case 'zawodnik':
        return "zawodnika";
        break;
      case 'trening':
        return "treningu";
        break;
    }
  }

  public static function  switchTypes($type) {
    switch ($type) {

      case 'trampkarze':
        $name = 'trampkarz';
        break;
      case 'mlodzicy':
        $name = 'mlodzik';
        break;
      case 'orliki':
        $name = 'orlik';
        break;
      case 'zaki':
        $name = 'zak';
        break;
      default;
        $name = 'zak';
        break;
    }

    return $name;
  }
    
  public static function clearHtml($string) {
    //$help = htmlentities($string, ENT_QUOTES, "UTF-8");
    return strip_tags($string);
  }
		
  public static function link($category, $id) {
    return htmlspecialchars($category . '/' . $id);	
  }
		
  public static function linkCategory($category, $subcategory) {
    return htmlspecialchars($category . '/'.$subcategory);	
  }
			
  public static function scoreTableName($category) {

    switch ($category) {

      case 'trampkarze':
        $name = 'trampkarze';
        break;
      case 'mlodzicy':
        $name = 'młodzicy';
        break;
      case 'orliki':
        $name = 'orliki';
        break;
      case 'zaki':
        $name = 'żaki';
        break;
      default;
        $name = '';
        break;
    }

    return $name;
  }

  public static function scoreTable($category) {
			
    switch($category) {

      case 'trampkarze':
          $page  = 'http://sportowetempo.pl/pn_malopolska_t_iii_liga_krakow_b_wiosna_13';
          break;
      case 'mlodzicy':
          $page = 'http://sportowetempo.pl/pn_malopolska_m_iii_liga_krakow_b_wiosna_13';
          break;
      case 'orliki':
          $page   = 'http://sportowetempo.pl/pn_malopolska_o_grupa_v_krakow_wiosna_13';
          break;
      case 'zaki':
          $page     = 'http://sportowetempo.pl/pn_malopolska_z_grupa_v_krakow_wiosna_13';
          break;
      default;
          echo 'Error...';
          break;							
    }

    $homepage = file_get_contents($page);
    $poczatek = strpos($homepage, '<div id="tabela">');			
    $koniec   = strpos($homepage, '<div id="prawa">');			


    $szukany_fragment = substr($homepage, $poczatek, $koniec-$poczatek); 
    $szukany_fragment = str_replace('localhost','sportowetempo.pl', $szukany_fragment);
    
    $string = str_replace("/pn_malopolska","http://sportowetempo.pl/pn_malopolska", $szukany_fragment);    

    return $string;				
  }

  public static function nivoImage() {
    $photo_names = array("socer1.jpg","socer2.jpg", "socer3.jpg");
    $name = array_rand($photo_names , 1);			
    $image = "src='public/".$photo_names[$name]."' data-thumb='public/".$photo_names[$name]."'";

    return 	$image;
  }
  
   public static function nivoSimpleImage() {
    $photo_names = array("socer1.jpg","socer2.jpg", "socer3.jpg");
    $name = array_rand($photo_names , 1);			
    $image = "public/".$photo_names[$name];

    return 	$image;
  }
		
  public static function score($category) {

    $dbController = dbController::getInstance();
    $db = $dbController->setConnection();

    try{
      $temp  = $db->query("SELECT * FROM score WHERE `score_category` IN ('$category') ORDER BY score_insert DESC LIMIT 1");			 
      $score = $temp->fetch();			  
      $temp->closeCursor();	 
    } catch(PDOException $e){}        

    return $score;
  }

  public static function category($name) {

    if($name=='article') {	$name = 'artykuł';	}

    return $name;
  }
}