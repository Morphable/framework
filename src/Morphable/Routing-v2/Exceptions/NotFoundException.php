<?php

namespace Morphable\Routing\Exceptions;

use Exception;

class NotFoundException extends Exception {
  
  public function response ($res) {
    $res->status(404);
    $res->json([
      'Status' => 404,
      'Error' => $this->getMessage()
    ]);
  }

}
