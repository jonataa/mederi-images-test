<?php

namespace Mederi;

class Application
{

  protected $routes = [];

  public function setRoutes($routes)
  {
    $this->routes = $routes;
  }

  public function dispatch($method, $uri)
  {    
    if (! isset($this->routes[$method][$uri]))
      throw new NotFoundException('Página não encontrada!');

    if (! is_callable($this->routes[$method][$uri]))
      throw new ExceptionBase("Função callback inválida!");
      
    return call_user_func($this->routes[$method][$uri]);
  }

}