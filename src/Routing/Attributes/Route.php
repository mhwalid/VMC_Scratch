<?php

namespace App\Routing\Attributes;

use Attribute;

#[Attribute()]
class Route {
    private string $name;
    private string $path;
    private string $httpMethods;

    public function __construct( string $path,
                                 string $httpMethod = 'GET',
                                 string $name = 'default')
    {
       $this->path  = $path;
       $this->httpMethods = $httpMethod;
       $this->name = $name;
    }

    /**
     * @return string
     */
    public function getHttpMethods(): string
    {
        return $this->httpMethods;
    }

    /**
     * @param string $httpMethods
     */
    public function setHttpMethods(string $httpMethods): void
    {
        $this->httpMethods = $httpMethods;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }


}