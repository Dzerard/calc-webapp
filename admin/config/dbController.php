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
          'name' => 'calc'
      ],
      'prod' => [
          'host' => '',
          'user' => '',
          'pass' => '',
          'name' => ''
      ],
      'master' => [
          'host' => 'localhost',
          'user' => 'lukaszg1_calc',
          'pass' => 'admin',
          'name' => 'lukaszg1_calc'
      ]
  ];

  private function __construct() {

  }

  private function __clone() {

  }

  public static function getInstance() {
    if (self::$instance === null) {
      self::$instance = new dbController();
    }
    return self::$instance;
  }

  public function setConnection() {

    $env = $GLOBALS['appConfiguration']['db'];
    $this->env = $this->config[$env];
    $this->dbConnection = new PDO('mysql:host=' . $this->env['host'] . ';dbname=' . $this->env['name'], $this->env['user'], $this->env['pass']);
    $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $this->dbConnection;
  }

}
