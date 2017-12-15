<?php

namespace Morphable\Routing\Exceptions;

use Exception;

class NotAllowedException extends Exception {
  
  public function response ($res) {
    $res->status(403);
    $res->json([
      'Status' => 403,
      'Error' => $this->getMessage()
    ]);
  }

}
