<?php

namespace Morphable\Routing\Dispatchers;

use Morphable\Routing\Interfaces;
use Morphable\Routing\Middleware;
use Morphable\Helper;
use Morphable\Http;

class RouteDispatcher implements Interfaces\RouteDispatcher {
  
  public $route;
  public $params;
  public $requestParams;

  public function __construct ($requestParams, $route) {
    $this->route = $route;
    $this->requestParams = $requestParams;
    $this->params = $this->routeToParams();
    $this->params = $this->buildMatchParams();
    
    return $this;
  }

  public function routeToParams () {
    return Helper::explodeUrl($this->route->route);
  }

  public function setValueParam ($key) {
    return isset($this->requestParams[$key]) ? $this->requestParams[$key] : null;
  }

  public function requestUrlTooLong () {
    if (count($this->requestParams) > count($this->params)) {
      return true;
    }

    return false;
  }

  public function buildMatchParams () {
    $params = $this->params;
    $result = [];

    foreach ($params as $key => $value) {
      switch ($value[0]) {
        case ':':
          $result[] = [
            'required' => true,
            'match' => false,
            'value' => $this->setValueParam($key),
            'param' => substr($value, 1)
          ];
          break;
        case '?':
          $result[] = [
            'required' => false,
            'match' => false,
            'value' => $this->setValueParam($key),
            'param' => substr($value, 1)
          ];
          break;
        default:
          $result[] = [
            'required' => true,
            'match' => true,
            'value' => $this->setValueParam($key),
            'param' => $value
          ];
          break;
      }
    }

    return $result;
  }

  public function getParams () {
    $params = [];
    foreach ($this->params as $param) {
      if (!$param['match']) {
        $params[$param['param']] = $param['value'];
      }
    }

    return $params;
  }

  public function dispatch ($handler) {
    if ($this->match()) {
      $request = new Http\Request();
      $response = new Http\Response();
      $request->setParams($this->getParams());

      $this->executeMiddleware($request, $response);
      $handler($request, $response);

      $_SESSION['previous_url'] = Helper::currentUrl();
      die;
    }
  }

  public function match () {
    $success = true;
    
    if ($this->requestUrlTooLong()) $success = false;

    foreach ($this->params as $param) {

      if ($param['required']) {
        if ($param['value'] == null) {
          $success = false;
          break;
        }
      }

      if ($param['match']) {
        if ($param['value'] != $param['param']) {
          $success = false;
          break;
        }
      }
    }

    return $success;
  }

  public function executeMiddleware ($req, $res) {
    Middleware::exec($this->route->middleware, $req, $res);
  }

}
