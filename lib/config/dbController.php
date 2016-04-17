<?php

class dbController {	
  
  private static $instance;
  protected $env;
  protected $dbConnection;
  protected $config = [
    'dev' => [
      'host' => 'localhost',
      'user' => 'root',
      'pass' => 'admin',
      'name' => 'malytram_admin'
    ],
    'prod' => [
      'host' => 'localhost',
      'user' => 'dragonsu_admin',
      'pass' => 'wasko87',
      'name' => 'dragonsu_admin'
    ]      
  ];

  private function __construct() {}
  private function __clone() {}
  
  public static function getInstance() {
    if(self::$instance === null) {
      self::$instance = new dbController();
    }
    return self::$instance;
  }    
  public function setConnection() {
    
    $env = $GLOBALS['appConfiguration']['db'];
    $this->env = $this->config[$env];
    $this->dbConnection = new PDO('mysql:host='.$this->env['host'].';dbname='.$this->env['name'], $this->env['user'], $this->env['pass']);			  
    $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $this->dbConnection;
  }
}