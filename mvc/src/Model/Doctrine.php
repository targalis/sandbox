<?php
namespace Model;

use Zanra\Framework\Application\Application;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Doctrine
{
  private static $_instance = null;
  
  private $entityManager;
  
  private function __Construct()
  {
    $application = Application::getInstance();
    $application->loadConfig('mvc/config/resources.ini');

    $resources = $application->getResources();
    $paths = array('mvc/src/Entity');
    $isDevMode = false;
    
    // the connection configuration
    $dbParams = array(
      'driver'   => $resources->database->driver,
      'host'     => $resources->database->host,
      'user'     => $resources->database->user,
      'password' => $resources->database->password,
      'dbname'   => $resources->database->name,
    );

    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
    $this->entityManager = EntityManager::create($dbParams, $config);
  }
  
  public function getEntityManager() 
  {
    return $this->entityManager;
  }
  
  public static function getInstance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new Doctrine();
    }
  
    return self::$_instance;
  }
}