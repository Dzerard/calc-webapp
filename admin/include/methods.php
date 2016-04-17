<?php

class helpers {
	
	public static function myLabels($id, $name) {
		
		switch($id) {
				
			case(1) :
				$label='<span class="label label-info">'.$name.'</span>';
				break;
			case(2) :
				$label='<span class="label label-success">'.$name.'</span>';
				break;
			case(3) :
				$label='<span class="label label-inverse">'.$name.'</span>';
				break;
			case(4) :
				$label='<span class="label label-important">'.$name.'</span>';			
				break;
			default:
				$label='<span class="label">'.$name.'</span>';
		}
		
		echo $label; 
	}
        
        public static function myLabelsType($name) {
		
		switch($name) {
				
			case('orlik') :
				$label='<span class="label label-info">Orliki</span>';
				break;
			case('zak') :
				$label='<span class="label label-success">Żaki</span>';
				break;
			case('mlodzik') :
				$label='<span class="label label-inverse">Młodzicy</span>';
				break;
			case('trampkarz') :
				$label='<span class="label label-important">Trampkarze</span>';			
				break;
			default:
				$label='<span class="label"></span>';
		}
		
		echo $label; 
	}
		
}
  
class methods{

    function __construct(){
       
    }

    public function is_logged(){
        return $this->logged;
    }

	public function logout($header) {
		ob_start();
		session_start();
		session_unset();
		session_destroy();      
		header('Location: ' . $header);
		ob_end_flush();
			
	}
}

$allowedExts = array("jpg", "jpeg", "gif", "png", "ico");


class alerts{
	
	function __construct(){   }
	
    public static function setMessage($message) {
       $_SESSION['alerts'] = $message;
    }

    public static function flushAlert($code) {
	
	echo '<div class="container"><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Return Code: " '. $code .' "<br></div></div>';
	
	}	
	
	public static function flushAlert_2($code=null) {
	
	echo '<div class="container"><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Nieobsługiwany format pliku !</div></div>';
	
	}	
	
		
}

class navi {
	function __construct(){   }
	
        
        public static function menuNavi($name) {
            
         $myMenu =  '<div class="navbar navbar-inverse navbar-fixed-top">
                        <div class="navbar-inner">
                          <div class="container">
                            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                            <form class="navbar-form pull-right" action="admin.php" method="post">            
                                <button type="submit" class="btn btn-danger btn-medium btn-logout" data-placement="left" title="wyloguj" name="logout"><i class="icon-off icon-white"></i></button>
                            </form>
                            <a class="brand" href="../">Dragons United</a>
                            <div class="nav-collapse collapse">
                              <ul class="nav">   		
                                <li '. ($name == "admin" ? "class='active'" : " " ).'><a href="admin.php">News</a></li>              
                                <li '. ($name == "contact" ? "class='active'" : " " ).' ><a href="contact.php">Kontakt</a></li>
                                <li '. ($name == "wyniki" ? "class='active'" : " " ).'><a href="category.php">Wyniki</a></li>        
                                <li '. ($name == "galerie" ? "class='active'" : " " ).'><a href="gallery.php">Galerie</a></li>   
                                <li '. ($name == "terminarz" ? "class='active'" : " " ).'><a href="list.php">Terminarz</a></li>   
                                <li '. ($name == "newsletter" ? "class='active'" : " " ).'><a href="newsletter.php">Newsletter</a></li>   
                                <li '. ($name == "events" ? "class='active'" : " " ).'><a href="events.php">Eventy</a></li>  
                                <li '. ($name == "settings" ? "class='active'" : " " ).'><a href="settings.php">Ustawienia</a></li>
                              </ul>
                              
                            </div><!--/.nav-collapse -->
                          </div>
                        </div>
                      </div>';            
	return  htmlspecialchars_decode($myMenu);
        
	}		
}

class baseController {
  public function redirect($url) {
    unset($_POST);
    header("Location:".$url);
    ob_end_flush();
    exit();
  }
}

class contact extends baseController{

  protected $pdo;
  public function __construct() {
    $dbController = dbController::getInstance();
    $this->pdo = $dbController->setConnection();
  }
  public function insertContact($coachName) {
    try {
     $this->pdo->exec('INSERT INTO `coach` (`coach_id`,`coach_name`) VALUES ( "", \''.$coachName.'\')');
    } catch(PDOException $e) {}
    
    
    unset($_POST);	
	unset($_GET);	
	header("Location: contact.php?id=". $this->pdo->lastInsertId());      	
	ob_end_flush();	
	exit();	
		
  }
  
  public function saveContact($_myPOST, $id, $_myFILES) {
	
	try {	 
      $this->pdo->exec('UPDATE `coach` SET `coach_name`= \''.$_myPOST['coach_name'].'\', `coach_email`=\''.$_myPOST['coach_email'].'\',`coach_phone`=\''.$_myPOST['coach_phone'].'\', `coach_desc`= \''.$_myPOST['coach_desc'].'\'  WHERE  `coach_id` IN (\''.$id.'\')');
	} catch(PDOException $e) {}
	
	//zdjęcie
	
			@  $extension = end(explode(".", $_myFILES["coach_img"]["name"]));
		
			if(isset($_myFILES["coach_img"])) {
			  
			  $extension = end(explode(".", $_myFILES["coach_img"]["name"]));
			  $allowedExts = array("jpg", "jpeg", "gif", "png", "ico");
			  
			  if($_myFILES["coach_img"]["type"] != ""){
						
				if ((($_myFILES["coach_img"]["type"] == "image/gif") || ($_myFILES["coach_img"]["type"] == "image/jpeg")	|| ($_myFILES["coach_img"]["type"] == "image/png")	|| ($_myFILES["coach_img"]["type"] == "image/pjpeg"))	&& ($_myFILES["coach_img"]["size"] < 2000000)	&& in_array($extension, $allowedExts))	  { 
		 
				  if ($_myFILES["coach_img"]["error"] > 0) { alerts::flushAlert($_myFILES["file"]["error"]); }		  

				  else	{
					echo '<div class="container"><div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>Upload: '.$_myFILES["coach_img"]["name"].' <br>			  
						  Rozmiar: '.($_myFILES["coach_img"]["size"] / 1024).' kB<br>';
			
					if (file_exists("img/coach/" . $_myFILES["coach_img"]["name"]))  {
					  echo $_myFILES["coach_img"]["name"] . " ta nazwa(plik) już istnieje ! </div></div>";
					}
					else  {
					  move_uploaded_file($_myFILES["coach_img"]["tmp_name"],
					  "img/coach/" . $_myFILES["coach_img"]["name"]);
					  echo "Zapisany w katalogu: " . "img/coach/" . $_myFILES["coach_img"]["name"]. '</div></div>';
					  
					  try{
						  //update loga w bazie		
						  $this->pdo->exec('UPDATE `coach` SET `coach_img`= \''. $_myFILES["coach_img"]["name"].'\' WHERE  `coach_id` IN (\''.$id.'\')');					  						  		  						  
						  
					  }
					  catch(PDOException $e){}
					  	  
					}		  
				}					
			  }
			else {
				 alerts::flushAlert_2();	
			}  
		  }
		}	
	
	
	
		
	}
    
    public function deleteContact($id) {
      try {
        if ($id !='' && (int)$id != 1) {
          $this->pdo->exec('DELETE FROM `coach` WHERE `coach_id` IN (\'' . $id . '\') ');
          alerts::setMessage('Trener został usunięty');
        }
      } catch (PDOException $e) { }
    
      unset($_POST);	
      header("Location: contact.php");      	
      ob_end_flush();	
      exit();	
    }
	
	public function loadContact($id = '') {

      try {
        if ($id == '') {
          $stmt = $this->pdo->query('SELECT * FROM coach');
          $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
          $stmt = $this->pdo->query('SELECT * FROM coach WHERE `coach_id` IN (\'' . $id . '\')');
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $stmt->closeCursor();
      } catch (PDOException $e) { }
    return $row;
  }

  public function delImageContact($id) {

    try{

      $file = $this->pdo->query('SELECT `coach_img` FROM `coach` WHERE `coach_id` IN (\''.$id.'\')');		  
      $row = $file->fetch(PDO::FETCH_ASSOC);
      $file->closeCursor();
      $fileToDelete = $row['coach_img'];	  
      $this->pdo->exec('UPDATE `coach` SET `coach_img`= ""  WHERE  `coach_id` IN (\''.$id.'\')');

      $katalog ="img/coach/";
      if (file_exists($katalog.$fileToDelete))
      {unlink($katalog.$fileToDelete); }	
    }
    catch(PDOException $e){}

    unset($_POST);
    header('Location: contact.php?id='.$id);      	
    ob_end_flush();	
    exit();
  }
}