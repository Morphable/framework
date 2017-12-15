<?php

namespace Morphable\Routing\Exceptions;

use Exception;

class BadRequestException extends Exception {
  
  public function response ($res) {
    $res->status(400);
    $res->json([
      'Status' => 400,
      'Error' => $this->getMessage()
    ]);
  }

}
