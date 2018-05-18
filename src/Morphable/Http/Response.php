<?php

namespace Morphable\Http;

class Response implements Interfaces\Response {

  public function redirect ($url) {
    $this->status(301);
    header('Location: ' . $url);
  }

  public function status ($code) {
    return http_response_code($code);
  }

  public function header ($type, $value) {
    return header("$type: $value");
  }

  public function json ($json) {
    $this->header('Content-type', 'application/json');
    echo json_encode($json);
  }

  public function xml($xml)
  {
    $this->header('Content-type', 'application/xml');
    echo $xml;
  }

  public function back () {
    $fullUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    if ($fullUrl != $_SESSION['framework']['previous_url'])
    {
      $this->redirect($_SESSION['framework']['previous_url']);
    }
  }

}
