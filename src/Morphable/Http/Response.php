<?php

namespace Morphable\Http;

class Response implements Interfaces\Response {

  public function redirect ($url) {
    $this->status(301);
    header('Location: ' . $url);
    exit;
  }

  public function status ($code) {
    return http_response_code($code);
  }

  public function header ($type, $value) {
    return header("$type: $value");
  }

  public function json (Array $json) {
    $this->header('Content-type', 'application/json');
    echo json_encode($json);
    exit;
  }

  public function back () {
    $this->redirect($_SESSION['previous_url']);
  }

}
