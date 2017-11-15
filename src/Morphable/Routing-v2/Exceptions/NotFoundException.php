<?php

namespace Morphable\Routing\Exceptions;

use Exception;

class NotFoundException extends Exception {
  
  public function run () {
    header('Content-type: application/json');
    echo json_encode([
      'code' => 404,
      'message' => $this->getMessage()
    ]);
    die;
  }

}
