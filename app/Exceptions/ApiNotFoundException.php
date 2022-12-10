<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Exception;

class ApiNotFoundException extends Exception
{
    public function render()
    {
        //$this->renderable(function (NotFoundHttpException $e, $request) {});
    }
}
