<?php

namespace App\Api;

use App\Api\Attributes\Api;
use ReflectionClass;
use ReflectionMethod;

class ApiGenerator {

    public function __construct()
    {

    }

    /**
     * @throws \ReflectionException
     */
    public function generateApi() {
        // Entity ou l'on veut generer une api
        $tabEntity = $this->getEntityWithAttributesApi();

        $className = 'UserApi';
        $nameSpace = 'App\ApiController';
        $code = <<<EX
<?php 
namespace $nameSpace;

class $className {
    private $db;
    private $requestMethod;
    private $userId;

    public function run() {
      echo '$className<br>';  
    }

    public function __call($name, $args ) {
        $args=implode(",",$args);
        echo "$name ($args)<br>";
    }
}EX;

        file_put_contents(__DIR__  . '\\..\\ApiController\\' .  $className . '.php' , $code);
    }


    /**
     * @return array Tableau des
     * @throws \ReflectionException
     */
    private function getEntityWithAttributesApi(): array {
        $files = array_slice(scandir(__DIR__ . '/../Entity') , 2);
        $entityNameSpace = "App\\Entity\\";
        $tabArgumentName = [];

        // Parcours nos fichiers
        foreach ($files as $file) {
            // Convetion des fichiers en fqcn
            $fqcn = $entityNameSpace . pathinfo($file, PATHINFO_FILENAME);
            $reflection = new ReflectionClass($fqcn);
            // Lecture des attributs API des entity
            $attributes = $reflection->getAttributes(Api::class);
            foreach ($attributes as $attribute) {
                /** @var Api */
                $api = $attribute->newInstance();
                $tabArgumentName[$fqcn] = $api->getPath();
            }
        }

        return $tabArgumentName;
    }

   
}
