<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ . "/vendor/autoload.php";

$entityManager = \Model\Doctrine::getInstance()->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);

class Registry
{ 
  private $services = array();  
  private static $instance;  
  private function __Construct() {}  
  public function get($key) {  
    return $this->services[$key]; 
  }  
  public function add($key, $callBack) 
  {  
    array_push($this->services, $key);    
    $this->services[$key] = $callBack; 
  }  
  
  public function remove() 
  {  
    unset($this->services[$key]); 
  }  
  
  public static function getInstance()    
  {        
    if (is_null(self::$instance)) {            
      self::$instance = new Registry();        
    }        
    
    return self::$instance;    
  }
}

class A
{ 
  private static $instance;  
  private function __Construct() {}  
  public function getRegistry() 
  {  
    return Registry::getInstance(); 
  }     
  
  public static function getInstance()    
  {        
    if (is_null(self::$instance)) {           
      self::$instance = new A();        
    }        
    
    return self::$instance;    
  }
}

class B
{ 
  public function show($x, $y) 
  {  
    echo $x + $y; 
  }
}

$app = A::getInstance();

$app->getRegistry()->add('message', function($name) { 
  echo $name;
});

$rB = $app->getRegistry()->get('message')('fff');
